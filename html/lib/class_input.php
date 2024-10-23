<?php
/**
 * This is a base class designed to be used to provide array used by filter_input_array for a class that
 * has a form to fill in. It can also be used as a standalone class to filter input on behalf of a 
 * program that was called with parameters.
 *
 * @author mark
 */
class input 
{
    /**
     * The filtered values received from the POST or GET, in the format ('field name' => 'value', etc) 
     * @var array 
     */
    private $filter  = array();
    /**
     * The list of names of the fields in the form that should be displayed as buttons.
     * @var array 
     */
    private $buttons = array();
    /**
     * The list of names of the fields in the form that should be displayed as a check box
     * @var array 
     */
    private $checkBox = array();
    /**
     * This defines the value to apply to the check box in the form. This is set in the format ('field name' => 'value', etc)
     * @var array 
     */
    private $checkValues = array();
    /**
     * A dictionary of key and boolean to denote if the check box needs to be displayed inline with the title or not. This is in the format ('field name' => TRUE, etc.) 
     * @var array 
     */
    private $checkInline = array();
    /**
     * A dictionary to define the CSS class to apply to the HTML when displaying this field in the form. This is in the format ('field name' => 'class name', etc.)
     * @var array
     */
    private $class = array();
    
    /**
     * A dictionary to define the  ID to apply to the HTML when displaying this field in the form.
     * @var array
     */
    private $id = array();
    
    /**
     * A dictionary to define if the field is to be set as a HIDDEN field within the HTML code. Set in the form ('field name' => TRUE, etc.) When TRUE the field has the hidden property set.
     * @var array
     */
    /**
     * List of fields that should have the headers printed rather than rely on placeholder values.
     * @var array
     */
    private $headers = array();
    /**
     * A dictionary of fields that are hidden from view and set as part of the calling class rather than by the user.
     * @var array
     */
    private $hidden = array();
    /**
     * A dictionary to define if the field is to be set as READONLY in the HTML form. Set in the value of ('field name' => BOOLEAN, etc). When set to TRUE the field will not be writable in the HTML form. 
     * @var array
     */
    private $readonly = array();
    /**
     * A list to define if the field in the HTML form is a select field. If the field name is in this variable then the HTML generated will be for a select field. This is in the format ('field name', 'field name2', etc.)
     * @var array
     */
    private $selectArray = array();
    /**
     * A dictionary of lists that hold the values to add to the select field. This is in the format ('field name' => ([0] ('option key' => 'value 1', 'option name' => 'name to display'), [1] ('option key' => 'value', 'option name' => 'name to display'), etc.)
     * @var array
     */
    private $selectValues = array();
    /**
     * A dictionary  used to map the option value key to the option display key for the field. This is in the format: ('field name' => ([0] => 'key to map to the selectArray option key value field', [1] => 'key to map to the selectArray option name field'))
     * @var array
     */
    private $selectCols = array();
    /**
     * A dictionary of sizes for the input fields. This is in the format: ('field name' => 'size of input field', etc.) 
     * @var array selectCols
     */
    private $size = array();
    
    /**
     * A list of field names that are text areas. If a field name is in this list the HTML for it will be displayed as a textarea. This is in the format ('field name', 'field name2', 'field name3') 
     * @var array
     */
    private $textArea = array();

    /**
     * Returns the value of 'autofocus' to the input fields if the tab = 1
     * @param int $tab set the return for the html - blank unless tab is 1 in which case the html page is told to autofocus on this field.
     * @return string '' or 'autofocus' depending on value of tab
     */
    public function autofocus($tab) 
    {
        $text = '';
        if ($tab == 1) {
            $text ='autofocus';
        }
        
        return $text;
    }
    
    /**
     * This will use the php filter created to extract the content of the $_GET
     * array and return in an array in the format: $input['name of input field'] => 'value of input field'.
     * @return array Returns the inputs received from the filter of the global array $_GET in a keyed array format.
     */
    public function GET() 
    {
        $inputs = filter_input_array(INPUT_GET, $this->filter);
        return $inputs;
    }
    
    /**
     * Returns the class for the key array
     * @param string $key = the key of the array to return the class for.
     * @return string the class returned
     */
    public function getClass($key) 
    {
        //echo "Returning value for class[$key] = $this->class[$key]";
        return $this->class[$key];
    }
    
