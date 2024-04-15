<?php
include(__DIR__ . '/../a.php');

$hit = 0;
$link = get_link();
$sql = "SELECT hyip_id, hyip FROM hyip WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $urll);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

$hit = 1;
$link = get_link();
$sql = "UPDATE hyip SET hit=? WHERE hyip_id=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii", $hit, $id);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}

if ($id) {
    $curl = call_curl($urll);
    $urll = get_url($curl['eff_url']);

    try {
        $link = get_link();
        $sql = "INSERT INTO hyip1 (hyip1) VALUES(?)";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s",  $urll);
            mysqli_stmt_execute($stmt);
            mysqli_close($link);
        }
    } catch (Exception $e) {

    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (hyip1) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
