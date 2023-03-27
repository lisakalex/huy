<?php
include(__DIR__ . '/a.php');

if (filter_input(INPUT_POST, 'doReset', FILTER_SANITIZE_SPECIAL_CHARS) === 'submit') {
    $user_email = clean_input($_POST['user_email']);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id FROM customer WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($id <= 0) {
        $err = urlencode("Sorry no such account exists or registered.");
        header("Location: recovery.php?err=$err");
        exit ();
    }

    $pwd1 = rand(1000, 9999);
    $pwd = password_hash($pwd1, PASSWORD_DEFAULT);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET pwd=?, pwd1= ? WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "sss", $pwd, $pwd1, $user_email);
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
        <p>Passwd: $pwd1</p>
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

    $err = urlencode("Your account password has been reset, and sent to your email address.");
    header("Location: login.php?err=$err");
    exit ();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Recovery - Investment market - Finance & Crypto Display Advertising</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <base href="https://display.Investment market.com">-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="auth/assets/css/auth.css">
    <link rel="stylesheet" href="assets/css/me.css">
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
</head>
<body>
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
<section class="auth">
    <div class="container header-auth">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-8 col-11 mx-auto">
                <a href="index.php">
                    <!--                    <img src="" alt="hindex" class="logo">-->
                    <h4>hindex</h4>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-8 col-11 mx-auto">
                <div class="card">
                    <form action="" method="post">
                        <input type="hidden" value="submit" name="doReset" id="product">
                        <div class="card-body">
                            <h1>Password Recovery</h1>
                            <div class="line-bellow d-block mt-3 mb-2"></div>
                            <div class="form-group">
                                <label for="email" id="email_label" class="col-form-label">Email</label>
                                <input type="email" data-validate="email" class="form-control" id="email"
                                       name="user_email"
                                       placeholder="Email Address" required>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <div class="g-recaptcha" data-sitekey="6LcEwn0UAAAAAIYk5vOyoJOmyOjcUDHkcoTFTLe9"></div>-->
<!--                            </div>-->
                            <div class="form-group">
                                <button type="submit" class="btn orange">Recover Your Password</button>
                            </div>
                            <p class="placeholder text-center">
                                Don't have an account yet? <br/>
                                <a href="sign-up/">Sign up now &xrarr;</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container footer-auth">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-8 col-11 mx-auto">
                <a href="https://Investment market.com/contact/">Contact Support</a>
                <div class="float-right">
                    <a href="https://Investment market.com/user-agreement/">User Agreement</a> -
                    <div class="dropdown">
                        <a href="https://Investment market.com/privacy-policy/" data-toggle="dropdown">Privacy &#9662;</a>
                        <div class="dropdown-menu d-none">
                            <div class="dropdown-header">
                                Check Our Policies
                            </div>
                            <a class="dropdown-item" href="https://Investment market.com/privacy-policy/">Privacy Policy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://Investment market.com/cookie-policy/">Cookie Policy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://Investment market.com/refund-policy/">Refund Policy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://Investment market.com/website-acceptance-policy/">Website
                                Acceptance Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src="auth/assets/js/auth.js"></script>
<script>
    // Get the modal
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === modal1) {
            modal1.style.display = "none";
        }

        if (event.target === modal2) {
            modal2.style.display = "none";
        }
    }
</script>
</body>
</html>
