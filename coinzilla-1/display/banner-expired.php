<?php
include(__DIR__ . '/../a.php');

page_protect();
$cus_id = $_SESSION ['cus_id'];
$first_name = $_SESSION ['first_name'];
$avatar_first_name = $first_name[0];
$user_email = $_SESSION ['user_email'];
$show = "";

$now = new DateTime('today');

$payment = "complete";

$active_banners = array();
$expired_banners = array();
$scheduled_banners = array();

$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if (($now >= $firstday) && ($now <= $lastday)) {
            $active_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }

        if ($now < $firstday) {
            $scheduled_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }

        if ($now > $lastday) {
            $expired_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }

    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$banner_price["Top"] = 100;
$banner_price["Left side 1"] = 50;
$banner_price["Left side 2"] = 50;
$banner_price["Left side 3.json"] = 50;
$banner_price["Left side 4"] = 50;
$banner_price["Left side 5"] = 50;
$banner_price["Right side 1"] = 50;
$banner_price["Right side 2"] = 50;
$banner_price["Right side 3.json"] = 50;
$banner_price["Right side 4"] = 50;
$banner_price["Right side 5"] = 50;
$banner_price["Bottom"] = 75;

$banner_size["Top"] = "728x90";
$banner_size["Left side 1"] = "125x125";
$banner_size["Left side 2"] = "125x125";
$banner_size["Left side 3.json"] = "125x125";
$banner_size["Left side 4"] = "125x125";
$banner_size["Left side 5"] = "125x125";
$banner_size["Right side 1"] = "125x125";
$banner_size["Right side 2"] = "125x125";
$banner_size["Right side 3.json"] = "125x125";
$banner_size["Right side 4"] = "125x125";
$banner_size["Right side 5"] = "125x125";
$banner_size["Bottom"] = "468x60";

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
<script id="headerHandlerView" type="text/template">
    <div id="wrap__loading"></div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar main-navigation navbar-expand-md navbar-light">
                        <div class="dropdown">
                            <a class="navbar-brand" data-toggle="dropdown" href="../index.php">
                                <img src="assets/images/logo-3.png" class="logo d-inline-block align-top" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler toggle-button" type="button" data-toggle="#mainNavBar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse toggle-content" id="mainNavBar">
                            <ul class="nav">
                                <li class="nav-item active">
                                    <a class="nav-link dot" href="overview.php">Overview<span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dot" href="addbanner.php">Add banner<span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
                                <li class="nav-item dropdown nav-user-account mr-0 ">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <span class="avatar rounded-circle"><?= $avatar_first_name ?></span>
                                        <span class="display-mobile">Account</span>
                                        <span class="icon far fa-angle-down"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <span class="d-none" id="u_target">838636421b180d0b237</span>
                                            <h3><?= $first_name ?></h3>
                                            <h4 class="u_email" id="u_email"><?= $user_email ?></h4>
                                            <div class="line-bellow-small"></div>
                                            <a href="logout.php"><span class="far fa-sign-out icon"></span> Sign Out</a>
                                        </div>
                                        <a class="dropdown-item  " href="billing.php"><span class="far fa-credit-card-blank icon"></span> Billing Center</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="profile.php"><span class="far fa-user-cog icon"></span> My Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="change-password.php"><span class="far fa-user-shield icon"></span> Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="delete-account.php"><span class="far fa-users icon"></span> Delete Account</a>
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
                            <a class="navbar-brand" data-toggle="dropdown" href="../index.php">
                                <img src="assets/images/logo-3.png" class="logo d-inline-block align-top" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler toggle-button" type="button" data-toggle="#mainNavBar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse toggle-content" id="mainNavBar">
                            <ul class="nav">
                                <li class="nav-item active">
                                    <a class="nav-link dot" href="overview.php">Overview<span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dot" href="addbanner.php">Add banner<span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
                                <li class="nav-item dropdown nav-user-account mr-0 ">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <span class="avatar rounded-circle"><?= $avatar_first_name ?></span>
                                        <span class="display-mobile">Account</span>
                                        <span class="icon far fa-angle-down"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <span class="d-none" id="u_target">838636421b180d0b237</span>
                                            <h3><?= $first_name ?></h3>
                                            <h4 class="u_email" id="u_email"><?= $user_email ?></h4>
                                            <div class="line-bellow-small"></div>
                                            <a href="logout.php"><span class="far fa-sign-out icon"></span> Sign Out</a>
                                        </div>
                                        <a class="dropdown-item  " href="billing.php"><span class="far fa-credit-card-blank icon"></span> Billing Center</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="profile.php"><span class="far fa-user-cog icon"></span> My Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="change-password.php"><span class="far fa-user-shield icon"></span> Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item  " href="delete-account.php"><span class="far fa-users icon"></span> Delete Account</a>
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
                                                    <a class="nav-link disabled pl-2"
                                                       href="https://display.Investment market.com/#">Account Summary</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="insight">
                                                <span class="title">Banners</span>
                                                <div class="line-bellow-small"></div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-7">
                                                    <div class="placeholder">Active
                                                    </div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-success d-block mb-2"
                                                                              data-toggle="tooltip"
                                                                              data-placement="bottom" title=""
                                                                              data-original-title="Active Campaigns / Total Campaigns"><?= count($active_banners) ?></strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Scheduled</div>
                                                </div>
                                                <div class="col-md-5"><strong
                                                            class="badge badge-light d-block mb-2"><?= count($scheduled_banners) ?></strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="placeholder">Expired</div>
                                                </div>
                                                <div class="col-md-5"><strong class="badge badge-light d-block mb-2"
                                                                              data-toggle="tooltip"
                                                                              data-placement="bottom" title=""
                                                                              data-original-title="Active Campaigns / Total Campaigns"><?= count($expired_banners) ?></strong></div>
                                            </div>
                                            <!--                                            <div class="row">-->
                                            <!--                                                <div class="col-md-7">-->
                                            <!--                                                    <div class="placeholder">Canceled</div>-->
                                            <!--                                                </div>-->
                                            <!--                                                <div class="col-md-5"><strong class="badge badge-light d-block mb-2"-->
                                            <!--                                                                              data-toggle="tooltip"-->
                                            <!--                                                                              data-placement="bottom" title=""-->
                                            <!--                                                                              data-original-title="Active Referred Users / Total Referred Users ">--><? //= $canceled ?><!--</strong>-->
                                            <!--                                                </div>-->
                                            <!--                                            </div>-->
                                            <div class="card-header">
                                                <ul class="nav nav-tabs card-header-tabs">
                                                    <li class="nav-item">
                                                    </li>
                                                </ul>
                                            </div>
                                            <br>
                                            <div class="">
                                                <strong>Account Settings</strong>
                                                <div class="line-bellow-small"></div>
                                                <ul>
                                                    <li><a href="profile.php" class=" ">My Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="change-password.php" class=" ">Change Password</a>
                                                    </li>
                                                    <li>
                                                        <a href="delete-account.php" class=" ">Delete Account</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-header">
                                                <ul class="nav nav-tabs card-header-tabs">
                                                    <li class="nav-item">
                                                    </li>
                                                </ul>
                                            </div>
                                            <br>
                                            <div class="">
                                                <strong>Billing Settings</strong>
                                                <div class="line-bellow-small"></div>
                                                <ul>
                                                    <li><a href="billing.php" class=" ">Billing History</a></li>
                                                </ul>
                                            </div>
                                            <div class="card-header">
                                                <ul class="nav nav-tabs card-header-tabs">
                                                    <li class="nav-item">
                                                    </li>
                                                </ul>
                                            </div>
                                            <br>
                                            <div class="">
                                                <strong>Banners</strong>
                                                <div class="line-bellow-small"></div>
                                                <ul>
                                                    <li>
                                                        <a href="overview.php" class=" ">Active</a>
                                                    </li>
                                                    <li>
                                                        <a href="banner-scheduled.php" class=" ">Scheduled</a>
                                                    </li>
                                                    <li>
                                                        <a href="banner-expired.php" class=" ">Expired</a>
                                                    </li>
                                                    <!--                                                    <li>-->
                                                    <!--                                                        <a href="banner-canceled.php" class=" ">Canceled</a>-->
                                                    <!--                                                    </li>-->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="card card-no-border delimiter-mb-top">-->
                                    <!--                                        <div class="card-header">-->
                                    <!--                                            <ul class="nav nav-tabs card-header-tabs">-->
                                    <!--                                                <li class="nav-item">-->
                                    <!--                                                    <a class="nav-link disabled pl-2" href="#">News &amp; Tutorials</a>-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="card-body">-->
                                    <!--                                            <h4 class="card-title">Beware of the Coinzilla Desktop App scam</h4>-->
                                    <!--                                            <div class="line-bellow-small"></div>-->
                                    <!--                                            <span class="placeholder d-block">15th of November 2022</span>-->
                                    <!--                                            <p class="card-text">-->
                                    <!--                                                We have recently been informed of a new scam that is circling around the interne... </p>-->
                                    <!--                                            <a href="https://coinzilla.medium.com/beware-of-the-coinzilla-desktop-app-release-its-a-scam-7734784bf0db?source=rss-d4610936bb57------2" target="_blank">Read the full story ⟶</a>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="card-body">-->
                                    <!--                                            <h4 class="card-title">Coinzilla Turns 6 | We’re Beating the Bear Market</h4>-->
                                    <!--                                            <div class="line-bellow-small"></div>-->
                                    <!--                                            <span class="placeholder d-block">9th of November 2022</span>-->
                                    <!--                                            <p class="card-text">-->
                                    <!--                                                On November 9th, Coinzilla turns 6, and despite 2022’s bear market, we’ve manage... </p>-->
                                    <!--                                            <a href="https://coinzilla.medium.com/coinzilla-turns-6-34c603d1f18f?source=rss-d4610936bb57------2" target="_blank">Read the full story ⟶</a>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                </div>

                                <div class="col-md-12 col-lg-9 list-content oder-mb-0">
                                    <div class="wrapper">
                                        <div class="container-fluid no-m-padding">
                                            Welcome <?= $first_name ?>
                                            <h3>Your Account Overview</h3>
                                            <div class="line-bellow"></div>
                                            <div class="container-fluid no-padding padding-top">
                                                <div class="row align-items-center">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Create a new campaign</h5>
                                                            <p>
                                                                Set up your campaign right away and deposit funds once you're ready to receive traffic.
                                                            </p>
                                                            <h5 class="card-title">Banners</h5>
                                                            <div class="line-bellow-small"></div>
                                                            <ul class="nav nav-tabs card-header-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link  " href="overview.php">Active</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link  " href="banner-scheduled.php">Scheduled</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class=" nav-link active" href="banner-expired.php">Expired</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (count($expired_banners) > 0) {
                                                        foreach ($expired_banners as $banner) {
                                                            $firstday = new DateTime($banner['start_date']);

                                                            $lastday = new DateTime($banner['start_date']);
                                                            $lastday->modify('+' . $banner['days'] - 1 . 'days');

                                                            $firstday = $firstday->format('d M Y');
                                                            $lastday = $lastday->format('d M Y');

                                                            ?>
                                                            <div class="col-lg-12">
                                                                <a href="https://marketplace.coinzilla.com/listing/425629f1a55b5ae1282/">
                                                                    <div class="listing card mb-3">
                                                                        <div class="card-body">
                                                                            <div class="container-fluid">
                                                                                <div class="row align-items-center">
                                                                                    <div class="">
                                                                                        <a href="<?= $banner['site'] ?>" target="_blank"><img src="<?= $banner['banner_url'] ?>" alt="" class="me-cover"></a>
                                                                                    </div>
                                                                                    <div class="col-md-7 list-marketplace">
                                                                                        <div class="title"><?= $banner['site'] ?> </div>
                                                                                        <div class="sub-title"><?= $firstday . " - " . $lastday ?></div>
                                                                                        <div class="sub-title">days total <?= $banner['days'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;days left 0
                                                                                            &nbsp;&nbsp;|&nbsp;&nbsp;<?= $banner['banner_id'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?= $banner_size[$banner['banner_id']] ?>
                                                                                            &nbsp;&nbsp;|&nbsp;&nbsp;slots <?= $banner['slot'] ?></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="col-md-12 text-center" style="color: #c9c9c9">
                                                            <strong class="display-1 mb-3 d-block">:(</strong>
                                                            <h1 style="color: #c9c9c9">Your shopping cart is empty!</h1>
                                                            <p><a href="/" class="  text-primary-v2"
                                                                  style="color: #ed893f">Browse our Listings ⟶ </a></p>
                                                        </div>
                                                    <?php } ?>
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