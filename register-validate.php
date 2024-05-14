<?php
    session_start();

    include 'db.php';

    if(!isset($_POST['submit'])){
        header("Location: index.php");
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO users(`user_id`, `username`, `user_password`, `first_name`, `last_name`, `role_id`, `status_id`, `remaining_hours`) VALUE 
    ({114}, {$username}, {$password}, {$first_name}, {$last_name}, {$role_id}, 0, {$deposit});";

    if(mysqli_query($conn, $query)){
       header("admin-page.php");
       $_SESSION['registration_message'] = "Account created"; 
    }else{
        header("register.php");
    }