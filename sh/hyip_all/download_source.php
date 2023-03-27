<?php
include(__DIR__ . '/../../a.php');
//$monitor = "https://fairmonitor.com/?lang=fr";
//$monitor = "https://graspgold.com";
//$monitor = "https://hyips.bz";
$monitor = "https://www.hyipexplorer.com";
// $monitor = "http://192.236.160.198//quick.php";
$curl = call_curl($monitor);


echo $source = $curl['contents'];
$file = fopen("source.htm", "w");
fwrite($file, $source);
fclose($file);
//phpinfo();
