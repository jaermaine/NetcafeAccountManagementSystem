<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
}

include '../validate/db.php';
$_SESSION['start_time'] = time();

$id = $_SESSION['user_id'];
$query = "SELECT time FROM account WHERE user_id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$_SESSION['original_time'] = $row['time'];

$time_end = $_SESSION['original_time'] + $_SESSION['start_time'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="..\style.css">
    <script>
        setInterval(function() {
            var end_time = <?php echo $time_end; ?>;
            var current_time = Math.floor(Date.now() / 1000);

            if (current_time >= end_time) {
                console.log("Time End");
                window.location = "../validate/logout-validate.php";
            } else {
                console.log("Time still going");
            }
        }, 10000);
    </script>

</head>

<body>
    <div class="container mt-5">
        <?php
        echo "<h1 class = 'text-center'>Welcome back " . $_SESSION['username'] . "</h1>";
        ?>

        <div class="text-center mt-4">
            <form action="..\validate\logout-validate.php" method="POST">
                <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                <input type="submit" class="button" value="logout">
            </form>
        </div>
    </div>
</body>

</html>