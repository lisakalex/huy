<?php
include(__DIR__ . '/../a.php');

$hit = 0;
$link = get_link();
$sql = "SELECT seed_id, seed FROM seed WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $seed_id, $seed);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

if ($seed_id) {
    $seed = urlencode($seed);
    $url = "https://www.allhyipmonitors.com/search/?keyword=" . $seed;
    $contents = call_curl($url);

    if (found($contents['contents'], "<div class=\"mtd\">")) {
        $seed1 = between("0 0 0 10px\">", "target", $contents['contents']);
        $seed1 = between("<a href=\"", "\"", $seed1);
        $seed1 = get_url($seed1);

        try {
            $link = get_link();
            $sql = "INSERT INTO seed1 (seed1) VALUES(?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $seed1);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }

        } catch (Exception $e) {

        }

    } else {
        $seedhs = between("<center>", "</center>", $contents['contents']);
        $seedhs = explode("<img src=\"https://blinky.nemui.org/shot/120x120?", $seedhs);
        array_shift($seedhs);
        foreach ($seedhs as $h) {
            $seed1 = before("/\"", $h);

            try {
                $link = get_link();
                $sql = "INSERT INTO seed1 (seed1) VALUES(?)";
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $seed1);
                    mysqli_stmt_execute($stmt);
                    mysqli_close($link);
                }

            } catch (Exception $e) {

            }
        }
    }

    $hit = 1;
    $link = get_link();
    $sql = "UPDATE seed SET hit=? WHERE seed_id=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $hit, $seed_id);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (seed1) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
