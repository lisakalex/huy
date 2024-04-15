<?php
include(__DIR__ . '/../a.php');

page_protect();
$cus_id = $_SESSION ['cus_id'];

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
        var slot = [];
        slot["1"] = 1;
        slot["2"] = 2;
        slot["3"] = 3;
        slot["4"] = 4;
        slot["5"] = 5;

        var banner_id = [];
        banner_id["Top"] = 100;
        banner_id["Left side 1"] = 50;
        banner_id["Left side 2"] = 50;
        banner_id["Left side 3"] = 50;
        banner_id["Left side 4"] = 50;
        banner_id["Left side 5"] = 50;
        banner_id["Right side 1"] = 50;
        banner_id["Right side 2"] = 50;
        banner_id["Right side 3"] = 50;
        banner_id["Right side 4"] = 50;
        banner_id["Right side 5"] = 50;
        banner_id["Bottom"] = 75;

        function getSlot() {
            var aSlot = 0;
            //Get a reference to the form id="cakeform"
            var theForm = document.forms["addbanner"];
            //Get a reference to the select id="filling"
            var selectedSlot = theForm.elements["slot"];

            //set cakeFilling Price equal to value user chose
            //For example filling_prices["Lemon".value] would be equal to 5
            aSlot = slot[selectedSlot.value];

            //finally we return cakeFillingPrice
            return aSlot;
        }

        function getBannerPrice() {
            var bannerPrice = 0;
            //Get a reference to the form id="cakeform"
            var theForm = document.forms["addbanner"];
            //Get a reference to the select id="filling"
            var selectedBanner = theForm.elements["banner_id"];

            //set cakeFilling Price equal to value user chose
            //For example filling_prices["Lemon".value] would be equal to 5
            bannerPrice = banner_id[selectedBanner.value];

            //finally we return cakeFillingPrice
            return bannerPrice;
        }

        function getDays() {
            var days = 0;
            //Get a reference to the form id="cakeform"
            var theForm = document.forms["addbanner"];
            //Get a reference to the select id="filling"
            days = theForm.elements["days"];

            //set cakeFilling Price equal to value user chose
            //For example filling_prices["Lemon".value] would be equal to 5
            // day = days.value;

            //finally we return cakeFillingPrice
            return days.value;
        }

        function calculateTotal() {
            //Here we get the total price by calling our function
            //Each function returns a number so by calling them we add the values they return together
            var cakePrice = getSlot() * getBannerPrice() * getDays();

            //display the result
            var divobj = document.getElementById('totalPrice');
            divobj.style.display = 'block';
            divobj.innerHTML = "Total Price: $" + cakePrice;

        }


        function hideTotal() {
            var divobj = document.getElementById('totalPrice');
            divobj.style.display = 'none';
        }
    </script>
    <section class="auth">
        <div class="container header-auth">
            <div class="row">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1>Add banner</h1>
                            <p class="placeholder">
                                Please add desired banners</a></p>
                            <div class="line-bellow mt-3"></div>
                            <form action="pay.php" id="addbanner" method="POST">
                                <input type="hidden" name="da" value="yes" id="product">
                                <div class="col-lg-12" style="color: red; font-size: 0.9em">
                                    <b style="font-size: 1em">&ast;</b> &nbsp;required
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" id="email_label" class="col-form-label"><b
                                                        style="color: red">&ast;&nbsp;</b>Banner URL</label>
                                            <input type="text" class="form-control" id="email" name="banner_url"
                                                   placeholder="https://banner_url.png" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="slot" id="" class="col-form-label">
                                                <b style="color: red">&ast;&nbsp;</b>Number of slots
                                                <div class="huytooltip">ⓘ
                                                    <span class="huytooltiptext">Please enter the number of slots required.</span>
                                                </div>
                                            </label>
                                            <select class="form-control" id="slot" name="slot"
                                                    onchange="calculateTotal()"
                                                    required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_id" id="" class="col-form-label">
                                                <b style="color: red">&ast;&nbsp;</b>Banner ID
                                                <div class="huytooltip">ⓘ
                                                    <span class="huytooltiptext">Choose the banner ID.</span>
                                                </div>
                                            </label>
                                            <select class="form-control" id="banner_id" name="banner_id"
                                                    onchange="calculateTotal()" required>
                                                <option value="Top">Top - $100 (728x90)</option>
                                                <option value="Left side 1">Left side 1 - $50 (125x125)</option>
                                                <option value="Left side 2">Left side 2 - $50 (125x125)</option>
                                                <option value="Left side 3">Left side 3 - $50 (125x125)</option>
                                                <option value="Left side 4">Left side 4 - $50 (125x125)</option>
                                                <option value="Left side 5">Left side 5 - $50 (125x125)</option>
                                                <option value="Right side 1">Right side 1 - $50 (125x125)</option>
                                                <option value="Right side 2">Right side 2 - $50 (125x125)</option>
                                                <option value="Right side 3">Right side 3 - $50 (125x125)</option>
                                                <option value="Right side 4">Right side 4 - $50 (125x125)</option>
                                                <option value="Right side 5">Right side 5 - $50 (125x125)</option>
                                                <option value="Bottom">Bottom - $75 (468x60)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" id="email_label" class="col-form-label"><b
                                                        style="color: red">&ast;&nbsp;</b>Website URL</label>
                                            <input type="text" class="form-control" id="email" name="site"
                                                   placeholder="https://my_site.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="days" id="days_label" class="col-form-label">
                                                <b style="color: red">&ast;&nbsp;</b>Number of days
                                                <div class="huytooltip">ⓘ
                                                    <span class="huytooltiptext">Please choose the number of day required.</span>
                                                </div>
                                            </label>
                                            <input type="number" class="form-control" id="days" name="days" value="1"
                                                   placeholder="1" onchange="calculateTotal()" min="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" id="email_label" class="col-form-label">
                                                <b style="color: red">&ast;&nbsp;</b>Start date
                                                <div class="huytooltip">ⓘ
                                                    <span class="huytooltiptext">Please choose the date to start displaying the banner.</span>
                                                </div>
                                            </label>
                                            <input type="date" class="form-control" id="email" name="start_date"
                                                   placeholder="" onchange="calculateTotal()" required>
<!--                                            <input type="text" class="form-control" name="start_date" value="" onchange="calculateTotal()"/>-->

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6" style="padding-top: 8%">
                                        <button type="submit" class="btn orange display-seo"
                                                style="padding: 10px 50px 10px 50px">Submit
                                        </button>
                                    </div>
                                    <div class="form-group total-price" id="totalPrice">Total Price: $0.00</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include(__DIR__ . '/footer.php');
