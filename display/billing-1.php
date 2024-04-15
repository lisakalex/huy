<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];

$bills = array();
$link = get_link();
//$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$sql = "SELECT trans.start_date, site, banner.banner_url, banner.banner_id, slot, days, banner.start_date, trans.usd_paid, trans.payment FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $cus_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $t_start_date, $site, $banner_url, $banner_id, $slot, $days, $b_start_date, $usd_paid, $payment,);
    while (mysqli_stmt_fetch($stmt)) {

        $bills[] = array('t_start_date' => $t_start_date, 'site' => $site, 'banner_url' => $banner_url, 'banner_id' => $banner_id, 'slot' => $slot, 'days' => $days, 'b_start_date' => $b_start_date, 'usd_paid' => $usd_paid, 'payment' => $payment);

    }
//    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

//include(__DIR__ . '/header.php');

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

$address = null;

if (filter_input(INPUT_POST, 'cancel', FILTER_SANITIZE_SPECIAL_CHARS) === 'da') {
    $address = clean_input($_POST["address"]);

    $payment = "canceled";
    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET payment=? WHERE address=?')) {
        mysqli_stmt_bind_param($stmt, "ss", $payment, $address);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

?>

<html lang="en" class=" lruh idc0_344">
<head>
    <meta charset="UTF-8">
    <title>Billing History - Coinzilla - Finance &amp; Crypto Display Advertising</title>
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
                                <li class="nav-item">
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
                                <li class="nav-item">
                                    <a class="nav-link navigate dot" href="/">Overview <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navigate tag_adv_trigger dot" href="campaigns/" data-gtm-vis-first-on-screen-10377712_22="219">Campaigns <span class="display-mobile icon-wrapper"><span
                                                    class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item no-border">
                                    <a class="nav-link navigate" href="reports/">Reports <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
                                <li class="nav-item nav-user-balance active">
                                    <a class="nav-link navigate" href="billing/"><span class="balance_wrapper"><span class="symbol">€</span><span class="balance">0.00</span></span></a>
                                </li>
                                <li class="nav-item dropdown nav-user-account mr-0">
                                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false"><span class="avatar rounded-circle">A</span><span class="display-mobile">Account</span><span class="icon far fa-angle-down"></span><span
                                                class="display-mobile user-current-balance"><span class="balance_wrapper"><span class="symbol">€</span><span class="balance">0.00</span></span></span></a>
                                    <div class="dropdown-menu dropdown-menu-right active">
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
<div id="alertHandler">
    <div class="container">
        <section class="alert alert-standard fade show" role="alert">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 active">
                        <strong></strong> <span class="icon far fa-exclamation-triangle text-warning"></span> Please complete your billing details to have your account fully functional. <a href="billing/" class="action navigate" data-action="">Fix it
                            ⟶</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="wrapperHandler" class="">
    <section class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card main-card">
                        <div class="card-header card-custom-mb">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link navigate" href="billing/">Billing Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navigate" href="deposit/">Deposit Funds</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navigate active" href="billing/history/">Billing History</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body no-padding">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="wrapper__body">
                                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-responsive table-striped table-bordered dtable w-100 d-block d-sm-block d-md-table dataTable no-footer" cellspacing="0" width="100%" id="example" role="grid"
                                                               aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                                            <!--                                                            <table id="example" class=" table-responsive  stripe" style="width:100%">-->
                                                            <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Site URL</th>
                                                                <th>Banner URL</th>
                                                                <th>Banner ID</th>
                                                                <th>Slots</th>
                                                                <th>Days</th>
                                                                <th>Start</th>
                                                                <th>USD</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if (count($bills) > 0) {
                                                                foreach ($bills as $bill) {
                                                                    $t_start_date = new DateTime($bill['t_start_date']);
                                                                    $t_start_date = $t_start_date->format('d M Y');
                                                                    $b_start_date = new DateTime($bill['b_start_date']);
                                                                    $b_start_date = $b_start_date->format('d M Y');
                                                                    $site = substr($bill['site'], 0, 20) . "...";
                                                                    $banner_url = substr($bill['banner_url'], 0, 20) . "...";
                                                                    echo "<tr>";
                                                                    echo "<td>" . $t_start_date . "</td>";
                                                                    echo "<td><a class=\"\" href=\"" . $bill['site'] . "\">" . $site . "</a></td>";
                                                                    echo "<td><a class=\"\" href=\"" . $bill['banner_url'] . "\">" . $banner_url . "</a></td>";
                                                                    echo "<td>" . $bill['banner_id'] . "</td>";
                                                                    echo "<td>" . $bill['slot'] . "</td>";
                                                                    echo "<td>" . $bill['days'] . "</td>";
                                                                    echo "<td>" . $b_start_date . "</td>";
                                                                    echo "<td>" . $bill['usd_paid'] . "</td>";
                                                                    echo "<td>" . $bill['payment'] . "</td>";
                                                                    echo "</tr>";
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="col-md-12 text-center"
                                                                     style="color: #c9c9c9">
                                                                    <strong class="display-1 mb-3 d-block">:(</strong>
                                                                    <h1 style="color: #c9c9c9">Your shopping cart is
                                                                        empty!</h1>
                                                                    <p><a href="/" class="navigate text-primary-v2"
                                                                          style="color: #ed893f">Browse our Listings
                                                                            ⟶ </a></p>
                                                                </div>
                                                            <?php }

                                                            echo "</tbody>";
                                                            echo "</table>";
                                                            ?>
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
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

</body>
</html>