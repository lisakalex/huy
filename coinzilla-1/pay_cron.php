<?php
include(__DIR__ . '/a.php');

echo "cron ";
//print_r(get_defined_vars());
//test_cron($_SERVER ['SCRIPT_NAME'], $link);
//phpinfo();
//var_dump($_SERVER);

$rate = get_rate();
$trans = array();

$pending = "pending";
$link = get_link();
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT cus_id, banner_id, usd, btc, address, start_date FROM trans WHERE payment=?')) {
    mysqli_stmt_bind_param($stmt, "s", $pending);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cus_id, $banner_id, $usd, $btc, $address, $start_date);

    while (mysqli_stmt_fetch($stmt)) {
        $trans[] = array('cus_id' => $cus_id, 'banner_id' => $banner_id, 'usd' => $usd, 'btc' => $btc, 'address' => $address, 'start_date' => $start_date);
    }
}

foreach ($trans as $tran) {
    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM customer WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $tran['cus_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_email);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if (get_transaction_status($tran['address']) > 0) {
        $btc_paid = get_transaction_status($tran['address']);
        if ($btc_paid >= $tran['btc']) {
            $payment = "complete";
            $link = get_link();
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET usd_paid=?, btc_paid=?,  payment=? WHERE address=?')) {
                mysqli_stmt_bind_param($stmt, "ddss", $tran['usd'], $btc_paid, $payment, $tran['address']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            $subject = "Payment confirmed";
            $from_user = "cron department";
            $from_email = "cron@" . $_SERVER ['HTTP_HOST'];
            mail_utf8($user_email, $from_user, $from_email, $subject, PAYMENT_SUCCESSFUL);
        } else {
            $usd = $btc_paid * $rate;
            $link = get_link();
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET usd_paid=?, btc_paid=?  WHERE address=?')) {
                mysqli_stmt_bind_param($stmt, "dds", $usd, $btc_paid, $tran['address']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            $subject = "Payment not full confirmed";
            $from_user = "cron department";
            $from_email = "cron@" . $_SERVER ['HTTP_HOST'];
            mail_utf8($user_email, $from_user, $from_email, $subject, PAYMENT_UNSUCCESSFUL);
        }
    } else {
        $now = new DateTime('NOW');
        try {
            $start_date = new DateTime($tran['start_date']);
        } catch (Exception $e) {
        }
        $diff = $now->diff($start_date)->h;

        if ($diff >= 1) {
            $payment = "canceled";
            $link = get_link();
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, 'UPDATE trans SET payment=? WHERE address=?')) {
                mysqli_stmt_bind_param($stmt, "ss", $payment, $tran['address']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
}
