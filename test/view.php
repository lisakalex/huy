<?php

$con = mysqli_connect("localhost","al","111","my_school");

if (mysqli_connect_errno()){
    echo mysqli_error($con);
    exit();
}


$sql = "select * from students" ;

if (!$result=mysqli_query($con, $sql)){
    echo mysqli_error($con);
}

else {

    $row = mysqli_fetch_array($result);

    header('Content-type: image/jpeg');

    echo $row["photo"];

}

mysqli_close($con);

?>