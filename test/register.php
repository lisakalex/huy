<?php

$con = mysqli_connect("localhost","al","111","my_school");

if (mysqli_connect_errno())
{
    echo mysqli_error($con);
    exit();
}

$imgbinarydata = mysqli_real_escape_string($con, file_get_contents("/var/www/html/test/czechhyipmonitor.cz.png" ));

$sql= "INSERT INTO students (student_name, photo) VALUES ('JOHN DOE','$imgbinarydata')";

if (!mysqli_query($con,$sql)){
    echo mysqli_error($con);
}

else {

    echo "Record inserted successfully";

}

mysqli_close($con);

?>