<?php
include 'a.php';

$today = array();
//$datetime = new DateTime('NOW');
//$datetime->modify('-12 days');
//$htime = $datetime->format('Y-m-d');
$htime = "2021-06-05";
$link = get_link();
$sql = "SELECT hyip, url, rate FROM graph WHERE htime=? AND rate > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $today[$url] = array('hyip' => $hyip, 'perf' => $perf);
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$link = get_link();
$sql = "SELECT SUM(rate) FROM graph WHERE htime=? AND rate > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $today_total);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

//$datetime = new DateTime('NOW');
//$datetime->modify('-13 days');
//$htime = $datetime->format('Y-m-d');
$htime = "2021-06-06";
$link = get_link();
$sql = "SELECT url, rate FROM graph WHERE htime=? AND rate > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $url, $perf);
    while (mysqli_stmt_fetch($stmt)) {
        $yesterday[$url] = $perf;
    }
    mysqli_close($link);
}

$link = get_link();
$sql = "SELECT SUM(rate) FROM graph WHERE htime=? AND rate > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $yesterday_total);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

$change_total = $today_total - $yesterday_total;
$change_totalp = ($change_total / $yesterday_total) * 100;

$change_total = number_format($change_total, 2);
if ($change_total > 0) $change_total = "+" . $change_total;

$change_totalp = number_format($change_totalp, 2) . "%";
if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;

$today_total = number_format($today_total, 2);

$change_totalu = $change_total;
$change_totalu = urlencode($change_totalu);

$change_totalpu = $change_totalp;
$change_totalpu = urlencode($change_totalpu);

$today_totalu = $today_total;
$today_totalu = urlencode($today_totalu);

$hyipsu = $hyips;
$hyipsu = urlencode($hyipsu);


foreach ($today as $k => $v) {
    if (isset($yesterday[$k])) {
        $today_perf = $v['perf'];
        $yesterday_perf = $yesterday[$k];

        $change = $today_perf - $yesterday_perf;
        $changep = ($change / $yesterday_perf) * 100;

        $change = number_format($change, 2);
        if ($change > 0) $change = "+" . $change;
        $changep = number_format($changep, 2) . "%";
        if ($changep > 0) $changep = "+" . $changep;

        $today[$k]['change'] = $change;
        $today[$k]['changep'] = $changep;
    }
}

