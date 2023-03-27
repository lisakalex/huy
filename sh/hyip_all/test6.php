<?php
include(__DIR__.'/../a.php');

$kak = "kak";
$link = get_link();
$sql = "INSERT INTO test (huy) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $kak);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
