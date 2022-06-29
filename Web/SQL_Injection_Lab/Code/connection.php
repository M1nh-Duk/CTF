<?php
    $host="localhost";
    $user="root";
    $pass="";
    $dbname="credentials";

    if (!$con = mysqli_connect($host,$user,$pass,$dbname)){
        die("Failed to connect !");
    }
?>