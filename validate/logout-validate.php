<?php

    if(!isset($_POST['logout'])){
        header("Location: ../login.php");
    }

    header("Location: ../login.php");
    session_unset();
    session_destroy();
?>