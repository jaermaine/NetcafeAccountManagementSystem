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
    $username = isset($_POST['username']) ? $_POST['username'] : $_POST['default_username'];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $status = $_POST['status_id']; 

    if (!checkUsernameValidity($conn, $username)) {
        // updates details to the database
        echo "<script language = 'JavaScript'>
                            alert('Username Taken');
                            window.location = \"../pages/modification-page.php?user_id=$user_id\";
                            </script>";
        exit;
    } else {
        $update = "UPDATE account
            SET first_name = '$first_name', last_name = '$last_name', status_id = '$status' WHERE user_id = $user_id";
        $results = $conn->query($update);
        if (!$results) {
            echo "Invalid Query: " . $conn->error;
        }
        $_SESSION['registration_message'] = "Successfully updated user's details";
        header("location: ../pages/admin-page.php");
    }
}
