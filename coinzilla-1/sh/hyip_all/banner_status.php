<?php
include(__DIR__ . '/../a.php');

$status = 1;
$link = get_link();
$sql = "SELECT id, days, start_date FROM banner WHERE status=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $days, $start_date);

    while (mysqli_stmt_fetch($stmt)) {
        $banners[] = array('id' => $id, 'days' => $days, 'start_date' => $start_date);
    }
    mysqli_close($link);
}

foreach ($banners as $banner) {
    $start_date = new DateTime($banner['start_date']);
    $finish = $start_date->modify('+' . $banner['days'] . 'days');
    $finish = $start_date->modify('-1 days');

    $now = new DateTime('NOW');
    $now = $now->format('Y-m-d');
    $now = new DateTime($now);

    if ($finish < $now) {
        $link = get_link();
        $sql = "UPDATE banner SET status=0 WHERE id=" . $banner['id'];
        mysqli_query($link, $sql);
        mysqli_close($link);
    }
}
