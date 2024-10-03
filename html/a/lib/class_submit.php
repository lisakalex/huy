<?php

/**
 * Allows update of database from a http get call.
 *
 * @author mark
 */
class submit
{
    /**
     * Dictionary of application names in format AppName => name of application ID => nn
     * @var dictionary
     */
    protected $appNames;

    /**
     * Dictionary of component names in format CompName => name of components, ID => nn
     * @var dictionary
     */
    protected $compNames;

    /**
     * Dictionary of environment names in format EnvName => name of environment, ID => nn
     * @var dictionary
     */
    protected $envNames;

    /**
     * Instance of the database connection
     * @var object
     */
    protected $db;

    /**
     * Connects to database and extracts the applications, environments and components
     */
    public function __construct()
    {
        $this->openDatabase();
        $this->getNames('AppName', 'tbl_Application');
        $this->getNames('EnvName', 'tbl_Environment');
        $this->getNames('CompName', 'tbl_Component');

        echo '<br>AppNames =';
        print_r($this->appNames);
        echo '<br>EnvNames =';
        print_r($this->envNames);
        echo '<br>CompNames =';
        print_r($this->compNames);
    }

    /**
     * This will query the application deployment table to determine if it is a new entry or an update to an existing one.
     * @param int $appID the ID from the application table of the application to be checked.
     * @param int $envID the environment ID from the environment table of the update being applied.
     * @param string $appVersion the version of the deployment.
     * @return int ID of the application deployment table to update.
     */
    protected function getAppDeployID(int $appID, int $envID, string $appVersion)
    {
        (int)$id = 0;
        $this->db->resetRows();
        $this->db->runSelect(['ID', 'AppID', 'EnvID', 'AppVersion'], 'tbl_AppDeployment');
        (array)$rows = $this->db->getRows();
        /* check for latest ID */
        (int)$highestID = 0;
        echo '<br>submit::getAppDeployID rows returned = <br>';
        print_r($rows);
        /* check if we already have a release for this application + environment + version */
        foreach ($rows as $row) {
            echo '<br>Checking if row[AppID]' . $row['AppID'] . ' = ' . $appID .
                ' and row[EnvID] ' . $row['EnvID'] . ' = ' . $envID .
                ' and row[AppVerision] ' . $row['AppVersion'] . ' = ' . $appVersion;
            if ($row['AppID'] == $appID && $row['EnvID'] == $envID &&
                $row['AppVersion'] == $appVersion) {
                echo '<br>Yes is does use id of ' . $row['ID'];
                $id = $row['ID'];
            } elseif ($highestID < $row['ID']) {
                echo '<br>No it does not. id=' . $id . ' highestID=' . $row['ID'];
                $highestID = $row['ID'];
            }
        }

        /* first release for this application + environment at this version - update to new id */
        if ($id == 0) {
            $id = $highestID + 1;
        }
        return $id;
    }

    /**
     * extract the application names and put them into appNames dictionary
     * @param string $column the name of the column to extract from the database
     * @param string $table the name of the table the ID and column are extracted from within the database
     */
    protected function getNames($column, $table)
    {
        $this->db->resetRows();
        $this->db->runSelect(['ID', $column], $table);
        (array)$rows = $this->db->getRows();

        foreach ($rows as $row) {
            if ($column == 'AppName') {
                $this->appNames[strtolower($row['AppName'])] = $row['ID'];
            } elseif ($column == 'EnvName') {
                $this->envNames[strtolower($row['EnvName'])] = $row['ID'];
            } elseif ($column == 'CompName') {
                $this->compNames[strtolower($row['CompName'])] = $row['ID'];
            }
        }
    }

    /**
     * This will go through the array and return a number larger than any in it.
     * @param array $values
     */
    protected function getNextID($values)
    {
        $next_id = 0;

        if (isset($values) && count($values) > 0) {

            foreach ($values as $key => $value) {
                if ($value > $next_id) {
                    $next_id = $value;
                }
            }
        }

        return $next_id + 1;
    }

    /**
     * Opens the database and sets the object to internal variable.
     */
    protected function openDatabase()
    {
        $this->db = new DB();
    }

