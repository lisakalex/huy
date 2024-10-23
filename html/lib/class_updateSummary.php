<?php

/**
 * Description of class_updateSummary - accepts the dictionary array from the 
 * json extract from the mules application that scans SharePoint and inserts 
 * into the correct fields in the release database.
 *
 * @author mark slater
 */
include_once 'lib/class_querySummary.php';

class updateSummary extends querySummary
{
    /**
     * A dictionary that is built up as the data fields are analysed and used to
     * update the table tbl_DeploymentEnvironment
     * @var dictionary array
     */
    protected $addDeploymentEnvironment;
    
    /**
     * A dictionary that is built up as the data fields are analysed and used to
     * update the table tbl_deploymemntSummary
     * @var dictionary array
     */
    protected $addDeploymentSummary;
    
    /**
     * Dictionary of values provided by the extract of the JSON passed by Mules
     * application.
     * @var array of dictionaries
     */
    protected $data;
    

    public function __construct(array $data, bool $debug = false) 
    {
        parent::__construct($debug);
        $this->data = $data;
        $this->debug = $debug;
        
        $this->setInitialUpdateValues();
        
        if (strcasecmp($this->data['ApplicationSubGroup'], 'NA') != 0) {
            // append subgroup to application name - usually for maestro
            $this->data['ApplicationName'] .= '/' . $this->data['ApplicationSubGroup'];
        }
               
        if ($debug) {
            $this->debug();
        }
    }
    
    /**
     * Set the initial values for the dictionaries used to update the release 
     * database. 
     * Values that require an ID are looked up using the appropriate method
     * which then populate the ID with the value that matches the string from
     * the look up table.
     */
    protected function setInitialUpdateValues()
    {
        $this->addDeploymentEnvironment = ['DeploymentID' => $this->data['Id'],
            'EnvID' => $this->getEnvId(), 'Created' => $this->data['Created'], 
            'DateDeployed' => $this->getValueIfSet('ActualReleaseDate'), 
            'Duration' => NULL, //TODO NEED TO BE ABLE TO UPDATE RELEASE TIME AND CORRELATE TO EXPECTED TIME AND ACTUAL RELEASE
            'StatusID' => $this->getStatusID(),
            'PreferredDate' => $this->data['PreferredReleaseDate'], 
            'ReleaseTime' => $this->getValueIfSet('ReleaseTime'), 
            'DBServerID' => $this->getDBServerID(),
            'ClientServerID' => $this->getClientServerID(),
            'DatabaseNameID' => $this->getDatabaseNameID(), 
            'ExpectedDuration' => $this->data['ExpectedDuration'],
            'DRStatus' => $this->data['DRStatus']];
        
        $this->addDeploymentSummary = ['ID' => $this->data['Id'], 
            'AppID' => $this->getAppID(),
            'AppVersion' => $this->data['VersionNumber'], 
            'MarvalReference' => $this->data['MarvalRef'], 
            'GasOrPower' => substr($this->data['GasOrPower'], 0, 1),
            'ReleaseType' => $this->data['ReleaseType'], 
            'TimesRejected' => $this->data['TimesRejected'], 
            'TeamProvidingReleaseID' => $this->getReleaseTeamID()];
    }
    
    public function debug()
    {
        echo '<br>DB Table contents for applications<br>';
        foreach ($this->applications as $application) {
            echo "ID = " . $application['ID'] . " AppName = " . 
                    $application['AppName'] . "<br>";
        }
                
        echo '<br>DB Table contents for environments<br>';
        foreach($this->environments as $environment) {
            echo "ID = " . $environment['ID'] . " EnvName = " . 
                    $environment['EnvName'] . "<br>";            
        }
        
        echo '<br>DB Table contents for database names<br>';
        foreach($this->dbnames as $dbname) {
            echo "ID = " . $dbname['ID'] . " DatabaseName = " . 
                    $dbname['DatabaseName'] . "<br>";            
        }
        
        echo '<br>DB Table contents for DBservers<br>';
        foreach($this->dbservers as $dbserver) {
            echo "ID = " . $dbserver['ID'] . " DBserver = " . 
                    $dbserver['DBserver'] . "<br>";            
        }
        
        echo '<br>DB Table contents for Client Servers<br>';
        foreach($this->clientservers as $clientserver) {
            echo "ID = " . $clientserver['ID'] . " ClientServer = " . 
                    $clientserver['ClientServer'] . "<br>";            
        }
        
        echo '<br>DB Table contents for Release Status<br>';
        foreach($this->releaseStatus as $releaseStatus) {
            echo "ID = " . $releaseStatus['ID'] . " Status = " . 
                    $releaseStatus['Status'] . "<br>";            
        }
        
        echo '<br>DB Table contents for Release Team<br>';
        foreach($this->releaseTeam as $releaseTeam) {
            echo "ID = " . $releaseTeam['ID'] . " ReleaseTeam = " . 
            $releaseTeam['ReleaseTeam'] . "<br>";            
        }
        
        echo '<br>Contents of JSON received<br>';
        foreach ($this->data as $key => $value) {
            echo $key . " = '" . $value . "'<br>\n";
        }
        
        echo '<br>appDeploymentSummary = ';
        print_r($this->addDeploymentSummary);
        
        echo '<br>appDeploymentEnvironment = ';
        print_r($this->addDeploymentEnvironment);
        
    }
    
