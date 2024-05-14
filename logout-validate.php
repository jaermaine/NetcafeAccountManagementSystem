<?php

    if(!isset($_POST['submit'])){
        header("index.php");
    }

    header("Location: index.php");
    session_unset();
    session_destroy();
?>