<?php
include(__DIR__ . '/a.php');
$link = get_link();

$datetime = new DateTime('NOW');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
$ttime = $datetime->format('Y-m-d');


//if (isset ($_GET ['today_total'])) {
//    $today_total = mysqli_real_escape_string($link, $_GET ['today_total']);
//    $change_total = mysqli_real_escape_string($link, $_GET ['change_total']);
//    $change_totalp = mysqli_real_escape_string($link, $_GET ['change_totalp']);
//    $hyips = mysqli_real_escape_string($link, $_GET ['hyips']);
//}

//$sql = "SELECT ttime, perf FROM graph4 WHERE perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
$sql = "SELECT ttime, perf FROM graph WHERE perf > 0 AND ttime < '$ttime' ORDER BY ttime";
//$sql = "SELECT htime, perf FROM graph";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $htime, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $graph[] = array('date' => $htime, 'value' => $perf);
    }
//    $hyips = mysqli_stmt_num_rows($stmt);
}

//mysqli_close($link);

$dates = array_column($graph, 'date');
$dates = array_unique($dates);

foreach ($dates as $date) {
    $value = null;
    foreach ($graph as $date_value) {
        if ($date_value['date'] == $date) {
            $value += $date_value['value'];
        }
    }

    $data[] = array('date' => $date, 'value' => $value);
}

$data = json_encode($data);


include(__DIR__ . '/header.php');
?>
    <div class="" style="text-align: center">
        <a href="<?= $all_banners['Top'][1] ?>"><img src="<?= $all_banners['Top'][0] ?>" alt="" class=""></a>
        <!--                                                <img src="https://hyipbanker.com/banners/2020_12_14_4382/imafil.gif">-->
        <!--                        <iframe src="https://files.cointraffic.io/pub/00814bc34ab35b05be1363acc303f5d8f1feb4da/fe49d09bff6439e7d1c5112503403090e6c5f18f/index.html"-->
        <!--                                width="728" height="90"-->
        <!--                                style="display: block; border: 0; overflow: hidden; margin:0 auto; width: 728px; max-width: 728px; height: 90px; max-height: 90px;"></iframe>-->
        <!--                    </div>-->
    </div>
    <div class="wrap__news" xmlns="http://www.w3.org/1999/html">
        <section class="news">
            <div class="container">
            </div>
        </section>
    </div>

    <div style="text-align: center;">
        <!--        <p style="font-size: 2.3em; font-weight: 500"> HYIP performance index</p>-->
        <h1> Investment market performance index</h1>
        <p><?= count($today) ?> companies listed &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; IMP index <?= $today_index ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Day change <?= $index_change ?>
            (<?= $index_change_percentage ?>%)</p>
    </div>

    <!--    <div class="" style="display: flex; flex-direction: row; padding: 2% 10% 2% 10%; justify-content: space-between">-->
    <!--        <div class="" style="">-->
    <!--            <img src="https://hyipbanker.com/banners/2020_12_20_4383/imafil.gif">-->
    <!--        </div>-->
    <!--        <div class="" style="">-->
    <!--            <img src="https://hyipbanker.com/banners/2020_12_20_4383/imafil.gif">-->
    <!--        </div>-->
    <!--    </div>-->
    <hr style="margin: 0 0 0 0;">
    <div class="wrap__news" style="display: flex; flex-direction: row; ">
        <hr style="margin: 0 0 0 0;">


        <!--        <div style=" width: 15%; background-color: white; padding: 4% 4% 0 0; text-align: right ">-->
        <!--            <div style="margin: 10px 0 10px 0">-->
        <!--                <img src="https://forexprofits.biz/images/FP-125.gif">-->
        <!--            </div>-->
        <!--            <div style="margin: 10px 0 10px 0">-->
        <!--                <img src="https://forexprofits.biz/images/FP-125.gif">-->
        <!--            </div>-->
        <!--            <div style="margin: 10px 0 10px 0">-->
        <!--                <img src="https://forexprofits.biz/images/FP-125.gif">-->
        <!--            </div>-->
        <!--            <div style="margin: 10px 0 10px 0">-->
        <!--                <img src="https://forexprofits.biz/images/FP-125.gif">-->
        <!--            </div>-->
        <!--            <div style="margin: 10px 0 10px 0">-->
        <!--                <img src="https://forexprofits.biz/images/FP-125.gif">-->
        <!--            </div>-->
        <!--        </div>-->

        <div style=" width: 15%; background-color: white; padding: 0 4% 0 0; text-align: right ">
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 1'][1] ?>"><img src="<?= $all_banners['Left side 1'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 2'][1] ?>"><img src="<?= $all_banners['Left side 2'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 3.json'][1] ?>"><img src="<?= $all_banners['Left side 3.json'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 4'][1] ?>"><img src="<?= $all_banners['Left side 4'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 5'][1] ?>"><img src="<?= $all_banners['Left side 5'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
        </div>
        <div style=" width: 70%; background-color: white; padding: 50px 0 50px 0">

            <!-- Styles -->
            <style>
                #chartdiv {
                    width: 100%;
                    height: 500px;
                }

            </style>

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
                    chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

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
            <div class="" style="text-align: center; margin: 5% 0 0 0">
                <a href="<?= $all_banners['Bottom'][1] ?>"><img src="<?= $all_banners['Bottom'][0] ?>"
                                                                alt="" class=""></a>
            </div>
        </div>
        <div style="width: 15%; background-color: white; padding: 0 0 0 4%;">
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 1'][1] ?>"><img src="<?= $all_banners['Right side 1'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 2'][1] ?>"><img src="<?= $all_banners['Right side 2'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 3.json'][1] ?>"><img src="<?= $all_banners['Right side 3.json'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 4'][1] ?>"><img src="<?= $all_banners['Right side 4'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 5'][1] ?>"><img src="<?= $all_banners['Right side 5'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
        </div>
    </div>

<?php
include(__DIR__ . '/footer.php');
