<?php
    if(!isset($_POST['register'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = "validate\register-validate.php" method = "POST">
        <label for = "first_name">First Name: </label>
        <input type = "text" name = "first_name" required><br>
        
        <label for = "last_name">Last Name:</label>
        <input type = "text" name = "last_name" required><br>

        <label for = "username">Username:</label>
        <input type = "text" name = "username" required><br>

        <label for = "password">Password:</label>
        <input type = "text" name = "password" required><br>

        <label for = "role">Role:</label>
        <select name = "role" required>
            <option value = "1">Admin</option>
            <option value = "2">Staff</option>
            <option value = "3">User</option>
        </select><br>

        <label for = "deposit">Initial hours</label>
        <input type = "number" name = "deposit"><br>

        <input type = "submit" name = "submit" value = "Confirm">
    </form>
</body>
</html>