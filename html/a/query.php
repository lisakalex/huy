<?php

$page_title = 'Jenkins Dashboard - Query';
include_once 'lib/class_query.php';
include_once 'includes/header.php';

$form = new query(TRUE);
$form->printForm();
include_once 'includes/footer.html';