    /**
     * Update the database tables with the release details.
     */
    public function updateReleaseDB()
    {
        $this->db->updateDB($this->addDeploymentEnvironment, 
                'tbl_DeploymentEnvironment');
        
        $this->db->updateDB($this->addDeploymentSummary, 
                'tbl_DeploymentSummary');
    }
    /**
     * Determines the app id used in the database from the app name supplied in
     * the JSON fields. If not found creates new entry based upon appID in 
     * $this->data.
     * @return int
     */
    protected function getAppID()
    {
        (string) $nameIndex = 'ApplicationName';
        (string) $idIndex = 'ApplicationId';
        
        (int) $appID = $this->updateVariables($this->applications, 'AppName', 
                $nameIndex, $idIndex);
        
        if ($appID == 0) {
            $appID = $this->updateApplicationTable($this->data[$idIndex], 
                    $this->data[$nameIndex]);
        }
        
        return $appID;
    }
    
    /**
     * Determines the client server ID from the name provided in JSON and the ID
     * for this in the database. Creates new database entry if not in database.
     * @return int
     */
    protected function getClientServerID()
    {
        (int) $clientServerID = 1;
        (string) $nameID = 'ClientServer';
        
        if ($this->data[$nameID] != 'Client Server Details' &&
           !$this->updateIDs($this->clientservers, $nameID, $nameID)) {
                $clientServerID = $this->updateClientServerTable($this->data[$nameID]);
        } else {
            // TODO WHAT IF CLIENT SERVER = 'Client Server Details'?
            $this->addDeploymentEnvironment['ClientServerID'] = $this->getUsedId(
                    $this->clientservers, $nameID, $this->data[$nameID]);
        }
        
        return $clientServerID;
    }
    
    /**
     * Determines the database name ID from the name provided in JSON and the ID
     * for this in the database. Creates new database entry if not in database.
     * @return int
     */
    protected function getDatabaseNameID()
    {
        (int) $databaseNameID = 1;
        (string) $dbColumn = 'DatabaseName';
        (string) $dataKey = 'Database';
        
        if ($this->data[$dataKey] != 'DB Details' &&
                !$this->updateIDs($this->dbnames, $dbColumn, $dataKey)) {
            $databaseNameID = $this->updateDatabaseNameTable(
                    $this->data[$dataKey]);
        } else {
            $databaseNameID = $this->getUsedId($this->dbnames, $dbColumn, 
                    $this->data[$dataKey]);
        }
        
        return $databaseNameID;
    }
    
    /**
     * Checks if the data[key] field has been updated and not empty string. If 
     * true it returns the value from the JSON field or else returns null.
     * @param string $key the dictionary key within $this->data to check for a value.
     * @return value set or null
     */
    protected function getValueIfSet(string $key)
    {
        if (isset($this->data[$key]) && 
                $this->data[$key] != '') {
            return $this->data[$key];
        }
        
        return null;
    }
    /**
     * Determines the database server ID from the name provided in JSON and the
     * id for this in the database. Creates new database entry if not in 
     * database.
     * @return int
     */
    protected function getDBServerID()
    {
        (int) $dbServerID = 1;
        (string) $dbColumn = 'DBServer';
        (string) $dataKey = $dbColumn;
        
        if ($this->data[$dataKey] != 'DB Server Details' &&
                !$this->updateIDs($this->dbservers, $dbColumn, $dataKey)) {
            $dbServerID = $this->updateDBServerTable($this->data[$dataKey]);
        } else {
            // TODO WHAT IF DBSERVER = 'DB Server Details'?
            $dbServerID = $this->getUsedId($this->dbservers, $dbColumn,
                    $this->data[$dataKey]);
        }
        return $dbServerID;
    }
    
