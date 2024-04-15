<?php


class hyip
{
//    private $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
//    protected $link = null;
    /**
     * hyip constructor.
     */
    public function __construct()
    {
    }

    function __destruct()
    {
        $this->clear();
    }

    public function get_link()
    {
        $link = mysqli_connect("localhost", "root", "", "tihuy");
        if (!$link) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit ();
        }

        mysqli_set_charset($link, 'utf8'); // https://www.php.net/manual/en/mysqli.set-charset.php
        return $link;
    }

//$ip = $_SERVER ['REMOTE_ADDR'];
//$url = $_SERVER ['REQUEST_URI'];
//if (isset($_SERVER['HTTP_REFERER'])) $url_ref = $_SERVER['HTTP_REFERER'];


    public function after($thiss, $inthat)
    {
        if (!is_bool(strpos($inthat, $thiss))) {
            return substr($inthat, strpos($inthat, $thiss) + strlen($thiss));
        }
    }

    public function between($thiss, $that, $inthat)
    {
        return before($that, after($thiss, $inthat));
    }

    public function before($thiss, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $thiss));
    }

    public function found($haystack, $needle)
    {
        return (strpos($haystack, $needle) !== false);
    }

    public function cutString($str, $amount = 1, $dir = "right")
    {
        if (($n = strlen($str)) > 0) {
            if ($dir == "right") {
                $start = 0;
                $end = $n - $amount;
            } else if ($dir == "left") {
                $start = $amount;
                $end = $n;
            }

            return substr($str, $start, $end);
        } else {
            return false;
        }
    }


    public function get_url($url)
    {
        $part1 = before("//", $url);
        $part2 = after("//", $url);
        if (found($part2, "/")) {
            return $part1 . "//" . before("/", $part2);
        } else {
            return $part1 . "//" . $part2;
        }
    }

    public function get_clean_url($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return 0;
        } else {
            $hyip_url3 = after("//", $url);
            $hurl_1 = before("/", $hyip_url3);
            $pos = strpos($hurl_1, "www.");
            if ($pos !== false) {
                $hurl_1 = after("www.", $hurl_1);
            }
        }
        return $hurl_1;
    }

    public function call_curl($url)
    {
        $data = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $contents = curl_exec($ch);

        $data['contents'] = $contents;

        $curlinfo_effective_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $curlinfo_total_time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        $curlinfo_total_time = round($curlinfo_total_time, 3);
        $curlinfo_response_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $curlinfo_filetime = curl_getinfo($ch, CURLINFO_FILETIME);
        $curlinfo_namelookup_time = curl_getinfo($ch, CURLINFO_NAMELOOKUP_TIME);
        $curlinfo_connect_time = curl_getinfo($ch, CURLINFO_CONNECT_TIME);
        $curlinfo_redirect_count = curl_getinfo($ch, CURLINFO_REDIRECT_COUNT);
        $curlinfo_size_download = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
        $curlinfo_speed_download = curl_getinfo($ch, CURLINFO_SPEED_DOWNLOAD);
        $data['eff_url'] = $curlinfo_effective_url;

        curl_close($ch);

//    $htime = gmdate("d-m-Y   H:i:s");
//    $sql = "INSERT INTO curl_data (curlinfo_effective_url, curlinfo_total_time, curlinfo_response_code, curlinfo_namelookup_time, curlinfo_connect_time, curlinfo_redirect_count, curlinfo_size_download, curlinfo_speed_download, htime) VALUES(?,?,?,?,?,?,?,?,?)";
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "sssssssss", $curlinfo_effective_url, $curlinfo_total_time, $curlinfo_response_code, $curlinfo_namelookup_time, $curlinfo_connect_time, $curlinfo_redirect_count, $curlinfo_size_download, $curlinfo_speed_download, $htime);
//        mysqli_stmt_execute($stmt);
//    }

//    $htime = gmdate("d-m-Y   H:i:s");
        $link = get_link();
        $sql = "INSERT INTO curl_data ( curlinfo_effective_url, curlinfo_total_time, curlinfo_response_code) VALUES(?,?,?)";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $curlinfo_effective_url, $curlinfo_total_time, $curlinfo_response_code);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        return $data;
    }

    public function run_yourself($table)
    {
        $hit = 0;
        $link = get_link();
        $sql = "SELECT COUNT(hit) FROM " . $table . " WHERE hit=?";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $hit);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $hit);
            mysqli_stmt_fetch($stmt);
            mysqli_close($link);
        }

        if ($hit) {
            $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            call_curl($url);
        } else {
//        if ($table == "seed") {
//            $link = get_link();
//            $sql = "INSERT INTO monitor1 SELECT * FROM monitor GROUP BY monitor";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//            run_someone("/hyip/hyip.php");
//        }

//        if ($table == "monitor1") {
//            $link = get_link();
//            $sql = "INSERT INTO hyip1 SELECT * FROM hyip GROUP BY hyip";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//            run_someone("/hyip/rate.php");
//        }
//
//        if ($table == "hyip1") {
//            $link = get_link();
//            $sql = "INSERT INTO performance1 SELECT * FROM performance GROUP BY url";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//
//            $link = get_link();
//            $sql = "INSERT INTO graph SELECT * FROM performance1";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//        }
        }
    }

    public function run_someone($url) //   /hyip/t.php
    {
        $url = $_SERVER['HTTP_HOST'] . $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_exec($ch);
        curl_close($ch);
    }

