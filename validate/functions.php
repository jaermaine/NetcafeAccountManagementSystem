<?php

session_start();

//if (!isset($_POST['submit'])) header("Location: ../index.php");
//session_destroy();

function checkUsername($conn, $username)
{
    $usercheck_query = "SELECT COUNT(username) AS numrows FROM account WHERE username = '" . $username . "'";
    $usercheck_result = mysqli_query($conn, $usercheck_query);
    $usercheck_row = mysqli_fetch_assoc($usercheck_result);
    if ($usercheck_row['numrows'] == 1) {
        $_SESSION['registration_message'] = "Username taken";
        $_SESSION['register'] = 'Create';   header("Location: " . $_SESSION['referer']);
        return false;
    }else{
        return true;
    }
}
