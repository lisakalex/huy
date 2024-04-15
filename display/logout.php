<?php
session_start();
/************ Delete the sessions****************/
//unset($_SESSION['cus_id']);
//unset($_SESSION['user_name']);
session_destroy();
/* Delete the cookies*******************/
setcookie("cus_id", '', time() - 60 * 60 * 24 * 60, "/");
setcookie("user_name", '', time() - 60 * 60 * 24 * 60, "/");
setcookie("user_email", '', time() - 60 * 60 * 24 * 60, "/");

/******************* After Logout set this to any redirect page you want*************/
header("Location: ../../index.php");
