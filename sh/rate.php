<?php
include(__DIR__ . '/../a.php');

$hit = 0;
$link = get_link();
$sql = "SELECT hyip_id, hyip1 FROM hyip1 WHERE hit=? LIMIT 1";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $hit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip_id, $hyip1);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

if ($hyip_id) {
    $hyip_url = "https://www.allhyipmonitors.com/search/?keyword=" . $hyip1;
    $contents = call_curl($hyip_url);

    $hyip_url = between("0 0 0 10px\">", "target", $contents['contents']);
    $hyip_url = between("<a href=\"", "\"", $hyip_url);
    $hyip_url = get_url($hyip_url);

    if ($hyip_url != null && $hyip_url != "") {
        if (found($hyip_url, "www.")) {
            $hyip = between("www.", ".", $hyip_url);
        } else {
            $hyip = between("//", ".", $hyip_url);
        }

        $whois = after("//", $hyip_url);
        $whois = shell_exec("whois " . $whois);
        $details['whois'] = $whois;

        /*
        calculate status to get performance
        R - rate
        t - total monitors quantity
        p - paying monitors quantity (percentage)
        n - not paying monitors quantity
        R = ((t + p - n)/2)*0.999*0.987
        /2)*0.999*0.987 - this is to get the number around 100 and make all numbers different
        */
        $total = substr_count($contents['contents'], "<div class=\"mtd\">");
        if ($total > 0) {
            $paying = between(">PAYING (", ")", $contents['contents']);
            $paying1 = intval($paying);
            $not_paying = $total - $paying1;
            $paying_per = $paying1 / $total * 100;
            $perf = (($total + $paying_per - $not_paying) / 2) * 0.999 * 0.987;
//        $perf = round($perf, 2);
//        $paying_per = round($paying_per, 2);
        } else {
            $perf = 0;
        }

        $monitors = explode("<div class=\"mtd\">", $contents['contents']);
        array_shift($monitors);
        foreach ($monitors as $m) {
            $mm[] = between("a></div>", "</div>", $m);
        }

        $details = array();
        $details['monitors'] = $mm;

        $statuses = explode("monitors report this status\">", $contents['contents']);
        array_shift($statuses);

        foreach ($statuses as $s) {
            $status[] = before("</div>", $s);
        }
        $details['status'] = $status;

        $details = json_encode($details);

        try {
            $link = get_link();
            $sql = "INSERT INTO rate (hyip, url, perf, details) VALUES(?,?,?,?)";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssds", $hyip, $hyip_url, $perf, $details);
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }

        } catch (Exception $e) {

        }
    }

    $hit = 1;
    $link = get_link();
    $sql = "UPDATE hyip1 SET hit=? WHERE hyip_id=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $hit, $hyip_id);
        mysqli_stmt_execute($stmt);
        mysqli_close($link);
    }
}

$pid = getmypid();
$link = get_link();
$sql = "INSERT INTO log (rate) VALUES(?)";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_close($link);
}
