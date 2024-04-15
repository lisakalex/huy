<?php
include(__DIR__ . '/../a.php');

$hit = 0;
$link = get_link();
$sql = "SELECT seed_id, seed1 FROM seed1 WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $seed_id, $seed1);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

if ($seed_id) {
    $url = "https://www.allhyipmonitors.com/search/?keyword=" . $seed1;
    $contents = call_curl($url);

    $monitors = explode("<div class=\"mtd\">", $contents['contents']);
    array_shift($monitors);
    foreach ($monitors as $m) {
        $monitor = between("</div>", "target", $m);
        $monitor = after("<a href=\"", $monitor);
        $monitor = get_url($monitor);

        try {
            $link = get_link();
            $sql = "INSERT INTO monitor (monitor) VALUES(?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $monitor);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }
        } catch (Exception $e) {

        }

        try {
            $link = get_link();
            $sql = "INSERT INTO monitor_backup (monitor) VALUES(?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $monitor);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }
        } catch (Exception $e) {

        }

    }

    $hit = 1;
    $link = get_link();
    $sql = "UPDATE seed1 SET hit=? WHERE seed_id=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $hit, $seed_id);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (monitor) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
