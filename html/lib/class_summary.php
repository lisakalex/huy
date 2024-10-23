<?php

/**
 * Provides a form to use to query the database to determine the summary of the release database.
 *
 * @author Mark Slater
 */
include_once 'lib/class_querySummary.php';
include_once 'lib/class_input.php';
include_once 'lib/class_DB.php';

class summary extends querySummary
{
    /**
     * Initialise the variables used for the class. Note these are all inherited from the class query.
     * @param bool $debug if set to TRUE this will display the sql queries used.
     */
    public function __construct(bool $debug = FALSE)
    {
        parent::__construct($debug);
        $this->constructForm();
        
    }
    
    /**
     * Sets up the form needed to get the details of the release search.
     */
    protected function constructForm()
    {
        (bool) $readOnly = False;
        (string) $class = 'summary-input';
        (int) $dateSize = 14;
        (string) $selectClass = 'summary-select-';
        (string) $buttonClass = 'summary-button row-3 ';
        $this->setSelect('Application Name', $this->applications, ['ID', 'AppName'], $selectClass . ' col1');
        $this->setString('Application Version', $readOnly, 'summary-input col3', $dateSize);
        $this->setHeader('Application_Version');
        $this->setSelect('Marval Number', $this->marvalReferences, ['ID', 'MarvalReference'], $selectClass . ' col5');
        $this->setSelect('Environment Name', $this->environments, ['ID', 'EnvName'], $selectClass . ' col7');
        $this->setSelect('Status', $this->releaseStatus, ['ID', 'Status'], $selectClass . ' col9');
        $this->setString('Created After', $readOnly, $class . ' row-2', $dateSize, 'datepickerc');
        $this->setHeader('Created_After');
        $this->setString('Created Before', $readOnly, $class . ' row-2 col3', $dateSize, 'datepickerc2');
        $this->setHeader('Created_Before');
        $this->setString('Deployed After', $readOnly, $class . ' row-2 col7', $dateSize, 'datepicker');
        $this->setHeader('Deployed_After');
        $this->setString('Deployed Before', $readOnly, $class . ' row-2 col9', $dateSize, 'datepicker2');
        $this->setHeader('Deployed_Before');
        $this->setButton('Reset', $buttonClass . 'col2');
        $this->setButton('Search', $buttonClass . 'col8');
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
     * This displays the form in the web page. If no input variables found then a blank form is shown.
     * Otherwise a table of the findings are shown at the bottom of the form.
     */
    public function printConsolidatedForm()
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
            (string) $orderByDateAndComp = 'DateDeployed DESC, AppName';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, 
                    $orderByDateAndComp, $this->distinct, $this->debug, TRUE);
            (array) $rows = $this->db->getRows();
            echo '</form>';
            $this->printResults($rows);
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
     * Produces a grid table with the details of AppName, CompName, Latest Version and Date Deployed
     * @param array $rows the list of rows to be displayed in table format. This is a list of keyed arrays.
     */
    protected function printAllRows(array $rows) 
    {
        (boolean) $odd = FALSE;
        (int) $dateLen = 10;
        (string) $end = "</span>\n";
        (array) $keys = ['AppVersion', 'MarvalReference', 'PreferredDate', 
            'DateDeployed', 'Status', 'EnvName', 'DBserver', 'ClientServer', 
            'DatabaseName', 'Duration'];
        
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
            
            
            echo $appSpan . $row['AppName'] . $end;
            
            foreach ($keys as $key) {
                if ($row[$key] == '') {
                    echo $span . "-" . $end;
                }
                elseif ($key == 'PreferredDate' || $key == 'DateDeployed') {
                    echo $span . substr($row[$key], 0, $dateLen) . $end;
                } else {
                    echo $span . $row[$key] . $end;
                }
            }
        }
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
            (string) $orderByDateAndComp = 'DateDeployed DESC, AppName';
            $this->db->resetRows();
            $this->db->runSelect($this->cols, $this->tables, $where, 
                    $orderByDateAndComp, $this->distinct, $this->debug, TRUE);
            (array) $rows = $this->db->getRows();
            echo '</form>';
            $this->printResults($rows);
        }
    }
    
    /**
     * This takes the release details extracted from the database and presents
     * it in a tabular format.
     */
    protected function printResults(array $rows) 
    {
        (string) $title = 'Release Summary for ';
        
        if (isset($this->inputs['Application_Name']) && $this->inputs['Application_Name'] != '') {
            $title .= 'Application ' . $this->getApplicationName($this->inputs['Application_Name']);           
        } else {
            $title .= "all Applications";
        }
        
        if (isset($this->inputs['Deployed_After']) && $this->inputs['Deployed_After'] != '') {
            $title .=  ' deployed after ' . $this->inputs['Deployed_After'];
            $and = " and";
        }
        
        if (isset($this->inputs['Deployed_Before']) && $this->inputs['Deployed_Before'] != '') {
            $title .= $and . ' deployed before ' . $this->inputs['Deployed_Before'];
        }
        $this->printTable($rows, $title);   
    }
    
    /**
     * This prints the table of components and release dates found.
     * @param array $rows the rows extracted from the database query
     * @param string $title the title to display on the top of the table.
     */
    protected function printTable(array $rows, string $title) 
    {
        (array) $tidiedRows = [];
        
        if (count($rows) > 0) {
            $this->printTableHeader($title);
            $this->printAllRows($rows);
            echo "</div>\n";        
            if (isset($this->warnings) && $this->warnings != '') {
                echo $this->warnings;
            }
        } else {
            echo '<p class="danger">No rows returned for this query</p>';
        }
    }
    
    /**
     * prints the header for the grid table to be displayed
     * @param string $title the table title
     */
    protected function printTableHeader(string $title)
    {
        echo '<div class="grid-summary-table">' . "\n";
        echo '<span class="table-title">' . $title . '</span>
            <span class="table-header left">Application Name</span>
            <span class="table-header">Version</span>
            <span class="table-header">Reference</span>
            <span class="table-header">Preferred Date</span>
            <span class="table-header">Date Applied</span>
            <span class="table-header">Status</span>
            <span class="table-header">Environment</span>
            <span class="table-header">DB Server</span>
            <span class="table-header">Client Server</span>
            <span class="table-header">Database</span>
            <span class="table-header">Duration</span>';
    }
}
