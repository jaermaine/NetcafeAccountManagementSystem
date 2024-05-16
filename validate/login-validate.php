<?php
    session_start();

    if(!isset($_POST['submit'])){
        session_destroy();
        session_unset();
        header("Location: /NetcafeAccountManagementSystem/index.php");   
    }

    include 'db.php';

    $user = $_POST["username"];
    $pass = $_POST["password"];

    $_SESSION['username'] = $user;

    $query = "SELECT `username`, `user_password`, `role_id` FROM `users` WHERE `username` = '{$user}'";
    $query_result = mysqli_query($conn, $query);

    $details = mysqli_fetch_assoc($query_result);

    if($user != $details["username"]){
        $_SESSION['message'] = "Username not found";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    if ($pass != $details["user_password"]){
        $_SESSION['message'] = "Incorrect Password";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else{

        $_SESSION['login'] = true;
        $_SESSION['role'] = $details['role_id'];

        switch($details["role_id"]){
        case 1:
            echo "<script>window.location = '/pages/admin-page.php' </script>";
        case 2:
            echo "<script>window.location = '/pages/staff-page.php' </script>";
        case 3:
            echo "<script>window.location = '/pages/user-page.php' </script>";
        }
    }

    //implement a session and store the username to a session global variable to display on the home page
    //have a set of seconds before switching to the home page 
?>