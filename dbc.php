<?php
//// echo $_SERVER [SERVER_NAME];
//if ($_SERVER ['SERVER_NAME'] === "kumpenot.com") {
//    $link = mysqli_connect("server-rr.zamahost.com", "kumpenot_da_user", "Zaichik1.&", "kumpenot_da");
//    if (!$link) {
//        echo "Error: Unable to connect to MySQL." . PHP_EOL;
//        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//        exit ();
//    }
//} else if ($_SERVER ['SERVER_NAME'] === "localhost") {
//    $link = mysqli_connect("localhost", "root", "", "dbase");
//    if (!$link) {
//        echo "Error: Unable to connect to MySQL." . PHP_EOL;
//        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//        exit ();
//    }
//}
//$admin_user = 'admin';
//$admin_pass = 'Zaichik1';
//function page_protect()
//{
//    session_start();
//
//    // check for cookies
//    if (isset ($_COOKIE ['cus_id']) && isset ($_COOKIE ['user_name'])) {
//        $_SESSION ['cus_id'] = $_COOKIE ['cus_id'];
//        $_SESSION ['full_name'] = $_COOKIE ['full_name'];
//        $_SESSION ['user_name'] = $_COOKIE ['user_name'];
//        $_SESSION ['upline'] = $_COOKIE ['upline'];
//    }
//
//    if (!isset ($_SESSION ['cus_id'])) {
//        header("Location: login.php");
//    }
//}
//
//function filter($link, $data)
//{
//    $data = trim(htmlentities(strip_tags($data)));
//
//    if (get_magic_quotes_gpc())
//        $data = stripslashes($data);
//
//    $data = mysqli_real_escape_string($link, $data);
//    $data = htmlspecialchars($data);
//    return $data;
//}
//
//function ChopStr($str, $len)
//{
//    if (strlen($str) < $len)
//        return $str;
//
//    $str = substr($str, 0, $len);
//    if ($spc_pos = strrpos($str, " "))
//        $str = substr($str, 0, $spc_pos);
//
//    return $str . "...";
//}
//
//function isEmail($email)
//{
//    return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
//}
//
//function isUserID($username)
//{
//    if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function isURL($url)
//{
//    if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function checkPwd($x, $y)
//{
//    if (empty ($x) || empty ($y)) {
//        return false;
//    }
//    if (strlen($x) < 1 || strlen($y) < 1) {
//        return false;
//    }
//
//    if (strcmp($x, $y) != 0) {
//        return false;
//    }
//    return true;
//}
//
//// string manipulation functions
//function after($thiss, $inthat)
//{
//    if (!is_bool(strpos($inthat, $thiss))) {
//        return substr($inthat, strpos($inthat, $thiss) + strlen($thiss));
//    }
//}
//
//function between($thiss, $that, $inthat)
//{
//    return before($that, after($thiss, $inthat));
//}
//
//function before($thiss, $inthat)
//{
//    return substr($inthat, 0, strpos($inthat, $thiss));
//}
//
//function found($haystack, $needle)
//{
//    return (strpos($haystack, $needle) !== false);
//}
//
//function cutString($str, $amount = 1, $dir = "right")
//{
//    if (($n = strlen($str)) > 0) {
//        if ($dir == "right") {
//            $start = 0;
//            $end = $n - $amount;
//        } else if ($dir == "left") {
//            $start = $amount;
//            $end = $n;
//        }
//
//        return substr($str, $start, $end);
//    } else {
//        return false;
//    }
//}
//
//// print array
//function printa($sweet)
//{
//    foreach ($sweet as $key => $value) {
//        echo $key . "\t" . $value . "<br>";
//    }
//}
//
//function satoshi_to_btc($value)
//{
//    return bcdiv(intval($value), 100000000, 8);
//}
//
////count how man new addresses left
//$payment = "new";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM trans WHERE payment=?')) {
//    mysqli_stmt_bind_param($stmt, "s", $payment);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $newpayment);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}
//
////count all satoshis
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(paid) FROM trans')) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $all);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}
//
//function get_rate()
//{
//    $url = "https://bitpay.com/api/rates/BTC/USD";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    $contents = curl_exec($ch);
//    $arr_json = json_decode($contents, true);
//    return $arr_json['rate'];
//}
//
////not used
//function confirmed($address)
//{
////    https://blockstream.info/api/address/" . $address . "/utxo
//    $url = "https://blockstream.info/testnet/api/address/" . $address . "/utxo";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    $contents = curl_exec($ch);
//    $arr_json = json_decode($contents, true);
//    return $arr_json[0]['status']['confirmed'];
//}
//
//function actual($address)
//{
////    https://github.com/Blockstream/esplora/blob/master/API.md
//    $url = "https://blockstream.info/api/address/" . $address;
////    $url = "https://blockstream.info/testnet/api/address/" . $address;
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    $contents = curl_exec($ch);
//    $arr_json = json_decode($contents, true);
//    return satoshi_to_btc($arr_json['chain_stats']['funded_txo_sum']);
//}
//
//function test_cron($page, $link)
//{
//    $stmt = mysqli_stmt_init($link);
//    $sql = "INSERT INTO customer (full_name, account_date)
//	VALUES(?, now())";
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "s", $page);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_close($stmt);
//    }
//}
//
//function unique_multidim_array($array, $key)
//{
//    $temp_array = array();
//    $i = 0;
//    $key_array = array();
//
//    foreach ($array as $val) {
//        if (!in_array($val[$key], $key_array)) {
//            $key_array[$i] = $val[$key];
//            $temp_array[$i] = $val;
//        }
//        $i++;
//    }
//    return $temp_array;
//}
//
//function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
//{
//    $from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
//    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
//
//    $headers = "From: $from_user <$from_email>\r\n" .
//        "MIME-Version: 1.0" . "\r\n" .
//        "Content-type: text/html; charset=UTF-8" . "\r\n";
//
//    return mail($to, $subject, $message, $headers);
//}
//
//
//$all_usd = $all * get_rate();
//$all_usd = number_format($all_usd, 0);
//
//?>