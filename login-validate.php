<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "netcafe";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed" . mysqli_connect_error());
?>