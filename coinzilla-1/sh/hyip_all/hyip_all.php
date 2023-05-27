<?php
//use Hyip;
//include(__DIR__ . '../../a.php');
//$huy = new Hyip();

function get_link()
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

function call_curl($url)
{
    $data = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $data['contents'] = curl_exec($ch);
    $data['eff_url'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $data['response_code'] = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    $curlinfo_filetime = curl_getinfo($ch, CURLINFO_FILETIME);
    $curlinfo_namelookup_time = curl_getinfo($ch, CURLINFO_NAMELOOKUP_TIME);
    $curlinfo_connect_time = curl_getinfo($ch, CURLINFO_CONNECT_TIME);
    $curlinfo_redirect_count = curl_getinfo($ch, CURLINFO_REDIRECT_COUNT);
    $data['size_download'] = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
    $curlinfo_speed_download = curl_getinfo($ch, CURLINFO_SPEED_DOWNLOAD);
    curl_close($ch);

    return $data;
}


function after($thiss, $inthat)
{
    if (!is_bool(strpos($inthat, $thiss))) {
        return substr($inthat, strpos($inthat, $thiss) + strlen($thiss));
    }
}

function between($thiss, $that, $inthat)
{
    return before($that, after($thiss, $inthat));
}

function before($thiss, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $thiss));
}

function found($haystack, $needle)
{
    return (strpos($haystack, $needle) !== false);
}

function cutString($str, $amount = 1, $dir = "right")
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


$monitor = "";
$monitors = array();
//$link = $huy->get_link();
$link = get_link();
$sql = "SELECT `monitor` FROM monitor";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $monitor);
    while (mysqli_stmt_fetch($stmt)) $monitors[] = $monitor;
    mysqli_close($link);
}
//$monitor = "invest-tracing.com";
/**
 * @param $url
 * @return false|string
 */
function clean_url($url)
{
    if (found($url, "www.")) {
        $url = between("www.", ".", $url);
    } else {
        $url = between("//", ".", $url);
    }
    return $url;
}

foreach ($monitors as $monitor) {
    $curl = call_curl($monitor);
    $size = $curl['size_download']/1000;
    $link = get_link();
    $sql = "UPDATE monitor SET response=?, size=? WHERE monitor=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ids", $curl['response_code'], $size, $monitor);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }

}

//foreach ($monitors as $monitor) {
//    $var_name = clean_url($monitor);
//    $$var_name = $var_name;
//    $curl = call_curl($monitor);
//    $source = $curl['contents'];
//    $file = fopen($$var_name, "w");
//    fwrite($file, $source);
//    fclose($file);
//
//}
