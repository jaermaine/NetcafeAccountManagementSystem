<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header("Location: ../index.php");
    }

    include '../validate/db.php';
    $_SESSION['time_start'] = time();

    $id = $_SESSION['user_id'];
    $query = "SELECT time FROM account WHERE user_id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $_SESSION['original_time'] = $row['time'];

    $_SESSION['time_end'] = $_SESSION['original_time'] + $_SESSION['time_start'];

    if(time() > $_SESSION['time_end']) {
        // Session has ended
        session_destroy();
        header('Location: ../index.php'); // replace 'login.php' with your login page
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <?php
        echo "<h1>Welcome back " . $_SESSION['username'] . "</h1>";
    ?>
    
    <form action = "..\validate\logout-validate.php" method = "POST">
    <input type ="text" name = "user_id" value = "<?php echo $_SESSION['user_id']; ?>" hidden>
        <input type = "submit" value = "logout">
    </form>
</body>
</html>