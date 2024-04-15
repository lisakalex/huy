<?php
include 'dbc.php';
if (filter_input(INPUT_POST, 'doSupport') === 'Support') {

    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $to = "info@kumpenot.com";
    $from_user = $data ['name'];
    $email = $data ['email'];
    $subject = "Support";
    $message = $data ['message'];
    mail_utf8($to, $from_user, $email, $subject, $message);

    header("Location: thankyou-s.php");

}

include 'header.php';
?>

    <section class="page-section login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="inner-page-title">Contact us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="login-form">
                        <form method="post" action="support.php">

                            <div class="form-row">
                                <label for="name">Your Name:</label>
                                <div class="input-box">
                                    <input type="text" name="name" value="" size=30 class="contacts-input"
                                           style="margin-bottom: 15px;">
                                    <i class="fas fa-user"></i>
                                </div>

                            </div>
                            <div class="form-row">
                                <label for="email">Your Email:</label>
                                <div class="input-box">
                                    <input type="email" name="email" value="" size=30 class="contacts-input"
                                           style="margin-bottom: 15px;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="message">Message:</label>
                                <div class="input-box">
                                    <textarea name=message class="text-input"></textarea>
                                    <i class="fas fa-comment"></i>
                                </div>
                            </div>

                            <div class="form-row text-center">
                                <input type="hidden" name="doSupport" value="Support">
                                <button type="submit" class="main-btn"><span>Send</span></button>
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
