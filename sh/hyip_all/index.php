<?php
include(__DIR__.'/../a.php');

$datetime = new DateTime('NOW');
$datetime->modify('-6 days');
$htime = $datetime->format('Y-m-d');
$link = get_link();
$sql = "SELECT hyip, url, performance FROM graph1 WHERE htime=? AND performance > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hyip, $url, $performance);
    while (mysqli_stmt_fetch($stmt)) {
        $today[$url] = array('hyip' => $hyip, 'performance' => $performance);
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$link = get_link();
$sql = "SELECT SUM(performance) FROM graph1 WHERE htime=? AND performance > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $today_total);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

$datetime = new DateTime('NOW');
$datetime->modify('-7 days');
$htime = $datetime->format('Y-m-d');
$link = get_link();
$sql = "SELECT url, performance FROM graph1 WHERE htime=? AND performance > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $url, $performance);
    while (mysqli_stmt_fetch($stmt)) {
        $yesterday[$url] = $performance;
    }
    mysqli_close($link);
}

$link = get_link();
$sql = "SELECT SUM(performance) FROM graph1 WHERE htime=? AND performance > 0";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $htime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $yesterday_total);
    mysqli_stmt_fetch($stmt);
    mysqli_close($link);
}

$change_total = $today_total - $yesterday_total;
$change_totalp = $change_total / $yesterday_total;

$change_total = number_format($change_total, 2);
if ($change_total > 0) $change_total = "+" . $change_total;

$change_totalp = number_format($change_totalp, 2) . "%";
if ($change_totalp > 0) $change_totalp = "+" . $change_totalp;


foreach ($today as $k => $v) {
    $today_perf = $v['performance'];
    try {
        $yesterday_perf = $yesterday[$k];

    } catch (Exception $e) {

    }
    $change = $today_perf - $yesterday_perf;
    try {
        $changep = $change / $yesterday_perf;

    } catch (Exception $e) {

    }
    $change = number_format($change, 2);
    if ($change > 0) $change = "+" . $change;
    $changep = number_format($changep, 2) . "%";
    if ($changep > 0) $changep = "+" . $changep;

    $today[$k]['change'] = $change;
    $today[$k]['changep'] = $changep;
}
include 'header.php';
?>
    <div class="wrap__news">
        <section class="news">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="card dark">
                            <div class="card-body">
                                <h2>Stay Tuned With Investment market</h2>
                                <span class="line-bellow d-block"></span>
                                <a href="https://academy.Investment market.com" class="d-block dashed xs-general-color">Check
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
                                        <h4>How to Speed Up your WordPress Website to Keep Up with the Crypto World</h4>
                                        <div class="line-bellow d-block"></div>
                                        <div class="content">
                                            The cryptocurrency industry is faster than you think, and web publishers
                                            need to
                                            keep up with it.&nbsp;
                                            CMS platforms(Content Management Platform) ...
                                        </div>
                                        <div class="clearfix">
                                            <div class="left"><span
                                                        class="placeholder placeholder-news">14th of May 2021</span>
                                            </div>
                                            <div class="right"><a
                                                        href="https://academy.Investment market.com/how-to-speed-up-your-wordpress-site/"
                                                        class="dashed action underlined">Read the full story &xrarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 slider-item">
                                <div class="day">
                                    <div class="card-body">
                                        <h4>Is Dogecoin a Good Investment? How does it work?</h4>
                                        <div class="line-bellow d-block"></div>
                                        <div class="content">
                                            Dogecoin is the most popular and quite the most successful meme
                                            cryptocurrency
                                            out there. In fact, it is so popular we can&#8217;t help but constantly...
                                        </div>
                                        <div class="clearfix">
                                            <div class="left"><span
                                                        class="placeholder placeholder-news">27th of April 2021</span>
                                            </div>
                                            <div class="right"><a
                                                        href="https://academy.Investment market.com/is-dogecoin-a-good-investment/"
                                                        class="dashed action underlined">Read the full story &xrarr;</a>
                                            </div>
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
    <hr style="margin: 0 0 0 0;">
    <div class="wrap__news" style="display: flex; flex-direction: row; ">

        <div style=" width: 15%; background-color: white">
            da
        </div>
        <div style=" width: 70%; background-color: white; padding: 50px 0 50px 0">
            <div style="text-align: center;">
                <p style="font-size: 2.3em; font-weight: 500"> HYIP performance index</p>
                <p><?= $hyips ?> companies listed, total <?= $today_total ?> day change <?= $change_total ?> bbb <?= $change_totalp ?> </p>
            </div>
            <table id="myTable" class="stripe row-border hover">
                <thead>
                <tr>
                    <th style=" width: 35%">Name</th>
                    <th style=" width: 35%">URL</th>
                    <th style=" width: 15%">Index</th>
                    <th style=" width: 15%">Day change</th>
                    <th style=" width: 15%">Details</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($today as $k => $v) { ?>
                    <tr>
                        <td><?= $v['hyip'] ?></td>
                        <td><?= $k ?></td>
                        <td style="text-align: right"><?= $v['performance'] ?></td>
                        <?php
                        if ($v['change'] > 0) { ?>
                            <td style="text-align: right; color: blue"><?= $v['change'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $v['changep'] ?></td>

                            <?php
                        } elseif ($v['change'] == 0) {
                            ?>
                            <td style="text-align: right; color: green"><?= $v['change'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $v['changep'] ?></td>

                            <?php
                        } else { ?>
                            <td style="text-align: right; color: red"><?= $v['change'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $v['changep'] ?></td>
                            <?php
                        }
                        ?>
                        <td style="text-align: right">details</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div style=" width: 15%; background-color: white">
            da
        </div>
    </div>

<?php
include 'footer.php';
