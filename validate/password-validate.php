<?php
    session_start();

    include 'db.php';

    if (empty($_SESSION['login'])) {
        header('Location: ../index.php');
        session_destroy();
    }

    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $retyped_password = $_POST['retyped_password'];

    if($password != $retyped_password){
        $_SESSION['registration_message'] = "Password Does Not Match";
        header("Location: ../pages/admin-page.php");
        exit;
    }

    $new_password = password_hash($password, PASSWORD_DEFAULT);

    $password_query = "UPDATE account set `password` = '$new_password' WHERE user_id = '$user_id'";
    $password_change = $conn->query($password_query);

    $_SESSION['registration_message'] = "Password Changed";
    header("Location: ../pages/admin-page.php");
?>