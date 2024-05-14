<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "netcafe";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$_SESSION['connect'] = $conn;

if(!$conn){
    die("Connection Failed " . mysqli_connect_error());
}

?>