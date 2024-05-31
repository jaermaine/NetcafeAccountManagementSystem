<?php

    if(!isset($_POST['logout'])){
        header("Location: ../index.php");
    }

    header("Location: ../index.php");
    session_unset();
    session_destroy();
?>