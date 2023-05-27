<?php
include(__DIR__.'/../a.php'); //https://www.php.net/manual/en/function.set-include-path.php
//sleep(10);
$huy = "sh/xxx";
$da = getmypid();
$link = get_link();
$sql = "INSERT INTO test (coindesk) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $huy);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}

//run_someone("/hyip/sh/test.php");
