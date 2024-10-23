<?php

/**
 * Provides a form to use to query the database.
 *
 * @author Mark Slater
 */
include_once 'lib/class_input.php';
include_once 'lib/class_DB.php';

class querySummary extends input
{
    /**
     * Dictionary of application names with their IDs
     * @var array
     */
    protected $applications;
    
    /**
     * List of client server names to be used when updating the database.
     * @var array
     */
    protected $clientservers;
    
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
     * List of database names to be used when updating the database.
     * @var array
     */
    protected $dbnames;
    
    /**
     * List of database server names to be used when updating the database.
     * @var array
     */
    protected $dbservers;
    
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
    protected $input;
    
    /**
     * If true display only the latest version
     * @var bool
     */
    protected $latest;

    /**
     * List of marval references to be put in select form. Here the ID and the
     * value are the same as there is not a separate database table for marval
     * references.
     * @var array
     */
    protected $marvalReferences;
    
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
     * Array of dictionary of release statuses in the format
     *     array[0]['ID'] => n, ['Status'] => status value
     * @var array
     */
    protected $releaseStatus;
    
    /**
     * Array of release teams indexed by ID in the format:
     *  array[0]['ID'] = 1, ['ReleaseTeam'] => 'Application Support'
     * @var array
     */
    protected $releaseTeam;
    
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
        (bool) $this->post = false; 
        (array) $this->cols = ['AppName', 'AppVersion', 'MarvalReference', 
            'PreferredDate', 'DateDeployed', 'Status', 'EnvName', 'DBserver', 
            'ClientServer', 'DatabaseName', 'Duration'];
        (array) $this->tables = ['tbl_Application', 'tbl_DeploymentSummary', 
            'tbl_DeploymentEnvironment', 'tbl_Environment', 'tbl_ReleaseStatus',
            'tbl_DBserver', 'tbl_ClientServer', 'tbl_DatabaseName'];
        $this->openDB();
        $this->applications = $this->getIDs(['ID', 'AppName'], 'tbl_Application');
        $this->clientservers = $this->getIDs(['ID', 'ClientServer'], 'tbl_ClientServer');
        $this->dbnames = $this->getIDs(['ID', 'DatabaseName'], 'tbl_DatabaseName');
        $this->dbservers = $this->getIDs(['ID', 'DBserver'], 'tbl_DBserver');
        $this->environments = $this->getIDs(['ID', 'EnvName'], 'tbl_Environment');
        $this->releaseStatus = $this->getIDs(['ID', 'Status'], 'tbl_ReleaseStatus');
        $this->releaseTeam = $this->getIDs(['ID', 'ReleaseTeam'], 'tbl_ReleaseTeam');
        $this->getMarvalReferences();
        
    }
    
    /**
     * Validates fields supplied and returns a where string to use in the query.
     * @return string the where string to use for the select statement
     */
    protected function constructWhereStatement() 
    {
        (string) $where = 'tbl_Application.ID = tbl_DeploymentSummary.AppID and'
                . ' DeploymentID = tbl_DeploymentSummary.ID and '
                . 'tbl_Environment.ID = EnvID and '
                . 'StatusID = tbl_ReleaseStatus.ID and '
                . 'tbl_DBserver.ID = DBServerID and '
                . 'tbl_ClientServer.ID = ClientServerID and '
                . 'tbl_DatabaseName.ID = DatabaseNameID';
        
        $this->input = $this->getInputs();

        $where .= $this->refineWhereStatement('Application_Name', 'tbl_Application.ID', 'int');
        $where .= $this->refineWhereStatement('Application_Version', 'AppVersion', 'str');
        $where .= $this->refineWhereStatement('Environment_Name', 'EnvID', 'int');
        $where .= $this->refineWhereStatement('Marval_Number', 'MarvalReference', 'str');
        $where .= $this->refineWhereStatement('Status', 'StatusID', 'int');
        $where .= $this->refineWhereStatement('Created_After', 'PreferredDate', 'date');
        $where .= $this->refineWhereStatement('Created_Before', 'PreferredDate', 'date', false);
        $where .= $this->refineWhereStatement('Deployed_After', 'DateDeployed', 'date');
        $where .= $this->refineWhereStatement('Deployed_Before', 'DateDeployed', 'date', false);
        
        return $where;
    }
    
    /**
     * This will create additional values to add to the where statement for the
     * database search.
     * @param string $field the value of the key returned from the form in 
     *               $this->input
     * @param string $column the value of the database column to be compared 
     *               with the input key value
     * @param string $type the type of value expected in $this->input[$field] 
     *               it can be either 'int', 'date' or 'str'
     * @param bool $after Only used when $type = 'date' if true will do > check
     *                    if false will do < check.
     * @return string additional clauses to add to the SQL WHERE statement.
     */
    protected function refineWhereStatement(string $field, string $column, 
            string $type, bool $after = TRUE)
    {
        (string) $where = '';
        (string) $validator = '=';
        (string) $suffix = '';
        
        if ($type == 'str') {
            $validator = " like '";
            $suffix = "'";
        } elseif ($type == 'date') {
            if ($after) {
                $validator = " > '";
                $suffix = "'";
            } else {
                $validator = " < '";
                $suffix = "'";
            }
        }
        
        if (isset($this->input[$field]) && $this->input[$field] != '') {
            $where .= " and " . $column . $validator . 
                    $this->convertWildCards($this->input[$field]) . $suffix;
        } 
        
        return $where;
    }

    /**
     * This will take the input string and check for any occurrences * with %
     * @param string $input the input string to validate / replace
     * @return string input string with any * replaced with %
     */
    protected function convertWildCards(string $input)
    {
        (int) $stringLen = strlen($input);
        (string) $output = $input;
        
        for((int) $ind = 0; $ind < $stringLen; $ind++) {
            if ($output[$ind] == '*') {
                $output[$ind] = '%';
            }
        }
        
        return $output;
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
     * This will extract unique list of marval reference values to insert into
     * drop down select field in form.
     */
    protected function getMarvalReferences()
    {
        (string) $column = 'MarvalReference';
        (string) $where = NULL;
        (string) $orderBy = $column;
        (bool) $distinct = true;
        
        $this->db->runSelect($column, 'tbl_DeploymentSummary', $where, $orderBy, 
                $distinct);
        (array) $rows = $this->db->getRows();
        
        /*
         * Construct array where -
         * 'ID' = marval number and 'MarvalReference' = marval number too.
         * So can be added to select form and still input into select statement
         * as database does not contain a table for just marval numbers
         */
        (int) $ind = 1;
        $this->marvalReferences[0] = ['ID' => '', 'MarvalReference' => ''];
        foreach ($rows as $row) {
            $this->marvalReferences[$ind] = [
                'ID' => $row['MarvalReference'], 
                'MarvalReference' => $row['MarvalReference']
                    ];
            $ind++;
        }
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
     * Extracts the id and value from the database and returns in a list of dictionaries
     * @param array $cols columns to extract from the database
     * @param string $table table to extract from
     * @param string $orderBy use this to order the database selection if null order by the ID number.
     * @return array list of dictionary array extracted.
     */
    protected function getIDs(array $cols, string $table, string $orderBy = null)
    {
        /* get list of primary domains */
        if ($orderBy != null) {
            $this->db->runSelect($cols, $table, NULL, $orderBy);
        } else {
            $this->db->runSelect($cols, $table, NULL, $cols[1]);
        }

        /* extract rows from database */
        $ids = $this->db->getRows();

        /* reset the rows */
        $this->db->resetRows();
        (array) $return_array[0] = [$cols[0] => '', $cols[1] => ''];
        
        /* add blank field at the start */
        for ((int) $ind = 0; $ind < count($ids); $ind++) {
            $return_array[$ind + 1] = $ids[$ind];
        } 
        return $return_array;
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
     * Prints the header for the form based upon the method used to supply it.
     * @param string $title the title to display at the top of the page.
     */
    protected function printFormHeader() 
    {
        (string) $class='class="summary">';
        if ($this->post) {
            echo '<form method="POST" ' . $class;  
        } else {
            echo '<form method="GET" ' . $class;
        }
    }
}
