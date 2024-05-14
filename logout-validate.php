<?php

    if(!isset($_POST['submit'])){
        header("Location: index.php");
    }

    header("Location: index.php");
    session_unset();
    session_destroy();
?>