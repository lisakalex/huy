<?php
include(__DIR__ . '/../a.php');

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

$today_all = [];

foreach ($today as $k => $v) {
//    if (isset($yesterday[$k])) {
        $today_perf = $v['perf'];
        $yesterday_perf = $yesterday[$k]['perf'];

        $change = $today_perf - $yesterday_perf;
//        $changep = ($change / $yesterday_perf) * 100;
        $changep = change_percentage($today_perf, $yesterday_perf);

//        $change = number_format($change, 2);
//        if ($change > 0) $change = "+" . $change;
//        $changep = number_format($changep, 2);
//        if ($changep > 0) $changep = "+" . $changep;

        $today_all[$k] = array('hyip' => $v['hyip'], 'perf' => $v['perf'], 'change' => $change, 'changep' => $changep);

//        $today_all[$k]['change'] = $change;
//        $today_all[$k]['changep'] = $changep;
//    }
}
$kak = null;