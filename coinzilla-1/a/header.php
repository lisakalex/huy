<?php
//include(__DIR__ . '/a.php');
//$today_totalu = null;
//$change_totalu = null;
//$change_totalpu = null;
//$today = array();
//$yesterday = array();
//$datetime = new DateTime('NOW');
//$datetime->modify('-1 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//$perf = 0.00;
//$today_index = null;
//$yesterday_index = null;
//
//$link = get_link();
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-06%' AND perf > 0";
////$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
//
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $today_index += $perf;
//    }
//
////    $today_total = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
//$datetime = new DateTime('NOW');
//$datetime->modify('-2 days');
//$ttime = $datetime->format('Y-m-d') . "%";
//
//$link = get_link();
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '2022-09-05%' AND perf > 0";
////$sql = "SELECT url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $hyip,$url, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
//        $yesterday_index += $perf;
//    }
//
////    $yesterday_total = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
//$index_change = $today_index - $yesterday_index;
//$index_change_percentage = ($index_change / $yesterday_index) * 100;
//
//$today_u = json_encode($today);
//$yesterday_u = json_encode($yesterday);
//
////$change_total = $today_total - $yesterday_total;
////$change_totalp = ($change_total / $yesterday_total) * 100;
////
////$change_total = number_format($change_total, 2);
////if ($change_total > 0) $change_total = "+" . $change_total;
////
////$change_totalp = number_format($change_totalp, 2) . "%";
////if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;
//
////$today_total = number_format($today_total, 2);
//
////$change_totalu = $change_total;
////$change_totalu = urlencode($change_totalu);
////
////$change_totalpu = $change_totalp;
////$change_totalpu = urlencode($change_totalpu);
////
////$today_totalu = $today_total;
////$today_totalu = urlencode($today_totalu);
////
////$hyipsu = $hyips;
////$hyipsu = urlencode($hyipsu);
//
//
////foreach ($today as $k => $v) {
////    if (isset($yesterday[$k])) {
////        $today_perf = $v['perf'];
////        $yesterday_perf = $yesterday[$k];
////
////        $change = $today_perf - $yesterday_perf;
////        $changep = change_percentage($today_perf, $yesterday_perf);
////
////        $change = number_format($change, 2);
////        if ($change > 0) $change = "+" . $change;
////        $changep = number_format($changep, 2);
////        if ($changep > 0) $changep = "+" . $changep;
////
////        $today[$k]['change'] = $change;
////        $today[$k]['changep'] = $changep;
////    }
////}
//
////$all_array_keys = array_merge(array_keys($today), array_keys($yesterday));
////$hyip_urls = array_unique($all_array_keys);
////
////$today_change = [];
////$index_perf = null;
////$index_change = null;
////$index_change_percentage = null;
//
//foreach ($today as $k => $v) {
//    if (isset($yesterday[$k])) {
//        $today_perf = $v['perf'];
//        $yesterday_perf = $yesterday[$k]['perf'];
//
//        $change = $today_perf - $yesterday_perf;
//        $changep = ($change / $yesterday_perf) * 100;
//
////        $change = number_format($change, 2);
////        if ($change > 0) $change = "+" . $change;
////        $changep = number_format($changep, 2) . "%";
////        if ($changep > 0) $changep = "+" . $changep;
//
//        $today[$k]['change'] = $change;
//        $today[$k]['changep'] = $changep;
//    }
//}
//$index_change = $today_index_perf - $yesterday_index_perf;
//$index_changep = change_percentage($today_index_perf, $yesterday_index_perf);
$today = array();
$yesterday = array();
$datetime = new DateTime('NOW');
$datetime->modify('-1 days');
$ttime = $datetime->format('Y-m-d') . "%";
$perf = null;
$today_index = null;
$yesterday_index = null;
//$link = get_link();

$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '2022-09-06%' AND rate > 0";
//$sql = "SELECT hyip, url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
        $today_index += $perf;
    }
}

$datetime = new DateTime('NOW');
$datetime->modify('-2 days');
$ttime = $datetime->format('Y-m-d') . "%";

$sql = "SELECT hyip, url, rate FROM graph WHERE ttime like '2022-09-05%' AND rate > 0";
//$sql = "SELECT url, perf FROM graph WHERE ttime like '" . $ttime . "' AND perf > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $yesterday[$url] = array('hyip' => $hyip, 'perf' => $perf);
        $yesterday_index += $perf;
    }
}

//mysqli_close($link);

$index_change = $today_index - $yesterday_index;
$index_change_percentage = change_percentage($today_index, $yesterday_index);

$index_change = number_format($index_change, 2);
if ($index_change > 0) $index_change = "+" . $index_change;

$index_change_percentage = number_format($index_change_percentage, 2);
if ($index_change_percentage > 0) $index_change_percentage = "+" . $index_change_percentage;

//$today_u = json_encode($today);
//$yesterday_u = json_encode($yesterday);

