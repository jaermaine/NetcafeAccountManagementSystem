<?php
    if(!isset($_POST['register'])){
        header("Location: /NetcafeAccountManagementSystem/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <div class = "box">

    </div>
    
    <form action = "validate\register-validate.php" method = "POST">
        <div class = "fname">
        <input type = "text" name = "first_name" placeholder="First Name" required><br>
        </div>
        
        <div class = "lname">
        <input type = "text" name = "last_name" placeholder="Last Name"required><br>
        </div>

        <div class = "uname">
        <input type = "text" name = "username" placeholder="Username"><br>
        </div>

        <div class = "pass">
        <input type = "text" name = "password" placeholder="Password"required><br>
        </div>

        <div class = "role">
        <label for = "role">Role:</label>
        <select name = "role" required>
            <option value = "1">Admin</option>
            <option value = "2">Staff</option>
            <option value = "3">User</option>
        </select><br>
        </div>

        <div class = "deposit">
        <input type = "number" name = "deposit"><br>
        </div>

        <input type = "submit" class = "button-30" name = "submit" value = "Confirm">
    </form>
</body>
</html>