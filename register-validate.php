<?php
    if(!isset($_POST['submit'])){
        header("Location: index.php");
    }

    $role_id = uniqid('2024-');
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO Users(`user_id`, `username`, `user_password`, `first_name`, `last_name`, `role_id`, `status_id`) VALUE 
    ({$role_id}, {$username}, {$password}, {$first_name}, {$last_name}, {$role_id}, 0, {$deposit});";

    if(mysqli_query($_SESSION['connect'], $query)){
       header("admin-page.php");
       $_SESSION['registration_message'] = "Account created"; 
    }else{
        header("register.php");
    }