    /**
     * Determines the environment id used in the database from the environment
     * name provided in the JSON fields. If not found it creates the new entry
     * based upon the ID provided.
     * @return int
     */
    protected function getEnvId()
    {
        (string) $nameIndex = 'EnvironmentName';
        (string) $idIndex = 'EnvironmentId';
        
        (int) $envID = $this->updateVariables($this->environments, 'EnvName', 
                $nameIndex, $idIndex);
        
        if ($envID == 0) {
            $envID = $this->updateEnvironmentTable($this->data[$idIndex], 
                    $this->data[$nameIndex]);            
        } 
        
        return $envID;        
    }
    
    /**
     * Determines the release team ID used in the database from the release 
     * team name. If not found it creates the new entry based upon the teamID in
     * the $this->data
     * @return int release team id in database
     */
    protected function getReleaseTeamID()
    {
        (string) $nameIndex = 'TeamProvidingReleaseName';
        (string) $idIndex = 'TeamProvidingReleaseId';
        (int) $teamID = $this->updateVariables($this->releaseTeam, 
                'ReleaseTeam', $nameIndex, $idIndex);
        
        if ($teamID == 0) {
            $teamID = $this->updateReleaseTeamTable($this->data[$idIndex], 
                    $this->data[$nameIndex]);
        } 
        
        return $teamID;
    }
    
    /**
     * This will take the list of dictionaries provided by class querySummary 
     * and return a list of ID's in numerical order which can be useful if we
     * need to allocate a new id for a new application or environment from 
     * SharePoint.
     * @param array $toSort list of dictionaries containing ['ID'] => integer
     * @return array
     */
    protected function getNextId(array $toSort)
    {
        (int) $largestId = 0;
        
        foreach ($toSort as $dict) {
            if ($dict['ID'] > $largestId) {
                $largestId = $dict['ID'] + 1;
            }
        }
        
        return $largestId;
    }
    
    /**
     * Returns the status ID based upon the status provided by the JSON.
     * @return int
     */
    protected function getStatusID()
    {
        (int) $statusID = 0;
        
        if (!$this->updateIDs($this->releaseStatus, 'Status', 'Status')) {
            $statusID = $this->updateReleaseStatusTable($this->data['Status']);
        } else {
            $statusID = $this->getUsedId($this->releaseStatus, 'Status', 
                    $this->data['Status']);
        }
        
        return $statusID;
    }
    
    /**
     * Accepts a list of dictionaries in format array(['ID' => n, 'key' => value])
     * When it finds a match for the value supplied it in the dictionary key
     * @param array $dict array of dictionaries to check
     * @param string $key key in dictionary name to use in comparison
     * @param string $value value to check for in dictionary
     * @return int indicator in database
     */
    protected function getUsedId($dict, $key, $value)
    {
        (int) $idToUse = 0;
        
        foreach ($dict as $field) {
            if (strcasecmp($field[$key], $value) == 0) {
                return $field['ID'];
            }
        }
        
        return $idToUse;
    }
    
    /**
     * Got through the dictionary of IDs and see if the one supplied by 
     * SharePoint is available to be used in the database table. If not already
     * used it will return the ID provided otherwise it will return the next 
     * highest in the sequence.
     * @param array $usedIds list of dictionary arrays in format 
     *                       ['ID' => n, 'elementname' => value]
     * @param int $proposedId the ID SharePoint is using for this value
     * @return int the ID to be inserted into the database table for this value
     */
    protected function getUnusedId(array $usedIds, int $proposedId)
    {
        (bool) $useProposed = true;
        
        foreach ($usedIds as $element) {
            if ($element['ID'] == $proposedId) {
                $useProposed = false;
            }
        }
        
        if (!$useProposed) {
            return $this->getNextId($usedIds);
        }
        
        return $proposedId;
    }
    
    /**
     * Upon finding a new application that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param int $id the id to be used when associating the application name
     * @param string $value the value of the application name.
     * @return int the id that is used within the database.
     */
    protected function updateApplicationTable(int $id, string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->applications, $id);
        (int) $ind = count($this->applications);
        
        $this->applications[$ind] = ['ID' => $idToUse, 'AppName' => $value];
        
        $this->db->updateDB($this->applications[$ind], 'tbl_Application');
        
