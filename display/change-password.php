<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];
$user_email = $_SESSION ['user_email'];
$pwd_old_db = "";
$show = "";
$wrong = "";

if (filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS) === 'da') {
    $pwd_new = clean_input($_POST['pwd_new']);
    $pwd_old = clean_input($_POST['pwd_old']);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT pwd FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $cus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $pwd_old_db);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if (password_verify($pwd_old, $pwd_old_db)) {
        $new = password_hash($pwd_new, PASSWORD_DEFAULT);

        $link = get_link();
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET pwd1=?, pwd=? WHERE id=? ')) {
            mysqli_stmt_bind_param($stmt, "ssi", $pwd_new, $new, $cus_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $show = "show";

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
//aA1111111111
include(__DIR__ . '/header.php');
?>
    <div id="alertHandler">
        <div class="container">
            <section class="alert alert-warning fade <?= $show ?>" role="alert" style="background-color: #addead">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: #3a5b39">
                            <strong>Success!</strong> You have updated your password.
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
                                        <a class="nav-link navigate" href="profile.php">My Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate active" href="change-password.php">Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate" href="delete-acc.php">Delete Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2>Change Your Password</h2>
                                            <div class="line-bellow"></div>
                                            <form action="change-password.php" method="post" onsubmit="return validateFormPass()">
                                                <input type="hidden" name="pass" value="da">
                                                <div class="form-group">
                                                    <label for="currentPassword">Current Password</label>
                                                    <span class="psw-tip" id="message3">&nbsp;<?= $wrong ?></span>
                                                    <input type="password" class="form-control" id="currentPassword" name="pwd_old" placeholder="Current Password" onfocus="myFocusFunction('message3')" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="newPassword">New Password
                                                        <div class="huytooltip">&nbsp;ⓘ &nbsp;
                                                            <span class="huytooltiptext">Your password must contain a minimum of 10 characters with at least one Uppercase, Symbol and Number.</span>
                                                        </div>
                                                    </label>
                                                    <span class="psw-tip" id="message1"></span>
                                                    <div class="relative">
                                                        <input type="password" class="form-control password-strength" id="newPassword" name="pwd_new" placeholder="New Password" onfocus="myFocusFunction('message1')" required>
                                                        <div class="line-strength"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="retypePassword">Retype Password
                                                        <div class="huytooltip">&nbsp;ⓘ &nbsp;
                                                            <span class="huytooltiptext">Must be the same with the new password.</span>
                                                        </div>
                                                    </label>
                                                    <span class="psw-tip" id="message2"></span>
                                                    <input type="password" class="form-control" id="retypePassword" name="pwd_new" placeholder="Retype Password" onfocus="myFocusFunction('message2')" required="">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><span
                                                                class="icon"><span
                                                                    class="far fa-check submit-icon"></span></span>
                                                        Change Password
                                                    </button>
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
<?php
include(__DIR__ . '/footer.php');