//$change_total = $today_total - $yesterday_total;
//$change_totalp = ($change_total / $yesterday_total) * 100;
//
//$change_total = number_format($change_total, 2);
//if ($change_total > 0) $change_total = "+" . $change_total;
//
//$change_totalp = number_format($change_totalp, 2) . "%";
//if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;

//$today_total = number_format($today_total, 2);

//$change_totalu = $index_change;
//$change_totalu = urlencode($change_totalu);
//
//$change_totalpu = $index_change_percentage;
//$change_totalpu = urlencode($change_totalpu);
//
//$today_totalu = $today_index;
//$today_totalu = urlencode($today_totalu);
//
//$hyipsu = count($today);
//$hyipsu = urlencode($hyipsu);


//foreach ($today as $k => $v) {
//    if (isset($yesterday[$k])) {
//        $today_perf = $v['perf'];
//        $yesterday_perf = $yesterday[$k];
//
//        $change = $today_perf - $yesterday_perf;
//        $changep = change_percentage($today_perf, $yesterday_perf);
//
//        $change = number_format($change, 2);
//        if ($change > 0) $change = "+" . $change;
//        $changep = number_format($changep, 2);
//        if ($changep > 0) $changep = "+" . $changep;
//
//        $today[$k]['change'] = $change;
//        $today[$k]['changep'] = $changep;
//    }
//}

//$all_array_keys = array_merge(array_keys($today), array_keys($yesterday));
//$hyip_urls = array_unique($all_array_keys);
//
//$today_change = [];
//$index_perf = null;
//$index_change = null;
//$index_change_percentage = null;

$today_perf = 0.00;
$yesterday_perf = 0.00;

foreach ($today as $k => $v) {
    $today_perf = $v['perf'];

    if (isset($yesterday[$k])) {
        $yesterday_perf = $yesterday[$k]['perf'];
    }

    $change = $today_perf - $yesterday_perf;
    $changep = change_percentage($today_perf, $yesterday_perf);

    $change = number_format($change, 2);
    if ($change > 0) $change = "+" . $change;
    $changep = number_format($changep, 2);
    if ($changep > 0) $changep = "+" . $changep;

//    $today_all[$k] = array('hyip' => $v['hyip'], 'perf' => $v['perf'], 'change' => $change, 'changep' => $changep);

    $today[$k]['change'] = $change;
    $today[$k]['changep'] = $changep;
}

//$all_banners['Top'] = array("https://tpc.googlesyndication.com/simgad/7130775551167661743?sqp=4sqPyQQrQikqJwhfEAEdAAC0QiABKAEwCTgDQPCTCUgAUAFYAWBfcAJ4AcUBLbKdPg&amp;rs=AOga4qnJFrY06lcLPWXKWRoP3hdyZM68-A", "#");
$all_banners['Top'] = array("https://solidtradebank.com/assets/banners/solid-trade_728x90.gif", "https://solidtradebank.com/\" target=\"_blank");
$all_banners['Left side 1'] = array("assets/images/125.png", "#");
$all_banners['Left side 2'] = array("assets/images/125.png", "#");
$all_banners['Left side 3.json'] = array("assets/images/125.png", "#");
$all_banners['Left side 4'] = array("assets/images/125.png", "#");
$all_banners['Left side 5'] = array("assets/images/125.png", "#");
$all_banners['Right side 1'] = array("assets/images/125.png", "#");
$all_banners['Right side 2'] = array("assets/images/125.png", "#");
$all_banners['Right side 3.json'] = array("assets/images/125.png", "#");
$all_banners['Right side 4'] = array("assets/images/125.png", "#");
$all_banners['Right side 5'] = array("assets/images/125.png", "#");
$all_banners['Bottom'] = array("https://solidtradebank.com/assets/banners/solid-trade_468x60.gif", "https://solidtradebank.com/\" target=\"_blank");
$now = get_now();
$banners = array();
$payment = "complete";

