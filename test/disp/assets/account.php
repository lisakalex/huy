
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Investment market - Finance & Crypto Display Advertising</title>
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

