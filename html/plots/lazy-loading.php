<?php
//include(__DIR__ . '/../a.php');
//$link = get_link();
//
///******************** imp ********************/
//$datetime = new DateTime('NOW');
//$ttime = $datetime->format('Y-m-d');
//
////$sql = "SELECT ttime, perf FROM graph WHERE perf > 0 AND ttime < '2023-05-30' ORDER BY ttime";
//$sql = "SELECT ttime, rate FROM graph WHERE ttime < '$ttime'";
////$sql = "SELECT htime, perf FROM graph";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $htime, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $graph[] = array('date' => $htime, 'value' => $perf);
//    }
//}
//
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
//    try {
//        $datetime = new DateTime($date);
//    } catch (Exception $e) {
//    }
//    $ttime = $datetime->format('Y-m-d');
//    $timestamp = strtotime($ttime);
//
//    $imp[] = [$timestamp * 1000, $value];
//}
////$sql = "SELECT DATE , `AAPL.Open` FROM plot1 limit 1000000";
////$stmt = mysqli_stmt_init($link);
////if (mysqli_stmt_prepare($stmt, $sql)) {
////    mysqli_stmt_execute($stmt);
////    mysqli_stmt_bind_result($stmt, $t, $p);
////    while (mysqli_stmt_fetch($stmt)) {
////        $p = floatval($p);
////        $imp[] = [$t * 1000, $p];
////    }
////}
//$imp = json_encode($imp);
//
///******************** top-ten-pie ********************/
//$datetime = new DateTime('NOW');
//$datetime->modify('-6 days');
//$ttime = $datetime->format('Y-m-d') . "%";
////$sql = "SELECT hyip, perf FROM graph WHERE ttime like '2023-05-29%' and perf > 0 ORDER BY perf desc LIMIT 10";
//$sql = "SELECT hyip, rate FROM graph WHERE ttime like '$ttime' ORDER BY rate desc limit 10";
//
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $h, $p);
//    while (mysqli_stmt_fetch($stmt)) {
//        $top_ten_pie[] = array('name' => $h, 'y' => floatval($p));
//
////        $top_ten_pie[] = [$h, $p];
//    }
//}
//
//$top_ten_pie = json_encode($top_ten_pie);
//
///******************** top-ten ********************/
//$graph = [];
//$hyips = [];
//$top_ten = [];
//$urls = [];
//$top = [];
//$u = [];
//
////$sql = "SELECT hyip, url FROM graph WHERE ttime like '2023-08-24%' ORDER BY perf DESC limit 10";
////$sql = "SELECT hyip, url FROM graph1 WHERE ttime like '$ttime' ORDER BY rate DESC limit 2";
////$sql = "SELECT hyip, url FROM graph1";
////$stmt = mysqli_stmt_init($link);
////if (mysqli_stmt_prepare($stmt, $sql)) {
////    mysqli_stmt_execute($stmt);
////    mysqli_stmt_bind_result($stmt, $hyip, $url);
////    while (mysqli_stmt_fetch($stmt)) {
////        $hyips[] = array('hyip' => $hyip, 'url' => $url);
////    }
////
////    sort($hyips);
////}
//
////$sql = "SELECT distinct url FROM graph1 ORDER BY rate DESC";
//$sql = "SELECT ddate, aapl FROM plot1";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt,  $ddate, $aapl);
//    while (mysqli_stmt_fetch($stmt)) {
//        $hyips[] = [$ddate * 1000, $aapl];
//    }
//}
//$hyips = array_unique($hyips);
//
////$ttime = '2024-04-28%';
//$d = new DateTime('today');
//$d->modify('-6 days');
//$yesterday = $d->format('Y-m-d') . "%";
////
//////$d = new DateTime('today');
//////$today = $d->format('Y-m-d') . "%";
////
//$sql = "SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $url);
//    while (mysqli_stmt_fetch($stmt)) {
//        $u[] = $url;
//    }
//}
////
//foreach ($u as $uu) {
//    $u1 = $u1 . $uu . '\',\'';
//}
//
//$u1 = "'" . substr($u1, 0, -2);
////$d = new DateTime('today');
////$d->modify('-1 days');
////$yesterday = $d->format('Y-m-d') . "%";
//
//
////$sql = "SELECT VID, thumb FROM video WHERE VID IN (select * from (SELECT VID FROM video WHERE title LIKE \"%'.$Channel['name'].'%\"ORDER BY viewtime DESC LIMIT 5) temp_tab) ORDER BY RAND() LIMIT 1)";
//
//$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$yesterday' and url IN (".$u1.")";
////$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$yesterday' and url IN ('https://www.safeassets.com','https://stakingi.com','https://bitcashdeposit.com','https://yinksfund.com','https://btcusdtfund.com','https://bitdepositday.com','https://vakfund.com','https://luxioprofit.com','https://earnbitprofit.com','https://aitimart.com')";
////$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '2024-05-04%' and url IN ('https://stakingi.com','https://www.safeassets.com','https://bitcashdeposit.com','https://btcusdtfund.com','https://yinksfund.com','https://bitdepositday.com','https://vakfund.com','https://luxioprofit.com','https://earnbitprofit.com','https://coinincome.biz')";
////$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE url IN (select * from (SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10) as temp_tab)";
////$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE ttime < '$today' and url IN ('$u[0]','$u[1]','$u[2]','$u[3]','$u[4]','$u[5]','$u[6]','$u[7]','$u[8]','$u[9]')";
////$sql = "SELECT hyip, url, rate, ttime  FROM graph WHERE url IN (SELECT url FROM graph WHERE ttime like '$yesterday' ORDER BY rate DESC limit 10)";
////$sql = "SELECT hyip, url, rate, ttime FROM graph";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url, $rate, $ttime);
//    while (mysqli_stmt_fetch($stmt)) {
//        $ttime = new DateTime($ttime);
//        $ttime = $ttime->format('Y-m-d');
////        $graph[] = array('hyip' => $hyip, 'url' => $url, 'rate' => floatval($rate), 'ttime' => strtotime($ttime) * 1000);
//        $graph[] = array('hyip' => $hyip, 'url' => $url, 'rate' => floatval($rate), 'ttime' => $ttime);
//    }
//}
//$graph1 = json_encode($graph);
////foreach ($graph as $g) {
////    if ($g['ttime'] == $yesterday) {
////        $urls[] = $g;
////    }
////}
////
////function array_orderby()
////{
////    $args = func_get_args();
////    $data = array_shift($args);
////    foreach ($args as $n => $field) {
////        if (is_string($field)) {
////            $tmp = array();
////            foreach ($data as $key => $row)
////                $tmp[$key] = $row[$field];
////            $args[$n] = $tmp;
////        }
////    }
////
////    $args[] = &$data;
////    call_user_func_array('array_multisort', $args);
////    return array_pop($args);
////}
////
////$urls = array_orderby($urls, 'rate', SORT_DESC);
////$urls = array_slice($urls, 0, 10);
////$urls = array_column($urls, 'url');
//
//foreach ($u as $url) {
//    $data = [];
//    foreach ($graph as $g) {
//        if ($g['url'] == $url) {
//            $data[] = array(strtotime($g['ttime']) * 1000, $g['rate']);
//        }
//
//    }
//    $top[] = array('name' => $url, 'data' => $data);
//
//}
//
//$top_ten = json_encode($top);
//
///******************** create header ********************/
//// create header (153 companies listed       IMP index 848.44       day change +24.10 (+2.92%))
//$today = array();
//$yesterday = array();
//$datetime = new DateTime('NOW');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//$perf = null;
//$today_index = null;
//$yesterday_index = null;
//$link = get_link();
//
////$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2023-05-29%' AND perf > 0";
//$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '$ttime'";
//
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $today_index += $perf;
//    }
//}
//
//$datetime = new DateTime('NOW');
//$datetime->modify('-2 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//
////$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2023-05-28%' AND perf > 0";
//$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '$ttime'";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $yesterday_index += $perf;
//    }
//}
//
//$index_change = $today_index - $yesterday_index;
//$index_change_percentage = change_percentage($today_index, $yesterday_index);
//
//$index_change = number_format($index_change, 2);
//if ($index_change > 0) $index_change = "+" . $index_change;
//
//$index_change_percentage = number_format($index_change_percentage, 2);
//if ($index_change_percentage > 0) $index_change_percentage = "+" . $index_change_percentage;
//
////$all_banners = all_banners();
//$huy = null;
//?>


