<?php
//include 'a.php';
function get_link() {
    $link = mysqli_connect("localhost", "al", "111", "intspeed");
//    $link = mysqli_connect("localhost", "tihuy", "Zaichik1.&", "tihuy");
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit ();
    }

    mysqli_set_charset($link, 'utf8'); // https://www.php.net/manual/en/mysqli.set-charset.php
    return $link;
}

$link = get_link();
//$today_totalu = null;
//$change_totalu = null;
//$change_totalpu = null;
//
//if (isset ($_GET ['today_total'])) {
//    $today_totalu = mysqli_real_escape_string($link, $_GET ['today_total']);
//    $change_totalu = mysqli_real_escape_string($link, $_GET ['change_total']);
//    $change_totalpu = mysqli_real_escape_string($link, $_GET ['change_totalp']);
//    $hyipsu = mysqli_real_escape_string($link, $_GET ['hyipsu']);
//}

//$sql = "SELECT htime, perf FROM graph WHERE perf > 0 AND htime < NOW() - INTERVAL 1 DAY ORDER BY htime";
$sql = "SELECT ttime, download FROM speed";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $htime, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $graph[] = array('date' => $htime, 'value' => $perf);
    }
//    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

//$dates = array_column($graph, 'date');
////$dates = array_unique($dates);
//
//foreach ($dates as $date) {
//    $value = null;
//    foreach ($graph as $date_value) {
////        if ($date_value['date'] == $date) {
//        $value += $date_value['value'];
////        }
//    }
//
//    $data[] = array('date' => $date, 'value' => $value);
//}

$data = json_encode($graph);

?>


<!--        <div style=" width: 70%; background-color: white; padding: 50px 0 50px 0">-->

<!-- Styles -->
<!--<style>-->
<!--    #chartdiv {-->
<!--        width: 100%;-->
<!--        height: 90%;-->
<!--    }-->
<!---->
<!--</style>-->

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
        chart.data = JSON.parse('<?= $data ?>');

// Set input format for the dates
//                     chart.dateFormatter.inputDateFormat = "yyyy-MM-dd-hh-mm";
        chart.dateFormatter.inputDateFormat = "yyyy-MM-dd hh-mm";

// Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "value";
        series.dataFields.dateX = "date";
        series.tooltipText = "{value}"
        series.strokeWidth = 2;
        series.minBulletDistance = 15;

// Drop-shaped tooltips
        series.tooltip.background.cornerRadius = 20;
        series.tooltip.background.strokeOpacity = 0;
        series.tooltip.pointerOrientation = "vertical";
        series.tooltip.label.minWidth = 40;
        series.tooltip.label.minHeight = 40;
        series.tooltip.label.textAlign = "middle";
        series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
        var bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.strokeWidth = 2;
        bullet.circle.radius = 4;
        bullet.circle.fill = am4core.color("#fff");

        var bullethover = bullet.states.create("hover");
        bullethover.properties.scale = 1.3;

// Make a panning cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panXY";
        chart.cursor.xAxis = dateAxis;
        chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
        chart.scrollbarY = new am4core.Scrollbar();
        chart.scrollbarY.parent = chart.leftAxesContainer;
        chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
        chart.scrollbarX = new am4charts.XYChartScrollbar();
        chart.scrollbarX.series.push(series);
        chart.scrollbarX.parent = chart.bottomAxesContainer;

        dateAxis.start = 0.79;
        dateAxis.keepSelection = true;


    }); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>



