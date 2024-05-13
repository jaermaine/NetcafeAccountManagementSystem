<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <!-- Login Page -->
    <h1>Login</h1>

    <div>
        <form action = "login-validate.php" method = "POST">
            <label for = "username">Username: </label>
            <input type = "text" name = "username" required><br>

            <label for = "password">Password: </label>
            <input type = "password" name = "password" required><br>
            <?php
                if(!empty($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
            ?>
            <input type = "submit" name = "submit" value = "Login">
        </form>
    </div>
</body>
</html>