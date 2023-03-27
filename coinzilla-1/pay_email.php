<?php
include 'dbc.php';
echo "email";

$user_email = "kumpenot@yandex.com";
$from_user = "Kumpenot";
$from_email = "info@" . $_SERVER ['HTTP_HOST'];
$subject = "News update from Kumpenot";
$message = "coindesk";
mail_utf8($user_email, $from_user, $from_email, $subject, $message);


//send email to all who have not paid or have not paid full amount
//$payment = "pending";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT cus_id, amount, paid FROM trans WHERE payment=?')) {
//    mysqli_stmt_bind_param($stmt, "s", $payment);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $cus_id, $amount, $paid);
//
//    while (mysqli_stmt_fetch($stmt)) {
//        $t[] = array($cus_id, $amount, $paid);
//    }
//}
//
//foreach ($t as $i) {
//    $cus_id = $i[0];
//    $amount = $i[1];
//    $paid = $i[2];
//    $owed = $amount - $paid;
//
//    $amount_d = number_format($amount, 8);
//    $paid_d = number_format($paid, 8);
//    $owed_d = number_format($owed, 8);
//
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM customer WHERE id=?')) {
//        mysqli_stmt_bind_param($stmt, "i", $cus_id);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_bind_result($stmt, $user_email);
//        mysqli_stmt_fetch($stmt);
//        mysqli_stmt_close($stmt);
//    }
//
//    $message = /** @lang text */
//        "<!DOCTYPE HTML>
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
//        <h3>Payment pending</h3>
//        <p>We have received your payment of $paid_d BTC.</p>
//        <p>The total amount due is $amount_d BTC.</p>
//        <p>Therefor you owe us  $owed_d BTC.</p>
//        <p>Thank you.</p>
//        <br>
//        <hr>
//    </div>
//    <br>
//    <div class=\"ka2\">
//        <h3>Просроченный платеж</h3>
//        <p>Мы получили ваш платеж в размере $paid_d BTC.</p>
//        <p>Общая сумма к оплате составляет $amount_d BTC.</p>
//        <p>Поэтому вы должны нам $owed_d BTC.</p>
//        <p>Спасибо.</p>
//        <br>
//    </div>
//    <div class=\"ku\">
//        <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
//        <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
//        <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
//        <p class=\"footer-copyright\">© 2018-2019 <a href=\"account.php\">kumpenot Ltd </a></p>
//    </div>
//</div>
//</body>
//</html>
//";
//    $subject = "Payment pending";
//    $from_user = "payments";
//    $from_email = "info@" . $_SERVER ['HTTP_HOST'];
//    mail_utf8($user_email, $from_user, $from_email, $subject, $message);
//}


// news update email, send to all users

//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT  user_name, user_email  FROM customer ')) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $u, $e);
//
//    while (mysqli_stmt_fetch($stmt)) {
//        $t[] = array($u, $e);
//    }
//}
//
//foreach ($t as $i) {
//    $user = $i[0];
//    $user_email = $i[1];
//    $message = /** @lang text */
//        "<!DOCTYPE HTML>
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
//            <a href=\"https://kumpenot.com/\"><img src=\"https://kumpenot.com/images/logo/kum.png\" alt=\"\" height=\"50\"></a>
//    </div>
//    <div class=\"ka1\">
//        A prepaid credit card for the crypto community
//    </div>
//    <br>
//    <div class=\"ka2\">
//        <h3>Hi $user</h3>
//        <p>Business news</p>
//        <p><a href=\"https://www.coindesk.com/china-bank-government-bond-blockchain-bitcoin\">World’s Second-Biggest Bank to Issue $3B in Bonds Tradable for Bitcoin</a></p>
//        <p><a href=\"https://www.coindesk.com/shapeshift-delists-privacy-coin-zcash-over-regulatory-concerns\">ShapeShift Delists Privacy Coin Zcash Over Regulatory Concerns</a></p>
//        <p><a href=\"https://www.coindesk.com/microstrategy-ceo-bitcoin-better-than-antiquated-gold\">MicroStrategy CEO Explains Why Bitcoin Is ‘a Million Times Better’ Than ‘Antiquated’ Gold</a></p>
//        <p><a href=\"https://www.coindesk.com/bitcoin-banking-despite-cred\">The Case for Bitcoin Banking (Despite Cred’s Bankruptcy)</a></p>
//        <p>Thank you.</p>
//        <br>
//        <hr>
//    </div>
//    <div class=\"ku\">
//        <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
//        <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
//        <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
//        <p class=\"footer-copyright\">© 2018-2019 <a href=\"account.php\">kumpenot Ltd </a></p>
//    </div>
//</div>
//</body>
//</html>
//";
//    $subject = "News update from Kumpenot";
//    $from_user = "Kumpenot";
//    $from_email = "info@" . $_SERVER ['HTTP_HOST'];
//    mail_utf8($user_email, $from_user, $from_email, $subject, $message);
//}
