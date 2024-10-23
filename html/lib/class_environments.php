<?php

include_once 'lib/class_query.php';

/**
 * Provides a form to use to query the database to determine the list of projects deployed across the 
 * different environments.
 *
 * @author Mark Slater
 * @version 001
 * @date 28-May-2023
 */
class environments extends query
{
    /**
     * List of applications in alphabetical order to ensure display of applications is done in same order.
     * @var array
     */
    protected $applicationNames = [];

    /**
     * Dictionary of dictionaries mapping the versions deployed to different environments keyed by application 
     * name for the main key and environment name for the dictionary within the main dictionary. 
     * @var array
     */
    protected $resultsTable;

    /**
     * Initialise the variables used for the class. Note these are all inherited from the class query.
     * @param bool $debug if set to TRUE this will display the sql queries used.
     */
    public function __construct(bool $debug = FALSE)
    {
        (bool) $this->debug = $debug;
        (bool) $this->post = TRUE;
        (array) $this->cols = ['AppName', 'EnvName', 'AppVersion', 'DeployDate'];
        (array) $this->tables = ['tbl_AppDeployment', 'tbl_Environment', 'tbl_Application'];
        $this->openDB();
        $this->getNames();
        $this->constructForm();
    }
    
    /**
     * Sets up the form needed to get the details of the release search.
     */
    protected function constructForm()
    {
        (bool) $readOnly = False;
        (string) $class = 'dashboard-input';
        (string) $resetButtonClass = 'reset-button';
        (string) $searchButtonClass = 'env-search-button';
        $this->setString('Application Name', $readOnly, $class, 24);
        $this->setHeader('Application_Name');
        $this->setString('Deployed After', $readOnly, $class, 24, 'datepicker');
        $this->setHeader('Deployed_After');
        $this->setString('Deployed Before', $readOnly, $class, 24, 'datepicker2');
        $this->setHeader('Deployed_Before');
        $this->setButton('Reset', $resetButtonClass);
        $this->setButton('Search', $searchButtonClass);
    }
    
    /**
     * Validates fields supplied and returns a where string to use in the query.
     * @return string the where string to use for the select statement
     */
    protected function constructEnvironmentWhereStatement() 
    {
        (string) $where = "tbl_Environment.ID = EnvID and tbl_Application.ID = AppID";
        if ($this->inputs['Application_Name'] != null) {
            $where .= " AND AppName like '" . $this->convertWildCards($this->inputs['Application_Name'] . "'");
        } 
        
        if ($this->inputs['Deployed_After'] != null) {
            $where .= " AND DeployDate > '" . $this->inputs['Deployed_After'] . "'";
        }
        
        if ($this->inputs['Deployed_Before'] != null) {
            $where .= " AND DeployDate < '" . $this->inputs['Deployed_Before'] . "'";
        }

        return $where;
    }
    
    /**
     * Accepts the environment the application was deployed to and returns a standard key to be use to populate the
     * results table array.
     * @param string $environment - the name of the environment the application was deployed to.
     */
    protected function getEnvironmentKey(string $environment)
    {
        switch ($environment) {
            case 'DP1':
            case 'DPT1':
                return 'DP1';
            
            case 'PD1':
            case 'PP1':
            case 'PROD':
                return 'PROD';

            case 'SOST1':
            case 'TEST':
                return 'ST1';
            
            case 'SOST2':
                return 'ST2';

            case 'SOUT1':
            case 'UAT':
                return 'UT1';

            case 'SOUT2':
                return 'UT2';
            
            case 'BAST1':
            case 'ST1':
            case 'ST2':
            case 'ST3':
            case 'ST4':
            case 'UT1':
            case 'UT2':
            case 'UT4':
                return $environment;
            
            default:
                return '';
                break;
        }
    }
    