        return $idToUse;
    }
    
    /**
     * Upon finding a new client server that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param string $value the value of the client server name.
     * @return int database name ID
     */
    protected function updateDatabaseNameTable(string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->dbnames, 1);
        (int) $ind = count($this->dbnames);
        
        $this->dbnames[$ind] = ['ID' => $idToUse, 'DatabaseName' => $value];
        
        $this->db->updateDB($this->dbnames[$ind], 'tbl_DatabaseName');
        
        return $idToUse;
    }
    
    /**
     * Upon finding a new client server that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param string $value the value of the client server name.
     * @return int the id of the entry within the database.
     */
    protected function updateDBServerTable(string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->dbservers, 1);
        (int) $ind = count($this->dbservers);
        
        $this->dbservers[$ind] = ['ID' => $idToUse, 'DBserver' => $value];
        
        $this->db->updateDB($this->dbservers[$ind], 'tbl_DBserver');
        
        return $idToUse;
    }
    
    /**
     * Upon finding a new client server that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param string $value the value of the client server name.
     */
    protected function updateClientServerTable(string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->clientservers, 1);
        (int) $ind = count($this->clientservers);
        
        $this->clientservers[$ind] = ['ID' => $idToUse, 'ClientServer' => $value];
        
        $this->db->updateDB($this->clientservers[$ind], 'tbl_ClientServer');
        
        return $idToUse;
    }
    
    /**
     * Upon finding a new release status that has been supplied by SharePoint
     * but is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param string $value the value of the status name.
     */
    protected function updateReleaseStatusTable(string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->releaseStatus, 1);
        (int) $ind = count($this->releaseStatus);
        
        $this->releaseStatus[$ind] = ['ID' => $idToUse, 'Status' => $value];
        
        $this->db->updateDB($this->releaseStatus[$ind], 'tbl_ReleaseStatus');
        
        return $idToUse;
    }
    
    /**
     * Upon finding a new environment that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param int $id the id to be used when associating the environment name
     * @param string $value the value of the environment name.
     */
    protected function updateEnvironmentTable(int $id, string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->environments, $id);
        (int) $ind = count($this->environments);
        
        $this->addDeploymentEnvironment['EnvID'] = $idToUse;
        $this->environments[$ind] = ['ID' => $idToUse, 'EnvName' => $value];
        
        $this->db->updateDB($this->environments[$ind], 'tbl_Environment');
    }
    
    /**
     * Ensures the values for the elements in the release database match the 
     * values that exist in SharePoint.
     * @param array $source the internal dictionary extracted from the database
     * @param string $sourceKey the element key name as stored in the database
     * @param string $dataKey the element key name as stored in SharePoint
     * @return bool true if value of the database matches the value in the json
     *              false if the value in the json is not in the database table.
     */
    protected function updateIDs(array $source, string $sourceKey, 
            string $dataKey)
    {
        (bool) $found = false;
        
        foreach($source as $value) {   
            if ( strcasecmp($value[$sourceKey], $this->data[$dataKey]) == 0) {
                $found = true;
            }
        }
        
        return $found;
    }
    
    /**
     * Upon finding a new release team that has been supplied by SharePoint but
     * is not in the database this will determine if the ID provided by 
     * SharePoint has already been allocated. If not it will use this otherwise
     * it will use the next value in the sequence.
     * @param int $id the id to be used when associating the release team name
     * @param string $value the value of the release team name.
     * @return int ID to use for the release team.
     */
    protected function updateReleaseTeamTable(int $id, string $value) 
    {
        (int) $idToUse = $this->getUnusedId($this->releaseTeam, $id);
        (int) $ind = count($this->releaseTeam);
        
        $this->releaseTeam[$ind] = ['ID' => $idToUse, 'ReleaseTeam' => $value];
        
        $this->db->updateDB($this->releaseTeam[$ind], 'tbl_ReleaseTeam');
        
        return $idToUse;
    }
    
    /**
     * Ensures the values for the elements in the release database match the 
     * values that exist in SharePoint.
     * @param array $source the internal dictionary extracted from the database
     * @param string $sourceKey the element key name as stored in the database
     * @param string $dataKey the element key name as stored in SharePoint
     * @param string $dataId the element id name as stored in SharePoint
     * @return int the ID found for the name provided. 0 if not found.
     */
    protected function updateVariables(array $source, string $sourceKey, 
            string $dataKey, string $dataId)
    {
        (int) $idFound = 0;
        
        foreach($source as $value) {   
            if ( strcasecmp($value[$sourceKey], $this->data[$dataKey]) == 0) {
                $this->data[$dataId] = $value['ID'];
                $idFound = $value['ID'];
            }
        }
        
        return $idFound;
    }
}
