<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}

include '../validate/db.php';
$_SESSION['start_time'] = time();

$id = $_SESSION['user_id'];
$query = "SELECT * FROM account WHERE user_id = '$id'";
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
                window.location = "../validate/logout-validate.php";
            }
        }, 10000);
    </script>

</head>

<body>
    <div class="container mt-5">
        <?php
        echo "<h1 class = 'text-center'>Welcome back " . $_SESSION['username'] . "</h1>";
        ?>

        <table class="tablee">
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Remaining Time (Hours)</th>
            </tr>

            <?php
            $original_time = number_format(($_SESSION['original_time'] / 3600));
            echo " <tr>
                        <td>$row[username]</td>
                        <td>$row[first_name]</td>
                        <td>$row[last_name]</td>
                        <td>$original_time</td>
                    </tr>";
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