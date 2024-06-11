<?php

/*if ( !isset($_GET['user_id']) && !isset($_POST['user_id']) ){
    header("Location: ../index.php");session_destroy();
}*/

function checkUsernameValidity($conn, $username)
{
    $usercount_query = "SELECT COUNT(username) AS numrows FROM account WHERE username = '" . $username . "'";
    $usercount_result = $conn->query($usercount_query);
    $usercount_row = $usercount_result->fetch_column(0);
    if ($usercount_row != null) {
        return false;
    }else{
        return true;
    }
}
