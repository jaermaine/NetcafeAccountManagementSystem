<?php
    $role_id = uniqid('2024-');
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO Users(`user_id`, `username`, `user_password`, `first_name`, `last_name`, `role_id`, `status_id`) VALUE 
    ({$role_id}, {$username}, {$password}, {$first_name}, {$last_name}, {$role_id}, 0, {$deposit});";

    if(mysqli_query($conn, $query)){

    }