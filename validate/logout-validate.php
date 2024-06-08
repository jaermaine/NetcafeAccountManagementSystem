<?php
    include 'db.php';
    session_start();

    if(!isset($_POST['logout'])){
        header("Location: ../index.php");
    }
    $user = $_POST['user_id'];

    if($_SESSION['role']){
        $remaining_time = $_SESSION['original_time'] - (time() - $_SESSION['time_start']); 
        $update_time = "UPDATE account SET time = '$remaining_time' WHERE user_id = '$user'";
        $conn->query($update_time);
    }

    $active_user = "UPDATE account SET active = 0 WHERE user_id = '$user'";
    $conn->query($active_user);

    header("Location: ../index.php");
    session_unset();
    session_destroy();
?>