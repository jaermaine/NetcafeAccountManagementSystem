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
    $pass = $_POST["password"];

    //fix this part of the code
    $query = "SELECT `username`, `user_password`, `role_id` FROM `users`";
    $query_result = mysqli_query($conn, $query);

    $details = mysqli_fetch_assoc($query_result);

    if($user != $details["username"]){
        echo "Username not found";
    }else{
        if($pass != $details["user_password"]){
            echo "Incorrect password";
        }else{
            switch($details["role_id"]){
                case 1:
                    echo "<script>window.location = 'admin-page' </script>";
                case 2:
                    echo "<script>window.location = 'staff-page' </script>";
                case 3:
                    echo "<script>window.location = 'user-page' </script>";
            }   
        }
    }
?>