<?php
include(__DIR__.'/../a.php');

$datetime = new DateTime('NOW');
$datetime->modify('-1 days');
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

$datetime = new DateTime('NOW');
$datetime->modify('-2 days');
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sort a HTML Table Alphabetically</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

    <script type="text/javascript" src="ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div style=" width: 70%;">
    <h1> HYIP performance index <?= $hyips ?></h1>
    <table id="myTable" class="display">
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

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

</body>
</html>
