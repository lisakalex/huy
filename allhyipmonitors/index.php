<?php
//include(__DIR__ . '/a.php');
///var/www/html/coinzilla-1/a.php
include(__DIR__ . '../coinzilla-1/a.php');
//include(__DIR__ . '/debug.php');
//$today_totalu = null;
//$change_totalu = null;
//$change_totalpu = null;
//$today = array();
//$yesterday = array();
//$datetime = new DateTime('NOW');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//$perf = 0.00;
//$today_index = null;
//$yesterday_index = null;
//
//$link = get_link();
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-06%' AND perf > 0";
////$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
//
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $today_index += $perf;
//    }
//
////    $today_total = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
//$datetime = new DateTime('NOW');
//$datetime->modify('-2 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//
//$link = get_link();
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-05%' AND perf > 0";
////$sql = "SELECT url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip,$url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $yesterday_index += $perf;
//    }
//
////    $yesterday_total = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
//$index_change = $today_index - $yesterday_index;
//$index_change_percentage = ($index_change / $yesterday_index) * 100;
//
//$today_u = json_encode($today);
//$yesterday_u = json_encode($yesterday);
//
////$change_total = $today_total - $yesterday_total;
////$change_totalp = ($change_total / $yesterday_total) * 100;
////
////$change_total = number_format($change_total, 2);
////if ($change_total > 0) $change_total = "+" . $change_total;
////
////$change_totalp = number_format($change_totalp, 2) . "%";
////if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;
//
////$today_total = number_format($today_total, 2);
//
////$change_totalu = $change_total;
////$change_totalu = urlencode($change_totalu);
////
////$change_totalpu = $change_totalp;
////$change_totalpu = urlencode($change_totalpu);
////
////$today_totalu = $today_total;
////$today_totalu = urlencode($today_totalu);
////
////$hyipsu = $hyips;
////$hyipsu = urlencode($hyipsu);
//
//
////foreach ($today as $k => $v) {
////    if (isset($yesterday[$k])) {
////        $today_perf = $v['perf'];
////        $yesterday_perf = $yesterday[$k];
////
////        $change = $today_perf - $yesterday_perf;
////        $changep = change_percentage($today_perf, $yesterday_perf);
////
////        $change = number_format($change, 2);
////        if ($change > 0) $change = "+" . $change;
////        $changep = number_format($changep, 2);
////        if ($changep > 0) $changep = "+" . $changep;
////
////        $today[$k]['change'] = $change;
////        $today[$k]['changep'] = $changep;
////    }
////}
//
////$all_array_keys = array_merge(array_keys($today), array_keys($yesterday));
////$hyip_urls = array_unique($all_array_keys);
////
////$today_change = [];
////$index_perf = null;
////$index_change = null;
////$index_change_percentage = null;
//
//foreach ($today as $k => $v) {
//    if (isset($yesterday[$k])) {
//        $today_perf = $v['perf'];
//        $yesterday_perf = $yesterday[$k]['perf'];
//
//        $change = $today_perf - $yesterday_perf;
//        $changep = ($change / $yesterday_perf) * 100;
//
////        $change = number_format($change, 2);
////        if ($change > 0) $change = "+" . $change;
////        $changep = number_format($changep, 2) . "%";
////        if ($changep > 0) $changep = "+" . $changep;
//
//        $today[$k]['change'] = $change;
//        $today[$k]['changep'] = $changep;
//    }
//}
//$index_change = $today_index_perf - $yesterday_index_perf;
//$index_changep = change_percentage($today_index_perf, $yesterday_index_perf);
$today = array();
$yesterday = array();
$datetime = new DateTime('NOW');
$datetime->modify('-1 days');
$ttime = $datetime->format('Y-m-d') . "%";
$perf = null;
$today_index = null;
$yesterday_index = null;
//$link = get_link();

$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-06%' AND perf > 0";
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";

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

$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-05%' AND perf > 0";
//$sql = "SELECT url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
        $yesterday_index += $perf;
    }
}

//mysqli_close($link);

$index_change = $today_index - $yesterday_index;
$index_change_percentage = change_percentage($today_index, $yesterday_index);

$index_change = number_format($index_change, 2);
if ($index_change > 0) $index_change = "+" . $index_change;

$index_change_percentage = number_format($index_change_percentage, 2);
if ($index_change_percentage > 0) $index_change_percentage = "+" . $index_change_percentage;

