<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];
$now = new DateTime('today');
$payment = "complete";
$banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
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
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$active = count($banners);


$now = get_now();
$payment = "complete";
$expired_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if ($now > $lastday) {
            $expired_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$expired = count($expired_banners);


$now = get_now();
$payment = "complete";
$scheduled_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if ($now < $firstday) {
            $scheduled_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$scheduled = count($scheduled_banners);


$now = get_now();
$payment = "canceled";
$canceled_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
        $canceled_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
    }

    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$canceled = count($canceled_banners);
?>

<!DOCTYPE html>
<html lang="en" class=" wocszodj idc0_344">
<head>
    <meta charset="UTF-8">
    <title>Coinzilla - Finance &amp; Crypto Display Advertising</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/switch/style.css">
    <link rel="stylesheet" href="assets/plugins/switch/simple.css">
    <link rel="stylesheet" href="assets/plugins/flags/sprite-flags.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFBBVRX" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6KHRGX" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script id="headerHandlerView" type="text/template">
    <div id="wrap__loading"></div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar main-navigation navbar-expand-md navbar-light">
                        <div class="dropdown">
                            <a class="navbar-brand" data-toggle="dropdown" href="#">
                                <img src="assets/images/coinzilla-logo.svg" class="logo d-inline-block align-top">
                                <span class="icon far fa-angle-down"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <a href="https://display.coinzilla.com" class="placeholder">Coinzilla > Display Network</a>
                                    <h3>Our Available Products</h3>
                                </div>
                                <a href="https://marketplace.coinzilla.com" class="dropdown-item">Coinzilla Marketplace</a>
                                <div class="dropdown-divider"></div>
                                <a href="https://academy.coinzilla.com" class="dropdown-item" target="_blank">Coinzilla Academy</a>
                            </div>
                        </div>
                        <button class="navbar-toggler toggle-button" type="button" data-toggle="#mainNavBar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse toggle-content" id="mainNavBar">
                            <ul class="nav">
                                <li class="nav-item active">
                                    <a class="nav-link navigate dot" href="/">Overview <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navigate tag_adv_trigger dot" href="campaigns/">Campaigns <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item no-border">
                                    <a class="nav-link navigate" href="reports/">Reports <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
                                <li class="nav-item nav-user-balance">
                                    <a class="nav-link navigate" href="billing/"><span class="balance_wrapper"><span class="symbol">&euro;</span><span class="balance">0.00</span></span></a>
                                </li>
                                <li class="nav-item dropdown nav-user-account mr-0 ">
                                    <a class="nav-link" data-toggle="dropdown" href="#"><span class="avatar rounded-circle">A</span><span class="display-mobile">Account</span><span class="icon far fa-angle-down"></span><span
                                                class="display-mobile user-current-balance"><span class="balance_wrapper"><span class="symbol">&euro;</span><span class="balance">0.00</span></span></span></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <span class="d-none" id="u_target">838636421b180d0b237</span>
                                            <h3>Al La</h3>
                                            <h4 class="u_email" id="u_email">lisakalex@gmail.com</h4>
                                            <div class="line-bellow-small"></div>
                                            <a href="logout/"><span class="far fa-sign-out icon"></span> Sign Out</a>
                                        </div>
                                        <a class="dropdown-item navigate" href="billing/"><span class="far fa-credit-card-blank icon"></span> Billing Center</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="change-password/"><span class="far fa-user-cog icon"></span> Account Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="security/"><span class="far fa-user-shield icon"></span> Account Security</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="referral-program/"><span class="far fa-users icon"></span> Refer a Friend</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</script>
<script id="footerHandlerView" type="text/template">
    <footer>
        <section class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        Copyright © 2016 - 2022 <a href="https://sevio.com" target="_blank">Sevio</a>
                    </div>
                    <div class="col-md-7 text-md-right">
                        <a href="https://coinzilla.com/terms/" target="_blank">Terms & Conditions</a> - <a href="https://coinzilla.com/privacy-policy/" target="_blank">Privacy Policy</a> - <a href="https://coinzilla.com/cookie-policy/"
                                                                                                                                                                                                target="_blank">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</script>
<script id="modalHandlerView" type="text/template">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
</script>
<div id="headerHandler">
    <div id="wrap__loading"></div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar main-navigation navbar-expand-md navbar-light">
                        <div class="dropdown">
                            <a class="navbar-brand" data-toggle="dropdown" href="#">
                                <img src="assets/images/coinzilla-logo.svg" class="logo d-inline-block align-top">
                                <span class="icon far fa-angle-down"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <a href="https://display.coinzilla.com" class="placeholder">Coinzilla &gt; Display Network</a>
                                    <h3>Our Available Products</h3>
                                </div>
                                <a href="https://marketplace.coinzilla.com" class="dropdown-item">Coinzilla Marketplace</a>
                                <div class="dropdown-divider"></div>
                                <a href="https://academy.coinzilla.com" class="dropdown-item" target="_blank">Coinzilla Academy</a>
                            </div>
                        </div>
                        <button class="navbar-toggler toggle-button" type="button" data-toggle="#mainNavBar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse toggle-content" id="mainNavBar" style="display: none;">
                            <ul class="nav">
                                <li class="nav-item active">
                                    <a class="nav-link navigate dot" href="/">Overview <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navigate tag_adv_trigger dot" href="campaigns/" data-gtm-vis-first-on-screen-10377712_22="106" data-gtm-vis-recent-on-screen-10377712_22="156755" data-gtm-vis-total-visible-time-10377712_22="100"
                                       data-gtm-vis-has-fired-10377712_22="1">Campaigns <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item no-border">
                                    <a class="nav-link navigate" href="reports/">Reports <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
                                <li class="nav-item nav-user-balance">
                                    <a class="nav-link navigate" href="billing/"><span class="balance_wrapper"><span class="symbol">€</span><span class="balance">0.00</span></span></a>
                                </li>
                                <li class="nav-item dropdown nav-user-account mr-0">
                                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false"><span class="avatar rounded-circle">A</span><span class="display-mobile">Account</span><span class="icon far fa-angle-down"></span><span
                                                class="display-mobile user-current-balance"><span class="balance_wrapper"><span class="symbol">€</span><span class="balance">0.00</span></span></span></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <span class="d-none" id="u_target">838636421b180d0b237</span>
                                            <h3>Al La</h3>
                                            <h4 class="u_email" id="u_email">lisakalex@gmail.com</h4>
                                            <div class="line-bellow-small"></div>
                                            <a href="logout/"><span class="far fa-sign-out icon"></span> Sign Out</a>
                                        </div>
                                        <a class="dropdown-item navigate" href="billing/"><span class="far fa-credit-card-blank icon"></span> Billing Center</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="change-password/"><span class="far fa-user-cog icon"></span> Account Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="security/"><span class="far fa-user-shield icon"></span> Account Security</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="referral-program/"><span class="far fa-users icon"></span> Refer a Friend</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>
<div id="wrapperHandler" class="">
    <section class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card main-card">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 no-padding oder-mb-1 delimiter-mb-top">
                                    <div class="card card-no-border">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link disabled pl-2" href="#">Account Summary</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="insight">
                                                <span class="title">Balance</span>
                                                <span class="value">0.00<span class="symbol">€</span></span>
                                            </div>
                                            <div class="line-bellow-small"></div>
                                            <a href="deposit/" class="navigate underlined">Deposit Funds ⟶</a>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Campaigns</div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-light d-block mb-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Active Campaigns / Total Campaigns">0/0</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Pending Deposit</div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-light d-block mb-2">N/A</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Total Deposits</div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-success d-block mb-2"><span class="symbol">€</span>0</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Referred Users</div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-light d-block mb-2" data-toggle="tooltip" data-placement="bottom" title=""
                                                                              data-original-title="Active Referred Users / Total Referred Users ">0/0</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-no-border delimiter-mb-top">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link disabled pl-2" href="#">News &amp; Tutorials</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="placeholder">No available news at this moment.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-9 list-content oder-mb-0">
                                    <div class="wrapper">
                                        <div class="container-fluid no-m-padding">
                                            Welcome Al,
                                            <h3>Your Account Overview</h3>
                                            <div class="line-bellow"></div>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">Create a new campaign</h5>
                                                    <div class="line-bellow-small"></div>
                                                    <p>
                                                        Set up your campaign right away and deposit funds once you're ready to receive traffic.
                                                    </p>
                                                    <a href="campaigns/" class="navigate underlined b-dashcc">Create a campaign ⟶</a>
                                                </div>
                                            </div>
                                            <div class="container-fluid">
                                                <div class="row text-center insights no-border">
                                                    <div class="col-md-3 col-sm-6 col-12 ">
                                                        <span class="title">Today Impressions</span>
                                                        <span class="value">0</span>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-12">
                                                        <span class="title">Today Clicks</span>
                                                        <span class="value">0</span>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-12">
                                                        <span class="title">Click Through Rate</span>
                                                        <span class="value">0.00<span class="symbol">%</span></span>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-12">
                                                        <span class="title">Today Spent</span>
                                                        <span class="value">0.00<span class="symbol">€</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid no-padding padding-top">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6 mb-3">
                                                        <a href="https://marketplace.coinzilla.com/"><img src="https://marketplace.coinzilla.com/assets/images/coinzilla-logo.svg" class="logo d-inline-block align-top"></a>
                                                    </div>
                                                    <div class="col-lg-6 mb-3" id="check-marketplace">
                                                        <a href="https://marketplace.coinzilla.com" class="underlined">Check our marketplace ⟶</a>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <a href="https://marketplace.coinzilla.com/listing/425629f1a55b5ae1282/">
                                                            <div class="listing card mb-3">
                                                                <div class="card-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-md-1 no-padding text-center">
                                                                                <img src="https://cdn.coinzilla.io/creative/a2b62888c0344e5b1de6e5519c61b32d.png" class="cover">
                                                                            </div>
                                                                            <div class="col-md-7 list-marketplace">
                                                                                <div class="title">Main Section Text Ad on MarketCapOf (Desktop+Mobile)</div>
                                                                                <div class="sub-title">Text Ads / Blockchain &amp; Crypto</div>
                                                                            </div>
                                                                            <div class="col-md-3 text-center">
                                                                                <div class="price"><span class="symbol">€</span>2,200.00</div>
                                                                            </div>
                                                                            <div class="col-md-1 text-center">
                                                                                ⟶
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <a href="https://marketplace.coinzilla.com/listing/90661caca9adb2cf938/">
                                                            <div class="listing card mb-3">
                                                                <div class="card-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-md-1 no-padding text-center">
                                                                                <img src="https://cdn.coinzilla.io/creative/3be8e2cd19f06c3cb0425c56f69ca301.png" class="cover">
                                                                            </div>
                                                                            <div class="col-md-7 list-marketplace">
                                                                                <div class="title">Native Ad on MarketCapOf (Desktop+Mobile)</div>
                                                                                <div class="sub-title">Text Ads / Blockchain &amp; Crypto</div>
                                                                            </div>
                                                                            <div class="col-md-3 text-center">
                                                                                <div class="price"><span class="symbol">€</span>2,200.00</div>
                                                                            </div>
                                                                            <div class="col-md-1 text-center">
                                                                                ⟶
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <a href="https://marketplace.coinzilla.com/listing/3005d25a2994c704282/">
                                                            <div class="listing card mb-3">
                                                                <div class="card-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-md-1 no-padding text-center">
                                                                                <img src="https://cdn.coinzilla.io/creative/4889c8dfcddd3c72732a4160200aa3b2.jpeg" class="cover">
                                                                            </div>
                                                                            <div class="col-md-7 list-marketplace">
                                                                                <div class="title">Organic Article on Coindoo</div>
                                                                                <div class="sub-title">Organic Article / Blockchain &amp; Crypto, Finance</div>
                                                                            </div>
                                                                            <div class="col-md-3 text-center">
                                                                                <div class="price"><span class="symbol">€</span>450.00</div>
                                                                            </div>
                                                                            <div class="col-md-1 text-center">
                                                                                ⟶
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid no-padding padding-top">
                                                <div class="row useful-links">
                                                    <div class="col-md-4 col-sm-6">
                                                        <strong>Profile Settings</strong>
                                                        <div class="line-bellow-small"></div>
                                                        <ul>
                                                            <li><a href="change-password/" class="navigate">Change Password</a></li>
                                                            <li><a href="email-settings/" class="navigate">Email Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6">
                                                        <strong>Billing Settings</strong>
                                                        <div class="line-bellow-small"></div>
                                                        <ul>
                                                            <li><a href="billing/" class="navigate">Billing History</a></li>
                                                            <li><a href="deposit/" class="navigate">Deposit Funds</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6">
                                                        <strong>Security Settings</strong>
                                                        <div class="line-bellow-small"></div>
                                                        <ul>
                                                            <li><a href="security/" class="navigate">Access Log</a></li>
                                                            <li><a href="2fa/" class="navigate">2FA Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(".balance").html("0.00");
    </script>
</div>
<div id="footerHandler">
    <footer>
        <section class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        Copyright © 2016 - 2022 <a href="https://sevio.com" target="_blank">Sevio</a>
                    </div>
                    <div class="col-md-7 text-md-right">
                        <a href="https://coinzilla.com/terms/" target="_blank">Terms &amp; Conditions</a> - <a href="https://coinzilla.com/privacy-policy/" target="_blank">Privacy Policy</a> - <a href="https://coinzilla.com/cookie-policy/"
                                                                                                                                                                                                    target="_blank">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>
<div id="modalHandler">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src="assets/js/app.js?ver=2.012"></script>
</body>
</html>