<?php

$page_title = 'Reporting';
include_once 'lib/class_reporting.php';
include_once 'includes/header.php';

$form = new reporting(false);
$form->printForm();

include_once 'includes/footer.html';


