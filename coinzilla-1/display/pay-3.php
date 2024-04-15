<?php
include(__DIR__ . '/../a.php');

page_protect();
$cus_id = $_SESSION ['cus_id'];
$first_name = $_SESSION ['first_name'];
$avatar_first_name = $first_name[0];
$user_email = $_SESSION ['user_email'];
$rate = get_rate();

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

$banner_url = $banner_id = $site = $slot = $days = $start_date = "";

if (filter_input(INPUT_POST, 'da', FILTER_SANITIZE_SPECIAL_CHARS) === 'yes') {
    $banner_url = clean_input($_POST["banner_url"]);
    $banner_id = clean_input($_POST["banner_id"]);
    $site = clean_input($_POST["site"]);
    $slot = clean_input($_POST["slot"]);
    $days = clean_input($_POST["days"]);
    $start_date = clean_input($_POST["start_date"]);

    $usd = $banner_price[$banner_id] * $slot * $days;
    $btc = $usd / $rate;

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO banner ( cus_id, banner_url, banner_id, site, slot, days, start_date)
	VALUES(?,?,?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "isssiis", $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        mysqli_stmt_execute($stmt);
        $b_id = mysqli_insert_id($link);
        mysqli_stmt_close($stmt);
    }
}

$payment = "new";
$limit = 1;
$link = get_link();
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT address FROM trans WHERE payment=? LIMIT ?')) {
    mysqli_stmt_bind_param($stmt, "si", $payment, $limit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $newaddress);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

$payment = "pending";
$link = get_link();
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET cus_id=?, banner_id=?, usd=?, btc=?, payment=?, start_date=NOW() WHERE address=? ')) {
    mysqli_stmt_bind_param($stmt, "iiddss", $cus_id, $b_id, $usd, $btc, $payment, $newaddress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$btc = number_format($btc, 8);
$qr = "bitcoin:" . $newaddress . "?amount=" . $btc;

?>

<!DOCTYPE html>
<html lang="en" class=" wqtlrxoe idc0_344">
<head>
    <meta charset="UTF-8">
    <title>Delete Account - Coinzilla - Finance &amp; Crypto Display Advertising</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--    <base href="https://display.coinzilla.com">-->
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
    <link rel="stylesheet" href="assets/css/me.css">


    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Dec 28, 2020 00:00:00").getTime();
        var countDownDate = new Date();
        countDownDate.setHours(countDownDate.getHours() + 1);

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
<body>
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
                                    <a class="nav-link navigate tag_adv_trigger dot" href="campaigns/">Campaigns <span class="display-mobile icon-wrapper"><span class="far fa-long-arrow-right"></span></span></a>
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
<div class="container" style="align-items: center">
    <div class="row">
        <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div id="advanced-targeting" class="card-body " style="display: block;">
                            <div class="container-fluid targeting table-select">
                                <div class="row">
                                    <div id="advanced-targeting" class="card-body advanced-settings " style="display: block;">
                                        <div class="container-fluid targeting table-select">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="browse-card card-select">
                                                        <div>
                                                            <h1>Send Bitcoin</h1>
                                                            <p class="placeholder">
                                                                Please scan QR code or copy BTC address</a></p>
                                                        </div>
                                                        <div style="">
                                                            <div class="line-bellow mt-3"></div>

                                                            <img src="../qr/php/qr_img.php?d=<?= $qr ?>&s=6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        confirmations of your
                                                        transaction! <br/>
                                                        And then it will be displayed in your personal account.
                                                        <div style="text-align: center">
                                                            <p style="" id="demo"></p>
                                                            <img src="assets/images/30.gif">
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div>
                                                            <h5><b>$<?= $usd ?> </b>(BTC <?= $btc ?>)</h5>

                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div style="display: flex; flex-direction: row;">
                                                            <div style="width: 50%">
                                                                <div>
                                                                    <div>
                                                                        Amount
                                                                    </div>
                                                                    <div style="">
                                                                        <input size="8" type="text" value="<?= $btc ?>" id="myInput" style="border: 0; outline: none; color: #536677">
                                                                    </div>
                                                                    <div class="copytooltip" style="">
                                                                        <div onclick="copyFunction('myInput', 'myTooltip')" onmouseout="outFunc('myTooltip', 'amount')">
                                                                            <span class="copytooltiptext" id="myTooltip">Copy amount</span>
                                                                            <div class="copy-button">
                                                                                <img src="assets/images/clipboard.png" class="icon" height="20">

                                                                                <!--                                                                        copy-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div style="">
                                                                        <label for="btcAddress"><img src="assets/images/bitcoin.png" class="icon" height="20"> BTC Deposit Address</label>
                                                                        <!--                                                                    <b>--><? //= $newaddress ?><!--</b>-->
                                                                        <input size="43" type="text" value="<?= $newaddress ?>" id="myInput1" style="border: 0; outline: none; font-family: monospace; color: #536677">

                                                                    </div>
                                                                    <div class="copytooltip" style="margin-top: auto;">
                                                                        <div onclick="copyFunction('myInput1', 'myTooltip1')" onmouseout="outFunc('myTooltip1', 'address')">
                                                                            <span class="copytooltiptext" id="myTooltip1">Copy address</span>
                                                                            <div class="copy-button">
                                                                                <img src="assets/images/clipboard.png" class="icon" height="20">
                                                                                <!--                                                                            copy-->
                                                                                <!--                                                                            <span class="input-group-btn"><button class="btn btn-secondary copy b-cd-c-dtc" data-id="btcAddress" type="button"><span class="far fa-copy"></span> Copy</button></span>-->
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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