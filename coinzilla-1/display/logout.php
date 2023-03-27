<?php
session_start();
session_destroy();
setcookie("cus_id", '', time() - 60 * 60 * 24 * 60, "/");
setcookie("user_name", '', time() - 60 * 60 * 24 * 60, "/");
setcookie("user_email", '', time() - 60 * 60 * 24 * 60, "/");
header("Location: ../index.php");
