<?php

/* load the database variables from protected file */
include_once 'dashboard/config.php';
include_once 'lib/class_logger.php';

/**
 * Connects to the database and runs SQL queries / updates etc.
 * Results from queries are stored in arrays which can be returned line by line,
 * or whole array.
 *
 * @author  mark
 * @version 002
 * @date    28-May-2017
 */
class DB extends logger
{
    /*
     * Database connector
     */
    protected $dbc = NULL;

    /*
     * Variables for the database.
     */
    protected $data = array();
    private $indicator;
    private $numRows;

    /*
     * public methods
     */
    public function __construct($dbConnector = NULL)
    {
        if ($dbConnector == NULL) {
            /* Database not open - open it */
            $this->openDatabase();
        } else {
            /* Take database connector provided */
            $this->dbc = $dbConnector;
        }

        /* set the indicator */
        $this->indicator = 0;
    }

    /**
     * Checks the date supplied is in the correct format to be inserted into a
     * mysql date field: ccyy-mm-dd If in another format that can be recognised
     * it will return the date in the format ccyy-mm-dd to be used by database.
     * @param string $date to check
     * @return string date in format of ccyy-mm-dd or empty string if cannot
     *                     convert it.
     */
    public function checkDate(string $date)
    {
        (string)$validDate = '';

        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $date)) {
            $this->log(DEBUG, 'DB::checkDate', 'Date supplied is in format '
                . 'd/m/ccyy or dd/mm/ccyy returning in format ccyy-mm-dd');
            (array)$tmp = explode('/', $date);
            $validDate = sprintf("%d-%02d-%02d", $tmp[2], $tmp[1], $tmp[0]);

        } elseif (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $date)) {
            $this->log(DEBUG, 'DB::checkDate', 'Date supplied is in format '
                . 'ccyy-mm-dd or ccyy-m-d returning in format ccyy-mm-dd');
            (array)$tmp = explode('-', $date);
            $validDate = sprintf("%d-%02d-%02d", $tmp[0], $tmp[1], $tmp[2]);
        } else {
            $this->log(WARNING, 'DB::checkDate', 'Date supplied "' . $date .
                '" is in a format that has not been catered for. Need it in '
                . 'ccyy-mm-dd format.');
        }

        return $validDate;
    }

    /**
     * Gets the number of rows read from the database
     * @return int = number of rows read from the database.
     */
    public function getCount()
    {
        return $this->numRows;
    }

    /**
     * Gets the database connector allowing new DB classes to be set up without
     * trying to open the database again.
     * @return type
     */
    public function getDBC()
    {
        return $this->dbc;
    }

    /**
     * Provides an array in the format 'indexColumn' => $valueColumn
     * @param string $indexColumn = the column to use as an index for the array - note must contain unique values or this will return strange results.
     * @param string $valueColumn = the column to use as the value for the array.
     * @return array = array('indexColumn' => valueColumn)
     */
    public function getIndex($indexColumn, $valueColumn)
    {
        $returnArray = [];
        foreach ($this->data as $row) {
            $returnArray[$row[$indexColumn]] = $row[$valueColumn];
        }

        return $returnArray;
    }

    /**
     * This will return the next row read from the database. When the last row is returned this resets the indicator back to the beginning.
     * @return array = row from the database
     */
    public function getNext()
    {
        $row = $this->data[$this->indicator];
        $this->indicator++;

        if ($this->indicator == $this->numRows) {
            $this->indicator = 0;
        }
        return $row;
    }

    /**
     * Find a random row from the database rows read.
     * @param string $key = the column name to use when determining chances of row returned - if NULL (default) the row will be picked at random with equal chance of each row being picked.
     *                      If a key is provided the values of the column name are added up then the number randomised from 1 to the sum of this column.
     *                      The rows are then run through again with the key column being added up as it goes when this equals or exceeds the random number the row is returned - this creates a weighted randomisation of rows.
     * @return array = the random row found.
     */
    public function getRandomRow($key = NULL)
    {
        $row = [];
        if ($key == NULL) {
            /* randomise from 0 to number of rows -1 and return that row */
            $rnd = rand(1, $this->getCount());
            $rnd--;
            $row = $this->data[$rnd];
        } else {
            /* use the column name provided as a key to randomise on */
            $row = $this->returnRandomisedOnColumn($key);
        }

        return $row;
    }

    /**
     * Get all the rows read from the database.
     * @return array = array[n]( array(colName => data, etc) )
     */
    public function getRows()
    {
        return $this->data;
    }

    /**
     * Only call when the rows returned from the search are in the format row[n] => array( ['ID'] => n, ['other fields'] => value.
     * @return array in format of row[ID NUMBER] = array ( ['ID'] => n, ['other field'] = other value, etc )
     */
    public function getRowsArrayByID()
    {
        if (isset($this->data[0]['ID'])) {
            $rowsByID = [];

            foreach ($this->data as $row) {
                $rowsByID[$row['ID']] = $row;
            }
        }

        return $rowsByID;
    }

    /**
     * This will reset the contents of the rows to an empty array ready for a new select command.
     */
    public function resetRows()
    {
        $this->data = [];
    }

    /**
     * Run the supplied insert statement onto the database.
     * @param string $sql
     * @return int ID of the insert if successful.
     */
    public function runInsert($sql)
    {
        print("<p>Calling insert of sql for '" . $sql . "'</p>");
        /* Prepare the SQL statement */
        $update = $this->dbc->prepare($sql);

        /* update database */
        $update->execute();

    }

    /**
     * Replaces into the database the values supplied. This expects a hash
     * array in order to build a safe insert into the database.
     * The hash array should be in the format:
     * hash['column name'] = value to insert.
     * @param array $columns hash array keyed by column name to insert into the
     *                       database table.
     * @param string $table table to update.
     */
    public function updateDB($columns, $table)
    {
        (string)$sql = "REPLACE INTO " . $table . "(";

        foreach ($columns as $key => $value) {
            $sql .= " " . $key . ",";
        }

        /* replace last character , with ) */
        $sql = $this->replaceLastChar($sql, ')');
        $sql .= ' VALUES(';

        foreach ($columns as $key => $value) {
            if ($value != '') {
                $sql .= ' :' . strtolower($key) . ',';
            } else {
                $sql .= 'NULL,';
            }
        }

        $sql = $this->replaceLastChar($sql, ');');

        $this->prepareAndRun($sql, $columns);
    }

    /**
     * Prepares the SQL statement to run then binds the data types to it from
     * the array columns.
     * @param string $sql sql to be run.
     * @param array $columns array of hashes in format
     *     $columns[n]['column' => 'column name', 'value' => 'value to insert'];
     */
    private function prepareAndRun($sql, $columns)
    {
        /* preparing sql statement */
        $this->log(DEBUG, 'prepareAndRun', '$this->dbc->prepare("' . $sql . '")');
        $prep = $this->dbc->prepare($sql);

        (array)$values = [];
        (int)$ind = 0;

        /* bind the variables into the sql */
        foreach ($columns as $key => $value) {
            (string)$param = ':' . strtolower($key);

            /*
             * PDO Bind needs a value it can read from when the call to execute
             * to write to the database is made so we need to pass values to
             * an array that stays there until the execute to make it work.
             */
            $values[$ind] = $value;
            (int)$zero = 0;

            /* check the nature of input field then bind data as appropriate */
            if ($value == '') {
                /* don't bind to null values */
            } elseif (preg_match('/^\d+$/', $value)) {
                $this->log(DEBUG, 'prepareAndRun', '$prep->bindParam(' . $param .
                    ', ' . $values[$ind] . ', PDO::PARAM_INT)');
                $prep->bindParam($param, $values[$ind], PDO::PARAM_INT);
            } else {
                $this->log(DEBUG, 'prepareAndRun', '$prep->bindParam(' . $param .
                    ', "' . $values[$ind] . '", PDO::PARAM_STR)');
                $prep->bindParam($param, $values[$ind], PDO::PARAM_STR);
            }
            $ind++;
        }

        /* run the sql */
        $prep->execute();
        $result = $prep->fetchAll(PDO::FETCH_ASSOC);
        $huy = null;

    }

    function prepareAndRun_1($sql, $dataa)
    {
//        $sql = 'SELECT DISTINCT AppName,CompName,AppVersion,EnvName,Type,DeployDate FROM tbl_Component,tbl_AppDeployment,tbl_Environment,tbl_CompDeployment,tbl_Application WHERE tbl_Environment.ID = tbl_AppDeployment.EnvID and tbl_Component.ID = tbl_CompDeployment.CompID and tbl_AppDeployment.ID = tbl_CompDeployment.AppDeploymentID and tbl_AppDeployment.AppID = tbl_Application.ID AND tbl_Environment.ID = :id AND CompName like :copmid AND AppVersion like :appversion AND AppID= appid AND DeployDate > :deploydate AND DeployDate < :deploydate ORDER BY DeployDate DESC, CompName';
//        $sql = 'SELECT EnvID FROM tbl_AppDeployment WHERE ID = :id';
        $sql = 'select * from tbl_AppDeployment';

        $prep = $this->dbc->prepare($sql);
//        foreach ($dataa as $key => $value) {
////            if ($value) {
//            if (preg_match('/^\d+$/', $value)) {
//                $prep->bindParam($key, $value, PDO::PARAM_INT);
//            } else {
//                $prep->bindParam($key, "%" . $value . "%", PDO::PARAM_STR);
//            }
////            }
//        }
//        $huy1 = "%".$dataa[2]."%";
//        $huy2 = "%".$dataa[3]."%";
        $environmentId = 11;
        $compName = '%zge-mktred-das4:dpAMR%'; // Escape wildcards if necessary
        $appVersion = '%1.0.1%';
        $appId = 56;
        $startDate = '2024-09-01';
        $endDate = '2024-09-24';
        $prep->bindParam(":id", $environmentId, PDO::PARAM_INT);
        $prep->bindParam(":copmid", $compName , PDO::PARAM_STR);  // Escape wildcards with % if necessary
        $prep->bindParam(":appversion", $appVersion , PDO::PARAM_STR);  // Escape wildcards with %
        $prep->bindParam(":appid", $appId, PDO::PARAM_INT);
        $prep->bindParam(":deploydate", $startDate, PDO::PARAM_STR);
        $prep->bindParam(":deploydate", $endDate, PDO::PARAM_STR);


        $prep->execute();
        //todo
//        $result = $prep->fetchAll(PDO::FETCH_ASSOC);

        $huy = null;

        $rowCount = 0;
        while (($row = $prep->fetch(PDO::FETCH_ASSOC)) != FALSE) {
            if (is_array($dataa)) {
                $this->setDataRows($row, $dataa, $rowCount);
            } else {
//                $this->data[$rowCount][$dataa] = $row[$dataa];
            }

            $rowCount++;
        }
        $this->numRows = count($this->data);
    }


    /**
     * Simple method to remove the last character from a string and replace it
     * with a new one.
     * @param string $value input string to have last character replaced
     * @param string $with character to add to end of string once last one
     *                     removed.
     * @return string value returned once change made.
     */
    private
    function replaceLastChar(string $value, string $with)
    {
        (int)$len = strlen($value) - 1;
        (string)$newValue = substr($value, 0, $len) . $with;
        return $newValue;
    }

    /**
     * Builds the SQL statement and runs select from the database using the columns and tables supplied.
     * @param $nvironment_Name
     * @param array $columns = the columns of data to select from the database table.
     * @param array $tables = the table(s) to select the data from.
     * @param string $where = the where clause to use (default NULL)
     * @param string $orderBy = the column to order the select by (default = NULL)
     * @param boolean $distinct = whether the select statement is distinct (unique) - default FALSE (not unique).
     * @param boolean $showSQL = whether to show the sql statement being run - default FALSE (don't show statement).
     * @param boolean $quiet = whether to show errors if no rows returned. If quiet = TRUE no errors reported.
     */
    public
    function runSelect($columns, $tables, $where = NULL, $orderBy = NULL, $distinct = FALSE, $showSQL = FALSE, $quiet = FALSE)
    {
        $huy = 'huy';
//        $where = "tbl_Environment.ID = EnvID and tbl_Component.ID = CompID and tbl_AppDeployment.ID = AppDeploymentID and AppID = tbl_Application.ID AND tbl_Environment.ID = ?";
//        $nvironment_Name = 10;
        /* build sql string */
        $sql = 'SELECT' . $this->addDistinct($distinct) . $this->addColumnsOrTables($columns) . ' FROM ' .
            $this->addColumnsOrTables($tables) . $this->addWhere($where) . $this->addOrderBy($orderBy);

        /* check if we need to show the SQL */
        if ($showSQL) {
            echo '<br>Running SQL statement "' . $sql . '"<br>';
        }

        /* prepare the statement */
        $statement = $this->dbc->prepare($sql);
//        $statement->bindParam(1, $nvironment_Name, PDO::PARAM_INT);
        /* run the statement */
        $statement->execute();

        /* count rows returned */
        $rowCount = 0;

        /* build the data array */
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) != FALSE) {
            if (is_array($columns)) {
                $this->setDataRows($row, $columns, $rowCount);
            } else {
                /* only one column returned - so simple to update array */
                $this->data[$rowCount][$columns] = $row[$columns];
            }

            $rowCount++;
        }

        /* set the number of rows */
        $this->numRows = count($this->data);

        /* check for errors */
        if ($rowCount == 0 && !$quiet) {
            echo '<br>ERROR no rows returned. Check sql statement:<br>"' . $sql . '"<br>';
        }
    }

    /**
     * Will go through each row in the database and add up the values of the column name provided - as long as this is an int
     * @param string $colName = the name of the column to add up.
     * @return int = the sum of the values in the columnName provided.
     */
    public
    function sumColumnName($colName)
    {
        (int)$sum = 0;

        foreach ($this->data as $row) {
            if (isset($row[$colName]) && preg_match('/^\d+$/', $row[$colName])) {
                $sum += $row[$colName];
            } else {
                echo '<br>sumColumnName(' . $colName . ') value for $this->data[nn] = ' . $row[$colName] . ' not an int<br>';
                print_r($row);
            }
        }

        return $sum;
    }

    /*
     * private methods
     */

    /**
     * Returns the addition to the SQL statement based upon whether the distinct option is set
     * @param boolean $distinct
     * @return string = ' DISTINCT ' if $distinct = TRUE otherwise ' '
     */
    private
    function addDistinct($distinct)
    {
        if ($distinct) {
            return ' DISTINCT ';
        } else {
            return ' ';
        }
    }

    /**
     * Takes a single column/table or array of columns/tables and returns the in format for SQL statement
     * @param string or array $list = list of columns or tables to select from
     * @return string = sql formated statement of columns or tables to select from.
     */
    private
    function addColumnsOrTables($list)
    {
        if (is_array($list)) {
            $cols = implode(',', $list);
        } else {
            $cols = $list;
        }

        return $cols;
    }

    /**
     * Provides the ORDER BY statement in the format needed for the SQL statement.
     * @param string $orderBy = the ORDER BY statement to be used (can be in the format ORDER BY ... or just the ... in which case the ORDER BY is added automatically.
     * @return string = ' ' if $orderBy is NULL else it will return ORDER BY .... in the format needed by SQL Statement
     */
    private
    function addOrderBy($orderBy)
    {
        if ($orderBy == NULL) {
            return ' ';
        } elseif (preg_match('/ORDER BY/', $orderBy)) {
            /* ORDER BY included just return the string */
            return ' ' . $orderBy;
        } else {
            /* ORDER BY not included add it to the return string */
            return ' ORDER BY ' . $orderBy;
        }
    }

    /**
     * Provides the where statement in the format needed for SQL statement.
     * @param string $where = the where statement to be used (can include WHERE ... or just the ... in which case the WHERE is added automatically.
     * @return string = ' ' if $where is NULL else it will return WHERE .... in format needed by SQL statement.
     */
    private
    function addWhere($where)
    {
        if ($where == NULL) {
            return ' ';
        } elseif (preg_match('/WHERE/', $where)) {
            /* where statement already included - just return it */
            return ' ' . $where;
        } else {
            /* where statement not included add it and return value */
            return ' WHERE ' . $where;
        }
    }

    /**
     * Opens the database using the variables defined in the class.
     */
    private
    function openDatabase()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s;port=%s;charset=%s",
            DB_HOSTNAME, DB_DATABASE, DB_PORT, DB_CHARSET);
        try {
            $this->dbc = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

        } catch (PDOException $e) {
            echo "Database connection failed. ";
            print_r($e);
            exit;
        }
    }

    /**
     * Determines if the column name supplied has the table name in it. Returns the column name without table name.
     * @param string $columnName = name of database column, can be in format columnName or tableName.columnName
     * @return string $columnName without any table names.
     */
    private
    function returnColumnName($columnName)
    {
        /* determine if the column name has table name in it */
        if (preg_match('/^\w+\.\w+/', $columnName)) {
            /* column name in format tableName.columnName */
            $temp = explode('.', $columnName);
            $col = $temp[1];
        } else {
            $col = $columnName;
        }

        return $col;
    }

    /**
     * This will go through a column provided and add up all the values then randomise a number from 1 to the sum of this colum and return it.
     * @param string $colName = the column to add up the contents of.
     * @return array = the random row found based on roll from 1 to sum of the colName.
     */
    private
    function returnRandomisedOnColumn($colName)
    {
        $sum = $this->sumColumnName($colName);
        $rnd = rand(1, $sum);
        $count = 0;

        foreach ($this->data as $row) {
            $count += $row[$colName];

            /* see if we have reached the row to return */
            if ($count >= $rnd) {
                return $row;
            }
        }

        /* did not find the row randomised - return the last one */
        $ind = $this->getCount() - 1;
        return $this->data[$ind];
    }

    /**
     * Sets the data array with the contents of the database row read.
     * @param array $row = the array returned from the database read.
     * @param string or array $columns = the names of the columns used in the select statement.
     * @param int $rowCount = the number of the row read.
     */
    private
    function setDataRows($row, $columns, $rowCount)
    {
        foreach ($columns as $colName) {
            $col = $this->returnColumnName($colName);

            $this->data[$rowCount][$col] = $row[$col];
        }
    }
}
