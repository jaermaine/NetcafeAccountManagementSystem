<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "stylesheet" href = "style.css">
</head>
    <div class = "box">

    </div>

    <div class = "icon">
        <img src = "frontend\profile.png" alt = "ICON">
    </div>

    <div class = "Login">
        <form action = "login-validate.php" method = "POST">
            <input type = "text" id = "Uname" name = "username" placeholder = "Username" required><br>

            <input type = "password" id = "Pass" name = "password" placeholder = "Username" required><br>
            <?php
                if(!empty($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
            ?>
            <input type = "submit" class = "button-30" name = "submit" value = "Login">
        </form>
    </div>
</body>
</html>

<?php
    session_destroy();
?>