    /**
     * This will update the database with the details of the release.
     * @param string $AppName name of the application being updated by the release
     * @param string $EnvName name of the environment being updated by the release
     * @param string $AppVersion the version of the release
     * @param string $MarvalRef the marval reference number for this release.
     * @param array $Components list of component files updated in this release
     * @param string $EnvType the type of environment being updated.
     */
    public function update($AppName, $EnvName, $AppVersion, $MarvalRef, $Components, $EnvType)
    {
        (string)$appNameLower = strtolower($AppName);
        (string)$envNameLower = strtolower($EnvName);
        (string)$envTypeLower = strtolower($EnvType);

        if (isset($this->appNames[$appNameLower])) {
            $appID = $this->appNames[$appNameLower];
        } else {
            $appID = $this->getNextID($this->appNames);
            $this->updateName($appID, $AppName, 'AppName', 'tbl_Application');
        }

        if (isset($this->envNames[$envNameLower])) {
            $envID = $this->envNames[$envNameLower];
        } else {
            $envID = $this->getNextID($this->envNames);
            $this->updateName($envID, $EnvName, 'EnvName', 'tbl_Environment', $envTypeLower);
        }

        (int)$appVersionID = $this->getAppDeployID($appID, $envID, $AppVersion);
        $this->updateAppVersion($appVersionID, $appID, $envID, $AppVersion, $MarvalRef);
        $this->updateComponents($Components, $appVersionID);
    }

    /**
     * This updates the database table tbl_AppDeployment with the details of the deployment;
     * @param int $id the unique ID of the entry for the table.
     * @param int $appID the ID for the application being deployed
     * @param int $envID the ID for the environment the deployment is to.
     * @param string $appVersion the version number of the deployment.
     * @param string $marvalRef the marval reference number for the deployment
     */
    protected function updateAppVersion(int $id, int $appID, int $envID,
                                        string $appVersion, string $marvalRef)
    {
        (object)$now = new DateTime();
        (array)$updateFields = [];
        $updateFields['ID'] = $id;
        $updateFields['AppID'] = $appID;
        $updateFields['EnvID'] = $envID;
        $updateFields['AppVersion'] = $appVersion;
        $updateFields['MarvalReference'] = $marvalRef;
        $updateFields['DeployDate'] = $now->format('Y-m-d H:i:s');

        echo '<p>Updating the database table tbl_AppDeployment with the following:<br>';
        print_r($updateFields);
        $this->db->updateDB($updateFields, 'tbl_AppDeployment');
    }

    /**
     * This will update the details of the components that have changed application deployment ID they were changed in.
     * @param array $components list of components that have been updated
     * @param int $appVersionID the id of the release where the components were updated.
     */
    protected function updateComponents(array $components, int $appVersionID)
    {
        (array)$compUpdates = [];
        $compUpdates['AppDeploymentID'] = $appVersionID;

        foreach ($components as $compent) {
            (string)$lcname = strtolower($compent);
            if (isset($this->compNames[$lcname])) {
                $compUpdates['CompID'] = $this->compNames[$lcname];

                echo '<p>Updating the database table tbl_CompDeployment with the following:<br>';
                print_r($compUpdates);
                $this->db->updateDB($compUpdates, 'tbl_CompDeployment');
            } else {
                (int)$compDeployedID = $this->getNextID($this->compNames);
                $this->compNames[$lcname] = $compDeployedID;
                $this->updateName($compDeployedID, $compent, 'CompName', 'tbl_Component');
                $compUpdates['CompID'] = $compDeployedID;

                echo '<p>Updating the database table tbl_CompDeployment with the following:<br>';
                print_r($compUpdates);
                $this->db->updateDB($compUpdates, 'tbl_CompDeployment');
            }
        }
    }

    /**
     * This will add the ID and Name in the supplied table in the database
     * @param int $id the ID for the value to add / replace in the database table.
     * @param string $name the name for the value to add / replace
     * @param string $column the name of the column for the name value in the table to update.
     * @param string $table the table to update
     * @param string $type the environment type (for the environment table only) otherwise leave blank.
     */
    protected function updateName(int $id, string $name, string $column,
                                  string $table, string $type = '')
    {
        /*
         * create dictionary to update the database table with.
         */
        (array)$updateFields = [];
        $updateFields['ID'] = $id;
        $updateFields[$column] = $name;

        if ($type != '') {
            $updateFields['Type'] = $type;
        }

        /*
         * write to database
         */

        echo '<p>Updating the database table ' . $table . ' with the following updates<br>';
        print_r($updateFields);
        $this->db->updateDB($updateFields, $table);
    }
}
