<?php
include '../validate/db.php';
include 'functions.php';

$user_id = "";
$username = "";
$password = "";
$first_name = "";
$last_name = "";
$role = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: show the data of the client 
    if (!isset($_GET["user_id"])) {
        header("../pages/admin-page.php");
        exit;
    }

    $user_id = $_GET["user_id"];

    // read the row of the selected client from the database table 
    $read = "SELECT * FROM account WHERE user_id=$user_id";
    $results = $conn->query($read);
    $row = $results->fetch_assoc();

    if (!$row) {
        header("../pages/admin-page.php");
        exit;
    }

    $username = $row["username"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $password = $row["password"];
    $status = $row['status_id'];
} else {
    // POST method: update the data off the client
    $change = "";
    $user_id = $_POST["user_id"];
    $username = $_POST['username'];
    $default_username = $_POST['default_username'];
    $new_username = "";
    if(!empty($username)){
        $new_username = $username;
    }
    else{
        $new_username = $default_username;
    }
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $status = $_POST['status_id'];

    if (!checkUsernameValidity($conn, $username)) {
        $_SESSION['registration_message'] = "Username Taken";
        session_write_close();
        header("Location: ../pages/admin-page.php");
    } else {
        $update = "UPDATE account
            SET first_name = '$first_name', last_name = '$last_name', username = '$new_username', status_id = '$status' WHERE user_id = $user_id";
        $results = $conn->query($update);
        if (!$results) {
            $_SESSION['registration_message'] = "Invalid Query: " . $conn->error;
            session_write_close();
        }
        $_SESSION['registration_message'] = "Details Updated";
        session_write_close();
        header("location: ../pages/admin-page.php");
    }
}
