<?php

    /**
     * Creates a table object that can be used to populate the rows and define 
     * the headings and sub headings. These tables will have built-in classes 
     * that work with the javascript to allow tables to be collapsed.
     */
    class genTable
    {	
        private $title;
        private $headers = array();
        private $headerColSpan = array();
        private $subHeaders = array();
        private $alignment = array();
        private $colSpan = array();
        private $colWidth = array();
        private $colHighlight = array();
        private $countCols = 0;
        private $display;
        private $numCols = 0;
        private $numRows = 0;
        private $rows = array();
        private $tableWidth = '100%';

        /**
         * Simple way to create a table.
         * @param string $title (the title for the table)
         * @param array $headers (the headers for each column can have a row of subheaders using the following format 'header:sub heading 1:sub heading2') The number of columns is expanded to fill the number of sub headers and these are added as a row below the heading)
         * @param string $width (the width of the page of the table - default '95%')
         * @param boolean $display (whether to show the content of the table or not - default TRUE show all the rows).
        */
        public function __construct($title, $headers = '', $width = '100%', $display = TRUE ) {
            $this->title = $title;
            $this->tableWidth = $width;
            $this->setHeaders($headers);	
            $this->display = $display;
        }
		
    /**
     * Takes an array of keys and a hash array and adds this to the table. This list of keys is important 
     * because it defines the order in which the table elements will be created
     * @param type $keys  - array of keys used in hash array in the order they are to appear in the table.
     * @param type $values  - array of hashes
     * @param string $colSpan (the number of columns each cell occupies - if set to 1 then each cell occupies 1 cell, if set to 2 each cell occupies 2 columns. Can also put in special format eg. 1:2:1 supplying 3 cells with the second cell occupying 2 columns)
     * 		Can also set alignment for individual cells by setting to 1L or 1R or 1:2R:1L which means 1 center, colspan 2 align right, colspan 1 align left
     * @param boolean $highlight indicates if the row should be highlighted within the table
     */
    public function addHashRow($keys, $values, $colSpan = '1', $highlight = FALSE ) {
        $ind   = 0;
        $lines = array();
      
        foreach( $keys as $k ) {
            $lines[$ind] = $values[$k];
            $ind++;
        }
      
        $this->addRow($lines, $colSpan, $highlight);
    }
    
    /**
     * Adds a row to the table
     * @param array $values (the contents of the cells in format - 'cell 1', 'cell 2', etc
     * @param string $colSpan (the number of columns each cell occupies - if set to 1 then each cell occupies 1 cell, if set to 2 each cell occupies 2 columns. Can also put in special format eg. 1:2:1 supplying 3 cells with the second cell occupying 2 columns)
     * 		Can also set alignment for individual cells by setting to 1L or 1R or 1:2R:1L which means 1 center, colspan 2 align right, colspan 1 align left
     * @param boolean $highlight indicates if the row should be highlighted within the table
     */
    public function addRow($values, $colSpan = '1', $highlight = FALSE ) {
					
	if ( is_array($values) ) {
            					
            $cc = $this->getColumnSizes($colSpan, $values);		
            $count = 0;
				
            foreach ($values as $v) {
                
                $this->rows[$this->numRows][$count] = $this->checkForLink($this->checkForNumber($v));
					
		// check for column(s) spanned					
		$this->colSpan[$this->numRows][$count] = $cc[$count];
		$count++;
            }
	} else {
            $this->rows[$this->numRows][0] = $this->checkForLink($values);
            $this->colSpan[$this->numRows][0] = $colSpan;
	}
			
        // update if this should be lightlighted. There can be many highlights per table
        if ($highlight) {
            $this->colHighlight[$this->numRows] = TRUE;
        } else {
            $this->colHighlight[$this->numRows] = FALSE;
        }

	// update number of rows
	$this->numRows++;
    }
		
    /**
     * This checks if the input is in the format 'program|name' if it is then it returns '<a href="program">name</a>'
     * @param type $input the input file to check if a link is required to be returned
     * @return type $value of string input with hyperlink if needed
     */
    private function checkForLink($input) {
        $line = $line2 = $input;
      
        if (preg_match('/\[.+\|.+\]/',$input)) {
            $line  = preg_filter('/\[/', '<a href="', $input);
            $line1 = preg_filter('/\|/', '">', $line);
            $line2 = preg_filter('/\]/', '</a>', $line1);
        } 
        elseif (preg_match('/\|/', $input)) {
            $tmp = explode('|', $input);
            $line2 = '<a href="' . $tmp[0] . '">' . $tmp[1] . '</a>';
        }

        return $line2;
    }

    /**
     * This will check to determine if the value supplied is an integer or decimal number and if it is over 999 in value. If it is then the thousands will be comma separated for ease of reading.
     * @param string $input = the value to check to see if it is a number greater than 999.
     * @return string = a formated version of the input with thousands comma separated (e.g. 1000 returned as 1,000)
     */
    private function checkForNumber($input) {
        $format = $input;
        if (preg_match('/^\d+$/', $input) || preg_match('/^\d+\.\d+$/', $input)) {
            # its a number
            if ( $input > 999) {
                $format = $this->formatThousands($input);
            } 
        }
        return $format;
    }
    /**
     * Sets the display value for the rows on the table to off - therefore will NOT display the rows after the main title
     * though they can be hidden by clicking on the title line.
     */
    public function displayOff() {
        $this->display = FALSE;
    }

    /**
    * Sets the display value for the rows on the table to on - therefore will display the rows after the main title
    * though they can be hidden by clicking on the title line.
    */
    public function displayOn() {
        $this->display = TRUE;
    }
    
    /**
     * Change the column alignment on the table based upon the header. Default alignment is center this changes it to left.
     * @param string $name (name of the header whose column is to be altered).
     * @param string $align (alignment to set - default left). Acceptable values: 'left', 'center', 'right'.
     * @param string $valign Vertical alignment within the table - default middle. Acceptable values: 'top', 'middle'
     */
    public function setColumnAlign($name, $align = 'left', $valign = 'middle') {
	
        if ( $valign == 'top' ) {
            $this->alignment[$name] = 'top';
        } else {
            $this->alignment[$name] = 'middle';
        }
        
        if ( $align == 'left' || $align == 'right' || $align == 'center' ) {
            $this->alignment[$name] .= ' ' . $align;
        } else {
            /* try splitting on space in case they have been merged */
            $temp = explode(' ', $align);
            
            if (is_array($temp) && ($temp[0] === 'middle' || $temp[0] === 'top')) {
                $this->alignment[$name] = $align;
            } else {
                echo "Do not recognize value for alignment of $align";
            }
	}
    }
		
    /**
     * This allows you to set a fixed width for a specific column
     * @param string $name (the name of the column which is the same as the header for the column)
     * @param string $width (the width of the column - can be a number in which case it is the width in pixels or it can be a percent e.g. '50%')
     */
    public function setColumnWidth($name, $width) {
	$this->colWidth[$name] = $width;
    }
        
    /**
     * This will read through the column details provided and the list of items to be added to the table cells and set the corrent table formating for them.
     * @param string $colSpan = the format for the columns this can also set alignment for individual cells by setting to 1L or 1R or 1:2R:1L which means 1 center, colspan 2 align right, colspan 1 align left
     * @param array $values   = list of variables to put into the table cells.
     * @return array of columns
     */
    private function getColumnSizes($colSpan, $values) {
        
        $cc = array();
        
        if ( preg_match('/:/', $colSpan) ) {
            /*
             * column Span in format n:n which is used to define specific column span requirements
             */
            $cc = explode(':', $colSpan);
        } else {
            /*
             * set each column to same value in column span for each table element in values array.
             */
            for ( $ind = 0; $ind < count($values); $ind++ ) {
                $cc[$ind] = $colSpan;
            }
        }
	
        return $cc;
    }
    
    /**
     * This sets the values for the headers for the table and determines if there are also subheaders to be added.
     * @param array or string $headers = the headers to put under the title of the table.
     */
    private function setHeaders($headers) {
        if ( is_array($headers)) {
            /* there is more than one column of headers */
            $this->numCols = $count = count($headers);

            for ($ind = 0; $ind < $count; $ind++) {
                if (isset($headers[$ind]) && preg_match('/:/', $headers[$ind])) {
                    /* there are sub headers (possibly multiple columns under this main header */
                    $this->setSubHeaders($headers[$ind], $ind);  
                    
                    /* set alignment keyed by column name */
                    $this->alignment[$headers[$ind]] = 'center';
                } elseif (isset ($headers[$ind])) {
                    /* there is only one column and no sub headers */
                    $this->headers[$ind] = $headers[$ind];
                    $this->headerColSpan[$headers[$ind]] = 1;
                    
                    /* set alignment keyed by column name */
                    $this->alignment[$headers[$ind]] = 'center';
                }

                
            }
        } else {
            /* only one header provided - only 1 column needed */
            $this->numCols = 1;
            $this->headers[0] = $headers;
            $this->headerColSpan[$headers] = 1;
            $this->alignment[$headers] = 'center';
        }
    }

    /**
     * This allows for a second level of heading - under the main headings. These sub-headings can cause there to be additional columns under the main headings.
     * @param string $subHeadings - if used to create additional columns the heading name will be in the format col1:col2 etc.
     * @param int $ind - indicator of the heading this applies to, so the heading can be set to the correct colspan when printed.
     */
    private function setSubHeaders($subHeadings, $ind) {
        $tmp = explode(':', $subHeadings);
        $this->headers[$ind] = $tmp[0];
        $count = count($tmp);
        $this->headerColSpan[$tmp[0]] = $count - 1;
        $this->numCols += $count - 2;

        // create array of subheadings
        for ($ind = 1; $ind < $count; $ind++) {
            $this->subHeaders[$tmp[0]][$ind - 1] = $tmp[$ind];
        }
    }
        
    /**
     * Print the cell elements within the table.
     * @param int $line = the line of the table to be printed (not including any headers)
     * @param int $cell = the cell within the line of the table to be printed.
     */
    private function printCells($line, $cell) 
    {
        
        /* assume 1 column span and no special alignment */
        $colSpan = '1';
        $align = '';
        
        /* check the alignment and column span for the cell */
        if (isset($this->colSpan[$line][$cell]) && !empty($this->colSpan[$line][$cell])) {
            
            if ( preg_match('/\dL/', $this->colSpan[$line][$cell])) {
                /* matched to a column span of 1 or more with alignment to the left */
                $colSpan = substr($this->colSpan[$line][$cell], 0, -1);
                $align = 'class="left"';
            } elseif (preg_match('/\dR/', $this->colSpan[$line][$cell])) {
                /* matched to a column span of 1 or more with alignment to the right */
                $colSpan = substr($this->colSpan[$line][$cell], 0, -1);
                $align = 'class="right"';
            }else {
                /* matched to a column span of 1 or more with alignment in the centre */
                $colSpan = $this->colSpan[$line][$cell];
                $align   = $this->getAlignmentByHeader($cell);
            } 
        }
        
        /* print the line and cell */
        if ($this->countCols > 0) {
            if (isset($this->rows[$line][$cell]) && !empty($this->rows[$line][$cell])) {
                echo '<td ' . $align . ' colspan="' . $colSpan . '">' . $this->rows[$line][$cell] . '</td>';
            } else {
                /* cell is empty put in a dash */
                echo '<td>-</td>';
            }
            
            /* reduce number of columns to print */
            $this->countCols--;
        }
        
    }
    /**
    * Print the start of the row - allowing for class and display
    * @param string $class = the class to apply to the row
    * @return boolean = FALSE if the class supplied was "odd" else TRUE (used to change the colour of the row in the table)
    */
    private function printRow($class = '') 
    {
        if (!empty($class)) {
            echo '<tr class="' . $class . '"';
        } else {
            echo '<tr';
        }
                        
        if (!$this->display) {
            /* don't display if set not to */
            echo ' style="display: none;"';
        } 
            
        echo '>';
        
        /*
         * if the class supplied is odd then return false so the next line will not be odd.
         */
        if (preg_match('/odd/', $class)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * This will print the first row of headers for the table under the main title.
     */
    private function printMainHeader() {
        if ($this->numCols > 1 ) {
            foreach ($this->headers as $k) {
                /*
                 *  print titles
                 */
		if (isset($this->colWidth[$k]) && !empty($this->colWidth[$k])) {
                    echo '<th width="' . $this->colWidth[$k] . '" colspan="' . $this->headerColSpan[$k] . 
                         '"><strong>' . $k . '</strong></th>';
		} else {
                    echo '<th colspan="' . $this->headerColSpan[$k] . '"><strong>' . $k . '</strong></th>';
		}
            }
	} elseif ($this->numCols == 1) {
            echo '<th><strong>' . $this->headers[0] . '</th>';
	}
			
	echo '</tr>';
    }
    
    /**
     * This will print the sub-headers for the table - just under the main headers.
     */
    private function printSubHeader() {
        if ( isset($this->subHeaders) && !empty($this->subHeaders)) {
            $this->printRow('subtitle');

            foreach ($this->headers as $h) {
                if ( isset($this->subHeaders[$h]) ) {
                    $this->outputSubheader($h);
                } else {
                    echo '<th>&nbsp;</th>';
                }
            }

            echo '</tr>';
        }
    }
    
    /**
     * Loops through the subHeader array and prints the content in strong mode.
     * @param array $h = array of subheaders
     */
    private function outputSubheader($h) {
        foreach ($this->subHeaders[$h] as $k) {
            echo '<th><strong>' . $k . '</strong></th>';
        }
    }
    
    /**
     * This will print the start of the table and the main title of the table.
     */
    private function printTableTop() {
        echo '<table width="' . $this->tableWidth . '"><tbody><tr class="heading"><th colspan="' . 
        $this->numCols . '"><strong>' . $this->title . '</strong></th></tr>';
        
        // print the headers
        $this->printRow('title');
    }
    
    /**
     * This will return the alignment of the cell based upon the header for the indicator supplied.
     * @param int $ind the index of the header to use to determine the alignment for the cell.
     * @return string the class to put in the cell to control the alignment of the contents of the cell.
     */
    private function getAlignmentByHeader($ind) {
        if (isset($this->headers[$ind]) && isset($this->alignment[$this->headers[$ind]])) {
            $align = 'class="' . $this->alignment[$this->headers[$ind]] . '"';
        } else {
            $align = 'class="center"';
        }
        
        return $align;
    }
    
    /**
    * print the table
    */
    public function show() {
        
	$odd = FALSE;
			
        $this->printTableTop();
        $this->printMainHeader();
	$this->printSubHeader();			
                  
	/* print elements all the elements of the table */
	for ( $line = 0; $line < $this->numRows; $line++ ) {
            /* print the rows */
            $this->countCols = count($this->rows[$line]);
            
            if ($this->colHighlight[$line]) {
                /*
                 * highlight this row. Don't check what is returned because we don't want to 
                 * change the line class.
                 */
                $this->printRow('highlight');
            } elseif ($odd) {
		$odd = $this->printRow('odd');

            } else {
		$odd = $this->printRow();
            }
				
            for ( $cell = 0; $cell < $this->numCols; $cell++ ) {
                /* print all the cells in this line */
                $this->printCells($line, $cell);
            }
				
            /* end the row - new line */
            echo '</tr>';
        }
			
        // end the table
        echo '</table>';
    }
}