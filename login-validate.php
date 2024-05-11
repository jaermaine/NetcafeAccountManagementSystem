<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "netcafe";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection Failed " . mysqli_connect_error());
    }

    echo "Connection established";

    $user = $_POST["username"];

    $query = "SELECT `username` FROM `users` WHERE `username` = '". $user . "';";

    if(mysqli_query($conn, $query) == $user){
        echo "Username found";
    }else{
        echo "Username is located in the system";
    }
?>