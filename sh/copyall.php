<?php
/*
include(__DIR__ . '/../a.php');

//$datenow = get_now();
$datenow = new DateTime('NOW');
$datenow = $datenow->format('Y-m-d');
$nullnow = null;

try {

    $link = get_link();
    $sql = "INSERT INTO graph (hyip, url, perf, details) SELECT hyip, url, perf, details FROM rate";
    mysqli_query($link, $sql);
    mysqli_close($link);

    $link = get_link();
    $sql = "INSERT INTO graph_backup (hyip, url, perf, details) SELECT hyip, url, perf, details FROM rate";
    mysqli_query($link, $sql);
    mysqli_close($link);

//    $link = get_link();
//    $sql = "UPDATE graph SET htime=? WHERE htime=?";
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "ss", $datenow, $nullnow);
//        mysqli_stmt_execute($stmt);
//        mysqli_close($link);
//    }

    $link = get_link();
    $sql = "DELETE FROM curl_data WHERE ttime < NOW() - INTERVAL 7 DAY";
    mysqli_query($link, $sql);
    mysqli_close($link);

    $htime = new DateTime('NOW');
    $htime = $htime->format('Y-m-d');
    $htime = "`" . $htime . "`";
    $link = get_link();
    $sql = "CREATE TABLE " . $htime . " SELECT * FROM rate;";
    mysqli_query($link, $sql);
    mysqli_close($link);

    $htime = new DateTime('NOW');
    $htime->modify('-7 days');
    $htime = $htime->format('Y-m-d');
    $htime = "`" . $htime . "`";
    $link = get_link();
    $sql = "DROP TABLE " . $htime;
    mysqli_query($link, $sql);
    mysqli_close($link);

    $pid = getmypid();
    $link = get_link();
    $sql = "INSERT INTO log (graph) VALUES(?)";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $pid);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }

    $link = get_link();
    $sql = "DELETE FROM log WHERE ttime < NOW() - INTERVAL 7 DAY";
    mysqli_query($link, $sql);
    mysqli_close($link);

} catch (Exception $e) {

}
