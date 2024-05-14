<?php
    session_start();

    include 'db.php';

    if(!isset($_POST['submit'])){
        header("Location: /NetcafeAccountManagementSystem/index.php");
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO users(`username`, `user_password`, `first_name`, `last_name`, `role_id`, `status_id`, `remaining_hours`) VALUE 
    ('{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$role_id}', 0, '{$deposit}');";

    if(mysqli_query($conn, $query)){
       header("Location: /NetcafeAccountManagementSystem/admin-page.php");
       $_SESSION['registration_message'] = "Account created"; 
    }else{
        header("Location: /NetcafeAccountManagementSystem/register.php");
    }