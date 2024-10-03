<?php

$page_title = 'Summary';
include_once 'lib/class_summary.php';
include_once 'includes/header.php';

$form = new summary(true);
$form->printForm();
include_once 'includes/footer.html';
