<?php
    include 'db.php';

    if(!isset($_POST['logout'])){
        header("Location: ../index.php");
    }

    $user = $_POST['user_id'];

    $active_user = "UPDATE account SET active = 0 WHERE user_id = '$user'";
    $conn->query($active_user);

    header("Location: ../index.php");
    session_unset();
    session_destroy();
?>