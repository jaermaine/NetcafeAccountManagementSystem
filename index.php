<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<form action="validate\login-validate.php" method="POST">
    <div class="parent">
        <div class="child">
            <div class="Login">
                <div class="LogoImage">
                <img src="frontend/profile.png" alt="Profile" class="profile"></div>
                <input type="text" id="Uname" name="username" placeholder="Username" required><br>

                <input type="password" id="Pass" name="password" placeholder="Password" required><br>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
                <input type="submit" class="button" name="submit" value="Login">
            </div>
        </div>
    </div>
</form>




</body>

</html>

<?php
session_destroy();
?>