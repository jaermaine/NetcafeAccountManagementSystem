<?php
session_start();

include 'db.php';
include 'functions.php';

if (!isset($_POST['submit'])) {
    header("Location: ../index.php");
}

$cntuser_qry = "SELECT COUNT(*) as total FROM account";

$cntuser_rslt = mysqli_query($conn, $cntuser_qry);
if (mysqli_num_rows($cntuser_rslt) > 0) {
    while ($row = mysqli_fetch_assoc($cntuser_rslt)) {
        $total = $row["total"];
        $total = $total + 1;
        $counter = str_pad($total, 3, '0', STR_PAD_LEFT);
    }
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

    $query = "INSERT INTO account(`user_id`, `first_name`, `last_name`, `username`, `password`, `time`, `role_id`, `status_id`) VALUE 
    ('{$counter}', '{$first_name}', '{$last_name}', '{$username}', '{$password}', '{$deposit}', '{$role}', '{$status}');";


    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/admin-page.php");
        $_SESSION['registration_message'] = "Account created";
    } else {
        header("Location:" . $_SESSION['referer']);
    }
}
