<?php
$page_title = 'Environments';
include_once 'lib/class_environments.php';
include_once 'includes/header.php';

$form = new environments(false);
$form->printenvironmentsForm();

include_once 'includes/footer.html';