// print array
    public function printa($sweet)
    {
        foreach ($sweet as $key => $value) {
            echo $key . "\t" . $value . "<br>";
        }
    }

    public function filter($data)
    {
        $link = get_link();
        $data = trim(htmlentities(strip_tags($data)));
        $data = stripslashes($data);
        $data = mysqli_real_escape_string($link, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function page_protect()
    {
        session_start();

        // check for cookies
        if (isset ($_COOKIE ['cus_id']) && isset ($_COOKIE ['user_name'])) {
            $_SESSION ['cus_id'] = $_COOKIE ['cus_id'];
            $_SESSION ['full_name'] = $_COOKIE ['full_name'];
            $_SESSION ['user_name'] = $_COOKIE ['user_name'];
            $_SESSION ['upline'] = $_COOKIE ['upline'];
        }

        if (!isset ($_SESSION ['cus_id'])) {
            header("Location: ../login.php");
        }
    }


    public function satoshi_to_btc($value)
    {
        return bcdiv(intval($value), 100000000, 8);
    }

    /**
     * count how man new addresses left
     */

    public function new_address()
    {
        $payment = "new";
        $newpayment = "";
        $link = get_link();
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM trans WHERE payment=?')) {
            mysqli_stmt_bind_param($stmt, "s", $payment);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $newpayment);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }

        return $newpayment;
    }

//count all satoshis
//$link = get_link();
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(paid) FROM trans')) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $all);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}

    public function get_rate()
    {
        $url = "https://bitpay.com/api/rates/BTC/USD";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        $arr_json = json_decode($contents, true);
        return $arr_json['rate'];
    }

//not used
    public function confirmed($address)
    {
//    https://blockstream.info/api/address/" . $address . "/utxo
        $url = "https://blockstream.info/testnet/api/address/" . $address . "/utxo";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        $arr_json = json_decode($contents, true);
        return $arr_json[0]['status']['confirmed'];
    }

    public function get_transaction_status($address)
    {
//    https://github.com/Blockstream/esplora/blob/master/API.md
//    $url = "https://blockstream.info/api/address/" . $address;
        $url = "https://blockstream.info/testnet/api/address/" . $address;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);
        $arr_json = json_decode($contents, true);
        return satoshi_to_btc($arr_json['chain_stats']['funded_txo_sum']);
    }

    public function test_cron($page, $link)
    {
        $link = get_link();
        $stmt = mysqli_stmt_init($link);
        $sql = "INSERT INTO customer (full_name, account_date)
	VALUES(?, now())";
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $page);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    public function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
    {
        $from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
        $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

        $headers = "From: $from_user <$from_email>\r\n" .
            "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=UTF-8" . "\r\n";

        return mail($to, $subject, $message, $headers);
    }


//$all_usd = $all * get_rate();
//$all_usd = number_format($all_usd, 0);

    public function reCaptcha($recaptcha)
    {
        $secret = "6LcEwn0UAAAAAP2Bm4qGvjhpDgzeDrkZCMR68Y2W";
        $ip = $_SERVER['REMOTE_ADDR'];

        $postvars = array("secret" => $secret, "response" => $recaptcha, "remoteip" => $ip);
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        $data = curl_exec($ch);
        curl_close($ch);

        return json_decode($data, true);
    }

    public function clean_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function get_now()
    {
        $now = new DateTime('NOW');
        $now = $now->format('Y-m-d');
        try {
            $now = new DateTime($now);
        } catch (Exception $e) {
        }
        return $now;
    }

    /**
     * A sweet interval formatting, will use the two biggest interval parts.
     * On small intervals, you get minutes and seconds.
     * On big intervals, you get months and days.
     * Only the two biggest parts are used.
     *
     * @param DateTime $start
     * @param DateTime|null $end
     * @return string
     * @throws Exception
     */
    public function formatDateDiff($start, $end = null)
    {
        if (!($start instanceof DateTime)) {
            $start = new DateTime($start);
        }

        if ($end === null) {
            $end = new DateTime();
        }

        if (!($end instanceof DateTime)) {
            $end = new DateTime($start);
        }

        $interval = $end->diff($start);
        $doPlural = function ($nb, $str) {
            return $nb > 1 ? $str . 's' : $str;
        }; // adds plurals

        $format = array();
        if ($interval->y !== 0) {
            $format[] = "%y " . $doPlural($interval->y, "year");
        }
        if ($interval->m !== 0) {
            $format[] = "%m " . $doPlural($interval->m, "month");
        }
        if ($interval->d !== 0) {
            $format[] = "%d " . $doPlural($interval->d, "day");
        }
        if ($interval->h !== 0) {
            $format[] = "%h " . $doPlural($interval->h, "hour");
        }
        if ($interval->i !== 0) {
            $format[] = "%i " . $doPlural($interval->i, "minute");
        }
        if ($interval->s !== 0) {
            if (!count($format)) {
                return "less than a minute ago";
            } else {
                $format[] = "%s " . $doPlural($interval->s, "second");
            }
        }

        // We use the two biggest parts
        if (count($format) > 1) {
            $format = array_shift($format) . " and " . array_shift($format);
        } else {
            $format = array_pop($format);
        }

        // Prepend 'since ' or whatever you like
        return $interval->format($format);
    }

    public function url_data($url, $url_ref, $ip)
    {
        if ($url !== null) {
            $link = get_link();
            $sql = "INSERT INTO url_data (url, url_ref, ip) VALUES(?,?,?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $url, $url_ref, $ip);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }

//count all satoshis
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(usd_paid) FROM trans'))
//{
//mysqli_stmt_execute($stmt);
//mysqli_stmt_bind_result($stmt, $all_usd);
//mysqli_stmt_fetch($stmt);
//mysqli_stmt_close($stmt);
//}

//$all_usd = $all * get_rate();
//$all_usd = number_format($all_usd, 0);
}