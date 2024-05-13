<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "netcafe";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection Failed " . mysqli_connect_error());
    }

    $user = $_POST["username"];
    $pass = $_POST["password"];

    $_SESSION['username'] = $user;

    $query = "SELECT `username`, `user_password`, `role_id` FROM `users`";
    $query_result = mysqli_query($conn, $query);

    $details = mysqli_fetch_assoc($query_result);

    if($user != $details["username"]){
        $_SESSION['message'] = "Username not found";
        header($_SERVER['HTTP_REFERER']);
    }
    
    if ($pass != $details["user_password"]){
        $_SESSION['message'] = "Incorrect Password";
        header($_SERVER['HTTP_REFERER']);
    }else{
        switch($details["role_id"]){
        case 1:
            echo "<script>window.location = 'admin-page.php' </script>";
        case 2:
            echo "<script>window.location = 'staff-page.php' </script>";
        case 3:
            echo "<script>window.location = 'user-page.php' </script>";
        }
    }

    //implement a session and store the username to a session global variable to display on the home page
    //have a set of seconds before switching to the home page 
?>