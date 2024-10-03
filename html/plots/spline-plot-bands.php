<?php
include(__DIR__ . '/../a.php');
$link = get_link();

/******************** imp ********************/
$datetime = new DateTime('NOW');
$ttime = $datetime->format('Y-m-d');

//$sql = "SELECT ttime, perf FROM graph WHERE perf > 0 AND ttime < '2023-05-30' ORDER BY ttime";
$sql = "SELECT ttime, rate FROM graph WHERE ttime < '$ttime'";
//$sql = "SELECT htime, perf FROM graph";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $htime, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $graph[] = array('date' => $htime, 'value' => $perf);
    }
}

$dates = array_column($graph, 'date');
$dates = array_unique($dates);

foreach ($dates as $date) {
    $value = null;
    foreach ($graph as $date_value) {
        if ($date_value['date'] == $date) {
            $value += $date_value['value'];
        }
    }

    try {
        $datetime = new DateTime($date);
    } catch (Exception $e) {
    }
    $ttime = $datetime->format('Y-m-d');
    $timestamp = strtotime($ttime);

    $imp[] = [$timestamp * 1000, $value];
}
//$sql = "SELECT DATE , `AAPL.Open` FROM plot1 limit 1000000";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $t, $p);
//    while (mysqli_stmt_fetch($stmt)) {
//        $p = floatval($p);
//        $imp[] = [$t * 1000, $p];
//    }
//}
$imp = json_encode($imp);

/******************** top-ten-pie ********************/
$datetime = new DateTime('NOW');
$datetime->modify('-6 days');
$ttime = $datetime->format('Y-m-d') . "%";
//$sql = "SELECT hyip, perf FROM graph WHERE ttime like '2023-05-29%' and perf > 0 ORDER BY perf desc LIMIT 10";
$sql = "SELECT hyip, rate FROM graph WHERE ttime like '$ttime' ORDER BY rate desc limit 10";

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $h, $p);
    while (mysqli_stmt_fetch($stmt)) {
        $top_ten_pie[] = array('name' => $h, 'y' => floatval($p));

//        $top_ten_pie[] = [$h, $p];
    }
}

$top_ten_pie = json_encode($top_ten_pie);

/******************** top-ten ********************/
$graph = [];
$hyips = [];
$top_ten = [];
$urls = [];
$top = [];
$u = [];

//$sql = "SELECT hyip, url FROM graph WHERE ttime like '2023-08-24%' ORDER BY perf DESC limit 10";
//$sql = "SELECT hyip, url FROM graph1 WHERE ttime like '$ttime' ORDER BY rate DESC limit 2";
//$sql = "SELECT hyip, url FROM graph1";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url);
//    while (mysqli_stmt_fetch($stmt)) {
//        $hyips[] = array('hyip' => $hyip, 'url' => $url);
//    }
//
//    sort($hyips);
//}

//$sql = "SELECT distinct url FROM graph1 ORDER BY rate DESC";
//$sql = "SELECT * FROM graph1";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt,  $url);
//    while (mysqli_stmt_fetch($stmt)) {
//        $hyips[] = array('hyip' => $hyip, ;
//    }
//}
//$hyips = array_unique($hyips);

//$ttime = '2024-04-28%';
$d = new DateTime('today');
$d->modify('-6 days');
$yesterday = $d->format('Y-m-d') . "%";
//
////$d = new DateTime('today');
////$today = $d->format('Y-m-d') . "%";
//
$sql = "SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $url);
    while (mysqli_stmt_fetch($stmt)) {
        $u[] = $url;
    }
}
//
foreach ($u as $uu) {
    $u1 = $u1 . $uu . '\',\'';
}

$u1 = "'" . substr($u1, 0, -2);
//$d = new DateTime('today');
//$d->modify('-1 days');
//$yesterday = $d->format('Y-m-d') . "%";


//$sql = "SELECT VID, thumb FROM video WHERE VID IN (select * from (SELECT VID FROM video WHERE title LIKE \"%'.$Channel['name'].'%\"ORDER BY viewtime DESC LIMIT 5) temp_tab) ORDER BY RAND() LIMIT 1)";

$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$yesterday' and url IN (".$u1.")";
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$yesterday' and url IN ('https://www.safeassets.com','https://stakingi.com','https://bitcashdeposit.com','https://yinksfund.com','https://btcusdtfund.com','https://bitdepositday.com','https://vakfund.com','https://luxioprofit.com','https://earnbitprofit.com','https://aitimart.com')";
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '2024-05-04%' and url IN ('https://stakingi.com','https://www.safeassets.com','https://bitcashdeposit.com','https://btcusdtfund.com','https://yinksfund.com','https://bitdepositday.com','https://vakfund.com','https://luxioprofit.com','https://earnbitprofit.com','https://coinincome.biz')";
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE url IN (select * from (SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10) as temp_tab)";
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$today' and url IN ('$u[0]','$u[1]','$u[2]','$u[3]','$u[4]','$u[5]','$u[6]','$u[7]','$u[8]','$u[9]')";
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE url IN (SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10)";
//$sql = "SELECT hyip, url, rate, ttime FROM graph";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $rate, $ttime);
    while (mysqli_stmt_fetch($stmt)) {
        $ttime = new DateTime($ttime);
        $ttime = $ttime->format('Y-m-d');
//        $graph[] = array('hyip' => $hyip, 'url' => $url, 'rate' => floatval($rate), 'ttime' => strtotime($ttime) * 1000);
        $graph[] = array('hyip' => $hyip, 'url' => $url, 'rate' => floatval($rate), 'ttime' => $ttime);
    }
}
$graph1 = json_encode($graph);
//foreach ($graph as $g) {
//    if ($g['ttime'] == $yesterday) {
//        $urls[] = $g;
//    }
//}
//
//function array_orderby()
//{
//    $args = func_get_args();
//    $data = array_shift($args);
//    foreach ($args as $n => $field) {
//        if (is_string($field)) {
//            $tmp = array();
//            foreach ($data as $key => $row)
//                $tmp[$key] = $row[$field];
//            $args[$n] = $tmp;
//        }
//    }
//
//    $args[] = &$data;
//    call_user_func_array('array_multisort', $args);
//    return array_pop($args);
//}
//
//$urls = array_orderby($urls, 'rate', SORT_DESC);
//$urls = array_slice($urls, 0, 10);
//$urls = array_column($urls, 'url');