//$link = get_link();
$sql = "SELECT banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $banner_url, $banner_id, $site, $slot, $days, $start_date);

    while (mysqli_stmt_fetch($stmt)) {
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if (($now >= $firstday) && ($now <= $lastday)) {
            $banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
}

mysqli_close($link);

$banners1 = array();
foreach ($banners as $banner) {
    for ($i = 0; $i < $banner['slot']; $i++) {
        $banners1[$banner['banner_id']][] = array($banner['banner_url'], $banner['site']);
    }
}

foreach ($banners1 as $k => $v) {
    $b = count($v);
    $b--;
    $b = rand(0, $b);
    $all_banners[$k] = $v[$b];
}

//
//$datetime = new DateTime('NOW');
////$datetime->modify('-1 days');
////$ttime = $datetime->format('Y-m-d') . "%";
//$ttime = $datetime->format('Y-m-d');
//
//$link = get_link();
//
//if (isset ($_GET ['today_total'])) {
//    $today_totalu = mysqli_real_escape_string($link, $_GET ['today_total']);
//    $change_totalu = mysqli_real_escape_string($link, $_GET ['change_total']);
//    $change_totalpu = mysqli_real_escape_string($link, $_GET ['change_totalp']);
//    $hyipsu = mysqli_real_escape_string($link, $_GET ['hyipsu']);
//}
//
////$sql = "SELECT ttime, perf FROM graph4 WHERE perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
//$sql = "SELECT ttime, perf FROM graph WHERE perf > 0 AND ttime < '$ttime' ORDER BY ttime";
////$sql = "SELECT htime, perf FROM graph";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $htime, $perf);
//    while (mysqli_stmt_fetch($stmt)) {
//        $graph[] = array('date' => $htime, 'value' => $perf);
//    }
//    $hyips = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
//$dates = array_column($graph, 'date');
//$dates = array_unique($dates);
//
//foreach ($dates as $date) {
//    $value = null;
//    foreach ($graph as $date_value) {
//        if ($date_value['date'] == $date) {
//            $value += $date_value['value'];
//        }
//    }
//
//    $data[] = array('date' => $date, 'value' => $value);
//}
//
//$data = json_encode($data);
//

//$datetime = new DateTime('NOW');
//$tt = $datetime->format('Y-m-d');
//
//$link = get_link();
//if (isset ($_GET ['u'])) {
//    $url = mysqli_real_escape_string($link, $_GET ['u']);
//    $hyip = mysqli_real_escape_string($link, $_GET ['h']);
//    $perf = mysqli_real_escape_string($link, $_GET ['perf']);
//    $change = mysqli_real_escape_string($link, $_GET ['change']);
//    $changep = mysqli_real_escape_string($link, $_GET ['changep']);
//}

//detail.php
//$du = null;
////$sql = "SELECT ttime, perf FROM graph WHERE url=? AND perf > 0 AND ttime < NOW() - INTERVAL 1 DAY ORDER BY ttime";
//$sql = "SELECT ttime, perf, details FROM graph WHERE url=? AND perf > 0 AND ttime < '$tt' ORDER BY ttime";
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, $sql)) {
//    mysqli_stmt_bind_param($stmt, "s", $url);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $ttime, $perf, $details);
//    while (mysqli_stmt_fetch($stmt)) {
//        $du[] = array('date' => $ttime, 'value' => $perf);
////        $d[] = array('details' => $details);
//    }
//
////    $hyips = mysqli_stmt_num_rows($stmt);
//    mysqli_close($link);
//}
//
////monitor images
//$da = json_encode($du);
//$de = json_decode($details);

//$url = "https://www.coindesk.com/category/tech";
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
//$contents = curl_exec($ch);
//
//$exploded = explode("list-item-wrapper", $contents);
//array_shift($exploded);
//
//foreach ($exploded as $e) {
//
//    $titles[] = between("title=\"", "\"", $e);
//    $urls[] = between("href=\"", "\"", $e);
//    $dates[] = between("class=\"time\">", "<", $e);
//    $texts[] = between("<p class=\"card-text\">", "<", $e);
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Investment market | Join The Top Finance & Crypto Ad Network</title>
    <link href="../assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-regular.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-solid.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/fa-brands.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/me.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
</head>
<body class="homepage__body overflow__limited">
<?php
if (isset ($_GET ['err'])) {
    $err = clean_input($_GET ['err']);
    echo "<div class=\"alertku\">
  <span class=\"closebtn-r\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$err</div>";
}

if (isset ($_GET ['msg'])) {
    $msg = clean_input($_GET ['msg']);
    echo "<div class=\"alertku-msg\">
  <span class=\"closebtn-g\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$msg</div>";
}
?>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5D4MPDT" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="../index.php">
                            <img src="../assets/images/logo-3.png" alt="Investment market Advertising Network"
                                 class="logo">
                        </a>
                        <div class="navbar-collapse collapse toggle-menu-mobile" id="navbarSupportedContent">
                            <ul class="navbar-nav navbar-right-Investment market">
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.php#perf"
                                       id="advertisersMenu">company list</a>
                                </li>
                                <li class="nav-item">
<!--                                    <a class="nav-link"-->
<!--                                       href="tdetail.php?today_total=--><?//= $today_totalu ?><!--&change_total=--><?//= $change_totalu ?><!--&change_totalp=--><?//= $change_totalpu ?><!--&hyips=--><?//= $hyipsu ?><!--"-->
<!--                                       id="publishersMenu">performance index</a>-->
                                    <a class="nav-link"
                                       href="tdetail.php"
                                       id="publishersMenu">performance index</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php"
                                       id="marketplaceMenu">about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php" id="marketplaceMenu">contact</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav navbar-right">
                                <?php if (isset($_COOKIE ['cus_id'])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="display/account.php">Member Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../logout.php">Logout</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup.php">Sign Up</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
    </header>
</div>

