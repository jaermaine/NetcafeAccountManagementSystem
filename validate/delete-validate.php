<?php
session_start();
include '../validate/db.php';

$user_id = $_GET['user_id'];
$sql_u = "SELECT * FROM account WHERE user_id='$user_id'";
$res_u = mysqli_query($conn, $sql_u);
$array = mysqli_fetch_assoc($res_u);

if (isset($_GET['user_id']) && $array['username'] != $_SESSION['username']) {
    
    $delete = "DELETE FROM account WHERE user_id=$user_id";
    $conn->query($delete);

    header("location: ../pages/admin-page.php");
}

header("location: " . $_SERVER['HTTP_REFERER']);
?>