<?php

    if(!isset($_GET['user_id'])){
        header("Location: ../index.php");
    }

    include '../validate/modify-validate.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!--<link rel = "stylesheet" href = "..\style.css">-->
</head>
<body>
    
    <form action = "<?php echo $_SERVER['HTTP_REFERER'];?>" method = "POST">
        <input type = "submit" class = "button-31" name = "back" value = "Back">
    </form>

    <form action = "../validate/modify-validate.php" method = "POST">
    <input type="hidden" value="<?php echo $user_id ?>" name="user_id">
    <div class = "box">

    </div>
    <div class = "fname"><br>
        <input type = "text" id = "Uname" name = "first_name" placeholder="First Name" value="<?php echo $first_name ?>" required><br>
        <br></div>
        
        <div class = "lname"><br>
        <input type = "text" id = "Uname" name = "last_name" placeholder="Last Name" value="<?php echo $last_name ?>"required><br>
        <br></div>

        <div class = "uname"><br>
        <input type = "text" id = "Uname" name = "username" placeholder="Username" value="<?php echo $username ?>" readonly><br>
        <br></div>

        <div class = "pass"><br>
        <input type = "text" id = "Uname" name = "password" placeholder="Password" value="<?php echo $password ?>"required><br>
        <br></div>

        <div class = "role">
        <label for = "role">Role:</label>
        <select name = "role_id" id = "Role">
            <option <?php if($role != '1'): ?> disabled<?php endif; ?> value = "1" >Admin</option>
            <option <?php if($role != '2'): ?> disabled<?php endif; ?> value = "2" >Staff</option>
            <option <?php if($role != '3'): ?> disabled<?php endif; ?> value = "3" >User</option>
        </select><br>
        </div>

        <div class = "status">
        <label for = "status">Status:</label>
        <select name = "status_id" id = "Status">
            <option <?php if($status != '1'): ?> disabled<?php endif; ?> value = "1" >Regular</option>
            <option <?php if($status != '2'): ?> disabled<?php endif; ?> value = "2" >VIP</option>
            <option <?php if($status != '3'): ?> disabled<?php endif; ?> value = "3" >Non-Customer</option>
        </select><br>
        </div>

        <input type = "submit" class = "button-30" name = "submit" value = "Confirm">
    </form>
</body>
</html>
