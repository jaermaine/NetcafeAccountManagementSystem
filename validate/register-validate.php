<?php
session_start();

include 'db.php';
include 'functions.php';

/*if (!isset($_POST['submit'])) {
    header("Location: ../index.php");
}*/

if (!checkUsernameValidity($conn, $_POST['username'])) {
    header("Location: ../pages/admin-page.php");
    $_SESSION['registration_message'] = "Username Taken";
} else {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $role = $_POST['role'];
    $status = $_POST['status'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO account(`first_name`, `last_name`, `username`, `password`, `time`, `role_id`, `status_id`) VALUE 
    ('{$first_name}', '{$last_name}', '{$username}', '{$password}', '{$deposit}', '{$role}', '{$status}');";


    $username_check_query = $conn->query($query);

    if (!$username_check_query) {
        header("Location: ../pages/registration-page.php");
    }

    header("Location: ../pages/admin-page.php");
    $_SESSION['registration_message'] = "Account created";
}
