<?php

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}

function checkUsernameValidity($conn, $username)
{
    $usercount_query = "SELECT COUNT(username) AS numrows FROM account WHERE username = '" . $username . "'";
    $usercount_result = $conn->query($usercount_query);
    $usercount_row = $usercount_result->fetch_column(0);
    if ($usercount_row != 0) {
        return false;
    } else {
        return true;
    }
}

function retrieveServices($conn)
{
    $services_query = "SELECT * FROM services";
    $services_result = $conn->query($services_query);
    $services_rows = $services_result->fetch_all();

    return $services_rows;
}

function validatePassword($conn, $password)
{
    if (strlen($password) < 6) {
        return false;
    }

    if (preg_match('/\s/', $password)) {
        return false;
    }

    $valid_characters = [
        'alpha' => '/[A-z]/',
        'numeral' => '/[0-9]/',
        'non_alphanumeric' => '/\W/'
    ];

    $valid_ctr = 0;
    foreach ($valid_characters as $key => $valid) {
        if (preg_match($valid, $password)) {
            $valid_ctr += 1;
        }
    }

    if($valid_ctr != 3){
        return false;
    }else{
        return true;
    }
}
