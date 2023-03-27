<?php
include(__DIR__ . '/a.php');
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
$all_banners['Left side 1'] = array("assets/images/125.png", "#");
$all_banners['Left side 2'] = array("assets/images/125.png", "#");
$all_banners['Left side 3.json'] = array("assets/images/125.png", "#");
$all_banners['Left side 4'] = array("assets/images/125.png", "#");
$all_banners['Left side 5'] = array("assets/images/125.png", "#");
$all_banners['Right side 1'] = array("assets/images/125.png", "#");
$all_banners['Right side 2'] = array("assets/images/125.png", "#");
$all_banners['Right side 3.json'] = array("assets/images/125.png", "#");
$all_banners['Right side 4'] = array("assets/images/125.png", "#");
$all_banners['Right side 5'] = array("assets/images/125.png", "#");
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
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/fa-regular.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/fa-solid.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/fa-brands.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/me.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
</head>
<body class="overflow__limited">
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5D4MPDT" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.html">
                            <img src="assets/images/coinzilla-logo.svg" alt="Coinzilla Advertising Network"
                                 class="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon far fa-bars button-menu-mobile"></span>
                        </button>
                        <div class="navbar-collapse collapse toggle-menu-mobile" id="navbarSupportedContent">
                            <ul class="navbar-nav navbar-right-coinzilla">
                                <li class="nav-item">
                                    <a class="nav-link" href="advertisers/index.html"
                                       id="advertisersMenu">Advertisers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="advertisers/tihuy.html" id="advertisersMenu">tihuy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="publishers/index.html" id="publishersMenu">Publishers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="marketplace/index.html"
                                       id="marketplaceMenu">Marketplace</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://academy.coinzilla.com//" id="marketplaceMenu">Academy</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav navbar-right">
                                <li class="nav-item">
                                    <a class="nav-link" href="display/sign-up/" id="signUp">Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn outline-dark" href="display/" id="signIn"><span
                                                class="far fa-lock-alt"></span> Sign In</a>
                                </li>
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
    <section class="content multi-features">
        <div class="container">
            <div class="row row-flex">
                <div class="col-md-6 bg__simple_lines_left">
                    <h1>Investment Market</h1>
                    <div class="line-bellow"></div>
                    <div class="content-bellow-line">
                        <h3 class="medium-text">Who We Are</h3>
                        <p>
                            Coinzilla is a platform developed by Sevio, a company that creates advertising technology
                            solutions. The project was founded in November 2016 as an initiative to promote the
                            continuously expanding crypto niche.
                        </p>
                        <p>
                            The primary objective of Coinzilla is to aid our partners in achieving the results and
                            revenue they desire with the help of our tools.
                        </p>
                        <h4 class="medium-text">Coinzilla for Advertisers</h4>
                        <p>
                            Our platform helps advertisers promote their finance & cryptocurrency projects by displaying
                            a variety of ads directly on our publishers' websites.
                        </p>
                        <p>
                            One of our main goals regarding advertising is to provide high-quality leads. That is why we
                            carefully select all the publishers that join our network.
                        </p>
                        <h4 class="medium-text">Coinzilla for Publishers</h4>
                        <p>
                            Through our platform, website owners can generate an additional revenue stream by displaying
                            our advertisers' ads directly on their websites.
                        </p>
                        <p>
                            Our ads are designed to provide a non-intrusive user experience, and they are analyzed in
                            detail to make sure they are relevant to your audience.
                        </p>
                        <h3 class="medium-text">WHAT DO WE AIM FOR?</h3>
                        <p>
                            Since 2016, we have signed hundreds of partnerships with well-known publishers from the
                            finance & cryptocurrency network. We aim to continue our journey toward working together
                            with all the major websites in the industry.
                        </p>
                        <p>
                            Our company is continuously evolving, and we constantly work to develop new features and
                            projects that will help our customers grow their businesses.
                        </p>
                    </div>
                    <p>
                        <a href="../contact/index.html" class="dashed underlined">I want to know more &xrarr;</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title">
                                        16,000+ Campaigns
                                    </div>
                                    <div class="description">
                                        Since the project’s release in 2016, we have delivered over 16,000 campaigns for
                                        more than 15,000 advertisers.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card dark">
                                <div class="card-body">
                                    <div class="title">
                                        40+ Team Members
                                    </div>
                                    <div class="description">
                                        Coinzilla is currently supported by a team of 40+ talented members, and we are
                                        constantly looking for new talent.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title">
                                        Over 20,000 Publishers
                                    </div>
                                    <div class="description">
                                        Our publisher network is made up of over 20,000 websites and mobile apps who use
                                        Coinzilla as a monetization tool.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card dark">
                                <div class="card-body">
                                    <div class="title">
                                        2209 Days of Coinzilla
                                    </div>
                                    <div class="description">
                                        Our project has been up and running ever since the 9th of November 2016, and it
                                        is in a state of continuous development.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mascot">
                        <img src="../assets/images/mascot/Investment Market.jpg" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        <a href="<?= $all_banners['Bottom'][1] ?>"><img class="me-contain"
                                                                        src="<?= $all_banners['Bottom'][0] ?>"
                                                                        alt=""></a>
                    </div>
                    <!--                    </div>-->
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
                <div class="day">
                    <div class="value">1B+</div>
                    <div class="info">Impressions</div>
                    <div class="placeholder">per month</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 card-item">
                <div class="day">
                    <div class="value">1.8M+</div>
                    <div class="info">Clicks</div>
                    <div class="placeholder">per month</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 card-item">
                <div class="day">
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
                    <li><a href="index.html">Who Are We?</a></li>
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
                            href="../privacy-policy/index.html">Privacy Policy</a> - <a
                            href="../cookie-policy/index.html">Cookie
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
<script src="https://coinzillatag.com/lib/performance.js" async></script>
<script>
    window.coinzilla_performance = window.coinzilla_performance || [];
    coinzilla_performance.push({});
</script>
<script>
    window.intercomSettings = {
        app_id: "aoltuu4t"
    };
</script>
<script>(function () {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', intercomSettings);
        } else {
            var d = document;
            var i = function () {
                i.c(arguments)
            };
            i.q = [];
            i.c = function (args) {
                i.q.push(args)
            };
            w.Intercom = i;

            function l() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://widget.intercom.io/widget/aoltuu4t';
                var x = d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }

            if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })()</script>
</body>
</html>
