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

$hyip_grgaph = json_encode($data);
mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        #chartdiv {
            width: 100%;
            height: 500px;
            max-width: 100%;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!--    <script src="https://cdn.amcharts.com/lib/5/core.js"></script>-->

    <!--    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>-->
    <!--    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>-->
    <!--    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>-->

    <!--    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>-->
    <!--    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>-->
    <!--    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>-->

    <!-- Chart code -->
    <script>
        am5.ready(function () {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // debugger;
            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                maxTooltipDistance: 0,
                pinchZoomX: true
                // chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
            }));

            // chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
            // var date = new Date();
            // date.setHours(0, 0, 0, 0);
            // var value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 4.2) + value);
                am5.time.add(date, "day", 1);
                // debugger;
                return {
                    date: date.getTime(),
                    value: value
                };

            }

            function generateDatas(count) {
                // var data = [];
                for (var i = 0; i < count; ++i) {
                    data.push(generateData());
                    // debugger;
                }
                return data;
            }

            // var data = [];
            // data.push([
            //     {
            //         "date": 1677456000000,
            //         "value": -2
            //     },
            //     {
            //         "date": 1677542400000,
            //         "value": 3
            //     },
            //     {
            //         "date": 1677628800000,
            //         "value": 8
            //     },
            //     {
            //         "date": 1677715200000,
            //         "value": 6
            //     }
            // ]);
            // data.push([
            //     {
            //         "date": 1677456000000,
            //         "value": -3
            //     },
            //     {
            //         "date": 1677542400000,
            //         "value": 5
            //     },
            //     {
            //         "date": 1677628800000,
            //         "value": 6
            //     },
            //     {
            //         "date": 1677715200000,
            //         "value": 9
            //     }
            // ]);
            var data = [];
            data = JSON.parse('<?= $hyip_grgaph ?>')


            debugger;

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0.2,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {}),
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // debugger;
            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            for (let i = 0; i < data.length; i++) {
                // debugger;
                var series = chart.series.push(am5xy.LineSeries.new(root, {
                    name: data[i][0]["hyip"],
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value",
                    valueXField: "date",
                    legendValueText: "{valueY}",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "{valueY}"
                    })
                }));
                // debugger;
                // date = new Date();
                // date.setHours(0, 0, 0, 0);
                // value = 0;
                // var data = generateDatas(100);
                // series.data.setAll(data);

                date = data[i][0]["date"];
                // date.setHours(0, 0, 0, 0);
                value = data[i][0]['value'];
                series.data.setAll(data[i]);

                // Make stuff animate on load
                // https://www.amcharts.com/docs/v5/concepts/animations/
                series.appear();
                debugger;
            }

            // for (let i = 0; i < da.length; i++)
            //     console.log(i + ". " + da[i]);
            //
            // document.getElementById("demo").innerHTML = da.toString();

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            // chart.set("scrollbarY", am5.Scrollbar.new(root, {
            //     orientation: "vertical"
            // }));


            // Add legend
            // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
            var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
                width: 200,
                paddingLeft: 15,
                height: am5.percent(100)
            }));

            // When legend item container is hovered, dim all the series except the hovered one
            legend.itemContainers.template.events.on("pointerover", function (e) {
                var itemContainer = e.target;

                // As series list is data of a legend, dataContext is series
                var series = itemContainer.dataItem.dataContext;

                chart.series.each(function (chartSeries) {
                    if (chartSeries != series) {
                        chartSeries.strokes.template.setAll({
                            strokeOpacity: 0.15,
                            stroke: am5.color(0x000000)
                        });
                    } else {
                        chartSeries.strokes.template.setAll({
                            strokeWidth: 3
                        });
                    }
                })
            })

            // When legend item container is unhovered, make all series as they are
            legend.itemContainers.template.events.on("pointerout", function (e) {
                var itemContainer = e.target;
                var series = itemContainer.dataItem.dataContext;

                chart.series.each(function (chartSeries) {
                    chartSeries.strokes.template.setAll({
                        strokeOpacity: 1,
                        strokeWidth: 1,
                        stroke: chartSeries.get("fill")
                    });
                });
            })

            legend.itemContainers.template.set("width", am5.p100);
            legend.valueLabels.template.setAll({
                width: am5.p100,
                textAlign: "right"
            });

            // It's is important to set legend data after all the events are set on template, otherwise events won't be copied
            legend.data.setAll(chart.series.values);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
</head>
<body>


<!-- HTML -->
<div id="chartdiv"></div>
<!--<div id="demo"></div>-->

</body>
</html>