    /**
     * This displays the form in the web page. If no input variables found then a blank form is shown.
     * Otherwise a table of the findings are shown at the bottom of the form.
     */
    public function printEnvironmentsForm()
    {
        $this->inputs = $this->getInputs();
        $this->printFormHeader('Latest Versions of Application Deployments by Environment');
        
        if (!isset($this->inputs) || (isset($this->inputs) && count($this->inputs) == 0) || 
           (isset($this->inputs['Reset']) && $this->inputs['Reset'] == 'Reset')) {
            $this->printBlank();
            echo '</form>';
        } else {
            $this->inputs['Search'] = '';
            $this->printInputs($this->inputs);
            (string) $where = $this->constructEnvironmentWhereStatement();
            (string) $orderByDateAndComp = 'DeployDate DESC, AppName';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, 
                    $orderByDateAndComp, $this->distinct, $this->debug, TRUE);
            (array) $rows = $this->db->getRows();
            echo '</form>';
            $this->populateResultsArray($rows);
            $this->printResults($rows);
        }
    }
    
    /**
     * Initialise the results table array with the application name and the environments that it could be deployed to.
     * @param string $appName - the name of the application that has been applied to an environment.
     */
    protected function initialiseResultsArray(string $appName)
    {
        $this->resultsTable[$appName] = ['PROD'=> '-', 'DP1' => '-', 'UT1' => '-', 'UT2' => '-', 'UT4' => '-', 
                                         'BAST1' => '-', 'ST1' => '-', 'ST2' => '-', 'ST3' => '-', 'ST4' => '-'];
    }

    /**
     * Reads the list of rows returned from the database query and constructs a dictionary of dictionaries keyed by 
     * the application name and then by environment to show what version of an application has been deployed to each
     * environment.
     * @param array $rows - the list of rows extracted from the database for the query of all applications and their
     *                      versions and environment. This is sorted in application then date deployed order with the 
     *                      most recent deployment being the first shown.
     */
    protected function populateResultsArray(array $rows)
    {
        foreach($rows as $row)
        {
            if (!isset($this->resultsTable[$row['AppName']])) {
                $this->applicationNames[count($this->applicationNames)] = $row['AppName'];
                $this->initialiseResultsArray($row['AppName']);
            }
            
            $this->setResultsTableVersion($row['AppName'], $row['EnvName'], $row['AppVersion'], $row['DeployDate']);
        }
    }

    /**
     * Produces a grid table with the details of AppName and the versions deployed to different environments.
     */
    protected function printEnvironmentRows() 
    {
        (boolean) $odd = FALSE;
        (string) $end = "</span>\n";
        (array) $environmentKeys = ['PROD', 'DP1', 'UT1', 'UT2', 'UT4', 'BAST1', 'ST1', 'ST2', 'ST3', 'ST4'];
        sort($this->applicationNames);
        foreach ($this->applicationNames as $appName) {
            if ($odd) {
                (string) $span = '<span class="odd">';
                (string) $appSpan = '<span class="odd left">';
                $odd = FALSE;
            } else {
                (string) $span = '<span>';
                (string) $appSpan = '<span class="left">';
                $odd = TRUE;
            }
                  
            print($appSpan . $appName . $end);
            foreach ($environmentKeys as $key) {
                echo $span . $this->resultsTable[$appName][$key] . $end;
            }
        }
    }
    
    /**
     * This takes the list of components for the application(s) and constructs 
     * the title for the table then calls the method to create the table.
     * @param array $rows = the rows extracted from the database query.
     */
    protected function printResults(array $rows) 
    {
        (string) $title = 'Latest Versions Deployed for each Environment for ';
        (string) $and = '';
        (bool) $allApplications = FALSE;
        
        if (isset($this->inputs['Application_Name']) && $this->inputs['Application_Name'] != '') {
            $title .= 'Application ' . $this->getApplicationName($this->inputs['Application_Name']);           
        } else {
            $title .= "all Applications";
            $allApplications = TRUE;
        }
        
        if (isset($this->inputs['Deployed_After']) && $this->inputs['Deployed_After'] != '') {
            $title .=  ' deployed after ' . $this->inputs['Deployed_After'];
            $and = " and";
        }
        
        if (isset($this->inputs['Deployed_Before']) && $this->inputs['Deployed_Before'] != '') {
            $title .= $and . ' deployed before ' . $this->inputs['Deployed_Before'];
        }
        
        $this->printEnvTable($rows, $allApplications, $title);   
    }
    
    /**
     * This prints the table of components and release dates found.
     * @param array $rows the rows extracted from the database query
     * @param bool $allApplications whether all applications are included in the db query
     * @param string $title the title to display on the top of the table.
     */
    protected function printEnvTable(array $rows, bool $allApplications, string $title) 
    {        
        if (count($this->resultsTable) > 0) {
            $this->printEnvTableHeader($allApplications, $title);
            $this->printEnvironmentRows();
            echo "</div>\n";        
            if (isset($this->warnings) && $this->warnings != '') {
                echo $this->warnings;
            }
        } else {
            echo '<p class="danger">No rows returned for Query' 
                    . $this->queryMessage . ' for the environment ' . 
                    $this->getEnvironmentName($this->inputs['Environment_Name'])
                    . '</p>';
        }
    }
    
    /**
     * prints the header for the grid table to be displayed
     * @param string $title - the table title
     */
    protected function printEnvTableHeader(string $title)
    {
        echo '<div class="grid-environments-table">' . "\n";
        echo '<span class="table-title">Latest Components for Release of all Applications</span>
                <span class="table-header">Application Name</span>
                <span class="table-header">Prod</span>
                <span class="table-header">DP1</span>
                <span class="table-header">UT1</span>
                <span class="table-header">UT2</span>
                <span class="table-header">UT4</span>
                <span class="table-header">BAST1</span>
                <span class="table-header">ST1</span>
                <span class="table-header">ST2</span>
                <span class="table-header">ST3</span>
                <span class="table-header">ST4</span>';
    }

    /**
     * Set the version for the environment for this application in the results table if this version value has not
     * already been set.
     * @param string $appName - the name of the application the release was deployed to.
     * @param string $environment - the name of the environment this release was deployed to for this application.
     * @param string $version - the version of the release applied to this environment for this application.
     * @param string $deployed - the date this version was deployed on.
     */
    protected function setResultsTableVersion(string $appName, string $environment, string $version, string $deployed)
    {
        $key = $this->getEnvironmentKey($environment);

        if ($key != '' && $this->resultsTable[$appName][$key] == '-') {
            $this->resultsTable[$appName][$key] = $version . '<br><em>' . substr($deployed, 0, 10) . '</em>';
        }
    }
}
