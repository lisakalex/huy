<?php

/**
 * Provides a form to use to query the database.
 *
 * @author Mark Slater
 */
include_once 'lib/class_input.php';
include_once 'lib/class_DB.php';

class reporting extends input
{
    /**
     * Dictionary of application names with their IDs
     * @var array
     */
    protected $applications;
    /**
     * List of columns to extract from the database.
     * @var array
     */
    protected $cols;
    /**
     * Link to the database object
     * @var object
     */
    protected $db;
    
    /**
     * Whether to show the sql statement or not.
     * @var boolean
     */
    protected $debug;

    /**
     * Whether the query should show all results or remove duplicates.
     * @var boolean
     */
    protected $distinct;
    
    /**
     * List of environments to be provided in the select for the form.
     * @var array
     */
    protected $environments;
    
    /**
     * The values input from the form
     * @var array
     */
    protected $inputs;
    
    /**
     * If true display only the latest version
     * @var bool
     */
    protected $latest;

    /**
     * Whether the form is in GET or POST mode
     * @var boolean
     */
    protected $post;
    
    /**
     * Message detailing the details of the query to be displayed if nothing found.
     * @var string
     */
    protected $queryMessage;

    /**
     * A list of tables to use in the query.
     * @var array
     */
    protected $tables;
    
    /**
     * list of error messages to display back to user.
     * @var string
     */
    protected $warnings;
    

    /**
     * Sets up the variables and structure of the form.
     */
    public function __construct(bool $debug = FALSE) 
    {
        (string) $this->warnings = "";
        (bool) $this->debug = $debug;
        (bool) $this->distinct = TRUE;
        (bool) $this->post = TRUE; 
        (array) $this->cols =  ['AppName', 'AppVersion', 'EnvName', 'MarvalReference', 'DeployDate'];
        (array) $this->tables = ['tbl_Application', 'tbl_AppDeployment', 'tbl_Environment'];
        $this->openDB();
        $this->getNames();
        $this->constructForm();
    }
    
