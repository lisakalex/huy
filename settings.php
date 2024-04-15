<?php
include 'a.php';
page_protect();
$cus_id = $_SESSION ['cus_id'];

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT user_email, address, country, website, sq, sa FROM customer WHERE id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $cus_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $full_name, $user_name, $user_email, $address, $country, $tel, $fax, $website, $sq, $sa, $account_date);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

if (filter_input(INPUT_POST, 'doSave') === 'Save') {
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $full_name = $data['full_name'];
    $address = $data['address'];
    $country = $data['country'];
    $tel = $data['tel'];
    $fax = $data['fax'];
    $website = $data['website'];
    $sq = $data['sq'];
    $sa = $data['sa'];
    $account_date = $data['account_date'];

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET address=?, country=?,  website=?, sq=?, sa=?  WHERE id=? ')) {
        mysqli_stmt_bind_param($stmt, "sssssi", $address, $country, $website, $sq, $sa, $cus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $msg = urlencode("Your profile saved");
    header("Location: settings.php?msg=$msg");
}

if (filter_input(INPUT_POST, 'doUpdate') === 'Update') {
// Sanitizing
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $p = $data ['pwd_new'];

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT pwd FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $cus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if (password_verify($data ['pwd_old'], $old)) {
        $new = password_hash($p, PASSWORD_DEFAULT);

        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE customer SET pwd=? WHERE id=? ')) {
            mysqli_stmt_bind_param($stmt, "si", $new, $cus_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $message = /** @lang text */
            "<!DOCTYPE HTML>
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
        <h3>Your password has been reset successfully!</h3>
        <p>You requested a password reset, here is your new password:</p>
        <p>$p</p>
        <p>Thank you</p>
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
        $from_user = "password reset";
        $from_email = "info@" . $_SERVER ['HTTP_HOST'];
        $subject = "Password reset";
        mail_utf8($user_email, $from_user, $from_email, $subject, $message);

        $msg = urlencode("Your account password has been reset. Your new password has been sent to your email address.");
        header("Location: settings.php?msg=$msg");
    } else {
        $err = urlencode("Your password is wrong");
        header("Location: settings.php?err=$err");
    }
}

//include 'header.php';
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up - Investment market - Finance & Crypto Display Advertising</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <base href="https://display.Investment market.com">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
        <link rel="stylesheet" href="auth/assets/css/auth.css">
        <script src='//www.google.com/recaptcha/api.js'></script>

    </head>
    <body>
    <section class="auth">
        <div class="container header-auth">
            <div class="row">
                <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                    <a href="https://Investment market.com"><img src="auth/assets/images/Investment market-logo.svg"
                                                       alt="Investment market Ad Network" class="logo"></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-8 col-sm-8 col-11 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1>Your Account Overview</h1>
                            <p class="placeholder">
                                You have already signed up with us? <a href="sign-in/">Sign in &xrarr;</a></p>
                            <div class="line-bellow mt-3"></div>
                            <form action="" method="POST">
                                <input type="hidden" value="Register" name="doRegister" id="product">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>Personal Details</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName" class="col-form-label"
                                                   id="lastName_label firstName_label">Name</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="firstName"
                                                           name="first_name"
                                                           placeholder="First Name" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="lastName"
                                                           name="last_name"
                                                           placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" id="email_label" class="col-form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="user_email"
                                                   placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password" id="password_label" class="col-form-label"><span
                                                        data-toggle="tooltip" data-placement="right"
                                                        title="Your password must contain a minimum of 8 characters with at least one Uppercase, Symbol and Number.">ⓘ</span>
                                                Password</label>
                                            <div class="relative">
                                                <input type="password" data-tooltip="#password_label"
                                                       class="form-control password-strength input-tooltip"
                                                       id="password"
                                                       placeholder="Password" name="pwd" required>
                                                <div class="line-strength"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="repeatPassword" id="repeatPassword_label"
                                                   class="col-form-label"><span data-toggle="tooltip"
                                                                                data-placement="right"
                                                                                title="Must be the same with the password.">ⓘ</span>
                                                Repeat Your Password</label>
                                            <input type="password" data-tooltip="#repeatPassword_label"
                                                   class="form-control input-tooltip" id="repeatPassword"
                                                   placeholder="Repeat Password" name="pwd" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="country" id="country_label" class="col-form-label">Country of
                                                Residency</label>
                                            <select class="form-control" id="country" name="country" required>
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
                                            <script>
                                                document.getElementById('country').value = "GB";
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address" class="col-form-label"
                                                   id="address_label">Website</label>
                                            <input type="text" class="form-control" id="address" name="website"
                                                   placeholder="Website" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>Company Details</strong>
                                    </div>
                                </div>
                                <div class="row form-company">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="inputGroup">
                                                <input id="company" name="company" value="1" type="checkbox"/>
                                                <label for="company"><span data-toggle="tooltip" data-placement="right"
                                                                           title="Invoices and receipts will be generated to the company you represent.">ⓘ</span>
                                                    I Represent a Company</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="companyDetails" class="blur">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="companyName" class="col-form-label">Company Name</label>
                                                <input type="text" name="companyName" class="form-control"
                                                       id="companyName"
                                                       placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="companyTax" class="col-form-label">TAX Number</label>
                                                <input type="text" class="form-control" name="companyTax"
                                                       id="companyTax"
                                                       placeholder="TAX Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="companyCountry" id="companyCountry_label"
                                                       class="col-form-label">Country of Incorporation</label>
                                                <select class="form-control" id="companyCountry" name="companyCountry">
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
                                                    <option value="MK">Macedonia, the former Yugoslav Republic of
                                                    </option>
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
                                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha
                                                    </option>
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
                                                    <option value="GS">South Georgia and the South Sandwich Islands
                                                    </option>
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
                                                <script>
                                                    document.getElementById('companyCountry').value = "GB";
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="companyAddress" class="col-form-label" id="address_label">Your
                                                    Company Address</label>
                                                <input type="text" class="form-control" id="companyAddress"
                                                       name="companyAddress" placeholder="City, Address, PO Box">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <hr class="mt-2 mb-2">
                                        <div class="form-group form-check">
                                            <label for="agree" class="label-cbx">
                                                <input type="hidden" name="agree" value="0">
                                                <input id="agree" name="agree" value="1" type="checkbox"
                                                       class="invisible">
                                                <div class="checkbox">
                                                    <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                        <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                        <polyline points="4 11 8 15 16 6"></polyline>
                                                    </svg>
                                                </div>
                                            </label>
                                            <span>I agree to the <a href="https://Investment market.com/user-agreement/"
                                                                    target="_blank">User Agreement</a> and to the </span>
                                            <div class="dropdown">
                                                <a href="https://Investment market.com/privacy-policy/" data-toggle="dropdown">Policies
                                                    &#9662;</a>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-header">
                                                        Check Our Policies
                                                    </div>
                                                    <a class="dropdown-item" href="https://Investment market.com/privacy-policy/"
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
                                        <div class="form-group">
                                            <div class="g-recaptcha"
                                                 data-sitekey="6LcEwn0UAAAAAIYk5vOyoJOmyOjcUDHkcoTFTLe9"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn orange display-seo">Create Account</button>
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
    <script src="auth/assets/js/auth.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121992660-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-121992660-1');
    </script>
    <script>
        $('input[name=accountType]').change(function () {
            var value = $('input[name=accountType]:checked').val();
            var button = $(".display-seo");
            if (value === '1') {
                if ($(button).hasClass("display-seo-publisher")) {
                    $(button).removeClass('display-seo-publisher')
                }
                $(button).addClass('display-seo-advertiser');
            } else if (value === '2') {
                if ($(button).hasClass("display-seo-advertiser")) {
                    $(button).removeClass('display-seo-advertiser')
                }
                $(button).addClass('display-seo-publisher');
            }
        });
    </script>
    <noscript>
        <style>html {
                display: none;
            }</style>
        <meta http-equiv="refresh" content="0.0;url=https://Investment market.com/noscript/">
    </noscript>
    </body>
    </html>
<?php
//include 'footer.php';
