<?php
include '../validate/db.php';

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
    $password = password_verify('', $row["password"]);
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $role = $row["role_id"];
    $status = $row['status_id'];

} else {
    // POST method: update the data off the client
    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $role = $_POST["role_id"];
    $status = $_POST['status_id'];

    // for finding if may same username sa database 
    $sql_u = "SELECT * FROM account WHERE username='$username'";
    $res_u = $conn->query($sql_u);
    $array = mysqli_fetch_assoc($res_u);

    if (mysqli_num_rows($res_u) > 0 && $username != $array['username']) {
        echo "Username already taken";
        header("Location: ../pages/modification-page.php");
    } else {
        // updates details to the database
        $update = "UPDATE account
            SET username = '$username', password = '$password', first_name = '$first_name', last_name = '$last_name', role_id = '$role' WHERE user_id = $user_id";
        $results = $conn->query($update);

        header("location: create.php");

        if (!$results) {
            echo "Invalid Query: " . $conn->error;
        }

        echo "Successfully updated user's details";

        header("location: ../pages/admin-page.php");

    }
}