foreach ($u as $url) {
    $data = [];
    foreach ($graph as $g) {
        if ($g['url'] == $url) {
            $data[] = array(strtotime($g['ttime']) * 1000, $g['rate']);
        }

    }
    $top[] = array('name' => $url, 'data' => $data);

}

$top_ten = json_encode($top);

/******************** create header ********************/
// create header (153 companies listed       IMP index 848.44       day change +24.10 (+2.92%))
$today = array();
$yesterday = array();
$datetime = new DateTime('NOW');
$datetime->modify('-1 days');
$ttime = $datetime->format('Y-m-d') . "%";
$perf = null;
$today_index = null;
$yesterday_index = null;
$link = get_link();

//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2023-05-29%' AND perf > 0";
$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '$ttime'";

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
        $today_index += $perf;
    }
}

$datetime = new DateTime('NOW');
$datetime->modify('-2 days');
$ttime = $datetime->format('Y-m-d') . "%";

//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2023-05-28%' AND perf > 0";
$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '$ttime'";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
        $yesterday_index += $perf;
    }
}

$index_change = $today_index - $yesterday_index;
$index_change_percentage = change_percentage($today_index, $yesterday_index);

$index_change = number_format($index_change, 2);
if ($index_change > 0) $index_change = "+" . $index_change;

$index_change_percentage = number_format($index_change_percentage, 2);
if ($index_change_percentage > 0) $index_change_percentage = "+" . $index_change_percentage;

//$all_banners = all_banners();
$huy = null;
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@demo.title@ Example</title>

    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            /*max-width: 800px;*/
            height: 900px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
</head>
<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        This demo shows how plot bands can be used on an axis to
        highlight regions of a chart. In this example, the plot
        bands are used to separate the wind speeds on the Y-axis
        into categories.
    </p>
</figure>


<script type="text/javascript">
    // Data retrieved from https://www.vikjavev.no/ver/#2020-04-15,2020-04-16
    const imp = document.currentScript.dataset.imp;

    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            scrollablePlotArea: {
                // minWidth: 600,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Wind speed during a day',
            align: 'left'
        },
        subtitle: {
            text: '15th & 16th of April, 2020 at two locations in Vik i Sogn, ' +
                'Norway',
            align: 'left'
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            title: {
                text: 'Wind speed (m/s)'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{ // Light air
                from: 0.3,
                to: 1.5,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Light air',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 1.5,
                to: 3.3,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Light breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 3.3,
                to: 5.5,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Gentle breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 5.5,
                to: 8,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Moderate breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Fresh breeze
                from: 8,
                to: 11,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Fresh breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Strong breeze
                from: 11,
                to: 14,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Strong breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Near Gale
                from: 14,
                to: 17,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Near gale',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Fresh Gale
                from: 17,
                to: 20.5,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Fresh gale',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Strong Gale
                from: 20.5,
                to: 24,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Strong gale',
                    style: {
                        color: '#606060'
                    }
                }
            }]
        },
        tooltip: {
            valueSuffix: ' m/s'
        },
        plotOptions: {
            spline: {
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                marker: {
                    enabled: false
                },
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(2020, 3, 15, 0, 0, 0)
            }
        },
        series: [{
            name: 'Hestavollane',
            data: [
                5.4, 5.2, 5.7, 6.3, 5.2, 5.6, 6.1,
                5.6, 5.9, 7.1, 8.6, 7.8, 8.6,
                8.0, 9.7, 11.2, 12.5, 13.1, 10.6,
                10.9, 8.9, 9.5, 7.5, 3.5, 4.2
            ]

        }, {
            name: 'Vik',
            data: [
                0.2, 0.1, 0.1, 0.5, 0.3, 0.2, 0.1,
                0.1, 0.1, 0.1, 0.2, 1.1, 1.3,
                2.0, 1.5, 1.5, 1.5, 1.4, 1.7,
                2.0, 2.9, 2.1, 2.1, 3.5, 2.9
            ]
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });

</script>
<script data-imp='<?= $imp ?>' data-top_ten_pie='<?= $top_ten_pie ?>' data-top_ten='<?= $top_ten ?>' src="/assets/js/highcharts.js"></script>

</body>
</html>
