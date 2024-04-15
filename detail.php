<?php
include(__DIR__ . '/a.php');

$link = get_link();

$datetime = new DateTime('NOW');
$tt = $datetime->format('Y-m-d');

if (isset ($_GET ['u'])) {
    $url = mysqli_real_escape_string($link, $_GET ['u']);
    $hyip = mysqli_real_escape_string($link, $_GET ['h']);
    $perf = mysqli_real_escape_string($link, $_GET ['perf']);
    $change = mysqli_real_escape_string($link, $_GET ['change']);
    $changep = mysqli_real_escape_string($link, $_GET ['changep']);
}

$hyip_rgaph = null;
//$sql = "SELECT ttime, perf FROM graph WHERE url=? AND perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
$sql = "SELECT ttime, rate, details FROM graph WHERE url=? AND rate > 0 AND ttime < '$tt' ORDER BY ttime";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $url);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ttime, $perf, $monitor_images);
    while (mysqli_stmt_fetch($stmt)) {
        $hyip_rgaph[] = array('date' => $ttime, 'value' => $perf);
    }
}

//mysqli_close($link);

$hyip_rgaph = json_encode($hyip_rgaph);
$monitor_images = json_decode($monitor_images);

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
    <div class="wrap__news">
        <section class="news">
            <div class="container">
            </div>
        </section>
    </div>
    <div style="text-align: center;">
        <!--        <p style="font-size: 2.3em; font-weight: 500">   <h1>--><?//= $url ?><!--</h1></p>-->
        <p style="font-size: 2.3em; font-weight: 500">
        <h1><?= $hyip ?></h1></p>
        <p><a href="<?= $url ?>"><?= $url ?></a></p>
        <p><?= "index " . $perf . "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; day change " . $change . " (" . $changep . "%)" ?></p>
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

        <div style=" width: 15%; background-color: white; padding: 0 4% 0 0; text-align: right;">
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
                    chart.data = JSON.parse('<?= $hyip_rgaph ?>');

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
                <div class="" style="text-align: center; margin: 5% 0 0 0">
                    <a href="<?= $all_banners['Bottom'][1] ?>"><img src="<?= $all_banners['Bottom'][0] ?>"
                                                                    alt="" class=""></a>
                </div>

                <div style="text-align: center; margin: 10% 0 0 0">
                    <h4><?= $hyip ?> is listed on these monitors</h4></p>
                    <p>
                        <?php
                        $kak = 1;
                        if ($monitor_images->status) {
                            foreach ($monitor_images->status as $status) {
                                echo $status;
                                if (count($monitor_images->status) > $kak) {
                                    echo " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; ";
                                }
                                $kak += 1;
                            }
                        }
                        ?>
                    </p>

                    <?php
                    $m_images = $monitor_images->monitors;
                    foreach ($m_images as $d) {
                        $d = str_replace("border=0", "border=\"0\" width=\"150\" height=\"200\"", $d);
                        echo "<div class=\"mtd\">" . $d . "</div>";
                    }
                    ?>
                </div>
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
