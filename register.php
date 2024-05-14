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
<body>
    <form action = "register-validate.php" method = "POST">
        <input type = "text" name = "first_name" required>
        <label for = "first_name">First Name: </label><br>
        
        <input type = "text" name = "last_name" required>
        <label for = "last_name">Last Name:</label><br>

        <input type = "text" name = "username" required>
        <label for = "username">Username:</label><br>

        <input type = "text" name = "password" required>
        <label for = "password">Password:</label><br>

        <select name = "role" required>
            <option value = "1">Admin</option>
            <option value = "2">Staff</option>
            <option value = "3">User</option>
        </select>
        <label for = "role">Role:</label><br>

        <input type = "number" name = "deposit">
        <label for = "deposite">Initial hours</label><br>

        <input type = "submit" value = "Confirm">
    </form>
</body>
</html>