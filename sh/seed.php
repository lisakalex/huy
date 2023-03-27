<?php
/*
include(__DIR__ . '/../a.php');

$link = get_link();
$sql = "TRUNCATE TABLE seed";
mysqli_query($link, $sql);
$sql = "TRUNCATE TABLE seed1";
mysqli_query($link, $sql);
//$sql = "TRUNCATE TABLE monitor";
//mysqli_query($link, $sql);
$sql = "TRUNCATE TABLE hyip";
mysqli_query($link, $sql);
$sql = "TRUNCATE TABLE hyip1";
mysqli_query($link, $sql);
$sql = "TRUNCATE TABLE rate";
mysqli_query($link, $sql);
mysqli_close($link);

$hit = 0;
$link = get_link();
$sql = "UPDATE monitor SET hit=?, da=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii", $hit, $hit);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}

$contents = call_curl("goldpoll.com");
$seeds = explode("<table class=", $contents['contents']);
array_shift($seeds);

foreach ($seeds as $s) {
    $seed = null;
    $s = explode("<a href=\"/out", $s);
    $seed = between(">", "<", $s[1]);
    $seed = trim($seed);
    $seed = strtolower($seed);

    try {
        $link = get_link();
        $sql = "INSERT INTO seed (seed) VALUES(?)";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $seed);
            mysqli_stmt_execute($stmt);
            mysqli_close($link);
        }
    } catch (Exception $e) {

    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (seed) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
