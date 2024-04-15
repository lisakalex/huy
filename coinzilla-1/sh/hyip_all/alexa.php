<?php
include(__DIR__ . '/../a.php');

$hit = 0;
$monitor = "";
$link = get_link();
$sql = "SELECT monitor FROM monitor WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $monitor);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

if ($monitor) {
    $url = "https://www.alexa.com/siteinfo/" . $monitor;
    $contents = call_curl($url);
    $alexa = between("Today<br/><span class=\"hash\">#</span><span class=\"rank\">", "<", $contents['contents']);
    $alexa = trim($alexa);
    $alexa = intval(preg_replace("/,+/", "", $alexa));
    if ($alexa == 0) $alexa = 1000000000;

    $link = get_link();
    $sql = "UPDATE monitor SET alexa=? WHERE monitor=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "is", $alexa, $monitor);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

$hit = 1;
$link = get_link();
$sql = "UPDATE monitor SET hit=? WHERE monitor=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $hit, $monitor);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
