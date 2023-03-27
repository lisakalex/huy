<?php

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

$account = "";
$mybanners = "";
$addbanner = "";
if (found($_SERVER['SCRIPT_NAME'], "account")) $account = "active";
elseif (found($_SERVER['SCRIPT_NAME'], "banner-active")) $mybanners = "active";
elseif (found($_SERVER['SCRIPT_NAME'], "banner-canceled")) $mybanners = "active";
elseif (found($_SERVER['SCRIPT_NAME'], "banner-expired")) $mybanners = "active";
elseif (found($_SERVER['SCRIPT_NAME'], "banner-scheduled")) $mybanners = "active";
elseif (found($_SERVER['SCRIPT_NAME'], "addbanner")) $addbanner = "active";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Investment market - Finance &amp; Crypto Display Advertising</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<!--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>

    <link rel="stylesheet" href="assets/plugins/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/switch/style.css">
    <link rel="stylesheet" href="assets/plugins/switch/simple.css">
    <link rel="stylesheet" href="assets/plugins/flags/sprite-flags.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/me.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!--    <script>-->
<!--        function myFunction(x) {-->
<!--            var checkBox = document.getElementById("body");-->
<!--            var text = document.getElementById("id01");-->
<!--            var da = document.getElementById("da");-->
<!--            if (checkBox.checked === false) {-->
<!--                text.style.display = "block";-->
<!--                da.textContent = x;-->
<!--            } else {-->
<!--                text.style.display = "none";-->
<!--            }-->
<!--        }-->
<!--    </script>-->
    <script>
        function myFunction(x) {
            var checkBox = document.getElementById("agree");
            var text = document.getElementById("id01");
            var da = document.getElementById("da");
            if (checkBox.checked === false) {
                text.style.display = "block";
                da.textContent = x;
            } else {
                text.style.display = "none";
            }
        }
    </script>
    <script>
        function copyFunction(x, y) {
            var copyText = document.getElementById(x);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            var tooltip = document.getElementById(y);
            tooltip.innerHTML = "Copied";
        }

        function outFunc(x, y) {
            var tooltip = document.getElementById(x);
            tooltip.innerHTML = "Copy " + y;
        }
    </script>
</head>
<body>
<!--<script src="../assets/js/me.js"></script>-->
<!--<script>-->
<!--    Swal.fire({-->
<!--        title: 'Error! da',-->
<!--        text: 'Do you want to continue',-->
<!--        icon: 'error',-->
<!--        confirmButtonText: 'Cool'-->
<!--    });-->
<!--</script>-->
<?php
if (isset ($_GET ['err'])) { ?>
    <div id="id02" class="modal1">
        <div class="modal-content animate">
            <div class="container"><?= $_GET ['err'] ?></div>
            <div onclick="document.getElementById('id02').style.display='none'" class="close" title="Close">OK</div>
        </div>
    </div>
<?php } ?>

<div id="id01" class="modal">
    <div class="modal-content animate">
        <div class="container" id="da"></div>
        <div onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">OK</div>
    </div>
</div>
<div id="" type="text/template">
    <div id="wrap__loading"></div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar main-navigation navbar-expand-md navbar-light">
                        <div class="dropdown">
                            <a class="navbar-brand" data-toggle="dropdown" href="#">
                                <img src="../assets/images/logo-3.png" class="logo">
<!--                                <span class="icon far fa-angle-down"></span>-->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <a href="https://display.Investment market.com" class="placeholder">Investment market > Display
                                        Network</a>
                                    <h3>Our Available Products</h3>
                                </div>
                                <a href="https://marketplace.Investment market.com" class="dropdown-item">Investment market
                                    Marketplace</a>
                                <div class="dropdown-divider"></div>
                                <a href="https://academy.Investment market.com" class="dropdown-item" target="_blank">Investment market
                                    Academy</a>
                            </div>
                        </div>
                        <button class="navbar-toggler toggle-button" type="button" data-toggle="#mainNavBar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse toggle-content" id="mainNavBar">
                            <ul class="nav">
                                <li class="nav-item <?= $account ?>">
                                    <a class="nav-link navigate dot" href="account.php">Account</a>
                                </li>
                                <li class="nav-item <?= $mybanners ?>">
                                    <a class="nav-link navigate tag_adv_trigger dot" href="banner-active.php">My
                                        banners</a>
                                </li>
                                <li class="nav-item <?= $addbanner ?>">
                                    <a class="nav-link navigate" href="addbanner.php">Add banner</a>
                                </li>
                                <li class="nav-item border-left d-none d-md-block"></li>
<!--                                <li class="nav-item">-->
<!--                                    <a class="nav-link navigate" href="billing/"><span class="balance_wrapper"><span-->
<!--                                                    class="symbol">&euro;</span><span class="balance">0.00</span></span></a>-->
<!--                                </li>-->
                                <li class="nav-item dropdown mr-0">
                                    <a class="nav-link" data-toggle="dropdown" href="#"><span
                                                class="avatar rounded-circle">A</span><span
                                                class="icon far fa-angle-down"></span></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <span class="d-none" id="u_target">9166089babeeab4e806</span>
                                            <h3>Al La</h3>
                                            <h4 class="u_email" id="u_email">tcps@bk.ru</h4>
                                            <div class="line-bellow-small"></div>
                                            <a href="logout.php/"><span class="far fa-sign-out icon"></span> Sign
                                                Out</a>
                                        </div>
                                        <a class="dropdown-item navigate" href="profile.php"><span
                                                    class="far fa-users-cog icon"></span> My Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="billing.php"><span
                                                    class="far fa-credit-card-blank icon"></span> Billing Center</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item navigate" href="security/"><span
                                                    class="far fa-user-shield icon"></span> Account Security</a>
<!--                                        <div class="dropdown-divider"></div>-->
<!--                                        <a class="dropdown-item navigate" href="referral-program/"><span-->
<!--                                                    class="far fa-users icon"></span> Refer a Friend</a>-->
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