//$today_u = json_encode($today);
//$yesterday_u = json_encode($yesterday);

//$change_total = $today_total - $yesterday_total;
//$change_totalp = ($change_total / $yesterday_total) * 100;
//
//$change_total = number_format($change_total, 2);
//if ($change_total > 0) $change_total = "+" . $change_total;
//
//$change_totalp = number_format($change_totalp, 2) . "%";
//if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;

//$today_total = number_format($today_total, 2);

//$change_totalu = $index_change;
//$change_totalu = urlencode($change_totalu);
//
//$change_totalpu = $index_change_percentage;
//$change_totalpu = urlencode($change_totalpu);
//
//$today_totalu = $today_index;
//$today_totalu = urlencode($today_totalu);
//
//$hyipsu = count($today);
//$hyipsu = urlencode($hyipsu);


//foreach ($today as $k => $v) {
//    if (isset($yesterday[$k])) {
//        $today_perf = $v['perf'];
//        $yesterday_perf = $yesterday[$k];
//
//        $change = $today_perf - $yesterday_perf;
//        $changep = change_percentage($today_perf, $yesterday_perf);
//
//        $change = number_format($change, 2);
//        if ($change > 0) $change = "+" . $change;
//        $changep = number_format($changep, 2);
//        if ($changep > 0) $changep = "+" . $changep;
//
//        $today[$k]['change'] = $change;
//        $today[$k]['changep'] = $changep;
//    }
//}

//$all_array_keys = array_merge(array_keys($today), array_keys($yesterday));
//$hyip_urls = array_unique($all_array_keys);
//
//$today_change = [];
//$index_perf = null;
//$index_change = null;
//$index_change_percentage = null;

$today_perf = 0.00;
$yesterday_perf = 0.00;

foreach ($today as $k => $v) {
    $today_perf = $v['perf'];

    if (isset($yesterday[$k])) {
        $yesterday_perf = $yesterday[$k]['perf'];
    }

    $change = $today_perf - $yesterday_perf;
    $changep = change_percentage($today_perf, $yesterday_perf);

    $change = number_format($change, 2);
    if ($change > 0) $change = "+" . $change;
    $changep = number_format($changep, 2);
    if ($changep > 0) $changep = "+" . $changep;

//    $today_all[$k] = array('hyip' => $v['hyip'], 'perf' => $v['perf'], 'change' => $change, 'changep' => $changep);

    $today[$k]['change'] = $change;
    $today[$k]['changep'] = $changep;
}

