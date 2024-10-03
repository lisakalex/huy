<?php

/**
 * Provides a form to use to query the database.
 *
 * @author Mark Slater
 */
include_once 'lib/class_input.php';
include_once 'lib/class_DB.php';

class query extends input
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
        (string)$this->warnings = "";
        (bool)$this->debug = $debug;
        (bool)$this->distinct = TRUE;
        (bool)$this->post = TRUE;
        (array)$this->cols = ['AppName', 'CompName', 'AppVersion', 'EnvName',
            'Type', 'DeployDate'];
        (array)$this->tables = ['tbl_Component', 'tbl_AppDeployment',
            'tbl_Environment', 'tbl_CompDeployment', 'tbl_Application'];
        $this->openDB();
        $this->getNames();
        $this->constructForm();
    }

    /**
     * Sets up the fields needed for the form.
     */
    protected function constructForm()
    {
        (bool)$readOnly = False;
        (string)$class = 'dashboard-input';
        (string)$selectClass = 'dashboard-select-';
        (string)$resetButtonClass = 'reset-button';
        (string)$searchButtonClass = 'search-button';
        $this->setSelect('Environment Name', $this->environments, ['ID', 'EnvName'], $selectClass . 'left');
        $this->setSelect('Application Name', $this->applications, ['ID', 'AppName'], $selectClass . 'right');
        $this->setString('Component Name', $readOnly, $class, 24);
        $this->setHeader('Component_Name');
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
     */
    protected function constructWhereStatement()
    {
        (string)$where = "tbl_Environment.ID = EnvID and tbl_Component.ID = CompID and "
            . "tbl_AppDeployment.ID = AppDeploymentID and AppID = tbl_Application.ID";
        if ($this->inputs['Environment_Name'] != null) {
            $where .= " AND tbl_Environment.ID = ?";
        }

        if ($this->inputs['Component_Name'] != null) {
            $where .= " AND CompName like ?";
        }

        if ($this->inputs['Application_Name'] != null) {
            $where .= " AND AppID = ?";
        }


        if ($this->inputs['Deployed_After'] != null) {
            $where .= " AND DeployDate > ?";
        }

        if ($this->inputs['Deployed_Before'] != null) {
            $where .= " AND DeployDate < ?";
        }

        if ($this->inputs['Start_Version'] != null) {
            $where .= " AND AppVersion >= ?";
        }

        if ($this->inputs['End_Version'] != null) {
            $where .= " AND AppVersion <= ?";
        }
//            (string)$where = "tbl_Environment.ID = EnvID and tbl_Component.ID = CompID and "
//            . "tbl_AppDeployment.ID = AppDeploymentID and AppID = tbl_Application.ID";
//        if ($this->inputs['Environment_Name'] != null) {
//            $where .= " AND tbl_Environment.ID = " . $this->inputs['Environment_Name'];
//        }
//
//        if ($this->inputs['Component_Name'] != null) {
//            $where .= " AND CompName like '" . $this->convertWildCards($this->inputs['Component_Name']) . "'";
//        }
//
//        if ($this->inputs['Application_Version'] != null) {
//            $where .= " AND AppVersion like '" . $this->convertWildCards($this->inputs['Application_Version']) . "'";
//        }
//
//        if ($this->inputs['Application_Name'] != null) {
//            $where .= " AND AppID=" . $this->inputs['Application_Name'];
//        }
//
//        if ($this->inputs['Deployed_After'] != null) {
//            $where .= " AND DeployDate > '" . $this->inputs['Deployed_After'] . "'";
//        }
//
//        if ($this->inputs['Deployed_Before'] != null) {
//            $where .= " AND DeployDate < '" . $this->inputs['Deployed_Before'] . "'";
//        }
//
//        if ($this->inputs['Start_Version'] != null) {
//            $where .= " AND AppVersion >= '" . $this->convertWildCards($this->inputs['Start_Version']) . "'";
//        }
//
//        if ($this->inputs['End_Version'] != null) {
//            $where .= " AND AppVersion <= '" . $this->convertWildCards($this->inputs['End_Version']) . "'";
//        }
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
        (bool)$quiet = TRUE;

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
        (int)$ind = 0;
        (array)$dropdownList[0] = ['' => 0];
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
        $this->printFormHeader('Query Component Deployments by Name');
        if (!isset($this->inputs) || (isset($this->inputs) && count($this->inputs) == 0) ||
            (isset($this->inputs['Reset']) && $this->inputs['Reset'] == 'Reset')) {
            $this->printBlank();
            echo '</form>';

        } else {
            $this->inputs['Search'] = '';
            $this->printInputs($this->inputs);
            (string)$where = $this->constructWhereStatement();
            (string)$orderByDateAndComp = 'DeployDate DESC, CompName';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, $orderByDateAndComp, $this->distinct, $this->debug, TRUE);
//            $sql = 'SELECT DISTINCT AppName, CompName, AppVersion, EnvName, Type, DeployDate FROM tbl_Component c JOIN tbl_AppDeployment ad ON c.ID = ad.AppID JOIN tbl_Environment e ON e.ID = ad.EnvID JOIN tbl_CompDeployment cd ON cd.AppDeploymentID = ad.ID JOIN tbl_Application a ON a.ID = cd.CompID WHERE e.ID = ? AND CompName LIKE ? AND AppVersion LIKE ? AND AppID = ? AND DeployDate > ? AND DeployDate < ? ORDER BY DeployDate DESC, CompName';
//            $sql = 'SELECT DISTINCT AppName,CompName,AppVersion,EnvName,Type,DeployDate FROM tbl_Component,tbl_AppDeployment,tbl_Environment,tbl_CompDeployment,tbl_Application WHERE tbl_Environment.ID = tbl_AppDeployment.EnvID and tbl_Component.ID = tbl_CompDeployment.CompID and tbl_AppDeployment.ID = tbl_CompDeployment.AppDeploymentID and tbl_AppDeployment.AppID = tbl_Application.ID AND tbl_Environment.ID = ? AND CompName like ? AND AppVersion like ? AND AppID= ? AND DeployDate > ? AND DeployDate < ? ORDER BY DeployDate DESC, CompName';
//            $sql = 'SELECT DISTINCT AppName,CompName,AppVersion,EnvName,Type,DeployDate FROM tbl_Component,tbl_AppDeployment,tbl_Environment,tbl_CompDeployment,tbl_Application WHERE tbl_Environment.ID = tbl_AppDeployment.EnvID and tbl_Component.ID = tbl_CompDeployment.CompID and tbl_AppDeployment.ID = tbl_CompDeployment.AppDeploymentID and tbl_AppDeployment.AppID = tbl_Application.ID AND tbl_Environment.ID = :id AND CompName like :copmid AND AppVersion like :appversion AND AppID= appid AND DeployDate > :deploydate AND DeployDate < :deploydate ORDER BY DeployDate DESC, CompName';

//            $dataa = [1 => intval($this->inputs['Environment_Name']), 2 =>$this->inputs['Component_Name'], 3 => $this->inputs['Application_Version'], 4 => intval($this->inputs['Application_Name']), 5 =>$this->inputs['Deployed_After'], 6 =>$this->inputs['Deployed_Before']];
//            $this->db->prepareAndRun_1($sql, $dataa);
            (array)$rows = $this->db->getRows();
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
        (array)$lines = [];

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
        (boolean)$odd = FALSE;
        (string)$end = "</span>\n";
        (array)$keys = ['AppVersion', 'EnvName', 'Type', 'DeployDate'];

        foreach ($rows as $row) {
            if ($odd) {
                (string)$span = '<span class="odd">';
                (string)$appSpan = '<span class="odd left">';
                $odd = FALSE;
            } else {
                (string)$span = '<span>';
                (string)$appSpan = '<span class="left">';
                $odd = TRUE;
            }
            echo $span . $row['AppName'] . $end;
            echo $appSpan . $row['CompName'] . $end;

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
        echo '<div class="grid-table">' . "\n";
        echo '<span class="table-title">List of Applications &amp; Components deployed by version and date</span>
                <span class="table-header">Application Name</span>
                <span class="table-header">Component Name</span>
                <span class="table-header">Version</span>
                <span class="table-header">Environment</span>
                <span class="table-header">Environment Type</span>
                <span class="table-header">Deployed on</span>';
    }

    /**
     * This will check the list of rows extracted from the database and return only the latest versions of them.
     * @param array $rows the list of components extracted from the database
     * @return array list of components extracted from the database with the latest versions only.
     */
    protected function getLatestVersions(array $rows)
    {
        (array)$lines = [];
        (array)$AppVersion = [];
        (array)$AppName = [];
        (array)$DeployDate = [];

        foreach ($rows as $row) {
            (string)$compName = $row['CompName'];
            (string)$version = $row['AppVersion'];

            if (!isset($AppVersion[$compName]) ||
                (isset($AppVersion[$compName]) && $AppVersion[$compName] < $version)) {
                $AppVersion[$compName] = $version;
                $AppName[$compName] = $row['AppName'];
                $DeployDate[$compName] = $row['DeployDate'];
            }
        }

        (int)$ind = 0;
        foreach ($AppName as $compName => $name) {
            $lines[$ind] = array('AppName' => $name, 'CompName' => $compName,
                'AppVersion' => $AppVersion[$compName], 'EnvName' => $row[0]['EnvName'],
                'Type' => $row[0]['Type'], 'DeployDate' => $DeployDate[$compName]);
            $ind++;
        }

        return $lines;
    }
}
