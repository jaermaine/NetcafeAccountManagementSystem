<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        header('Location: index.php');
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

        if(isset($_SESSION['registration_message'])){
            echo $_SESSION['registration_message'];
        }
    ?>
    
    <form action = "registration-page.php" method = "POST">
        <input type = "submit" name = "register" value = "Create">
    </form>

    <form action = "validate\logout-validate.php" method = "POST">
        <input type = "submit" name = "logout" value = "Logout">
    </form>
</body>
</html>