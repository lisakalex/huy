<?php
include(__DIR__ . '/a.php');
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

$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '2022-09-06%' AND rate > 0";
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

$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '2022-09-05%' AND rate > 0";
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
    <meta charset="UTF-8">
    <title>Coinzilla | Join The Top Finance & Crypto Ad Network</title>
    <link rel="canonical" href="index.html"/>
    <meta property="og:site_name" content="Coinzilla Advertising Network">
    <meta property="og:title" content="Coinzilla | Join the Largest Crypto Advertising Network">
    <meta name="description"
          content="Monetize your website or deliver crypto ads across top industry websites and reach your target audience through our advertising network.">
    <meta property="og:description"
          content="Monetize your website or deliver crypto ads across top industry websites and reach your target audience through our advertising network.">
    <meta property="og:url" content="https://coinzilla.com/">
    <meta property="og:image" content="https://coinzilla.com/assets/images/display-presentation.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="">
    <link href="../assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-regular.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-solid.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-brands.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
</head>
<body class="homepage__body overflow__limited homepage-v2">
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.html">
                            <img src="../assets/images/coinzilla-logo.svg" alt="Coinzilla Advertising Network"
                                 class="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon far fa-bars button-menu-mobile"></span>
                        </button>
                        <div class="navbar-collapse collapse toggle-menu-mobile" id="navbarSupportedContent">
                            <ul class="navbar-nav navbar-right-coinzilla">
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.php#perf" id="advertisersMenu">company list</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tdetail.php" id="publishersMenu">performance index</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php" id="marketplaceMenu">about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php" id="marketplaceMenu">contact</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav navbar-right">
                                <?php if (isset($_COOKIE ['cus_id'])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../display/overview.php">Member Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../logout.php">Logout</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../display/login.php">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../display/signup.php">Sign Up</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>
<div id="wrap__page">
    <section class="content page-top-slider top-slider-spacing" style="padding-bottom: 20px">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!--                    <div class="video">-->
                    <!--                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/k1zi-WghtQY"-->
                    <!--                                iv_load_policy="3" showinfo="0" controls="1" autoplay="1" rel="0" fs="0"-->
                    <!--                                frameborder="0"></iframe>-->
                    <div class="me-flex">
                        <a href="<?= $all_banners['Top'][1] ?>"><img class="me-contain"
                                                                     src="<?= $all_banners['Top'][0] ?>" alt=""></a>
                    </div>
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <section class="brands">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-5 col-lg-7">
                    <div class="publishers-carousel" id="version-2">
                        <div class="row-publishers">
                            <div class="wrap-slider-brands"></div>
                            <div class="row container-slider-brands">
                                <div class="d-block d-sm-none d-lg-block col-12 col-md-12 col-lg-6 col-mob-12 slider-brands-to-bottom">
                                    <div class="row row-slider slider-to-bottom">
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/logo-beincrypto.png" alt="beincrypto.com">
                                                <span class="top-visits">beincrypto.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/blockcypher.svg" alt="blockcypher.com">
                                                <span class="top-visits">blockcypher.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coincodex.svg" alt="coincodex.com">
                                                <span class="top-visits">coincodex.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coingecko.svg" alt="coingecko.com">
                                                <span class="top-visits">coingecko.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinpaprika.svg" alt="coinpaprika.com">
                                                <span class="top-visits">coinpaprika.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinstats.svg" alt="coinstats.app">
                                                <span class="top-visits">coinstats.app</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinwarz.png" alt="coinwarz.com">
                                                <span class="top-visits">coinwarz.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/dextools.svg" alt="dextols.io">
                                                <span class="top-visits">dextols.io</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block d-sm-none d-lg-block col-6 col-mob-12 slider-brands-to-top">
                                    <div class="row row-slider slider-to-top">
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/logo-coingape.png" alt="coingape.com">
                                                <span class="top-visits">coingape.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/cryptopotato.png" alt="cryptopotato.com">
                                                <span class="top-visits">cryptopotato.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/etherscan.svg" alt="etherscan.io">
                                                <span class="top-visits">etherscan.io</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/kriptokoin.png" alt="kriptokoin.com">
                                                <span class="top-visits">kriptokoin.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/logo-bscscan.svg" alt="bscscan.com">
                                                <span class="top-visits">bscscan.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/thecryptoapp.svg" alt="thecrypto.app">
                                                <span class="top-visits">thecrypto.app</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/whattomine.svg" alt="whattomine.com">
                                                <span class="top-visits">whattomine.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/stormgain.svg" alt="stormgain.com">
                                                <span class="top-visits">stormgain.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-none d-sm-block d-lg-none slider-brands-to-bottom">
                                    <div class="row row-slider slider-to-bottom slider-all-brands">
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/blockcypher.svg" alt="blockcypher.com">
                                                <span class="top-visits">blockcypher.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coincodex.svg" alt="coincodex.com">
                                                <span class="top-visits">coincodex.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coingecko.svg" alt="coingecko.com">
                                                <span class="top-visits">coingecko.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinpaprika.svg" alt="coinpaprika.com">
                                                <span class="top-visits">coinpaprika.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinstats.svg" alt="coinstats.app">
                                                <span class="top-visits">coinstats.app</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/coinwarz.png" alt="coinwarz.com">
                                                <span class="top-visits">coinwarz.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/dextools.svg" alt="dextols.io">
                                                <span class="top-visits">dextols.io</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/cryptopotato.png" alt="cryptopotato.com">
                                                <span class="top-visits">cryptopotato.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/etherscan.svg" alt="etherscan.io">
                                                <span class="top-visits">etherscan.io</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/kriptokoin.png" alt="kriptokoin.com">
                                                <span class="top-visits">kriptokoin.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/logo-bscscan.svg" alt="bscscan.com">
                                                <span class="top-visits">bscscan.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/thecryptoapp.svg" alt="thecrypto.app">
                                                <span class="top-visits">thecrypto.app</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/whattomine.svg" alt="whattomine.com">
                                                <span class="top-visits">whattomine.com</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-mob-12 col-md-12 col-lg-12 slider-item">
                                            <div class="item dark item-margin">
                                                <img src="../assets/images/logos/stormgain.svg" alt="stormgain.com">
                                                <span class="top-visits">stormgain.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-7 col-lg-5 bg__simple_lines">
                    <h2>Advertise on top finance & crypto websites </h2>
                    <div class="line-bellow"></div>
                    <div class="content-bellow-line">
                        <h3 class="medium-text">16,000+ CAMPAIGNS DELIVERED</h3>
                        <p class="small-text gray-text pr-3">
                            We work daily with top websites from the finance & cryptocurrency industry to provide you
                            with exclusive offers and advantageous rates.
                        </p>
                        <p>
                            Increase your ROI and achieve new leads with our performance-driven crypto ad network.
                        </p>
                    </div>
                    <p>
                        <a href="../advertisers/index.html" class="d-inline-block dashed underlined">See all your benefits
                            &xrarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="chart">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-7 col-lg-5 bg__simple_lines_left left-chart">
                    <h2>Customize your ads and budgets</h2>
                    <span class="line-bellow"></span>
                    <div class="content-bellow-line">
                        <h3 class="medium-text">GET COMPLETE CONTROL OVER YOUR CAMPAIGNS</h3>
                        <p>
                            Craft your crypto ads, target your audience, and manage your budgets based on performance.
                        </p>
                        <p>
                            Our advertising specialists are here to help you optimize your campaigns and outperform your
                            competitors.
                        </p>
                    </div>
                    <p class="action-formats">
                        <a href="../formats/index.html" class="d-inline-block dashed underlined">Check out our ad formats
                            &xrarr;</a>
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-5 col-lg-7">
                    <img src="../assets/images/elements/cz-home-ad2.svg" class="d-none d-lg-block background" width="850">
                    <img src="../assets/images/elements/cz-home-ad-tablet-mobile.svg" class="d-block d-lg-none background"
                         width="315">
                </div>
            </div>
        </div>
    </section>
    <section class="display">
        <div class="container">
            <div class="row align-items-center align-items-lg-end">
                <div class="col-12 col-sm-6 col-md-5 col-lg-5 order-2 order-sm-1">
                    <img src="../assets/images/elements/cz-moon-3.svg" class="d-none d-lg-block background moon-img"
                         width="515">
                    <img src="../assets/images/elements/cz-moon-tablet-mobile.svg"
                         class="d-block d-lg-none background moon-img" width="298">
                </div>
                <div class="col-12 col-sm-6 col-md-7 col-lg-7 order-1 order-sm-2 bg__simple_lines">
                    <h2>Set up your crypto advertising campaign within minutes</h2>
                    <span class="line-bellow"></span>
                    <div class="content-bellow-line">
                        <h3 class="medium-text">REACH MILLIONS OF POTENTIAL CUSTOMERS</h3>
                        <p>
                            Set up your campaign and deliver ads to the right users across hundreds of industry
                            websites.
                        </p>
                        <p>
                            Our tracking and optimization tools will help you improve your marketing results, and your
                            Coinzilla campaign manager will make sure your ads run smoothly from start to finish.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sliders">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-7 col-lg-5 bg__simple_lines_left">
                    <h2>50% of advertisers in the crypto market choose Coinzilla </h2>
                    <span class="line-bellow"></span>
                    <div class="content-bellow-line">
                        <h3 class="medium-text">RESULTS-DRIVEN ADVERTISING</h3>
                        <p>
                            Our primary focus is performance. We make exclusive deals with top finance & cryptocurrency
                            websites to help you deliver your campaigns efficiently.
                        </p>
                        <p>
                            Our banners are placed in the most visible areas of a website, ensuring that your campaign
                            will generate the results you need.
                        </p>
                    </div>
                    <p>
                        <a href="../display/sign-up" class="d-inline-block dashed underlined">Create
                            your advertiser account &xrarr;</a>
                    </p>
                </div>
                <div class="col-12 col-sm-5 col-lg-7 sliders-containers">
                    <div class="d-none d-sm-block row row-publishers slider-row-publisher">
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/1xbit.svg" alt="1xbit.com">
                                    <span class="top-visits">1xbit.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/aax.svg" alt="aax.com">
                                    <span class="top-visits">aax.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bcgame.svg" alt="bc.game">
                                    <span class="top-visits">bc.game</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bitcoincasino.svg" alt="bitcoincasino.io">
                                    <span class="top-visits">bitcoincasino.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/etoro.svg" alt="etoro.com">
                                    <span class="top-visits">etoro.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bitstarz.svg" alt="bitstarz.io">
                                    <span class="top-visits">bitstarz.io</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-sm-block row row-publishers slider-row-publisher-rtl" dir="rtl">
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bityard.svg" alt="bityard.com">
                                    <span class="top-visits">bityard.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bybit.svg" alt="bybit.com">
                                    <span class="top-visits">bybit.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/cryptocom.svg" alt="crypto.com">
                                    <span class="top-visits">crypto.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/gemini.svg" alt="gemini.com">
                                    <span class="top-visits">gemini.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/nexo.svg" alt="nexo.io">
                                    <span class="top-visits">nexo.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/vetter.png" alt="vetter.ai">
                                    <span class="top-visits">vetter.ai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-sm-block row row-publishers slider-row-publisher">
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/sportsbet.svg" alt="sportsbet.io">
                                    <span class="top-visits">sportsbet.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/lbank.svg" alt="lbank.info">
                                    <span class="top-visits">lbank.info</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/kucoin.svg" alt="kucoin.com">
                                    <span class="top-visits">kucoin.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/gate.io.png" alt="gate.io">
                                    <span class="top-visits">gate.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/lbank.svg" alt="lbank.info">
                                    <span class="top-visits">lbank.info</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/kucoin.svg" alt="kucoin.com">
                                    <span class="top-visits">kucoin.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-none row row-publishers slider-row-publisher">
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/1xbit.svg" alt="1xbit.com">
                                    <span class="top-visits">1xbit.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/aax.svg" alt="aax.com">
                                    <span class="top-visits">aax.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bcgame.svg" alt="bc.game">
                                    <span class="top-visits">bc.game</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bitcoincasino.svg" alt="bitcoincasino.io">
                                    <span class="top-visits">bitcoincasino.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/etoro.svg" alt="etoro.com">
                                    <span class="top-visits">etoro.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bitstarz.svg" alt="bitstarz.io">
                                    <span class="top-visits">bitstarz.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/sportsbet.svg" alt="sportsbet.io">
                                    <span class="top-visits">sportsbet.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/lbank.svg" alt="lbank.info">
                                    <span class="top-visits">lbank.info</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-none row row-publishers slider-row-publisher-rtl" dir="rtl">
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bityard.svg" alt="bityard.com">
                                    <span class="top-visits">bityard.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/bybit.svg" alt="bybit.com">
                                    <span class="top-visits">bybit.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/cryptocom.svg" alt="crypto.com">
                                    <span class="top-visits">crypto.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/gemini.svg" alt="gemini.com">
                                    <span class="top-visits">gemini.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/nexo.svg" alt="nexo.io">
                                    <span class="top-visits">nexo.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/vetter.png" alt="vetter.ai">
                                    <span class="top-visits">vetter.ai</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/kucoin.svg" alt="kucoin.com">
                                    <span class="top-visits">kucoin.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="row-slider">
                            <div class="col-12 col-mob-12 col-md-12 col-lg-12 ">
                                <div class="item dark item-margin">
                                    <img src="../assets/images/logos/gate.io.png" alt="gate.io">
                                    <span class="top-visits">gate.io</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="benefits">
        <div class="container">
            <div class="card dark benefits-inner">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card-benefits">
                            <div class="row section-benefits-container">
                                <div class="col-12 col-sm-6 col-lg-12">
                                    <h2>Your benefits as an advertiser</h2>
                                    <span class="line-bellow mb-5"></span>
                                    <div class="d-none d-lg-block">
                                        <a href="../display/sign-up" class="btn shine b-s3adv"
                                           onclick="ym(71768668,'reachGoal','1'); return true;">Start advertising</a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-12 d-flex flex-column">
                                    <div class="d-block d-lg-none">
                                        <a href="../display/sign-up" class="btn shine b-s3adv"
                                           onclick="ym(71768668,'reachGoal','1'); return true;">Start advertising</a>
                                    </div>
                                    <p class="mt-lg-auto mb-0 text-publisher">If you're a publisher, you can sign up <a
                                                href="../display/sign-up?type=publisher" target="_blank"
                                                class="d-inline-block dashed underlined">here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-auto col-lg-6">
                        <div class="row row-benefits-items">
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="benefits-item">
                                    <div class="title d-flex align-items-center">
                                        <div class="icon icon-container mr-3">
                                            <span class="sprite-icon icon-self-served-m"></span>
                                        </div>
                                        Self-Serve Campaigns
                                    </div>
                                    <div class="description">
                                        Manage and customize your display campaigns with ease.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="benefits-item">
                                    <div class="title d-flex align-items-center">
                                        <div class="icon icon-container mr-3">
                                            <span class="sprite-icon icon-campaign-optimization"></span>
                                        </div>
                                        Campaign Optimization
                                    </div>
                                    <div class="description">
                                        Reach your advertising goals with minimum costs.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="benefits-item">
                                    <div class="title d-flex align-items-center">
                                        <div class="icon icon-container mr-3">
                                            <span class="sprite-icon icon-prospecting"></span>
                                        </div>
                                        HTML5 Banners
                                    </div>
                                    <div class="description">
                                        Connect with target audiences using custom HTML5 banners.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="benefits-item">
                                    <div class="title d-flex align-items-center">
                                        <div class="icon icon-container mr-3">
                                            <span class="sprite-icon icon-adjustable-budget"></span>
                                        </div>
                                        Adjustable Budgets
                                    </div>
                                    <div class="description">
                                        Optimize your ad delivery based on costs and performance.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="benefits-item">
                                    <div class="title d-flex align-items-center">
                                        <div class="icon icon-container mr-3">
                                            <span class="sprite-icon icon-quality-placement"></span>
                                        </div>
                                        Effective Ad Placements
                                    </div>
                                    <div class="description">
                                        Place your banners in a website’s most visible areas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2>What our clients say</h2>
                        <span class="line-bellow mb-5"></span>
                    </div>
                </div>
            </div>
    </section>
    <section class="testimonials-slider">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonials-inner">
                        <div class="testimonials-slider-inner">
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Max</p>
                                        <p>CMO @ 1xBit</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            Our partnership with Coinzilla has been and still is very fruitful. They
                                            helped us reach our targets and show our project to the entire crypto
                                            community.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/1xbit.svg" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Daniel</p>
                                        <p>CMO @ StudentCoin</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            With significant experience and guidance in running advertising campaigns on
                                            Coinzilla, Student Coin was able to reach a considerable number of investors
                                            worldwide. We hit the top 300 largest
                                            cryptocurrencies in terms of market cap in just a dozen months since our
                                            establishment.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/Student_Coin.svg" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Lyubcho Kostadinov</p>
                                        <p>CMO @ Nexo</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            Coinzilla is the best crypto advertising network we’ve worked with so far.
                                            They offer great reach amongst their catalog of crypto-related websites,
                                            easy to understand user experience, and awesome customer
                                            support that is willing to take the extra mile to make their customers
                                            happy.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/nexo.svg" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Sada Leung</p>
                                        <p>Digital Marketing Manager @ AAX</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            We are happy to work with the Coinzilla team, who have always been
                                            supportive and responsive. The crypto network always delivers consistent and
                                            good results in driving user acquisition and different
                                            campaign goals.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/aax.svg" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>A.</p>
                                        <p>CEO of Wall Street Games</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            We are very glad to be able to work with such a fantastic team of talented
                                            people at Coinzilla! They are very professional and timely, and the work
                                            done is always on point. Their services are a great
                                            addition to the much-needed exposure for crypto projects and they always do
                                            their best to deliver the absolute perfect result.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/wallstreetgames.png" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Zack</p>
                                        <p>Revoluzion.io</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            Absolutely the best so far, direct contacts with their sales team and they
                                            handle it brilliantly. Everything is simple with easy to understand UI and
                                            easy deposit as well.
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/revoluzion.png" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item text-center">
                                <div class="box">
                                    <div class="box__header">
                                        <p>Mike</p>
                                        <p>PlayToEarn</p>
                                    </div>
                                    <div class="box__content">
                                        <p>
                                            Best ad-network in the entire crypto space. I have been working for more
                                            than 1 year with Coinzilla and they do an awesome job!
                                        </p>
                                    </div>
                                    <div class="box__footer">
                                        <img src="../assets/images/logos/testimonials/playtoearn.png" alt="1xbit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<footer>
    <div class="container footer__above">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="title">Let's Reach New Borders</div>
                <div class="line-bellow"></div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 card-item">
                <div class="item">
                    <div class="value">1B+</div>
                    <div class="info">Impressions</div>
                    <div class="placeholder">per month</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 card-item">
                <div class="item">
                    <div class="value">1.8M+</div>
                    <div class="info">Clicks</div>
                    <div class="placeholder">per month</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 card-item">
                <div class="item">
                    <div class="value">650+</div>
                    <div class="info">Websites</div>
                    <div class="placeholder">per month</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-12 footer-meet-container">
                <div class="title">Contact Our Sales Team</div>
                <a href="../contact/index.html" class="b-fcnt">Send us a message &xrarr;</a>
            </div>
        </div>
    </div>
    <div class="container footer__info">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3 footer-item">
                <span class="title">About</span>
                <ul>
                    <li><a href="../about/index.html">Who Are We?</a></li>
                    <li><a href="../partners/index.html">Meet our Partners</a></li>
                    <li><a href="../contact/index.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 footer-item">
                <span class="title">Services</span>
                <ul>
                    <li><a href="../advertisers/index.html">Coinzilla for Advertisers</a></li>
                    <li><a href="../publishers/index.html">Coinzilla for Publishers</a></li>
                    <li><a href="../marketplace/index.html">Coinzilla Marketplace</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 footer-item">
                <span class="title">Help</span>
                <ul>
                    <li><a href="https://blog.coinzilla.com/">Blog</a></li>
                    <li><a href="../faq/index.html">Frequently Asked Questions</a></li>
                    <li><a href="https://docs.coinzilla.com/coinzilla-media-kit.zip" class="dashed">Download Media
                            Kit</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 footer-item">
                <span class="title">Social Presence</span>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul>
                            <li><a href="https://facebook.com/adsbycoinzilla" target="_blank">Facebook</a></li>
                            <li>
                                <a href="https://twitter.com/intent/follow?original_referer=https%3A%2F%2Fadsbycoinzilla%2F&ref_src=twsrc%5Etfw&region=follow_link&screen_name=adsbycoinzilla&tw_p=followbutton"
                                   target="_blank">Twitter</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul>
                            <li><a href="https://www.youtube.com/c/Coinzilla?sub_confirmation=1"
                                   target="_blank">Youtube</a></li>
                            <li><a href="https://www.linkedin.com/company/coinzilla/" target="_blank">Linkedin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright © 2016 - 2022 <a href="https://sevio.com" target="_blank">Sevio</a> -
                    <a href="../website-acceptance-policy/index.html">Terms & Conditions</a> - <a
                            href="../privacy-policy/index.html">Privacy Policy</a> - <a href="../cookie-policy/index.html">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </section>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="../assets/js/app.js"></script>
<script>
    $("#networkMenu").addClass("active");
    $("#networkDisplayMenu").addClass("active");
</script>
</body>
</html>
