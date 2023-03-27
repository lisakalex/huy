<?php
include(__DIR__ . '/a.php');

//$monitor = "https://graspgold.com";
//$monitor = "https://hyiphome.net";
//$monitor = "https://invest-tracing.com";
//$monitor = "https://instant-monitor.com";
//$monitor = "https://gold-lister.com";
//$monitor = "https://eurohyips.net";
//$monitor = "https://exclusive-profit.com/?lang=fr";
//$monitor = "https://fairmonitor.com/?lang=fr";
//$monitor = "https://hyipclub.club";
//$monitor = "https://keyhyip.com";
//$monitor = "https://hyips.bz";
//$monitor = "https://www.hyipexplorer.com";
//$monitor = "https://asianhyip.com";
//$monitor = "https://makemoneyventure.com";
//$monitor = "https://hyipbusket.com/";
//$monitor = "https://graspgold.com/go/lid/3799/";

//$monitor = "https://invest-tracing.com/program-Arbill.html";
$monitor = "http://hindex.uk/";

$curl = call_curl($monitor);
$source = $curl['contents'];
$file = fopen("../source.htm", "w");
fwrite($file, $source);
fclose($file);

//sleep(10);
//echo "da";
