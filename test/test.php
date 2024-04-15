<?php
include(__DIR__ . '/../a.php');

//$d =

//$aa = get_hyip_name('https://cryptomines.biz');
//$today = json_decode("{
//  \"https:\/\/cryptomines.biz\": {
//    \"hyip\": \"cryptomines\",
//    \"perf\": \"93.63\"
//  },
//  \"http:\/\/nftpump.ai\": {
//    \"hyip\": \"nftpump\",
//    \"perf\": \"41.58\"
//  },
//  \"http:\/\/centoinvestment.com\": {
//    \"hyip\": \"centoinvestment\",
//    \"perf\": \"61.40\"
//  }}");

$today = array();
$today['https://cryptomines.biz'] = array('hyip' => 'cryptomines', 'perf' => 90.63);
$today['https://nftpump.ai'] = array('hyip' => "nftpump", 'perf' => 41.58);
$today['https://centoinvestment.com'] = array('hyip' => 'centoinvestment', 'perf' => 61.40);
$today['https://xxxxxx.com'] = array('hyip' => 'centoinvestment', 'perf' => 30.30);

$yesterday = array();
$yesterday['https://cryptomines.biz'] = array('hyip' => 'cryptomines', 'perf' => 93.63);
$yesterday['https://nftpump.ai'] = array('hyip' => "nftpump", 'perf' => 40.58);
$yesterday['https://centoinvestment.com'] = array('hyip' => 'centoinvestment', 'perf' => 61.40);
$yesterday['https://ssssss.com'] = array('hyip' => 'centoinvestment', 'perf' => 30.30);

//$a = array_sum($yesterday[]['perf']);

$all_array_keys = array_merge(array_keys($today), array_keys($yesterday));
$hyip_urls = array_unique($all_array_keys);

$today_change = [];
$index_perf = null;
$index_change = null;
$index_change_percentage = null;
foreach ($hyip_urls as $hyip_url) {
    if (isset($today[$hyip_url]['perf'])) {
        $today_perf = $today[$hyip_url]['perf'];
    } else {
        $today_perf = 0;
    }

    if (isset($yesterday[$hyip_url]['perf'])) {
        $yesterday_perf = $yesterday[$hyip_url]['perf'];
    } else {
        $yesterday_perf = 0;
    }

    $change = $today_perf - $yesterday_perf;
    $changep = change_percentage($today_perf, $yesterday_perf);

    $today_index_perf += $today_perf;
    $yesterday_index_perf += $yesterday_perf;
//    $index_change += $change;
//    $index_change_percentage += $changep;
//    $change = number_format($change, 2);
//    if ($change > 0) $change = "+" . $change;
//    $changep = number_format($changep, 2);
//    if ($changep > 0) $changep = "+" . $changep;

    if (isset($today[$hyip_url])) {
        $today_change[$hyip_url] = array('hyip' => $today[$hyip_url]['hyip'], 'perf' => $today_perf, 'change' => $change, 'changep' => $changep);
    } else {
        $today_change[$hyip_url] = array('hyip' => $yesterday[$hyip_url]['hyip'], 'perf' => $today_perf, 'change' => $change, 'changep' => $changep);
    }
}

$index_change = $today_index_perf - $yesterday_index_perf;
$index_changep = change_percentage($today_index_perf, $yesterday_index_perf);

$kak = null;