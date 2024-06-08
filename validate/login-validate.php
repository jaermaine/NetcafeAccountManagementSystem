<?php
    session_start();

    if(!isset($_POST['submit'])){
        session_destroy();
        session_unset();
        header("Location: ../index.php");   
    }

    include 'db.php';

    $user = $_POST["username"];
    $pass = $_POST["password"];

    $query = "SELECT `user_id`, `username`, `password`, `role_id`, `time` FROM `account` WHERE `username` = '{$user}'";
    $active_user = "UPDATE account SET active = 1 WHERE username = '$user'";
    $query_result = mysqli_query($conn, $query);

    $details = mysqli_fetch_assoc($query_result);

    if($details['role_id'] == 3 && $details['time'] <= 0){
        session_destroy();
        session_unset();
        header("Location: ../index.php");   
    }

    $username = $user == $details['username'] ? true : false;
    $password = password_verify($pass, $details['password']);
    
    if (!$username || !$password){
        $_SESSION['message'] = "Login Failed";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else{
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $details['user_id'];
        $_SESSION['login'] = true;
        $_SESSION['role'] = $details["role_id"];
        $conn->query($active_user);
 
        switch($details["role_id"]){
        case 1:
            echo "<script>window.location = '../pages/admin-page.php' </script>";
        case 2:
            echo "<script>window.location = '../pages/staff-page.php' </script>";
        case 3:
            echo "<script>window.location = '../pages/user-page.php' </script>";
        }
    }
?>