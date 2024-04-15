<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];
$user_email = $_SESSION ['user_email'];
$pwd_db = "";
$show = "";
$wrong = "";

if (filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS) === 'da') {
    $pwd = clean_input($_POST['pwd']);
    $reason = clean_input($_POST['reason']);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT pwd FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $cus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $pwd_db);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if (password_verify($pwd, $pwd_db)) {
        $link = get_link();
        $sql = "INSERT INTO deleted_customer (cus_id, first_name, last_name, user_email, address, country, activation_code, agree, approved, banned, pwd1, pwd, user_ip, create_date) SELECT id, first_name, last_name, user_email, address, country, activation_code, agree, approved, banned, pwd1, pwd, user_ip, ttime FROM customer WHERE id=" . $cus_id;
        mysqli_query($link, $sql);
        mysqli_close($link);

        $link = get_link();
        $stmt = mysqli_stmt_init($link);
        $sql = "UPDATE deleted_customer SET reason=? WHERE cus_id=?";
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $reason,  $cus_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $link = get_link();
        $sql = "DELETE FROM customer WHERE id=" . $cus_id;
        mysqli_query($link, $sql);
        mysqli_close($link);

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

include(__DIR__ . '/header.php');
?>
    <div id="alertHandler">
        <div class="container">
            <section class="alert alert-warning fade <?= $show ?>" role="alert" style="background-color: #addead">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: #3a5b39">
                            <strong>Success!</strong>Account deleted.
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
                                        <a class="nav-link navigate" href="change-password.php">Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate active" href="delete-acc.php">Delete Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3>Delete Account</h3>
                                            <p>
                                                Deleting your account is an irreversible action. Once your request is automatically verified after 48h, all your information will be deleted from our database, and you will not be able to recover your account.
                                            </p>
                                            <div class="line-bellow"></div>
                                            <form action="delete-acc.php" method="post">
                                                <input type="hidden" name="pass" value="da">
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <label for="reason">Reason for closure</label>
                                                        <textarea name="reason" id="reason" cols="30" rows="5" class="form-control" placeholder="Write the reason why you wish to close your account" required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <label for="upass_203291">Current account password</label>
                                                        <span class="psw-tip" id="message3">&nbsp;<?= $wrong ?></span>
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
<?php
include(__DIR__ . '/footer.php');
