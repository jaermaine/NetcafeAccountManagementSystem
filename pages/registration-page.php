<?php
session_start();

if (!isset($_SESSION['register'])) {
    header("Location: ../index.php");
    session_destroy();
}
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
                        <input type="text" id="Uname" name="first_name" placeholder="First Name" required><br>
                        <br>

                        <input type="text" id="Uname" name="last_name" placeholder="Last Name" required><br>
                        <br>

                        <input type="text" id="Uname" name="username" placeholder="Username"><br>
                        <br>
                    </div>
                    <input type="password" id="Uname" name="password" placeholder="Password" required><br>
                    <br>

                    <div class="role-dropdown">
                        <details class="dropdown">
                            <summary role="button" aria-haspopup="true">Choose A Role</summary>
                            <ul>
                                <li><label><input type="radio" name="role" value="1">Admin</label></li>
                                <li><label><input type="radio" name="role" value="2">Staff</label></li>
                                <li><label><input type="radio" name="role" value="3" checked>User</label></li>
                            </ul>
                        </details>
                    </div><br>

                    <div class="statusaccount">
                        <input name="status" type="radio" id="normal" class="statusaccount__input" value="1" checked>
                        <label for="normal" class="statusaccount__label">Normal</label>
                        <input name="status" type="radio" id="vip" class="statusaccount__input" value="2">
                        <label for="vip" class="statusaccount__label">VIP</label>
                        <input name="status" type="radio" id="non-customer" class="statusaccount__input" value="3">
                        <label for="non-customer" class="statusaccount__label">Non-Customer</label>
                    </div>
                    <br>


                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <form action="../pages/admin-page.php" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>


    </div>

</body>

</html>