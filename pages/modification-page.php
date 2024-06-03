<?php

if (!isset($_GET['user_id'])) {
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
    <link rel="stylesheet" href="..\style.css">
</head>

<body>

    <div class="parent">
        <div class="child">
            <form action="..\validate\register-validate.php" method="POST">
                <div class="Login">
                    <div class="TextFields1">
                    <input type="text" id="Uname" name="first_name" placeholder="First Name" value="<?php echo $first_name ?>" required><br>
                    <br>

                    <input type="text" id="Uname" name="last_name" placeholder="Last Name" value="<?php echo $last_name ?>" required><br>
                    <br>

                    <input type="text" id="Uname" name="username" placeholder="Username" value="<?php echo $username ?>" required><br>
                    <br>

                    <input type="text" id="Uname" name="password" placeholder="Change Password"><br>
                    <br>
                    </div>

                    <div class="role-dropdown">
                        <details class="dropdown">
                            <summary role="button" aria-haspopup="true">Choose A Role</summary>
                            <ul>
                                <li><label><input type="radio" name="role" <?php if ($role != '1') : ?> disabled<?php endif; ?> value="1">Admin</label></li>
                                <li><label><input type="radio" name="role" <?php if ($role != '2') : ?> disabled<?php endif; ?> value="2">Staff</label></li>
                                <li><label><input type="radio" name="role" <?php if ($role != '3') : ?> disabled<?php endif; ?> value="3" checked>User</label></li>
                            </ul>
                        </details>
                    </div><br>

                    <div class="statusaccount">
                        <input name="status" type="radio" id="normal" class="statusaccount__input" <?php if ($status != '1') : ?> disabled<?php endif; ?> value="1">
                        <label for="normal" class="statusaccount__label">Normal</label>
                        <input name="status" type="radio" id="vip" class="statusaccount__input" <?php if ($status != '2') : ?> disabled<?php endif; ?> value="2">
                        <label for="vip" class="statusaccount__label">VIP</label>
                        <input name="status" type="radio" id="non-customer" class="statusaccount__input" <?php if ($status != '3') : ?> disabled<?php endif; ?> value="3">
                        <label for="non-customer" class="statusaccount__label">Non-Customer</label>
                    </div>
                    <br>


                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <form action="<?php echo $_SESSION['referer']; ?>" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>


    </div>
</body>

</html>