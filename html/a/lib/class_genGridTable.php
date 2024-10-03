<?php

/**
 * Used to generate a table using divs and spans and relying on html grid class
 * to sort out the look and feel.
 *
 * @author mark
 */
class genGridTable 
{
    /**
     * List of lists where each list is the content of a row to add to the table.
     * @var array
     */
    protected $rows = [];
    
    /**
     * The name of the grid class to encompass the table to ensure the column sizes are correct.
     * @var string
     */
    protected $tableClass = '';
    
    /**
     * List of headers to display as the next line under the table title.
     * @var array
     */
    protected $tableHeaders = [];

    /**
     * Title to display at the top of the table.
     * @var string
     */
    protected $tableTitle = '';
    

    /**
     * The name of the grid class to encompass the table to ensure the column
     * sizes are correct.
     * @param string $tableClass
     */
    public function __construct(string $tableClass)
    {
        (string) $this->tableClass = $tableClass;
    }
    
    /**
     * 
     * @param array $row the row to add to the table
     */
    public function addRow(array $row, array $classes = [])
    {
        (int) $rowCount = count($this->rows);
        (int) $fieldCount = count($row);
        $this->rows[$rowCount] = '';
            
        for ((int) $ind = 0; $ind < $fieldCount; $ind++) {
            if (isset($classes[$ind]) && $classes[$ind] != '') {
                $this->rows[$rowCount] .= '   <span class="' . $classes[$ind] .
                        '">' . $row[$ind] . "</span>\n";
            } else {
                $this->rows[$rowCount] .= '   <span>' . $row[$ind] . "</span>\n";
            }
        }
    }
    
    /** 
     * 
     * @param array $row list of fields to add to the table in the format 'keyname' => 'value'
     * @param array $classByKey list of classes to apply to the table in the format 'keyname' => 'class'
     */
    public function addKeyRow(array $row, array $classByKey)
    {
        (boolean) $odd = FALSE;
        (int) $rowCount = count($this->rows);
        (int) $fieldCount = count($row);
        $this->rows[$rowCount] = '';
        
        foreach ($row as $key => $value) {
            if (isset($classByKey[$key]) && $classByKey[$key] != '') {
                if ($odd) {
                    $this->rows[$rowCount] .= '   <span class=odd "' . 
                            $classByKey[$key] . '">' . $value . "</span>\n";
                    $odd = FALSE;
                } else {
                    $this->rows[$rowCount] .= '   <span class="' . 
                            $classByKey[$key] . '">' . $value . "</span>\n";
                    $odd = TRUE;
                }
                
            } else {
                if ($odd) {
                    $this->rows[$rowCount] .= '   <span class="odd">' . $value . 
                            "</span>\n";
                    $odd = FALSE;
                } else {
                    $this->rows[$rowCount] .= '   <span>' . $value . "</span>\n";
                    $odd = TRUE;
                }
            }
        }
    }
    
    /**
     * This will output the html for the table.
     */
    public function show()
    {
        echo '<div class="' . $this->tableClass . '">' . "\n";
        echo '   <span class="table-title">' . $this->tableTitle . '</span>' . "\n";
        
        foreach ($this->tableHeaders as $value) {
            echo '   <span class="table-header">' . $value . '</span>' . "\n";
        }
        
        (int) $rowCount = count($this->rows);
        
        for ((int) $ind = 0; $ind < $rowCount; $ind++) {
            echo $this->rows;
        }
        
        echo "</div>\n";
    }
    
    /**
     * This allows the person creating the table to set the title and headers for the table.
     * Note: This will set the class for the title as table-title and the header classes as table-header.
     * @param string $title the title to display at the top of the table.
     * @param array $headers the headers for each column.
     */
    public function setTitleAndHeaders(string $title, array $headers)
    {
        (string) $this->tableTitle = $title;
        (array) $this->tableHeaders = $headers;
    }
}
