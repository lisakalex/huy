<?php
include(__DIR__ . '/../a.php');

page_protect();
$cus_id = $_SESSION ['cus_id'];
$rate = get_rate();

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

$banner_url = $banner_id = $site = $slot = $days = $start_date = "";

if (filter_input(INPUT_POST, 'da', FILTER_SANITIZE_SPECIAL_CHARS) === 'yes') {
    $banner_url = clean_input($_POST["banner_url"]);
    $banner_id = clean_input($_POST["banner_id"]);
    $site = clean_input($_POST["site"]);
    $slot = clean_input($_POST["slot"]);
    $days = clean_input($_POST["days"]);
    $start_date = clean_input($_POST["start_date"]);

    $usd = $banner_price[$banner_id] * $slot * $days;
    $btc = $usd / $rate;

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO banner ( cus_id, banner_url, banner_id, site, slot, days, start_date)
	VALUES(?,?,?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "isssiis", $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        mysqli_stmt_execute($stmt);
        $b_id = mysqli_insert_id($link);
        mysqli_stmt_close($stmt);
    }
}

$payment = "new";
$limit = 1;
$link = get_link();
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT address FROM trans WHERE payment=? LIMIT ?')) {
    mysqli_stmt_bind_param($stmt, "si", $payment, $limit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $newaddress);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

$payment = "pending";
$link = get_link();
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET cus_id=?, banner_id=?, usd=?, btc=?, payment=?, start_date=NOW() WHERE address=? ')) {
    mysqli_stmt_bind_param($stmt, "iiddss", $cus_id, $b_id, $usd, $btc, $payment, $newaddress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$btc = number_format($btc, 8);
$qr = "bitcoin:" . $newaddress . "?amount=" . $btc;

//
//$kum = "kum";
//$paid = 1;
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(amount),sum(mout), sum(first_bonus), sum(ref_bonus) FROM card WHERE cus_id=? AND card=? AND paid=?')) {
//    mysqli_stmt_bind_param($stmt, "isi", $cus_id, $kum, $paid);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $amount, $mout, $first_bonus, $ref_bonus);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}
//
//$kum_balance = number_format($amount + $first_bonus + $ref_bonus - $mout, 2);
//
//$kumv = "kumv";
//$paid = 1;
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(amount), sum(mout), sum(first_bonus), sum(ref_bonus) FROM card WHERE cus_id=? AND card=? AND paid=?')) {
//    mysqli_stmt_bind_param($stmt, "isi", $cus_id, $kumv, $paid);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $amount, $mout, $first_bonus, $ref_bonus);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}
//
//$kumv_balance = number_format($amount + $first_bonus + $ref_bonus - $mout, 2);
//
//$payment = "pending";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT id, amount, paid, paytime FROM trans WHERE cus_id=? AND payment=?')) {
//    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $id, $amount, $paid, $paytime);
//
//    while (mysqli_stmt_fetch($stmt)) {
//        $t[] = array($id, $amount, $paid, $paytime);
//    }
//}
//
//include 'header.php';

include(__DIR__ . '/header.php');
?>

    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Dec 28, 2020 00:00:00").getTime();
        var countDownDate = new Date();
        countDownDate.setHours(countDownDate.getHours() + 1);

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
    <section class="auth">
        <div class="container header-auth">
            <div class="row">

            </div>
        </div>
        <div class="container" style="align-items: center">
            <div class="row">
                <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; flex-direction: row;">
                                <div>
                                    <h1>Send Bitcoin</h1>
                                    <p class="placeholder">
                                        Please scan QR code or copy BTC address</a></p>
                                </div>
                                <div style="text-align: right; margin-top: auto; width: 60%">
                                    <h5><b>$<?= $usd ?> </b>(BTC <?= $btc ?>)</h5>

                                </div>
                            </div>
                            <div class="line-bellow mt-3"></div>
                            <section class="main-content">
                                <div class="deposit_confirm_wrap">
                                    <div class="container">
                                        <div style="padding-bottom: 5% ">
                                            <div class="form-security deposit-form daa2" style="">
                                                <div style="">
                                                    <div style="display: flex; flex-direction: row;">
                                                        <div style="">
                                                            <img src="../qr/php/qr_img.php?d=<?= $qr ?>&s=6">
                                                        </div>
                                                        <div style="padding-left: 5%; height: 50%; margin: auto ">
                                                            The deposit will be automatically created after 3
                                                            confirmations of your
                                                            transaction! <br/>
                                                            And then it will be displayed in your personal account.
                                                            <div style="text-align: center">
                                                                <p style="" id="demo"></p>
                                                                <img src="../images/30.gif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="display: flex; flex-direction: row;">
                                                        <div style="width: 50%">
                                                            <div style="display: flex; flex-direction: row; margin-bottom: 20px">
                                                                <div style="padding-right: 20px">
                                                                    Amount
                                                                </div>
                                                                <div style="">
                                                                    <input size="8" type="text" value="<?= $btc ?>" id="myInput" style="border: 0; outline: none; color: #536677">
                                                                </div>
                                                                <div class="copytooltip" style="">
                                                                    <div  onclick="copyFunction('myInput', 'myTooltip')" onmouseout="outFunc('myTooltip', 'amount')">
                                                                        <span class="copytooltiptext" id="myTooltip">Copy amount</span>
                                                                        <div class="copy-button">
                                                                            <img src="../assets/images/icons/clipboard.png" class="icon" height="20">

                                                                            <!--                                                                        copy-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="display: flex; flex-direction: row;">
                                                                <div style="">
                                                                    <label for="btcAddress"><img src="../assets/images/payment-methods/bitcoin.png" class="icon" height="20"> BTC Deposit Address</label>
<!--                                                                    <b>--><?//= $newaddress ?><!--</b>-->
                                                                    <input size="43" type="text" value="<?= $newaddress ?>" id="myInput1" style="border: 0; outline: none; font-family: monospace; color: #536677">

                                                                </div>
                                                                <div class="copytooltip" style="margin-top: auto;">
                                                                    <div  onclick="copyFunction('myInput1', 'myTooltip1')" onmouseout="outFunc('myTooltip1', 'address')">
                                                                        <span class="copytooltiptext" id="myTooltip1">Copy address</span>
                                                                        <div class="copy-button">
                                                                            <img src="../assets/images/icons/clipboard.png" class="icon" height="20">
<!--                                                                            copy-->
<!--                                                                            <span class="input-group-btn"><button class="btn btn-secondary copy b-cd-c-dtc" data-id="btcAddress" type="button"><span class="far fa-copy"></span> Copy</button></span>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="text-align: right; width: 100%; margin-top: auto">
                                                            <form action="account.php" id="addbanner" method="POST">
                                                                <input type="hidden" name="cancel" value="da">
                                                                <input type="hidden" name="address"
                                                                       value="<?= $newaddress ?>">
                                                                <button type="submit" class="btn orange" style="width: 50%">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include(__DIR__ . '/footer.php');