//$all_banners['Top'] = array("https://tpc.googlesyndication.com/simgad/7130775551167661743?sqp=4sqPyQQrQikqJwhfEAEdAAC0QiABKAEwCTgDQPCTCUgAUAFYAWBfcAJ4AcUBLbKdPg&amp;rs=AOga4qnJFrY06lcLPWXKWRoP3hdyZM68-A", "#");
$all_banners['Top'] = array("https://solidtradebank.com/assets/banners/solid-trade_728x90.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 1'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 2'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 3.json'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 4'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 5'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Right side 1'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Right side 2'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Right side 3.json'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Right side 4'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Right side 5'] = array("https://solidtradebank.com/assets/banners/solid-trade_125x125.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Bottom'] = array("https://solidtradebank.com/assets/banners/solid-trade_468x60.gif", "https://solidtradebank.com/\" target=\"_blank");

$now = get_now();
$banners = array();
$payment = "complete";

//$link = get_link();
$sql = "SELECT banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $banner_url, $banner_id, $site, $slot, $days, $start_date);

    while (mysqli_stmt_fetch($stmt)) {
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if (($now >= $firstday) && ($now <= $lastday)) {
            $banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
}

mysqli_close($link);

$banners1 = array();
foreach ($banners as $banner) {
    for ($i = 0; $i < $banner['slot']; $i++) {
        $banners1[$banner['banner_id']][] = array($banner['banner_url'], $banner['site']);
    }
}

foreach ($banners1 as $k => $v) {
    $b = count($v);
    $b--;
    $b = rand(0, $b);
    $all_banners[$k] = $v[$b];
}

//
//$datetime = new DateTime('NOW');
////$datetime->modify('-1 days');
////$ttime = $datetime->format('Y-m-d') . "%";
//$ttime = $datetime->format('Y-m-d');
//
//$link = get_link();
//
//if (isset ($_GET ['today_total'])) {
//    $today_totalu = mysqli_real_escape_string($link, $_GET ['today_total']);
//    $change_totalu = mysqli_real_escape_string($link, $_GET ['change_total']);
//    $change_totalpu = mysqli_real_escape_string($link, $_GET ['change_totalp']);
//    $hyipsu = mysqli_real_escape_string($link, $_GET ['hyipsu']);
//}
//
////$sql = "SELECT ttime, perf FROM graph4 WHERE perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
//$sql = "SELECT ttime, perf FROM graph WHERE perf > 0 AND ttime < '$ttime' ORDER BY ttime";
////$sql = "SELECT htime, perf FROM graph";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $htime, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $graph[] = array('date' => $htime, 'value' => $perf);
//    }
//    $hyips = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
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
//    $data[] = array('date' => $date, 'value' => $value);
//}
//
//$data = json_encode($data);
//

//$datetime = new DateTime('NOW');
//$tt = $datetime->format('Y-m-d');
//
//$link = get_link();
//if (isset ($_GET ['u'])) {
//    $url = mysqli_real_escape_string($link, $_GET ['u']);
//    $hyip = mysqli_real_escape_string($link, $_GET ['h']);
//    $perf = mysqli_real_escape_string($link, $_GET ['perf']);
//    $change = mysqli_real_escape_string($link, $_GET ['change']);
//    $changep = mysqli_real_escape_string($link, $_GET ['changep']);
//}

//detail.php
//$du = null;
////$sql = "SELECT ttime, perf FROM graph WHERE url=? AND perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
//$sql = "SELECT ttime, perf, details FROM graph WHERE url=? AND perf > 0 AND ttime < '$tt' ORDER BY ttime";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_bind_param($stmt, "s", $url);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $ttime, $perf, $details);
//    while (mysqli_stmt_fetch($stmt)) {
//        $du[] = array('date' => $ttime, 'value' => $perf);
////        $d[] = array('details' => $details);
//    }
//
////    $hyips = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
////monitor images
//$da = json_encode($du);
//$de = json_decode($details);

//$url = "https://www.coindesk.com/category/tech";
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
//$contents = curl_exec($ch);
//
//$exploded = explode("list-item-wrapper", $contents);
//array_shift($exploded);
//
//foreach ($exploded as $e) {
//
//    $titles[] = between("title=\"", "\"", $e);
//    $urls[] = between("href=\"", "\"", $e);
//    $dates[] = between("class=\"time\">", "<", $e);
//    $texts[] = between("<p class=\"card-text\">", "<", $e);
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All HYIP Monitors .com - Check your investment status on all HYIP monitors at once.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/me.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.sticky-sidebar.min.js"></script>
    <script type="text/javascript">
        var stickySidebar = null;
        $(document).on('ready', function () {
            if ($('.preloader').length) {
                $('.preloader').delay(200).fadeOut(500);
            }
            if ($(window).width() > 740) {
                stickySidebar = $('.sidebnrs').stickySidebar({
                    topSpacing: 5,
                    bottomSpacing: 5,
                    containerSelector: '.wrap1',
                    innerWrapperSelector: '.sidebnrsin'
                });
            }
        });
        $(window).bind('resize', function () {
            if ($(window).width() > 740) {
                stickySidebar = $('.sidebnrs').stickySidebar({
                    topSpacing: 5,
                    bottomSpacing: 5,
                    containerSelector: '.wrap1',
                    innerWrapperSelector: '.sidebnrsin'
                });
            } else {
                $('.sidebnrs').stickySidebar('destroy');
            }
        });
    </script>
</head>
<body>
<div class="preloader" style="position:fixed;left:0px;top:0px;width:100%;height:100%;z-index:999999;background-color:#ffffff;background-position:center center;background-repeat:no-repeat;background-image:url(images/imgloader.gif);"></div>
<div style="width: 100%; margin:auto;">
    <div id="header_canv">
        <div id="headerl"><h1 onclick="document.location='/';">All HYIP Monitors</h1>
            <h2>Check investment status of HYIP on all monitors at once</h2><b><span style="color:red">NEW</span> we
                become closer by branding new short domain -- <a href="http://www.allhyip.biz/">www.allhyip.biz</a></b>
        </div>
        <div id="headerr"><a href="https://carfoxes.com/?p=XgCwqyge" follow="nofollow" id="header_bb" target=_blank><img
                        src="https://carfoxes.com/img/banner/468x60_en_2.gif" width=469 height=60 border=0
                        alt="https://carfoxes.com/?p=XgCwqyge"></a><br><a style="font-size: 9px" href="advertise.html">buy
                banner here for $75</a></div>
    </div>
</div>
<br class=clearall>

<div id="domainoffer">
    <p style="float:left;padding-right:10px" class="instbrowsext_wrap"><b class="instbrowsext"
                                                                          style="display:inline-block;vertical-align:top;">Install
            Extension for your browser:</b>
        <a href="https://chrome.google.com/webstore/detail/allhyipmonitorscom/mgkeimohpioamjmaannmpfmimflcdpmn/"
           target=_blank class="brwext chrome"></a>
        <a href="https://addons.mozilla.org/en-US/firefox/addon/allhyipmonitorscom/" target=_blank
           class="brwext firefox"></a>
        <a href="allhyipmonitors.safariextz.html" target=_blank class="brwext safari"></a>
        <a href="https://addons.opera.com/en/extensions/details/allhyipmonitorscom/" target=_blank
           class="brwext opera"></a>
        <a href="https://chrome.google.com/webstore/detail/allhyipmonitorscom/mgkeimohpioamjmaannmpfmimflcdpmn/"
           target=_blank class="brwext yandex"></a>
    </p>
    <div class="domainoffer_menu">
        <p style="float: right; padding-right: 10px"><a href="favorite_domains.html">My Favorite Domains</a> | <a
                    href="favorite_monitors.html">My Favorite Monitors</a></p>
    </div>
    <div class="domainoffer_menu_mob" style="display:none">
        <p style="float: right; padding-right: 10px"><a href="favorite_domains.html">My Favorite Domains</a> | <a
                    href="favorite_monitors.html">My Favorite Monitors</a></p>
    </div>
</div>

<div class="wrap1">
    <br class="clearall"/>
    <div id="leftbnrs" class="sidebnrs">
        <div class="sidebnrsin">


            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://bestjakprofit.com/?ref=bestjakprofit" follow="nofollow" target=_blank class="bb"
                   id="left_bb_46.00"><img src="https://bestjakprofit.com/img/banners/125x125.gif" width=125 height=125
                                           border=0 alt="bestjakprofit.com"></a>
            </div>
            <br>
            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://bitdeposit.name/?ref=nyinfogirlgc" follow="nofollow" target=_blank class="bb"
                   id="left_bb_44.00"><img src="https://bitdeposit.name/images/bitdeposit125.gif" width=125 height=125
                                           border=0 alt="bitdeposit.name"></a>
            </div>
            <br>
            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://coindeposit.net/?ref=dleyvx7" follow="nofollow" target=_blank class="bb"
                   id="left_bb_42.00"><img src="https://coindeposit.net/images/coindeposit125.gif" width=125 height=125
                                           border=0 alt="coindeposit.net"></a>
            </div>
            <br>
            <a style="font-size: 9px" href="advertise.html">buy banner here starts from &#36;40</a>
            <br>
        </div>
    </div>

    <div id="rightbnrs" class="sidebnrs">
        <div class="sidebnrsin">


            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://8bit.ltd/c/register/allhyipmonitors" follow="nofollow" target=_blank class="bb"
                   id="right_bb_46.00"><img src="https://s4.gifyu.com/images/Zombie_125K125px_01_04.10.gif" width=125
                                            height=125 border=0 alt="8bit.ltd"></a>
            </div>
            <br>
            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://8bit.ltd/c/register/allhyipmonitors" follow="nofollow" target=_blank class="bb"
                   id="right_bb_44.00"><img src="https://s4.gifyu.com/images/Zombie_125K125px_02_04.10.gif" width=125
                                            height=125 border=0 alt="8bit.ltd"></a>
            </div>
            <br>
            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://8bit.ltd/c/register/allhyipmonitors" follow="nofollow" target=_blank class="bb"
                   id="right_bb_42.00"><img src="https://s4.gifyu.com/images/Zombie_125K125px_03_04.10.gif" width=125
                                            height=125 border=0 alt="8bit.ltd"></a>
            </div>
            <br>
            <div style="width: 125px; height: 125px;display:inline-block;">
                <a href="https://8bit.ltd/c/register/allhyipmonitors" follow="nofollow" target=_blank class="bb"
                   id="right_bb_40.00"><img
                            src="https://s7.gifyu.com/images/Get-25_-Bonus_125x125px_Gif-light_14.09.gif" width=125
                            height=125 border=0 alt="8bit.ltd"></a>
            </div>
            <br>
            <a style="font-size: 9px" href="advertise.html">buy banner here starts from &#36;40</a>
            <br>

            <br><br>
            <SCRIPT type='text/javascript' language='JavaScript'
                    src='https://xslt.alexa.com/site_stats/js/t/b?url=allhyipmonitors.com'></SCRIPT>
        </div>
    </div>

    <div id="center_block" style="margin: 0 130px 0 130px; overflow: hidden;padding:0 2% 0 2%;">
        <div style="  background-color: white; margin: auto">
            <div style="text-align: center;">
                <!--                <p style="font-size: 2.3em; font-weight: 500"> Investment market performance index</p>-->
                <!--                <h1 style="color: #536677"><a href="#perf"> Investment market performance index</a></h1>-->
                <h1 id="perf" style="color: #536677">Investment market performance index</h1>
                <p><?= count($today) ?> companies listed.</p>
            </div>
            <?php
            echo "<table id=\"myTable\" class=\"stripe row-border hover table-responsive\">";
            echo "<thead>";
            echo "<tr>";
            echo "<th style=\" width: 30%\">Name</th>";
            echo "<th style=\" width: 30%\">URL</th>";
            echo "<th style=\" width: 10%\">Index</th>";
            echo "<th style=\" width: 10%\">Day</th>";
            echo "<th style=\" width: 10%\">Day %</th>";
            echo "<th style=\" width: 10%\">Details</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($today as $k => $v) {
                if (isset($v['change']) && isset($v['changep'])) {
                    echo "<tr>";
                    echo "<td>" . $v['hyip'] . "</td>";
                    echo "<td ><a href=\"" . $k . "\">" . $k . "</a></td>";
                    echo "<td style=\"text-align: right\">" . $v['perf'] . "</td>";
                    if ($v['change'] > 0) {
                        echo "<td style=\"text-align: right; color: blue\">" . $v['change'] . "</td>";
                    } elseif ($v['change'] == 0) {
                        echo "<td style=\"text-align: right; color: green\">" . $v['change'] . "</td>";
                    } else {
                        echo "<td style=\"text-align: right; color: red\">" . $v['change'] . "</td>";
                    }

                    if ($v['changep'] > 0) {
                        echo "<td style=\"text-align: right; color: blue\">" . $v['changep'] . "%" . "</td>";
                    } elseif ($v['changep'] == 0) {
                        echo "<td style=\"text-align: right; color: green\">" . $v['changep'] . "%" . "</td>";
                    } else {
                        echo "<td style=\"text-align: right; color: red\">" . $v['changep'] . "%" . "</td>";
                    }
                    echo "<td style=\"text-align: right\"><a href=\"detail.php?u=" . urlencode($k) . "&h=" . urlencode($v['hyip']) . "&perf=" . urlencode($v['perf']) . "&change=" . urlencode($v['change']) . "&changep=" . urlencode($v['changep']) . "\">details</a></td>";
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
            ?>
        </div>
    </div>
    <br class="clearboth"/>
    <div style="text-align:center;">
        <a href="https://www.safeassets.com" follow="nofollow" target=_blank class="bb" id="bottom_bb"><img
                    src="https://safeassets.co/img/promo/gif/leaderboard/728х90.gif" width=468 height=60 border=0
                    alt="https://www.safeassets.com"></a>
        <br><a style="font-size: 9px" href="advertise.html">buy banner here for $25</a>
    </div>
    <br>
</div>
<br clear=all>
<div id="bottomlc">
    <div id="toollinks">
        |&nbsp;<a href="home.html">Home</a>|&nbsp;<a href="advertise.html">Advertise</a>|&nbsp;<a href="addsite.html">Add
            Your Site</a>|&nbsp;<a href="aboutus.html">About Us</a>|&nbsp;<a href="contact.html">Contact Us</a>|
    </div>
    <div id="copyright">
        Copyright &copy; 2007-2022 AllHYIPMonitors.com . All rights reserved.
    </div>
</div>

<br class="clearboth"/>
<div id="disclaimer">
    <p>
        DISCLAIMER: We do not own or promote any programs listed here.The information provided here is for your own
        use.Some programs, investments or any listings here may be illegal depending on your country's laws.We do not
        recommend you spend what you cannot afford to lose.
    </p>


</div>

<!--script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=hothyips"></script-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets/js/app.js" async defer></script>
<script src="assets/js/me.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>
