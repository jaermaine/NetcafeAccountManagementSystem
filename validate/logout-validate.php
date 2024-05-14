<?php

    if(!isset($_POST['logout'])){
        header("Location: /NetcafeAccountManagementSystem/index.php");
    }

    header("Location: /NetcafeAccountManagementSystem/index.php");
    session_unset();
    session_destroy();
?>