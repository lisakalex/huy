<?php
include(__DIR__ . '/../a.php');
page_protect();
$cus_id = $_SESSION ['cus_id'];
$now = new DateTime('today');
$payment = "complete";
$banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if (($now >= $firstday) && ($now <= $lastday)) {
            $banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$active = count($banners);


$now = get_now();
$payment = "complete";
$expired_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if ($now > $lastday) {
            $expired_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$expired = count($expired_banners);


$now = get_now();
$payment = "complete";
$scheduled_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
//        $banners[] = array($cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
        try {
            $firstday = new DateTime($start_date);
            $lastday = new DateTime($start_date);
            $lastday->modify('+' . $days - 1 . 'days');
        } catch (Exception $e) {
        }

        if ($now < $firstday) {
            $scheduled_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
        }
    }
    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$scheduled = count($scheduled_banners);


$now = get_now();
$payment = "canceled";
$canceled_banners = array();
$link = get_link();
$sql = "SELECT banner.cus_id, banner.banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE banner.cus_id=? AND trans.payment=?";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "is", $cus_id, $payment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_url, $banner_id, $site, $slot, $days, $start_date);
    while (mysqli_stmt_fetch($stmt)) {
        $canceled_banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
    }

    $hyips = mysqli_stmt_num_rows($stmt);
    mysqli_close($link);
}

$canceled = count($canceled_banners);
include(__DIR__ . '/header.php');
?>
    <div id="wrapperHandler" class="">
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card main-card">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 no-padding oder-mb-1 delimiter-mb-top">
                                        <div class="card card-no-border">
                                            <div class="card-header">
                                                <ul class="nav nav-tabs card-header-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled pl-2"
                                                           href="https://display.Investment market.com/#">Account Summary</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="insight">
                                                    <span class="title">Banners</span>
                                                    <div class="line-bellow-small"></div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="placeholder">Active
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5"><strong class="badge badge-light d-block mb-2"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="bottom" title=""
                                                                                  data-original-title="Active Campaigns / Total Campaigns"><?= $active ?></strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="placeholder">Scheduled</div>
                                                    </div>
                                                    <div class="col-md-5"><strong
                                                                class="badge badge-light d-block mb-2"><?= $scheduled ?></strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="placeholder">Expired</div>
                                                    </div>
                                                    <div class="col-md-5"><strong class="badge badge-light d-block mb-2"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="bottom" title=""
                                                                                  data-original-title="Active Campaigns / Total Campaigns"><?= $expired ?></strong></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="placeholder">Canceled</div>
                                                    </div>
                                                    <div class="col-md-5"><strong class="badge badge-light d-block mb-2"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="bottom" title=""
                                                                                  data-original-title="Active Referred Users / Total Referred Users "><?= $canceled ?></strong>
                                                    </div>
                                                </div>
                                                <div class="card-header">
                                                    <ul class="nav nav-tabs card-header-tabs">
                                                        <li class="nav-item">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <strong>Profile Settings</strong>
                                                    <div class="line-bellow-small"></div>
                                                    <ul>
                                                        <li><a href="profile.php" class="navigate">My Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="change-password.php" class="navigate">Change Password</a>
                                                        </li>
                                                        <li>
                                                            <a href="delete-acc.php" class="navigate">Delete Account</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-header">
                                                    <ul class="nav nav-tabs card-header-tabs">
                                                        <li class="nav-item">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <strong>Billing Settings</strong>
                                                    <div class="line-bellow-small"></div>
                                                    <ul>
                                                        <li><a href="billing.php" class="navigate">Billing History</a></li>
                                                    </ul>
                                                </div>
                                                <div class="card-header">
                                                    <ul class="nav nav-tabs card-header-tabs">
                                                        <li class="nav-item">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <strong>Banners</strong>
                                                    <div class="line-bellow-small"></div>
                                                    <ul>
                                                        <li>
                                                            <a href="banner-active.php" class="navigate">Active</a>
                                                        </li>
                                                        <li>
                                                            <a href="banner-scheduled.php" class="navigate">Scheduled</a>
                                                        </li>
                                                        <li>
                                                            <a href="banner-expired.php" class="navigate">Expired</a>
                                                        </li>
                                                        <li>
                                                            <a href="banner-canceled.php" class="navigate">Canceled</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-no-border delimiter-mb-top">

                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-9 list-content oder-mb-0">
                                        <div class="wrapper">
                                            <div class="container-fluid no-m-padding">
                                                <p style="color: #F08B3E;">Welcome Al,</p>
                                                <h3>Your Account</h3>
                                                Active banners
                                                <div class="line-bellow"></div>
                                                <?php
                                                if (count($banners) > 0) {
                                                    foreach ($banners as $banner) {
                                                        $firstday = new DateTime($banner['start_date']);

                                                        $lastday = new DateTime($banner['start_date']);
                                                        $lastday->modify('+' . $banner['days'] - 1 . 'days');

                                                        $daysleft = $lastday;

                                                        if ($daysleft < $now) {
                                                            $daysleft = 0;
                                                        } else {
                                                            $daysleft = $now->diff($daysleft)->days;
                                                        }

                                                        $firstday = $firstday->format('d M Y');
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
                                                                        <span class="value"><?= $daysleft ?></span>
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
            </div>
        </section>
        <script>
            $(".balance").html("0.00");
        </script>
    </div>
<?php
include(__DIR__ . '/footer.php');
