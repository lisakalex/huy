<?php
include(__DIR__ . '../../a.php');
$link = get_link();

//$datetime = new DateTime('NOW');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
$hyip = null;
$perf = null;

if (isset ($_GET ['u'])) {
    $url = mysqli_real_escape_string($link, $_GET ['u']);
    $hyip = mysqli_real_escape_string($link, $_GET ['h']);
    $perf = mysqli_real_escape_string($link, $_GET ['perf']);
    $change = mysqli_real_escape_string($link, $_GET ['change']);
    $changep = mysqli_real_escape_string($link, $_GET ['changep']);
}

$sql = "SELECT hyip, perf FROM graph WHERE ttime like '2022-09-06%' AND perf > 0 ORDER BY perf LIMIT 10";
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $data[] = array('category' => $hyip, 'value' => $perf);
    }
}

//$dates = array_column($graph, 'date');
//$dates = array_unique($dates);
//
//foreach ($dates as $date) {
//    $value = null;
//    foreach ($graph as $date_value) {
//        if ($date_value['date'] == $date) {
//            $value += $date_value['value'];
//        }
//    }
//
//    $data[] = array('category' => $category, 'value' => $value);
//}

$hyip_pie = json_encode($data);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
    </style>
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

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

// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    endAngle: 270
                })
            );

// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "category",
                    endAngle: 270
                })
            );

            series.states.create("hidden", {
                endAngle: -90
            });

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
//        series.data = JSON.parse('<?//= $hyip_pie ?>//')
        series.data.setAll(JSON.parse('<?= $hyip_pie ?>')
            // series.data.setAll([{
            //     category: "Lithuania",
            //     value: 501.9
            // }, {
            //     category: "Czechia",
            //     value: 301.9
            // }, {
            //     category: "Ireland",
            //     value: 201.1
            // }, {
            //     category: "Germany",
            //     value: 165.8
            // }, {
            //     category: "Australia",
            //     value: 139.9
            // }, {
            //     category: "Austria",
            //     value: 128.3
            // }, {
            //     category: "UK",
            //     value: 99
                );
            // }]);

            series.appear(1000, 100);

        }); // end am5.ready()
    </script>

</head>
<body>


<!-- HTML -->
<div id="chartdiv"></div>

</body>
</html>