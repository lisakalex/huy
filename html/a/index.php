<?php

$page_title = 'Applications';
include_once 'lib/class_query.php';
include_once 'includes/header.php';

$form = new query(FALSE);
$form->printForm();

include_once 'includes/footer.html';


