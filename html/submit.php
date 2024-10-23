<?php

include_once 'lib/class_input.php';
include_once 'lib/class_DB.php';
include_once 'lib/class_submit.php';

/*
 *  create instance of input class
 */
$fm = new input();

/*
 *  set the fields to receive from the get
 */
$fm->setInt('ID');
(array) $compNames = [];
(array) $fields = ['AppName', 'EnvName', 'MarvalRef', 'EnvType'];

foreach ($fields as $value) {
    # create input string field based on list of field names
    $fm->setString($value);
}

/*
 *  create fields that allow for any input
 */
$fm->setBlank('AppVersion');
$fm->setBlank('Components');

/*
 * extract the input received from the call to this command expected format example:
 * http://localhost/submit.php?AppName=crs_batch&EnvName=SOST4&AppVersion=5.0.2&MarvalRef=CHG-456254&EnvType=test&Components=archive_CRSRDPRO.sh,crsbus_jobautographfile.sh
 */
$filtered = $fm->GET();

/* 
 * check the values provided for the components installed
 */
if (isset($filtered['Components'])) {
    $compNames = explode(',', $filtered['Components']);
}

/*
 * If we have an AppName and some components to apply make the call to update the database.
 */
if (isset($filtered) && $filtered['AppName'] != '' && count($compNames) > 0 && 
        $filtered['AppVersion'] != '') {
    # create instance of submit class
    $sub = new submit();
    
    # run method to update database
    $sub->update($filtered['AppName'], $filtered['EnvName'], $filtered['AppVersion'], 
        $filtered['MarvalRef'], $compNames, $filtered['EnvType']);

} else {
    # we did not get all the correct information - run a trace of what we did get.
    echo '<br>Did not update the database.<br>Filtered = ';
    print_r($filtered);
    echo '<br>Component names = ';
    print_r($compNames);
}
