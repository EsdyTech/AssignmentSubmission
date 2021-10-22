<?php
// $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_database)or die('Cannot open database');	
// $con=mysqli_connect("localhost", "id13019632_laspotechattendance", "PASS=word@2020", "id13019632_attendance");

$con=mysqli_connect("localhost", "root", "", "attendancemgtsys2");
if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error(); 
}

    // $con=mysqli_connect("localhost", "root", "", "attendancemgtsys");
    // if(mysqli_connect_errno()){
    // echo "Connection Fail".mysqli_connect_error();
    // }

?>
