<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];
$user_email = $_SESSION ['user_email'];
$first_name = $_SESSION ['first_name'];
$avatar_first_name = $first_name[0];
$pwd_db = "";
$show = "";
$wrong = "";

if (filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS) === 'da') {
    $pwd = clean_input($_POST['pwd']);
    $delete_reason = clean_input($_POST['delete_reason']);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT pwd FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $cus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $pwd_db);
        mysqli_stmt_fetch($stmt);
//        mysqli_stmt_close($stmt);
    }

    if (password_verify($pwd, $pwd_db)) {
//        $link = get_link();
//        $sql = "INSERT INTO deleted_customer (cus_id, first_name, last_name, user_email, address, country, activation_code, agree, approved, banned, pwd1, pwd, user_ip, create_date) SELECT id, first_name, last_name, user_email, address, country, activation_code, agree, approved, banned, pwd1, pwd, user_ip, ttime FROM customer WHERE id=" . $cus_id;
//        mysqli_query($link, $sql);
//        mysqli_close($link);

//        $link = get_link();
        $deleted =1;
        $stmt = mysqli_stmt_init($link);
        $sql = "UPDATE customer SET deleted=?, delete_reason=? WHERE id=?";
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "isi", $deleted, $delete_reason,  $cus_id);
            mysqli_stmt_execute($stmt);

        }

        mysqli_stmt_close($stmt);
        header("Location: ../logout.php");
//        $show = "show";

//        $message = /** @lang text */
//            "<!DOCTYPE HTML>
//<html lang=\"en\">
//<head>
//    <style>
//        .ka {
//            padding: 100px 0 0 0;
//        }
//
//        .ka1 {
//            color: #20bea8;
//        }
//
//        .ka2 {
//            padding: 2% 25% 2% 25%;
//            color: #606662;
//            text-align: left;
//
//        }
//
//        .ka3 {
//            /*background-color: #20bea8;*/
//            /*padding: 10px;*/
//            /*margin: 30px;*/
//            text-decoration: none;
//            color: #fff;
//            font-weight: 700;
//            font-size: 1.3em;
//            /*text-align: left;*/
//
//        }
//
//        .ka4 {
//            background-color: #20bea8;
//            padding: 10px;
//            margin: 30px 25% 30px 25%;
//            text-decoration: none;
//            color: #fff;
//            text-align: center;
//            border-radius: 5px;
//
//        }
//
//        .ku {
//            background-color: #e4edef;
//            padding: 50px 0 50px 0;
//            box-sizing: border-box;
//            display: block;
//            font-family: \"Open Sans\", sans-serif;
//            font-size: 14px;
//            line-height: 20px;
//            color: #8d9a9d;
//            /*text-align: center;*/
//
//        }
//
//        .main-container {
//            background-color: #F6F8F9;
//            /*height: 500px;*/
//            /*padding: 50px;*/
//            text-align: center;
//        }
//
//    </style>
//</head>
//<body class=\"\">
//<div class=\"main-container\">
//    <div class=\"ka\">
//        <img src=\"https://kumpenot.com/images/logo/kum.png\" alt=\"\" height=\"50\">
//    </div>
//    <div class=\"ka1\">
//        A prepaid credit card for the crypto community
//    </div>
//    <br>
//    <div class=\"ka2\">
//        <h3>Your password has been reset successfully!</h3>
//        <p>You requested a password reset, here is your new password:</p>
//        <p>$pwd_new</p>
//        <p>Thank you</p>
//        <br>
//    </div>
//    <div class=\"ku\">
//        <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
//        <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
//        <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
//        <p class=\"footer-copyright\">© 2018-2019 <a href=\"index.php\">kumpenot Ltd </a></p>
//    </div>
//</div>
//</body>
//</html>
//";
//        $from_user = "password reset";
//        $from_email = "info@" . $_SERVER ['HTTP_HOST'];
//        $subject = "Password reset";
//        mail_utf8($user_email, $from_user, $from_email, $subject, $message);
    } else {
        $wrong = "wrong password";
    }
}

?>


<!DOCTYPE html>
<html lang="en" class=" tqmiwljs idc0_344">
<head>
    <meta charset="UTF-8">
    <title>Delete Account - Coinzilla - Finance &amp; Crypto Display Advertising</title>
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

<!--<div id="alertHandler">-->
<!--    <div class="container">-->
<!--        <section class="alert alert-standard fade show" role="alert">-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12 active">-->
<!--                        <strong></strong> <span class="icon far fa-exclamation-triangle text-warning"></span> Please complete your billing details to have your account fully functional. <a href="billing/" class="action  " data-action="">Fix it-->
<!--                        ⟶</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->
<!--</div>-->
<div id="wrapperHandler" class="">
    <section class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card main-card">
                        <div class="card-header card-custom-mb">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class=" nav-link" href="profile.php">My Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="change-password.php">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="delete-account.php">Delete Account</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>Delete Account</h3>
                                        <p>
                                            Deleting your account is an irreversible action. Once your request is automatically verified after 48h, all your information will be deleted from our database, and you will not be able to recover your
                                            account.
                                        </p>
                                        <div class="line-bellow"></div>
                                        <form action="delete-account.php" method="post">
                                            <input type="hidden" name="pass" value="da">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="reason">Reason for closure</label>
                                                    <textarea name="delete_reason" id="reason" cols="30" rows="5" class="form-control" placeholder="Write the reason why you wish to close your account" required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="upass_203291">Current account password</label>
                                                    <input type="password" name="pwd" id="upass_203291" class="form-control" placeholder="Your Password" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-danger"><span class="icon"><span class="far fa-check submit-icon"></span></span> Submit Your Request</button>
                                                </div>
                                            </div>
                                            <div class="modal fade" tabindex="-1" role="dialog" id="modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content"></div>
                                                </div>
                                            </div>
                                        </form>
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