<?php
$now = new DateTime('NOW');
$huy = $now->format("m-d-Y H:i:s");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IM+Fell+English">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Mukta+Malar" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Cormorant Unicase" rel="stylesheet">


    <!--<link href="https://fonts.googleapis.com/css?family=Philosopher|Abhaya+Libre|Aclonica|Alice|Averia+Serif+Libre|Cormorant+Infant|Cormorant+Unicase|Delius|Delius+Swash+Caps|Forum|Gilda+Display|Gruppo|Italiana|Judson|Katibeh|Kurale|Laila|Lustria|Marmelad|Nixie+One|Overlock|Quando|Ruluko|Sorts+Mill+Goudy|Syncopate|Unna" rel="stylesheet">-->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            display: table;
        }

        .centered-text {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            font-size: 6cm;
            font-weight: bold;
            color: #ff9900;

            /*                    font-family: 'Alice', serif;
                                font-family: 'Marmelad', sans-serif;
                                font-family: 'Syncopate', sans-serif;
                                font-family: 'Lustria', serif;
                                font-family: 'Overlock', cursive;
                                font-family: 'Unna', serif;
                                font-family: 'Nixie One', cursive;
                                font-family: 'Kurale', serif;
                                font-family: 'Aclonica', sans-serif;
                                font-family: 'Gilda Display', serif;
                                font-family: 'Quando', serif;
                                font-family: 'Delius', cursive;
                                font-family: 'Judson', serif;
                                font-family: 'Abhaya Libre', serif;
                                font-family: 'Averia Serif Libre', cursive;
                                font-family: 'Gruppo', cursive;
                                font-family: 'Delius Swash Caps', cursive;
                                font-family: 'Katibeh', cursive;
                                font-family: 'Italiana', serif;
                                font-family: 'Cormorant Infant', serif;
                                font-family: 'Laila', serif;
                                font-family: 'Ruluko', sans-serif;*/
            font-family: 'Cormorant Unicase', serif;
        }

        .da {
            font-size: 0.5em;
        }

    </style>
</head>
<body>
<div class="da">
    kuku da d
</div>
<div class="da">
    kuku da d
</div>
<div class="da">
    kuku da d
</div>
<div class="da">
    kuku da d
</div>
<div class="centered-text">
    <?= $huy ?>
</div>
</body>
</html>