    /**
     * Sets up the fields needed for the form.
     */
    protected function constructForm() 
    {
        (bool) $readOnly = False;
        (string) $class = 'dashboard-input';
        (string) $selectClass = 'dashboard-report-';
        (string) $resetButtonClass = 'report-reset-button';
        (string) $searchButtonClass = 'report-search-button';
        $this->setString('Application Name', $readOnly, $selectClass . 'left', 24 );
        $this->setHeader('Application_Name');
        $this->setString('Environment Name', $readOnly, $selectClass . 'right', 16 );
        $this->setHeader('Environment_Name');
        $this->setString('Application Version', $readOnly, $class, 24);
        $this->setHeader('Application_Version');
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
     * 
     * 
     * select DISTINCT AppName, AppVersion, EnvName, MarvalReference, DeployDate 
     * from tbl_AppDeployment, tbl_Application, tbl_Environment 
     * where tbl_Application.ID = AppID and tbl_Environment.ID = EnvID;
     * 
     * TODO put values into an array keyed by CompName value = 
     */
    protected function constructWhereStatement() 
    {
        (string) $where = 'tbl_Application.ID = AppID and tbl_Environment.ID = EnvID';
        if ($this->inputs['Application_Name'] != null) {
            $where .= " AND AppName like '" . 
                    $this->convertWildCards($this->inputs['Application_Name']) . "'";
        }
        
        if ($this->inputs['Environment_Name'] != null) {
            $where .= " AND EnvName like '" . 
            $this->convertWildCards($this->inputs['Environment_Name']) . "'";
        }
        
        if ($this->inputs['Application_Version'] != null) {
            $where .= " AND AppVersion like '" .
            $this->convertWildCards($this->inputs['Application_Version']) . "'";
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
     * This will loop through the array of application names by id and return the application name that matches the id provided.
     * @param int $id the ID of the application as it appears in the database table tbl_Application
     * @return stringthe name of the application found or null string if none found.
     */
    protected function getApplicationName($id) 
    {
        foreach ($this->applications as $row) {
            if ($row['ID'] == $id) {
                return $row['AppName'];
            }
        }
        return '';
    }
    
    /**
     * This will loop through the array of environment names by id and return the environment name that matches the id provided.
     * @param int $id the ID of the environment as it appears in the database table tbl_Environment
     */
    protected function getEnvironmentName($id)
    {
        if ($id == '') {
            return 'all environments';
        }
        foreach ($this->environments as $row) {
            if ($row['ID'] == $id) {
                return 'environment ' . $row['EnvName'];
            }
        }
        return 'unknown environment';
    }
    
    /**
     * Extract the list of environment names and store in value to be used in the select field.
     */
    protected function getNames()
    {
        $where = NULL;
        (bool) $quiet = TRUE;
        
        $this->db->runSelect(['ID', 'EnvName'], 'tbl_Environment', $where, 
                'EnvName', $this->distinct, $this->debug, $quiet);
        $this->environments = $this->populateDropDownLists();
        $this->db->resetRows();
        
        $this->db->runSelect(['ID', 'AppName'], 'tbl_Application', $where, 
                'AppName', $this->distinct, $this->debug, $quiet);
        # allow for blank selects on dropdowns i.e. everything
        $this->applications = $this->populateDropDownLists();       
    }
            
    /**
     * Creates an array of items to put in the drop down list read from the 
     * database query.
     * @return array of items used to populate the drop down list
     */
    protected function populateDropDownLists() 
    {
        (int) $ind = 0;
        (array) $dropdownList[0] = ['' => 0];
        foreach ($this->db->getRows() as $row) {
            $ind++;
            $dropdownList[$ind] = $row;
        }
        
        return $dropdownList;
    }
    /**
     * This will return the contents of the form.
     * @return array
     */
    protected function getInputs() 
    {
        if ($this->post) {
            return $this->POST();
        } else {
            return $this->GET();
        }
    }
    
    /**
     * Opens the database connection and sets into a variable to use when querying.
     */
    protected function openDB()
    {
        $this->db = new DB();
    }
    
    /**
     * Displays the form.
     */
    public function printForm() 
    {
        $this->inputs = $this->getInputs();
        $this->printFormHeader();
        if (!isset($this->inputs) || (isset($this->inputs) && count($this->inputs) == 0) || 
           (isset($this->inputs['Reset']) && $this->inputs['Reset'] == 'Reset')) {
            $this->printBlank();
            echo '</form>';

        } else {
            $this->inputs['Search'] = '';
            $this->printInputs($this->inputs);
            (string) $where = $this->constructWhereStatement();
            (string) $orderByDate = 'DeployDate DESC';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, 
                    $orderByDate, $this->distinct, $this->debug, TRUE);
            (array) $rows = $this->db->getRows();
            echo '</form>';
            $this->printResult($rows);
        }
    }
    
    /**
     * Prints the header for the form based upon the method used to supply it.
     */
    protected function printFormHeader() 
    {
        if ($this->post) {
            echo '<form method="POST">';  
        } else {
            echo '<form method="GET">';
        }
    }
    
    /**
     * Will print a grid of results or a message saying no data found if the rows array supplied is empty.
     * @param array $rows the rows returned from the database query.
     */
    protected function printResult(array $rows) 
    {
        (array) $lines = [];
        
        if (count($rows) > 0) {
            if ($this->latest) {
                $lines = $this->getLatestVersions($rows);
            } else {
                $lines = $rows;
            }
        }
        if (count($rows) > 0) {
            
            $this->printTable($rows);
            echo "</div>\n";
            
            if (isset($this->warnings) && $this->warnings != '') {
                echo $this->warnings;
            }
        } else {
            echo '<p class="danger">No rows returned for Query' 
                    . $this->queryMessage . ' for ' . 
                    $this->getEnvironmentName($this->inputs['Environment_Name']) 
                    . '</p>';
        }
    }
    
    /**
     * This loops through each row and provides the grid table output in correct key order to make use of the grid template for this table.
     * @param array $rows list of rows returned from database query in the format array([0] array('AppName' => value, etc) 
     */
    protected function printTable(array $rows) 
    {
        $this->printTableHeader();
        (boolean) $odd = FALSE;
        (string) $end = "</span>\n";
        (array) $keys = ['AppName', 'AppVersion', 'EnvName', 'MarvalReference', 'DeployDate'];
        
        foreach ($rows as $row) {
            if ($odd) {
                (string) $span = '<span class="odd">';
                $odd = FALSE;
            } else {
                (string) $span = '<span>';
                $odd = TRUE;
            }
            
            foreach ($keys as $key) {
                echo $span . $row[$key] . $end;
            }
        }
    }
    
    /**
     * prints the header for the grid table to be displayed
     */
    protected function printTableHeader()
    {
        echo '<div class="grid-report-table">' . "\n";
        echo '<span class="table-title">Report of Applications Deployed</span>
                <span class="table-header">Application Name</span>
                <span class="table-header">Version</span>
                <span class="table-header">Environment</span>
                <span class="table-header">Marval Reference</span>
                <span class="table-header">Deployed on</span>';
    }
    
    /**
     * This will check the list of rows extracted from the database and return only the latest versions of them.
     * @param array $rows the list of components extracted from the database
     * @return array list of components extracted from the database with the latest versions only.
     */
    protected function getLatestVersions(array $rows)
    {
        (array) $lines = [];
        (array) $AppVersion = [];
        (array) $AppName = [];
        (array) $DeployDate = [];
        
        foreach ($rows as $row) {
            (string) $compName = $row['CompName'];
            (string) $version = $row['AppVersion'];

            if (!isset($AppVersion[$compName]) || 
                    (isset($AppVersion[$compName]) && $AppVersion[$compName] < $version)) {
                $AppVersion[$compName] = $version;
                $AppName[$compName] = $row['AppName'];
                $DeployDate[$compName] = $row['DeployDate'];
            } 
        }
        
        (int) $ind = 0;
        foreach ($AppName as $compName => $name) {
            $lines[$ind] = array('AppName' => $name, 'CompName' => $compName, 
                'AppVersion' => $AppVersion[$compName], 'EnvName' => $row[0]['EnvName'], 
                'Type' => $row[0]['Type'], 'DeployDate' => $DeployDate[$compName] );
            $ind++;
        }
        
        return $lines;
    }
}
