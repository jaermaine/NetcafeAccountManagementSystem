<?php
session_start();

include 'db.php';
include 'functions.php';

if (!isset($_POST['submit'])) {
    header("Location: ../index.php");
}

$usercheck_query = "SELECT COUNT(username) AS numrows FROM account WHERE username = '" . $_POST['username'] . "'";
$usercheck_result = mysqli_query($conn, $usercheck_query);
$usercheck_row = mysqli_fetch_assoc($usercheck_result);
if (checkUsername($conn, $_POST['username'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $status = $_POST['status'];
    $deposit = $_POST['deposit'];

    $query = "INSERT INTO account(`first_name`, `last_name`, `username`, `password`, `time`, `role_id`, `status_id`) VALUE 
    ('{$first_name}', '{$last_name}', '{$username}', '{$password}', '{$deposit}', '{$role}', '{$status}');";


    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/admin-page.php");
        $_SESSION['registration_message'] = "Account created";
    } else {
        header("Location:" . $_SESSION['referer']);
    }
}