include 'header.php';
?>
    <div class="" style="text-align: center">
        <a href="<?= $all_banners['Top'][1] ?>"><img src="<?= $all_banners['Top'][0] ?>" alt=""
                                                     class=""></a>
        <!--                                                <img src="https://hyipbanker.com/banners/2020_12_14_4382/imafil.gif">-->
        <!--                        <iframe src="https://files.cointraffic.io/pub/00814bc34ab35b05be1363acc303f5d8f1feb4da/fe49d09bff6439e7d1c5112503403090e6c5f18f/index.html"-->
        <!--                                width="728" height="90"-->
        <!--                                style="display: block; border: 0; overflow: hidden; margin:0 auto; width: 728px; max-width: 728px; height: 90px; max-height: 90px;"></iframe>-->
        <!--                    </div>-->
    </div>
    <div class="wrap__news">
        <section class="news">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="card dark">
                            <div class="card-body">
                                <div>
                                    <h4 style="color: white">Investment Market index</h4>
                                    <div style="color: white; font-size: 3em; font-weight: 500; padding: 30px"><?= $today_total ?></div>
                                    <div style="color: white; font-size: 1em; font-weight: 500; padding: 0 30px 0 30px"><?= $change_total ?>
                                        (<?= $change_totalp ?>)
                                    </div>
                                </div>
                                <span class="line-bellow d-block"></span>
                                <a href="tdetail.php?today_total=<?= $today_totalu ?>&change_total=<?= $change_totalu ?>&change_totalp=<?= $change_totalpu ?>&hyipsu=<?= $hyipsu ?>"
                                   class="d-block dashed xs-general-color">Check
                                    our
                                    latest news &xrarr;</a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-news-to-right col-md-8 col-12">
                        <div class="row-slider row">

                            <div class="col-md-6 col-12 slider-item">
                                <div class="day">
                                    <div class="card-body">
                                        <h4>Investment Market index</h4>
                                        <div class="line-bellow d-block"></div>
                                        <div class="content">
                                            The Investment Market index is calculated by weighing indexes of all Investment market
                                            companies listed on the Hindex.
                                            <br>
                                            Companies with higher index have more weight in the Investment Market index and
                                            therefore have a bigger effect on the index’s price movements.
                                            These data updated on daily bases and displayed through graphs.
                                            <br>
                                            The Investment Market index is also considered a good indicator of the health
                                            of the Investment market industry.
                                            It can give you a good idea of how investors are generally feeling, whether
                                            optimistic or nervous,
                                            which can in turn inform your own decision as to whether or not to invest,
                                            and what to put your money into or take it out of.

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 slider-item">
                                <div class="day">
                                    <div class="card-body">
                                        <h4>Investment market performance index</h4>
                                        <div class="line-bellow d-block"></div>
                                        <div class="content">
                                            Many Investment market traders and investors consider the Investment market performance index to
                                            be
                                            the most important indicator of the health of an Investment market company.
                                            <br>
                                            The index is made up of performance indicators such as the number of
                                            monitors the
                                            Investment market company is registered with,
                                            the ratio of the number of monitors the company pays and number of monitors
                                            it does not.
                                            <br>
                                            These data updated on daily bases and displayed through graphs.
                                            Virtually all Investment market companies in the world are listed here.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--    <div class="" style="display: flex; flex-direction: row; padding: 2% 10% 2% 10%; justify-content: space-between">-->
    <!--        <div class="" style="">-->
    <!--            <img src="https://hyipbanker.com/banners/2020_12_20_4383/imafil.gif">-->
    <!--        </div>-->
    <!--        <div class="" style="">-->
    <!--            <img src="https://hyipbanker.com/banners/2020_12_20_4383/imafil.gif">-->
    <!--        </div>-->
    <!--    </div>-->
    <hr style="margin: 0 0 0 0;">
    <div class="wrap__news" style="display: flex; flex-direction: row; ">

        <div style=" width: 15%; background-color: white; padding: 15% 4% 0 0; text-align: right ">
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 1'][1] ?>"><img src="<?= $all_banners['Left side 1'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 2'][1] ?>"><img src="<?= $all_banners['Left side 2'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 3.json'][1] ?>"><img src="<?= $all_banners['Left side 3.json'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 4'][1] ?>"><img src="<?= $all_banners['Left side 4'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Left side 5'][1] ?>"><img src="<?= $all_banners['Left side 5'][0] ?>"
                                                                     alt="" class=""></a>
            </div>
        </div>
        <div style=" width: 70%; background-color: white; padding: 50px 0 50px 0">
            <div style="text-align: center;">
                <!--                <p style="font-size: 2.3em; font-weight: 500"> Investment market performance index</p>-->
                <h1 style="color: #536677"> Investment market performance index</h1>
                <p><?= $hyips ?> companies listed.</p>
            </div>
            <?php
            echo "<table id=\"myTable\" class=\"stripe row-border hover\">";
            echo "<thead>";
            echo "<tr>";
            echo "<th style=\" width: 30%\">Name</th>";
            echo "<th style=\" width: 30%\">URL</th>";
            echo "<th style=\" width: 10%\">Index</th>";
            echo "<th style=\" width: 10%\">Day</th>";
            echo "<th style=\" width: 10%\">Day %</th>";
            echo "<th style=\" width: 10%\">Details</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($today as $k => $v) {
                if (isset($v['change']) && $v['changep']) {
                    echo "<tr>";
                    echo "<td>" . $v['hyip'] . "</td>";
                    echo "<td ><a href=\"" . $k . "\">" . $k . "</a></td>";
                    echo "<td style=\"text-align: right\">" . $v['perf'] . "</td>";
                    if ($v['change'] > 0) {
                        echo "<td style=\"text-align: right; color: blue\">" . $v['change'] . "</td>";
                    } elseif ($v['change'] == 0) {
                        echo "<td style=\"text-align: right; color: green\">" . $v['change'] . "</td>";
                    } else {
                        echo "<td style=\"text-align: right; color: red\">" . $v['change'] . "</td>";
                    }

                    if ($v['changep'] > 0) {
                        echo "<td style=\"text-align: right; color: blue\">" . $v['changep'] . "</td>";
                    } elseif ($v['changep'] == 0) {
                        echo "<td style=\"text-align: right; color: green\">" . $v['changep'] . "</td>";
                    } else {
                        echo "<td style=\"text-align: right; color: red\">" . $v['changep'] . "</td>";
                    }
                    echo "<td style=\"text-align: right\"><a href=\"detail.php?u=" . urlencode($k) . "\">details</a></td>";
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
            ?>
            <div class="" style="text-align: center; margin: 5% 0 0 0">
                <a href="<?= $all_banners['Bottom'][1] ?>"><img src="<?= $all_banners['Bottom'][0] ?>"
                                                                alt="" class=""></a>
            </div>
        </div>
        <div style="width: 15%; background-color: white; padding: 15% 0 0 4%;">
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 1'][1] ?>"><img src="<?= $all_banners['Right side 1'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 2'][1] ?>"><img src="<?= $all_banners['Right side 2'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 3.json'][1] ?>"><img src="<?= $all_banners['Right side 3.json'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 4'][1] ?>"><img src="<?= $all_banners['Right side 4'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
            <div style="margin: 10px 0 10px 0">
                <a href="<?= $all_banners['Right side 5'][1] ?>"><img src="<?= $all_banners['Right side 5'][0] ?>"
                                                                      alt="" class=""></a>
            </div>
        </div>
    </div>

<?php
include 'footer.php';
