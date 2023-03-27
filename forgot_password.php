<?php
include 'a.php';

if (filter_input(INPUT_POST, 'doReset') === 'submit') {
    $user_email = mysqli_real_escape_string($link, $_POST ['user_email']);

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id FROM customer WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($id <= 0) {
        $err = urlencode("Error - Sorry no such account exists or registered.");
        header("Location: forgot_password.php?err=$err");
        exit ();
    }

    $new = rand(1000, 9999);
    $pwd = password_hash($new, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET pwd=?, pwd1= ? WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "sss", $pwd, $new, $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

    $message = /** @lang text */
        "
    <!DOCTYPE HTML>
<html lang=\"en\">
<head>
    <style>
        .ka {
            padding: 100px 0 0 0;
        }

        .ka1 {
            color: #20bea8;
        }

        .ka2 {
            padding: 2% 25% 2% 25%;
            color: #606662;
            text-align: left;

        }

        .ka3 {
            /*background-color: #20bea8;*/
            /*padding: 10px;*/
            /*margin: 30px;*/
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            font-size: 1.3em;
            /*text-align: left;*/

        }

        .ka4 {
            background-color: #20bea8;
            padding: 10px;
            margin: 30px 25% 30px 25%;
            text-decoration: none;
            color: #fff;
            text-align: center;
            border-radius: 5px;

        }

        .ku {
            background-color: #e4edef;
            padding: 50px 0 50px 0;
            box-sizing: border-box;
            display: block;
            font-family: \"Open Sans\", sans-serif;
            font-size: 14px;
            line-height: 20px;
            color: #8d9a9d;
            /*text-align: center;*/

        }

        .main-container {
            background-color: #F6F8F9;
            /*height: 500px;*/
            /*padding: 50px;*/
            text-align: center;
        }

    </style>
</head>
<body class=\"\">
<div class=\"main-container\">
    <div class=\"ka\">
        <img src=\"https://kumpenot.com/images/logo/kum.png\" alt=\"\" height=\"50\">
    </div>
    <div class=\"ka1\">
        A prepaid credit card for the crypto community
    </div>
    <br>

    <div class=\"ka2\">
        <h3>Here are your new password details</h3>
        <p>User Email: $user_email.</p>
        <p>Passwd: $new</p>
        <p>Thank You Administrator</p>
        <br>
    </div>
    <div class=\"ku\">
        <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
        <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
        <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
        <p class=\"footer-copyright\">© 2018-2019 <a href=\"account.php\">kumpenot Ltd </a></p>
    </div>
</div>

</body>
</html>

    ";

    $from_user = "Password department";
    $from_email = " info@" . $_SERVER ['HTTP_HOST'];
    $subject = "Password changed";
    mail_utf8($user_email, $from_user, $from_email, $subject, $message);

    $user_email_me = "info@kumpenot.com";
    mail_utf8($user_email_me, $from_user, $from_email, $subject, $message);

    $msg = urlencode("Your account password has been reset and a new password has been sent to your email address.");
    header("Location: login.php?msg=$msg");
    exit ();
}

include 'header.php';
?>
    <section class="page-section login forgot-password">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="inner-page-title">Forgot your password?</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="login-form">
                        <form method=post name=forgotform action="forgot_password.php">
                            <div class="form-row">
                                <label for="email">Type your e-mail:</label>
                                <div class="input-box">
                                    <input type="email" name='user_email' class="contacts-input" value=""
                                           autofocus="autofocus">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="form-row text-center">
                                <input type="hidden" name="doReset" value="submit">
                                <button type=submit class="main-btn login-btn"><span>get password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
<?php
include 'footer.php';
