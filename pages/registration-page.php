<?php
    if(!isset($_POST['register'])){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel = "stylesheet" href = "..\style.css">
</head>
<body>
    
    <form action = "<?php echo $_SERVER['HTTP_REFERER'];?>" method = "POST">
        <input type = "submit" class = "button-31" name = "back" value = "Back">
    </form>

    <form action = "..\validate\register-validate.php" method = "POST">
    <div class = "box">

    </div>
        <div class = "fname"><br>
        <input type = "text" id = "Uname" name = "first_name" placeholder="First Name" required><br>
        <br></div>
        
        <div class = "lname"><br>
        <input type = "text" id = "Uname" name = "last_name" placeholder="Last Name"required><br>
        <br></div>

        <div class = "uname"><br>
        <input type = "text" id = "Uname" name = "username" placeholder="Username"><br>
        <br></div>

        <div class = "pass"><br>
        <input type = "text" id = "Uname" name = "password" placeholder="Password"required><br>
        <br></div>

        <div class = "role">
        <label for = "role">Role:</label>
        <select name = "role" id = "Role" required>
            <option value = "1">Admin</option>
            <option value = "2">Staff</option>
            <option value = "3">User</option>
        </select><br>
        </div>

        <div class = "status">
        <label for = "status">Status:</label>
        <select name = "status" id = "Status" required>
            <option value = "1">Regular</option>
            <option value = "2">VIP</option>
            <option value = "3">Non-Customer</option>
        </select><br>
        </div>

        <div class = "deposit">
        <label for = "deposit">Initial hours</label>
        <input type = "number" name = "deposit"><br>
        </div>

        <input type = "submit" class = "button-30" name = "submit" value = "Confirm">
    </form>
</body>
</html>
