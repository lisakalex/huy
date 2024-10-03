<?php

/**
 * Provides a form to use to query the database to determine the contents of a 
 * consolidate release.
 *
 * @author Mark Slater
 */
include_once 'lib/class_query.php';

class consolidate extends query
{
    /**
     * Initialise the variables used for the class. Note these are all inherited from the class query.
     * @param bool $debug if set to TRUE this will display the sql queries used.
     */
    public function __construct(bool $debug = FALSE)
    {
        (bool) $this->debug = $debug;
        (bool) $this->post = TRUE;
        (array) $this->cols = ['AppName', 'CompName', 'AppVersion', 'DeployDate'];
        (array) $this->tables = ['tbl_Component', 'tbl_AppDeployment', 
            'tbl_Environment', 'tbl_CompDeployment', 'tbl_Application'];
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
        (string) $selectClass = 'dashboard-select-';
        (string) $resetButtonClass = 'reset-button';
        (string) $searchButtonClass = 'search-button';
        $this->setSelect('Application Name', $this->applications, ['ID', 'AppName'], $selectClass . 'left');
        $this->setSelect('Environment Name', $this->environments, ['ID', 'EnvName'], $selectClass . 'right');
        $this->setString('Start Version', $readOnly, $class, 24);
        $this->setHeader('Start_Version');
        $this->setString('End Version', $readOnly, $class, 24);
        $this->setHeader('End_Version');
        $this->setString('Deployed After', $readOnly, $class, 24, 'datepicker');
        $this->setHeader('Deployed_After');
        $this->setString('Deployed Before', $readOnly, $class, 24, 'datepicker2');
        $this->setHeader('Deployed_Before');
        $this->setButton('Reset', $resetButtonClass);
        $this->setButton('Search', $searchButtonClass);
    }
    
    /**
     * This displays the form in the web page. If no input variables found then a blank form is shown.
     * Otherwise a table of the findings are shown at the bottom of the form.
     */
    public function printConsolidatedForm()
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
            (string) $where = $this->constructWhereStatement();
            (string) $orderByDateAndComp = 'DeployDate DESC, CompName';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, 
                    $orderByDateAndComp, $this->distinct, $this->debug, TRUE);
            (array) $rows = $this->db->getRows();
            echo '</form>';
            $this->printResults($rows);
        }
    }
    
    /**
     * Produces a grid table with the details of AppName, CompName, Latest Version and Date Deployed
     * @param array $rows the list of rows to be displayed in table format. This is a list of keyed arrays.
     * @param boolean $allApplications If set to true this will include the application name column in the table output.
     */
    protected function printAllRows(array $rows, bool $allApplications = FALSE) 
    {
        (boolean) $odd = FALSE;
        (string) $end = "</span>\n";
        (array) $keys = ['AppVersion', 'DeployDate'];
        
        foreach ($rows as $row) {
            if ($odd) {
                (string) $span = '<span class="odd">';
                (string) $appSpan = '<span class="odd left">';
                $odd = FALSE;
            } else {
                (string) $span = '<span>';
                (string) $appSpan = '<span class="left">';
                $odd = TRUE;
            }
            if ($allApplications) {
                echo $span . $row['AppName'] . $end;
            }
            
            echo $appSpan . $row['CompName'] . $end;
            
            foreach ($keys as $key) {
                echo $span . $row[$key] . $end;
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
        (string) $title = 'Latest Components for Release of ';
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
        
        $this->printConsolidatedTable($rows, $allApplications, $title);   
    }
    
    /**
     * This prints the table of components and release dates found.
     * @param array $rows the rows extracted from the database query
     * @param bool $allApplications whether all applications are included in the db query
     * @param string $title the title to display on the top of the table.
     */
    protected function printConsolidatedTable(array $rows, bool $allApplications, string $title) 
    {
        (array) $tidiedRows = [];
        
        if (count($rows) > 0) {
            $this->printConsolidatedTableHeader($allApplications, $title);
            $tidiedRows = $this->removeDuplicateRows($rows, $allApplications);
            $this->printAllRows($tidiedRows, $allApplications);
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
     * @param bool $allApplications whether to display the list of all applications or not.
     * @param string $title the table title
     */
    protected function printConsolidatedTableHeader(bool $allApplications, string $title)
    {
        if ($allApplications) {
            echo '<div class="grid-apps-table">' . "\n";
            echo '<span class="table-title">Latest Components for Release of all Applications</span>
                <span class="table-header">Application Name</span>
                <span class="table-header">Component Name</span>
                <span class="table-header">Latest Version</span>
                <span class="table-header">Date Deployed</span>';
        }
        else {
            echo '<div class="grid-comp-table">' . "\n";
            echo '<span class="table-title">' . $title . '</span>
                <span class="table-header">Component Name</span>
                <span class="table-header">Latest Version</span>
                <span class="table-header">Date Deployed</span>';
        }
    }
    
    /**
     * This scans through the rows returned from the database query and removes 
     * all components with the same name just leaving them with the latest version
     * for that component within the search criteria.
     * @param array $rows data returned from the database query
     * @param bool $allApplications whether all applications or just 1 application is included in the query
     * @return array the list of components and their versions, deploy dates and applications if all are specified.
     */
    protected function removeDuplicateRows(array $rows, bool $allApplications = FALSE) 
    {
        (array) $components = [];
        (array) $deployedOn = [];
        (array) $applications = [];
        
        foreach ($rows as $row) {
            $compName = $row['CompName'];
            $version = $row['AppVersion'];

            if (!isset($components[$compName]) || 
                    (isset($components[$compName]) && $components[$compName] < $version)) {
                $components[$compName] = $version;
                $deployedOn[$compName] = $row['DeployDate'];
                
                if ($allApplications) {
                    $applications[$compName] = $row['AppName'];
                }
            }
        }
           
        return $this->constructReleaseSummary($components, $allApplications, 
                $applications, $deployedOn);
    }
    
    /**
     * This goes through the lists of components, applications and deployment 
     * dates and creates a consolidated list to be used to construct the table 
     * of results.
     * @param array $components
     * @param bool $allApplications
     * @param array $applications
     * @param array $deployedOn
     * @return array of components deployed in format Array ( 
     *           [0] => Array ( [AppName] => name [CompName] => file [AppVersion] => nn.nn [DeployDate] => ccyy-mm-dd hh:mm:ss ) 
     *           [1] => Array ( [AppName] => name [CompName] => file [AppVersion] => nn.nn [DeployDate] => ccyy-mm-dd hh:mm:ss ) ) 
     */
    protected function constructReleaseSummary(array $components, bool $allApplications, array $applications, array $deployedOn)
    {
        (array) $singleRows = [];
        (int) $ind = 0;
        
        foreach ($components as $name => $version) {
            
            if ($allApplications) {
                $singleRows[$ind] = [
                    'AppName' => $applications[$name], 'CompName' => $name, 'AppVersion' => $version, 'DeployDate' => $deployedOn[$name]
                        ];
                $this->warnings = '<p class="info"><strong>Note:</strong> No value provided for '
                    . 'application name. Defaulting to all applications for '
                    . $this->getEnvironmentName($this->inputs['Environment_Name']) .'</p>';
            } else {
                $singleRows[$ind] = [
                    'CompName' => $name, 'AppVersion' => $version, 'DeployDate' => $deployedOn[$name]
                        ];
                $this->warnings = '';
            }
        
            $ind++;     
        }
        
        return $singleRows;
    }
}
