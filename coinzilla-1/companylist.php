<?php
include(__DIR__ . '/a.php');
$today = array();
$yesterday = array();
$datetime = new DateTime('NOW');
$datetime->modify('-1 days');
$ttime = $datetime->format('Y-m-d') . "%";
$perf = null;
$today_index = null;
$yesterday_index = null;
$link = get_link();

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

$index_change = $today_index - $yesterday_index;
$index_change_percentage = change_percentage($today_index, $yesterday_index);

$index_change = number_format($index_change, 2);
if ($index_change > 0) $index_change = "+" . $index_change;

$index_change_percentage = number_format($index_change_percentage, 2);
if ($index_change_percentage > 0) $index_change_percentage = "+" . $index_change_percentage;

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

    $today[$k]['change'] = $change;
    $today[$k]['changep'] = $changep;
}

//$all_banners['Top'] = array("https://tpc.googlesyndication.com/simgad/7130775551167661743?sqp=4sqPyQQrQikqJwhfEAEdAAC0QiABKAEwCTgDQPCTCUgAUAFYAWBfcAJ4AcUBLbKdPg&amp;rs=AOga4qnJFrY06lcLPWXKWRoP3hdyZM68-A", "#");
$all_banners['Top'] = array("./assets/images/imafil-728-90.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Left side 1'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Left side 2'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Left side 3.json'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Left side 4'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Left side 5'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Right side 1'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Right side 2'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Right side 3.json'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Right side 4'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Right side 5'] = array("./assets/images/imafil-125-125.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['Bottom'] = array("./assets/images/imafil-468-60.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['250x250-1'] = array("https://www.allhyipmonitors.com/assets/banners/solid-trade_250x250.gif", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['300x250-1'] = array("./assets/images/300x250.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
$all_banners['300x600-1'] = array("./assets/images/300x600-1.jpeg", "https://www.allhyipmonitors.com/\" target=\"_blank");

$now = get_now();
$banners = array();
$payment = "complete";

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
    <!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>-->
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <style>
        .material-symbols-outlined {
            color: red;
            font-variation-settings: 'FILL' 1,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48
        }
    </style>
</head>
<body class="overflow__limited">
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="" href="index.php">

                            <!--                            <img src="assets/images/coinzilla-logo.svg" alt="Coinzilla Advertising Network" class="logo">-->
                            <img src="assets/images/logo-3.png" alt="Coinzilla Advertising Network" class="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon far fa-bars button-menu-mobile"></span>
                        </button>
                        <div class="navbar-collapse collapse toggle-menu-mobile" id="navbarSupportedContent">
                            <ul class="navbar-nav navbar-right-coinzilla">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#perf" id="advertisersMenu">company list</a>
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
                                        <a class="nav-link" href="display/overview.php">Member Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="display/login.php">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="display/signup.php">Sign Up</a>
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
    <section class="" style="padding-bottom: 20px">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Top'][1] ?>"><img class="me-contain"
                                                                     src="<?= $all_banners['Top'][0] ?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="" style="background-color: white;">
        <div class="container">
            <div class="row row-flex">
                <div class="col-md-2">
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <!--                    <div style="  background-color: white; margin: auto">-->
                    <div style="text-align: center;">
                        <!--                <p style="font-size: 2.3em; font-weight: 500"> Investment market performance index</p>-->
                        <!--                <h1 style="color: #536677"><a href="#perf"> Investment market performance index</a></h1>-->
                        <h1 id="perf" style="color: #536677">Investment market performance index</h1>
                        <p><?= count($today) ?> companies listed &nbsp;| &nbsp; IMP index <?= $index_change ?> (<?= $index_change_percentage ?>)<span class="material-symbols-outlined">change_history</span></p>
                    </div>
                    <table id="myTable" class="stripe row-border hover table-responsive">
                        <thead>
                        <tr>
                            <th style=" width: 100%">Name</th>
                            <th style=" width: 100%">URL</th>
                            <th style=" width: 100%">Index</th>
                            <th style=" width: 100%">Day</th>
                            <th style=" width: 100%">Day %</th>
                            <th style=" width: 100%">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
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
                        <!--                    </div>-->

                </div>
                <div class="col-md-2">
                    <div class="row">
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Right side 5'][1] ?>"><img class="me-contain" src="<?= $all_banners['Right side 5'][0] ?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="" style="padding-bottom: 20px">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="me-flex-1">
                        <a href="<?= $all_banners['Bottom'][1] ?>"><img class="me-contain" src="<?= $all_banners['Bottom'][0] ?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<footer>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
