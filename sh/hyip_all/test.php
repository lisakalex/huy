<?php
//include(__DIR__ . '/../../simplehtmldom/simple_html_dom.php');
//$monitor = "https://fairmonitor.com/?lang=fr";
//$hyips = file_get_html($monitor);
//
//foreach ($hyips->find('table.detn_stat1_block') as $e) {
//    $hyip[] = $e->find('a', 0)->plaintext;
//    $url[] = $e->find('a', 0)->href;
//    $status[] = $e->find('span span', 0)->plaintext;
//}
//var_dump($status);

//class huy{
//    public $huylo = "huylo";
//}
include 'huy.php';
$hyip = new huy();
print($hyip->huylo);
$huy = null;
