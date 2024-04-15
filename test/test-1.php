<?php
include(__DIR__ . '/../a.php');
//printf ("%6.2f",3.json.360011);
//$changep = get_percentage(0, 2);

function change_percentage1($today_perf, $yesterday_perf) {
    if ($yesterday_perf > 0) {
        $change = $today_perf - $yesterday_perf;
        return ($change * 100) / $yesterday_perf;
    } else {
        return 100;
    }
}

$changep = change_percentage1(8281.52, 8229.0);

$kak = null;