<?php
$page_title = 'Consolidated';
include_once 'lib/class_consolidate.php';
include_once 'includes/header.php';

$form = new consolidate(false);
$form->printConsolidatedForm();

include_once 'includes/footer.html';