<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@demo.title@ Example</title>

    <style type="text/css">
        #container {
            height: 400px;
            min-width: 310px;
        }


    </style>
</head>
<body>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div id="container"></div>

<script type="text/javascript">
    const dataURL = 'https://demo-live-data.highcharts.com/aapl-historical.json';
    // const dataURL = 'http://huy.com/plots/lazy-loading/aapl-historical.json';

    /**
     * Load new data depending on the selected min and max
     */
    function afterSetExtremes(e) {
        const { chart } = e.target;
        chart.showLoading('Loading data from server...');
        fetch(`${dataURL}?start=${Math.round(e.min)}&end=${Math.round(e.max)}`)
            .then(res => res.ok && res.json())
            .then(data => {
                chart.series[0].setData(data);
                chart.hideLoading();
            }).catch(error => console.error(error.message));
    }

    fetch(dataURL)
        .then(res => res.ok && res.json())
        .then(data => {
            // debugger
            // Add a null value for the end date
            data.push([Date.UTC(2011, 9, 14, 18), null, null, null, null]);

            // create the chart
            Highcharts.stockChart('container', {
                chart: {
                    // type: 'candlestick',
                    type: 'spline',
                    zooming: {
                        type: 'x'
                    }
                },

                navigator: {
                    adaptToUpdatedData: false,
                    series: {
                        data: data
                    }
                },

                scrollbar: {
                    liveRedraw: false
                },

                title: {
                    text: 'AAPL history by the minute from 1998 to 2011',
                    align: 'left'
                },

                subtitle: {
                    text: 'Displaying 1.7 million data points in Highcharts ' +
                        'Stock by async server loading',
                    align: 'left'
                },

                rangeSelector: {
                    buttons: [{
                        type: 'hour',
                        count: 1,
                        text: '1h'
                    }, {
                        type: 'day',
                        count: 1,
                        text: '1d'
                    }, {
                        type: 'month',
                        count: 1,
                        text: '1m'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '1y'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    inputEnabled: false, // it supports only days
                    selected: 4 // all
                },

                xAxis: {
                    events: {
                        afterSetExtremes: afterSetExtremes
                    },
                    minRange: 3600 * 1000 // one hour
                },

                yAxis: {
                    floor: 0
                },

                series: [{
                    data: data,
                    dataGrouping: {
                        enabled: false
                    }
                }]
            });
        }).catch(error => console.error(error.message));

</script>
<!--<script data-imp='--><?//= $imp ?><!--' data-top_ten_pie='--><?//= $top_ten_pie ?><!--' data-top_ten='--><?//= $top_ten ?><!--' src="/assets/js/highcharts.js"></script>-->

</body>
</html>
