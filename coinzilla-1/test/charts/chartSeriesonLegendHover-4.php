<?php
include(__DIR__ . '../../a.php');
$link = get_link();

$datetime = new DateTime('NOW');
//$datetime1 = new DateTime('today');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//$ttime = $datetime->format('Y-m-d');
$ttime = "2022-09-07%";
$graph = [];
$hyips = [];
$data = [];

//if (isset ($_GET ['u'])) {
//    $url = mysqli_real_escape_string($link, $_GET ['u']);
//    $hyip = mysqli_real_escape_string($link, $_GET ['h']);
//    $perf = mysqli_real_escape_string($link, $_GET ['perf']);
//    $change = mysqli_real_escape_string($link, $_GET ['change']);
//    $changep = mysqli_real_escape_string($link, $_GET ['changep']);
//}

$sql = "SELECT hyip, url FROM graph WHERE ttime like '$ttime' ORDER BY perf DESC limit 10";
//$sql = "SELECT hyip, perf, ttime FROM graph";
//$sql = "SELECT htime, perf FROM graph";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url);
    while (mysqli_stmt_fetch($stmt)) {
        $hyips[] = array('hyip' => $hyip, 'url' => $url);
    }

    sort($hyips);
}

$datetime = new DateTime('today');
$ttime = $datetime->format('Y-m-d');
//$url = "http://activefunds7.com";
//$sql = "SELECT ttime, perf FROM graph4 WHERE perf > 0 AND ttime < now() - INTERVAL 1 DAY ORDER BY ttime";
$sql = "SELECT hyip, perf, ttime, url FROM graph WHERE ttime < '$ttime'";
//$sql = "SELECT hyip, perf, ttime FROM graph";
//$sql = "SELECT htime, perf FROM graph";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $perf, $htime, $url);
    while (mysqli_stmt_fetch($stmt)) {
        $datetime = new DateTime($htime);
        $ttime = $datetime->format('Y-m-d');
        $graph[] = array('hyip' => $hyip, 'date' => strtotime($ttime) * 1000, 'value' => floatval($perf), 'url' => $url);
    }
}
foreach ($hyips as $h) {
    $series = [];
    foreach ($graph as $g) {
        if ($g['url'] == $h['url']) {
            $series[] = $g;
        }
    }
    sort($series);
    $data[] = $series;
}

$hyip_graph_total = json_encode($data);
mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./me.css">
</head>
<body>


<div id="chartdiv"></div>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script data-hyip_graph_total='<?= $hyip_graph_total ?>' src="./me.js"></script>
</body>
</html>