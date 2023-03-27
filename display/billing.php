<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];

$bills = array();
$link = get_link();
//$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$sql = "SELECT trans.start_date, site, banner.banner_url, banner.banner_id, slot, days, banner.start_date, trans.usd_paid, trans.payment FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $cus_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $t_start_date, $site, $banner_url, $banner_id, $slot, $days, $b_start_date, $usd_paid, $payment,);
    while (mysqli_stmt_fetch($stmt)) {

        $bills[] = array('t_start_date' => $t_start_date, 'site' => $site, 'banner_url' => $banner_url, 'banner_id' => $banner_id, 'slot' => $slot, 'days' => $days, 'b_start_date' => $b_start_date, 'usd_paid' => $usd_paid, 'payment' => $payment);

    }
//    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

include(__DIR__ . '/header.php');

?>
    <div id="wrapperHandler" class="">
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card main-card">
                            <div class="card-header card-custom-mb">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link navigate active" href="#">Billing History</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <h2>Billing History</h2>
                                            Here you can find all your billing history
                                            <div class="line-bellow"></div>
                                            <div class="wrapper__body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div style=" width: 100%; background-color: white; padding: 50px 0 50px 0">
                                                                <?php
                                                                echo "<table id=\"myTable\" class=\"table-responsive stripe row-border hover\">";
                                                                echo "<thead>";
                                                                echo "<tr>";
                                                                echo "<th style=\" width: 12%\">Date</th>";
                                                                echo "<th style=\" width: 10%\">Site URL</th>";
                                                                echo "<th style=\" width: 10%\">Banner URL</th>";
                                                                echo "<th style=\" width: 15%\">Banner ID</th>";
                                                                echo "<th style=\"\">Slots</th>";
                                                                echo "<th style=\"\">Days</th>";
                                                                echo "<th style=\" width: 12%\">Start</th>";
                                                                echo "<th style=\" width: 10%\">USD</th>";
                                                                echo "<th style=\" width: 10%\">Status</th>";
                                                                echo "</tr>";
                                                                echo "</thead>";
                                                                echo "<tbody>";
                                                                if (count($bills) > 0) {
                                                                    foreach ($bills as $bill) {
                                                                        $t_start_date = new DateTime($bill['t_start_date']);
                                                                        $t_start_date = $t_start_date->format('d M Y');
                                                                        $b_start_date = new DateTime($bill['b_start_date']);
                                                                        $b_start_date = $b_start_date->format('d M Y');
                                                                        $site = substr($bill['site'], 0, 20) . "...";
                                                                        $banner_url = substr($bill['banner_url'], 0, 20) . "...";
                                                                        echo "<tr>";
                                                                        echo "<td>" . $t_start_date . "</td>";
                                                                        echo "<td><a class=\"\" href=\"".$bill['site']."\">" . $site . "</a></td>";
                                                                        echo "<td><a class=\"\" href=\"".$bill['banner_url']."\">" . $banner_url . "</a></td>";
                                                                        echo "<td>" . $bill['banner_id'] . "</td>";
                                                                        echo "<td>" . $bill['slot'] . "</td>";
                                                                        echo "<td>" . $bill['days'] . "</td>";
                                                                        echo "<td>" . $b_start_date . "</td>";
                                                                        echo "<td>" . $bill['usd_paid'] . "</td>";
                                                                        echo "<td>" . $bill['payment'] . "</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <div class="col-md-12 text-center"
                                                                         style="color: #c9c9c9">
                                                                        <strong class="display-1 mb-3 d-block">:(</strong>
                                                                        <h1 style="color: #c9c9c9">Your shopping cart is
                                                                            empty!</h1>
                                                                        <p><a href="/" class="navigate text-primary-v2"
                                                                              style="color: #ed893f">Browse our Listings
                                                                                ⟶ </a></p>
                                                                    </div>
                                                                <?php }

                                                                echo "</tbody>";
                                                                echo "</table>";
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>


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
<?php
include(__DIR__ . '/footer.php');
