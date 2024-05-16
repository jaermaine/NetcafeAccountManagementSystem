<?php

    if(!isset($_POST['logout'])){
        header("Location: /NetcafeAccountManagementSystem/login.php");
    }

    header("Location: /NetcafeAccountManagementSystem/login.php");
    session_unset();
    session_destroy();
?>