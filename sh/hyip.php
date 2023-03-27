<?php
//include(__DIR__ . '/hyip_function.php');
//
//
//$monitor = monitor();
////$monitor = "https://fairmonitor.com/?lang=fr";
//
//if ($monitor == "https://www.goldpoll.com") {
//    goldpoll();
//}
//
//if ($monitor == "https://www.list4hyip.com") {
//    list4hyip();
//}
//
//if ($monitor == "https://fairmonitor.com/?lang=fr") {
//    fairmonitor($monitor);
//}
//
//
//$huy = null;

include(__DIR__ . '/../a.php');

$link = get_link();
$hit = 0;
$sql = "SELECT monitor_id, monitor FROM monitor WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $monitor_id, $monitor);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

if ($monitor_id) {
    $contents = call_curl($monitor);
    try {
//        $hyips = explode("<a class=\"name\"", $contents[`contents`]);
        $hyips = explode("<a class=\"name\"", $contents['contents']);
        array_shift($hyips);
    } catch (Exception $e) {

    }
    foreach ($hyips as $h) {
        $hyip = between("target=_blank>", "<", $h);
        $hyip = trim($hyip);
        $hyip = strtolower($hyip);

        try {
            $link = get_link();
            $sql = "INSERT INTO hyip (monitor, hyip) VALUES(?,?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $monitor, $hyip);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }
        } catch (Exception $e) {

        }

        if ($hyip != null && $hyip != "") {
            $link = get_link();
            $da = 1;
            $sql = "UPDATE monitor SET da=?, da1=? WHERE monitor_id=?";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "iii", $da, $da, $monitor_id);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }
        }
    }

    $link = get_link();
    $hit = 1;
    $sql = "UPDATE monitor SET hit=? WHERE monitor_id=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $hit, $monitor_id);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (hyip) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
