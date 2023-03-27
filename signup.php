<?php
include(__DIR__ . '/a.php');

if (filter_input(INPUT_POST, 'doRegister', FILTER_SANITIZE_SPECIAL_CHARS) === 'Register') {
//    $recaptcha = $_POST['g-recaptcha-response'];
//    $res = reCaptcha($recaptcha);
//    if (!$res['success']) {
//        // Error
//        echo "coindesk";
//    }
//    $sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";

    $user_email = clean_input($_POST['user_email']);
    $first_name = clean_input($_POST['first_name']);
    $last_name = clean_input($_POST['last_name']);
    $address = clean_input($_POST['address']);
    $country = clean_input($_POST['country']);
    $agree = clean_input($_POST['agree']);
    $pwd1 = clean_input($_POST['pwd']);

    $pwd = password_hash($pwd1, PASSWORD_DEFAULT);
    $user_ip = $_SERVER ['REMOTE_ADDR'];
    $activation_code = rand(1000, 9999);
    if ($agree) $agree = 1;

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM customer WHERE user_email=? ')) {
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($total > 0) {
        $err = urlencode(" This email address already registered. Please try again with different email address.");
        header("Location: signup.php?err=$err");
        exit ();
    }

    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO customer (first_name, last_name, user_email, address, country, activation_code, agree, pwd, pwd1, user_ip )
	VALUES(?,?,?,?,?,?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssiisss", $first_name, $last_name, $user_email, $address, $country, $activation_code, $agree, $pwd, $pwd1, $user_ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $id = mysqli_insert_id($link);


//    $message = /** @lang text */
//        "
//    <!DOCTYPE HTML>
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
//
//    <div class=\"ka2\">
//        <h3>Registration Successful</h3>
//        <p>Your Kumpenot account has been created.</p>
//        <p>Please secure your account by verifying your email address.</p>
//        <p><i>Failure to verify your email address may result in service suspension.</i></p>
//        <a href=\"https://$host$path/login.php?cus_id=$id&activation_code=$activation_code\" class=\"ka3\">
//            <div class=\"ka4\">verify email</div>
//        </a>
//        <br>
//    </div>
//    <div class=\"ku\">
//        <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
//        <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
//        <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
//        <p class=\"footer-copyright\">© 2018-2019 <a href=\"account.php\">kumpenot Ltd </a></p>
//    </div>
//</div>
//
//</body>
//</html>
//
//    ";
//
//    $from_user = "new account";
//    $from_email = " info@" . $_SERVER ['HTTP_HOST'];
//    $subject = "New account";
//    mail_utf8($user_email, $from_user, $from_email, $subject, $message);

    header("Location: thankyou.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Investment market - Finance & Crypto Display Advertising</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/me.css">
    <link rel="stylesheet" href="auth/assets/css/auth.css">

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
            <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                <a href="index.php">
                    <!--                    <img src="" alt="hindex" class="logo">-->
                    <h4>hindex</h4>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1>Sign up</h1>
                        <p class="placeholder">
                            You have already signed up with us? <a href="login.php">Sign in &xrarr;</a></p>
                        <div class="line-bellow mt-3"></div>
                        <form action="" method="POST" onsubmit="return validateFormPass()">
                            <input type="hidden" name="doRegister" value="Register" id="product">
                            <div class="row">
                                <div class="col-lg-12" style="color: red; font-size: 0.9em">
                                    <b style="font-size: 1em">&ast;</b> &nbsp;reqired
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName" class="col-form-label" id="lastName_label firstName_label">Name</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-form-label" id="address_label">Your Full Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="City, Address, PO Box">
                                    </div>
                                    <div class="form-group">
                                        <label for="country" id="country_label" class="col-form-label">Country of Residency</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select your country</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia, Plurinational State of</option>
                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA">Bosnia and Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, the Democratic Republic of the</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Cote d'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curacao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island and McDonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran, Islamic Republic of</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea, Democratic People's Republic of</option>
                                            <option value="KR">Korea, Republic of</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Democratic Republic</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia, Federated States of</option>
                                            <option value="MD">Moldova, Republic of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestinian Territory, Occupied</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">Saint Barthelemy</option>
                                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value="KN">Saint Kitts and Nevis</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="MF">Saint Martin (French part)</option>
                                            <option value="PM">Saint Pierre and Miquelon</option>
                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SX">Sint Maarten (Dutch part)</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan, Province of China</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania, United Republic of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor-Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks and Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">Virgin Islands, British</option>
                                            <option value="VI">Virgin Islands, U.S.</option>
                                            <option value="WF">Wallis and Futuna</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" id="email_label" class="col-form-label"><b style="color: red">&ast;&nbsp;</b>Email</label>
                                        <input type="email" class="form-control" id="email" name="user_email" placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" id="password_label" class="col-form-label"><b style="color: red">&ast;&nbsp;</b>Password
                                            <div class="huytooltip">&nbsp;ⓘ &nbsp;
                                                <span class="huytooltiptext">Your password must contain a minimum of 10 characters with at least one Uppercase, Symbol and Number.</span>
                                            </div>
                                        </label>
                                        <span class="psw-tip" id="message1"></span>
                                        <div class="relative">
                                            <input type="password" data-tooltip="#password_label" class="form-control password-strength input-tooltip" id="newPassword" placeholder="Password" name="pwd" onfocus="myFocusFunction('message1')" required>
                                            <div class="line-strength"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeatPassword" id="repeatPassword_label"><b style="color: red">&ast;&nbsp;</b>Retype Password
                                            <div class="huytooltip">&nbsp;ⓘ &nbsp;
                                                <span class="huytooltiptext">Must be the same with the new password.</span>
                                            </div>
                                        </label>
                                        <span class="psw-tip" id="message2"></span>
                                        <input type="password" data-tooltip="#repeatPassword_label" class="form-control input-tooltip" id="retypePassword" placeholder="Repeat Password" name="pwd" onfocus="myFocusFunction('message2')" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <hr class="mt-2 mb-2">
                                    <div style="display: flex; flex-direction: row;">
                                        <b style="color: red">&ast;&nbsp;</b>
                                        <div class="form-group form-check">
                                            <label for="agree" class="label-cbx">
                                                <input id="agree" name="agree" type="checkbox" class="invisible"
                                                       required>
                                                <div class="checkbox">
                                                    <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                        <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                        <polyline points="4 11 8 15 16 6"></polyline>
                                                    </svg>
                                                </div>
                                            </label>
                                            <span>I agree to the <a href="https://Investment market.com/user-agreement/" target="_blank">User Agreement</a> and to the </span>
                                            <div class="dropdown">
                                                <a href="https://Investment market.com/privacy-policy/" data-toggle="dropdown">Policies&#9662;</a>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-header">
                                                        Check Our Policies
                                                    </div>
                                                    <a class="dropdown-item"
                                                       href="https://Investment market.com/privacy-policy/"
                                                       target="_blank">Privacy Policy</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="https://Investment market.com/cookie-policy/"
                                                       target="_blank">Cookie Policy</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="https://Investment market.com/refund-policy/"
                                                       target="_blank">Refund Policy</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item"
                                                       href="https://Investment market.com/website-acceptance-policy/"
                                                       target="_blank">Website Acceptance Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group">-->
                                    <!--                                        <div class="g-recaptcha" data-sitekey="6LfNQoMUAAAAADewfioYTnBcN1jlWoYq8GnZ2S6s"></div>-->
                                    <!--                                    </div>-->
                                    <div class="form-group">
                                        <button type="submit" class="btn orange display-seo"
                                                onclick="myFunction('You must agree to our User Agreement and Privacy Policy before creating an account.')">
                                            Create Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container footer-auth">
        <div class="row">
            <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
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
<script src="assets/js/me.js"></script>
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
