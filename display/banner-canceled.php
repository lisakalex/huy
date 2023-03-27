<?php
include(__DIR__ . '/../a.php');

page_protect();
$cus_id = $_SESSION ['cus_id'];

$now = get_now();
$payment = "canceled";
$banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
        $banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
    }

    $hyips = mysqli_stmt_num_rows($stmt);
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
                                        <a class="nav-link navigate" href="banner-active.php">Active</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate" href="banner-scheduled.php">Scheduled</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate" href="banner-expired.php">Expired</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link navigate active" href="banner-canceled.php">Canceled</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-9 oder-mb-0">
                                            <h2>Canceled banners</h2>
                                            Here you can find all your canceled banners
                                            <div class="line-bellow"></div>
                                            <?php
                                            if (count($banners) > 0) {
                                                foreach ($banners as $banner) {
                                                    $firstday = new DateTime($banner['start_date']);
                                                    $firstday = $firstday->format('d M Y');

                                                    $lastday = new DateTime($banner['start_date']);
                                                    $lastday->modify('+' . $banner['days'] - 1 . 'days');
                                                    $lastday = $lastday->format('d M Y');
                                                    ?>
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <!--                                                        <div class="" style="display: flex; flex-direction: row;">-->
                                                            <div class="display-flex"
                                                                 style="justify-content: space-between">
                                                                <div style="font-weight: 600;">
                                                                    <?= $banner['site'] ?>
                                                                </div>
                                                                <div>
                                                                    <?= $firstday . " - " . $lastday ?>
                                                                </div>
                                                                <div>
                                                                    <?= $banner_size[$banner['banner_id']] ?>
                                                                </div>
                                                                <div>
                                                                    <?= $banner['banner_id'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="line-bellow-small"></div>
                                                            <div class="me-align-center" style="padding-top: 1em">
                                                                <a href="<?= $banner['site'] ?>"><img
                                                                            src="<?= $banner['banner_url'] ?>"
                                                                            alt="" class=""></a>
                                                            </div>
                                                            <div class="row text-center insights no-border"
                                                                 style="justify-content: space-between">
                                                                <div class="col-md-3 col-sm-6 col-12">
                                                                    <span class="title">slots</span>
                                                                    <span class="value"><?= $banner['slot'] ?></span>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6 col-12">
                                                                    <span class="title">days total</span>
                                                                    <span class="value"><?= $banner['days'] ?></span>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6 col-12">
                                                                    <span class="title">days left</span>
                                                                    <span class="value">0</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-md-12 text-center" style="color: #c9c9c9">
                                                    <strong class="display-1 mb-3 d-block">:(</strong>
                                                    <h1 style="color: #c9c9c9">Your shopping cart is empty!</h1>
                                                    <p><a href="/" class="navigate text-primary-v2"
                                                          style="color: #ed893f">Browse our Listings ⟶ </a></p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(".balance").html("0.00");
        </script>
    </div>

<?php
include(__DIR__ . '/footer.php');
