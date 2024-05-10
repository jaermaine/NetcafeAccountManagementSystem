<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <!-- Login Page -->

    <div>
        <form action = "login-validate.php" method = "POST">
            <label for = "username">Username: </label>
            <input type = "text" name = "username" required><br>

            <label for = "password">Password: </label>
            <input type = "password" name = "password" required><br>

            <input type = "submit" name = "submit" value = "Login">

            <a href = "register.php">Create an account</a>
        </form>
    </div>
</body>
</html>