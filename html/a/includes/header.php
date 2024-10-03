<!DOCTYPE html>
<html>
    <head>
        <title><?php echo 'Release Database - ' . $page_title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/sass/text.css" rel="stylesheet" type="text/css"/>
        <link href="/css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="../sass/grid.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.js" type="text/javascript"></script>
        <script>
            $( function() {

              $( "#datepicker" ).datepicker();

            } );
        </script>
        <script>
            $( function() {

              $( "#datepicker2" ).datepicker();

            } );
        </script>
        <script>
            $( function() {

              $( "#datepickerc" ).datepicker();

            } );
        </script>
        <script>
            $( function() {

              $( "#datepickerc2" ).datepicker();

            } );
        </script>
    </head>
    <body>
        <div class="dashboard-container">
            <div class="logo">
                <img src="images/logo.png" height="76" alt="TotalEnergies Gas & Power logo" />
            </div>
            <div class="dashboard-title">
                <h1>Release Database</h1>
            </div>
            <nav class="menu">
                <ul class="menu">
                <?php
                    if (strcmp($page_title, "Applications")) {
                        echo '<li><a href="index.php">Applications</a></li>';
                    } else {
                        echo '<li class="selected"><a href="index.php">Applications</a></li>';
                    }

                    if (strcmp($page_title, "Environments")) {
                        echo '<li><a href="environments.php">Environments</a></li>';
                    } else {
                        echo '<li class="selected"><a href="environments.php">Environments</a></li>';
                    }

                    if (strcmp($page_title, "Consolidated")) {
                        echo '<li><a href="consolidate.php">Consolidated</a></li></li>';
                    } else {
                        echo '<li class="selected"><a href="consolidate.php">Consolidated</a></li></li>';
                    }

                    if (strcmp($page_title, "Reporting")) {
                        echo '<li><a href="reporting.php">Reporting</a></li>';
                    } else {
                        echo '<li  class="selected"><a href="reporting.php">Reporting</a></li>';
                    }
                ?>
                </ul>
            </nav>
        