    /**
     * Returns the size for the key array
     * @param string $key = the key of the array to return the size for.
     * @return string the size returned
     */
    public function getSize($key) 
    {
        //echo "Returning value for size[$key] = $this->size[$key]";
        return $this->size[$key];
    }
    
    /**
     * Returns the filter created.
     * @return array The filtered values received from the POST or GET, in the format ('field name' => 'value', etc) 
     */
    public function getFilter() 
    {
        return $this->filter;
    }
    
    /**
     * Checks if field is a button. If it is returns TRUE else it will return FALSE
     * @param string $name = name of field
     * @return boolean      = true if field is a button
     */
    public function isButton($name) 
    {
        foreach ($this->buttons as $value) {
            if ($name == $value) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    /**
     * Checks if field is a checkbox. If it is returns TRUE else it will return FALSE
     * @param string $name = name of field
     * @return boolean     = true if field is a checkbox
     */
    public function isCheckBox($name) 
    {
        foreach ($this->checkBox as $value) {
            if ($name == $value) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    /**
     * Checks if field is select. If it is returns TRUE else it will return FALSE
     * @param string $name = name of field
     * @return boolean      = true if field is a select statement
     */
    public function isSelect($name) 
    {
        foreach ($this->selectArray as $value) {
            if ($name == $value) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    /**
     * Checks if field is a text area. If it is return TRUE else it will return FALSE.
     * @param string $name = name of field.
     * @return boolean      = true if field is a text area.
     */
    public function isTextArea($name) 
    {
        foreach ($this->textArea as $value) {
            if ($name == $value) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    /**
     * Prints the input fields for the form
     * @param array $inputs list of input fields to print in format 'field name' => 'field value'
     */
    public function printInputs($inputs) 
    {
        $tab = 1;
        
        foreach ($inputs as $key => $value) {
            $this->printFields($key, $value, $tab, $this->class[$key], $this->size[$key]);
            $tab++;
        }
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
     * Prints the blank fields for the form when no input values have been set.
     */
    public function printBlank() 
    {
        $tab = 1;
        $fields = $this->getFilter();
        foreach ($fields as $key => $value) {
            $this->printFields($key, '', $tab, $this->class[$key], 
                    $this->size[$key]);
            $tab++;
        }
    }
    
    /**
     * This will provide the html required for the button to be displayed on the page.
     * @param string $class = the css class to apply to this button.
     * @param string $key = the name and title of the button within this form.
     * @param int $tab = the tab index of the button on the html grid.
     */
    public function printButton($class, $key, $tab) 
    {
        echo '<div class="' . $class . '"><p class="center"><button type="submit" value="' . $key . 
                    '" name="' . $key . '" title="' .  $key . '" tabindex="' . $tab . '" >' . 
                    $this->underlineToSpace($key) . '</button></p></div>';
    }

    /**
     * Writes the html needed to produce a checkbox on the form.
     * @param string $class = the css class for the checkbox on the form.
     * @param string $key = the name and title ot the checkbox on the form.
     * @param int $tab = the tab index of the checkbox on the form.
     * @param string $checked = whether the check box should be checked. (Default null value = not ticked)
     */
    public function printCheckBox($class, $key, $tab, $checked = '') 
    {
        /* put a check if the box is ticked */
        if ($checked != '') {
            $tick = ' checked';
        } else {
            $tick = '';
        }
        
        if ($this->checkInline[$key]) {
            /* want this check box inline with the title */
            $this->printHeader($class, $key, FALSE);
        } else {
            $this->printHeader($class, $key);
        }
        
        echo '<input type="checkbox" name="' . $key . '" value="' . $this->checkValues[$key] . 
                '" size="1" tabindex="' . $tab . '" ' . $this->readOnly($key) . 
                $this->autofocus($tab) . ' placeholder="' . $this->underlineToSpace($key) . 
                '" ' . $tick . '/></p></div>';
    }
    
    /**
     * Prints the html required for each field in the form.
     * @param string $key = the name and title of the field in the form.
     * @param string $value = the value to display within the field of the form
     * @param int $tab = the tab index of the field.
     * @param string $class = the grid class to apply to the div holding the input field. Default is "grid_2"
     * @param int $numCols = the size of the input field. Default is 4.
     * @param int $numRows = the number of rows to be used in a text area field only. Default = 5.
     * @param string $checked = used by the check box to see if a value was provided
     */
    public function printFields($key, $value, $tab, $class="grid_2", $numCols = 20, $numRows = 5, $checked='') 
    {
        
        if ($this->isButton($key)) {
            /* it is a button */
            $this->printButton($class, $key, $value);
            
        } elseif ($this->isSelect($key)) { 
            $this->printSelect($key, $tab, $class, $value);
        } elseif ($this->isTextArea($key)) {
            /* it is a text area */
            $this->printTextArea($class, $key, $value, $class, $numRows, $numCols);
            
        } elseif ($this->isCheckBox($key)) {
            /* it is a check box */
            $this->printCheckBox($class, $key, $tab, $checked);
            
        } else {
            /* standard input field */
            $this->printInput($class, $value, $key, $tab);
        }
    }

    /**
     * print standard div for input field.
     * @param string $class = the grid class to apply to the div holding the input field. Default is "grid_2"
     * @param string $key = a label to add to the field (default blank = no label)
     * @param boolean $newLine If no key this will cause a new paragraph to be displayed.
     */
    public function printHeader($class, $key = '', $newLine = TRUE) 
    {
        if ($key != '' && $newLine) {
            echo '<div class="' . $class . '"><h6 class="center">' . $this->underlineToSpace($key) . '</h6><p class="center">';
        } elseif ($key != '') {
            echo '<div class="' . $class . '"><p class="center">' . $this->underlineToSpace($key) . '&nbsp;&nbsp;&nbsp;';
        }else {
            echo '<div class="' . $class . '"><p class="center">';
        }
    }
    
    /**
     * prints all the hidden fields for the for.
     */
    public function printHidden() 
    {
        foreach ($this->hidden as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
    }
    
    /**
     * Writes the html for the input field of the form to the page.
     * @param string $class = the css class to be used for this input field.
     * @param string $value = the default value to be displayed for the input field.
     * @param string $key = the name and title of the input field.
     * @param int $tab = the tab index of the field within the form.
     */
    public function printInput($class, $value, $key, $tab) 
    {
        if (isset($this->headers[$key]) && $this->headers[$key]) {
            /* print the header for this field */
            $this->printHeader($class, $key);
        } else {
            $this->printHeader($class);
        }
            
        if (isset($this->id[$key]) && $this->id[$key] != '') {
            echo '<input id="' . $this->id[$key] . '" type="text" name="' . $key . '" value="' . $value . '" tabindex="' .  $tab . 
                '" size="' . $this->size[$key] . '" ' . $this->readOnly($key) . ' ' . 
                $this->autofocus($tab) . ' placeholder="' . $this->underlineToSpace($key) . 
                '" /></p></div>';
        } else {
            echo '<input type="text" name="' . $key . '" value="' . $value . '" tabindex="' .  $tab . 
                '" size="' . $this->size[$key] . '" ' . $this->readOnly($key) . ' ' . 
                $this->autofocus($tab) . ' placeholder="' . $this->underlineToSpace($key) . 
                '" /></p></div>';
        }
    }

    /**
     * Print the html required for each field in the form.
     * @param string $key = the name and title of the field in the form.
     * @param int $tab = the tab index of the field.
     * @param string $class = the grid class to apply to the div holding the input field. Default is "grid_2".
     * @param string $value the value to mark as pre-selected
     */
    public function printSelect($key, $tab, $class, $value = 0) 
    {
        $this->printHeader($class, $key, $newLine = FALSE);
        echo '<select type="text" name="' . $key . '" value="" rows="' .
                $this->size[$key] . '" tabindex="' . $tab . '">';
        
        foreach ($this->selectValues[$key] as $vkey) {
            if ($value == $vkey[$this->selectCols[$key][0]]) {
                /* this value has been selected */
                echo '<option selected ';
            } else {
                echo '<option ';
            }
            echo 'value="' . $vkey[$this->selectCols[$key][0]] . '">' . 
                    $vkey[$this->selectCols[$key][1]] . '</option>';
        }
        echo '</select></p></div>';
    }
    
    /**
     * Writes the html required for the text area in a form
     * @param string $class = the css class to be applied to this text area.
     * @param string $key = the name and title of the text area within the form.
     * @param string $value = the value displayed within the text area by default.
     * @param int $tab = the tab index of the area on the form
     * @param int $numRows = the number of rows of the text area.
     * @param int $numCols = the number of columns of the text area.
     */
    public function printTextArea($class, $key, $value, $tab, $numRows, $numCols) 
    {
        if (isset($this->headers[$key]) && $this->headers[$key]) {
            /* print the header for this field */
            $this->printHeader($class, $key);
        } else {
            $this->printHeader($class);
        }
        echo '<textarea name="' . $key . '" tabindex="' .  $tab . '" rows="' . 
                $numRows . '" cols="' . $numCols . '" ' . $this->readOnly($key) . ' ' . 
                $this->autofocus($tab) . ' placeholder="' . $this->underlineToSpace($key) . 
                '">' . $value .'</textarea></p></div>';      
    }
    
    /**
     * This will use the php filter created to extract the content of the $_POST
     * array and return in an array.
     * @return array inputs received from the filter of the global array $_POST
     */
    public function POST() 
    {
        $inputs = filter_input_array(INPUT_POST, $this->filter);
        return $inputs;
    }
    
    /**
     * This will return a blank string or the word 'readonly' depending if the 
     * field was set to Read Only when setter called 
     * @param type $name = name of field to check
     * @return string blank if field not readonly else word readonly returned - used in input field
     */
    public function readOnly($name) 
    {
        $text = '';
        foreach ($this->readonly as $key => $value) {
            if ($key == $name && $value == TRUE) {
                $text = 'readonly';
            }
        }
        
        return $text;
    }
    
    /**
     * Set the filter array to allow for any input.
     * @param string $name name of the input field.
     * @param boolean $readOnly = set to True if the field is a display only field that cannot have data entered into it. 
     * @param string $class the css class to apply to this field
     * @param int $size the size of the input field to be applied to the HTML
     */
    public function setBlank($name, $readOnly = FALSE, $class = 'col-lg-2 col-md-3 col-sm-4 col-xs-6', $size = 4) 
    {
        $key = $this->spaceToUnderline($name);
        $this->filter[$key] = '';
        $this->readonly[$key] = $readOnly;
        $this->setHTML($key, $class, $size);
    }
    
    /**
     * Sets the filter array to define a button to press.
     * @param string $key = name of the button
     * @param string $class = the css class to apply to the display of this button
     */
    public function setButton($key, $class='col-lg-12') 
    {
        $param = $this->spaceToUnderline($key);
        $this->filter[$param] = $param;
        $this->buttons[$param] = $param;
        $this->class[$param] = $class;
        $this->size[$param] = 2;
    }
    
    /**
     * Set the filter array to allow for a checkbox
     * @param string $key = name of the input field.
     * @param string $value = the value to be returned in the form if the check box is set.
     * @param bool $inline display the title inline with the check box true or false.
     */
    public function setCheckBox($key, $value, bool $inline = FALSE) 
    {
        $param = $this->spaceToUnderline($key);
        $this->setBlank($param);
        $this->checkBox[$param] = $param;
        $this->checkValues[$param] = $value;
        $this->checkInline[$param] = $inline;
    }
    
    /**
     * This will set the filter validation to apply to each field. This is used
     * when extracting the data returned from a _GET or _POST without running
     * the risk of accessing these global arrays directly but instead accessing
     * them using the filter_input_array command to ensure our program only gets
     * expected input.
     * @param string $field the name of the input field this filter applies to
     * @param array $validation the details of the filtering to be applied. This
     *                          can be simple FILTER_VALIDATE_INT to a more 
     *                          complex filter that defines upper and lower 
     *                          limits to be applied. Any value not passing the
     *                          rules of the filter will not be added to the 
     *                          input array.
     */
    public function setFilter($field, $validation) 
    {
        $this->filter[$field] = $validation;
    }

    /**
     * Updates the list of headers for the key supplied to true to force the 
     * printing of labels for this field. Note can be unset using unsetHeader
     * @param string $key the field to show the header for.
     */
    public function setHeader(string $key) 
    {
        $this->headers[$key] = TRUE;
    }
    /**
     * Creates a hidden field with the name of $name and a value of $value
     * @param string $name = name of the hidden field.
     * @param string $value = value of the hidden field.
     */
    public function setHidden($name, $value) 
    {
        $this->hidden[$name] = $value;
    }
    /**
     * Set the class and size for the input field.
     * @param string $param = the name of the field the class and size apply to.
     * @param string $class = the name of the class to apply to the div the field is in.
     * @param int $size = the size of the field.
     * @param string $id = the ID to associate to the CSS for this key
     */
    public function setHTML($param, $class, $size, $id='') 
    {
        $this->class[$param] = $class;
        if ($id != '') {
            $this->id[$param] = $id;
        }
        $this->size[$param] = $size;
    }
    
    /**
     * Set the filter array to allow for an integer input.
     * @param string $key name of the input field.
     * @param boolean $readOnly = set to True if the field is a display only field 
     *        that cannot have data entered into it. 
     * @param type $class = class for <div> (default is "col-lg-2 col-md-3 col-sm-4 col-xs-6")
     * @param type $size = size of the input field (default is 4)
     */
    public function setInt($key, $readOnly = FALSE, $class = 'col-lg-2 col-md-3 col-sm-4 col-xs-6', $size = 4) 
    {
        $param = $this->spaceToUnderline($key);
        $this->filter[$param] = FILTER_VALIDATE_INT;
        $this->readonly[$param] = $readOnly;
        $this->setHTML($param, $class, $size);
    }
    
    /**
     * This sets or unsets the field provided to have the read only attribute 
     * when output as HTML
     * @param string $field the name of the field to be set to read only or not 
     * @param boolean $readOnly TRUE = display field as readonly. 
     *                          FALSE = allow field to receive input
     */
    public function setReadOnly($field, $readOnly) 
    {
        $this->readonly[$field] = $readOnly;
    }
    
    /**
     * Set filter array to allow for a select field. Expects an array in the format:
     * array(
     *      [0]array([value1][value displayed in dropdown]),
     *      [1]array([value2][value displayed in dropdown]), etc
     *      )
     * @param string $key = name of the select field returned in the form.
     * @param array $values  = an array of key, value pairs to put in the select statement. 
     * @param array $cols = keys used in the value pairs - this will be the names of variables used
     *                      in the previous array. The first one being the value returned in the form,
     *                      the second one being the value displayed in the dropdown.
     * @param string $class = class to use in the div html - in format col-lg-n col-md-n col-sm-n col-xs-n
     * @param int $rows = number of rows to show in the select dropdown.
     */
    public function setSelect($key, $values, $cols, $class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12', $rows = 5) 
    {
        $param = $this->spaceToUnderline($key);
        $this->setBlank($param);
        $this->selectValues[$param] = $values;
        $this->selectArray[$param] = $param;
        $this->selectCols[$param] = $cols;
        $this->setHTML($param, $class, $rows);
    }
    
    /**
     * Set the filter array to allow for a string input. Have tried the sanitize filter for this.
     * @param string $key = name of the input field.
     * @param boolean $readOnly = set to True if the field is a display only field that cannot have data entered into it. 
     * @param string $class = the CSS class to apply to this field to improve formatting effects.
     * @param int $size = the size of the field put in the HTML code for this field.
     * @param string $id the id to add to the CSS for this application.
     */
    public function setString($key, $readOnly = FALSE, $class = 'col-lg-2 col-md-3 col-sm-4 col-xs-6', $size = 4, $id = '') 
    {
        $param = $this->spaceToUnderline($key);
        $this->filter[$param] = FILTER_SANITIZE_STRING;
        $this->readonly[$param] = $readOnly;
        $this->setHTML($param, $class, $size, $id);
    }
    
    /**
     * Set the filter array to allow any input but indicate this is a text area field when displayed in the form.
     * @param string $key = name of the input field. 
     * @param boolean $readOnly = set to True if the field is a display only field that cannot have data entered into it. 
     * @param string $class = the CSS class to apply to this field to improve formatting effects.
     * @param int $size = the size of the field put in the HTML code for this field.

     */
    public function setTextArea($key, $readOnly = FALSE, $class = 'col-lg-2 col-md-3 col-sm-4 col-xs-6', $size = 4) 
    {
        $param = $this->spaceToUnderline($key);
        $this->setBlank($param, $readOnly);
        $this->textArea[$param] = $param;
        $this->setHTML($param, $class, $size);
    }
    
    /**
     * This will replace any fields with spaces with underscores.
     * @param string = $string that may have spaces
     * @return string = with underscores instead of spaces.
     */
    public function spaceToUnderline($string) 
    {
        $temp = explode(' ', $string);
        
        return implode('_', $temp);
    }
    
    /**
     * This will replace any fields with underscores with spaces.
     * @param string = $string that may have underscores
     * @return string = with spaces instead of underscores.
     */
    public function underlineToSpace($string) 
    {
        $temp = explode('_', $string);
        
        return implode(' ', $temp);
    }
    
    /**
     * Used to indicate this field should not have a header (label) displayed 
     * when the form is printed. 
     * @param string $key the key of the field to unset the header for
     */
    public function unsetHeader(string $key) 
    {
        $this->headers[$key] = FALSE;
    }
}
