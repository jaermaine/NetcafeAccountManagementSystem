<?php
    session_start();

    if(!isset($_SESSION['role'])) {
        header('index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <?php
        echo "<h1>Welcome back " . $_SESSION['username'] . "</h1>";
    ?>
    
    <form action = "register.php" method = "POST">
        <input type = "submit" value = "Create">
    </form>

    <form action = "logout-validate.php" method = "POST">
        <input type = "submit" value = "Logout">
    </form>
</body>
</html>