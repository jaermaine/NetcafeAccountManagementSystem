<?php
session_start();

if (!isset($_POST['register'])) {
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
                    <div class="dropdown">
                        <div class="select" onclick="toggleDropdown()">
                            <span class="selected">Choose a Role</span>
                            <div class="caret"></div>
                        </div>
                        <ul class="menu">
                            <li><label><input type="radio" name="role" value="1" onclick="selectRole('Admin')">Admin</label></li>
                            <li><label><input type="radio" name="role" value="2" onclick="selectRole('Staff')">Staff</label></li>
                            <li><label><input type="radio" name="role" value="3" onclick="selectRole('User')" checked>User</label></li>
                        </ul>
                    </div>

                    <div class="statsAcc">
                        <div class="tabs">

                            <input type="radio" id="normal" name="status" class="statusaccount__input" value="1" checked>
                            <label class="statusaccount__label" for="normal">Normal</label>

                            <input type="radio" id="vip" name="status" class="statusaccount__input" value="2">
                            <label class="statusaccount__label" for="vip">VIP</label>

                            <input type="radio" id="non-customer" name="status" class="statusaccount__input" value="3">
                            <label class="statusaccount__label" for="non-customer">Non-Customer</label>

                            <span class="glider"></span>
                        </div>
                    </div>

                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <form action="../pages/admin-page.php" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>


    </div>
    <script>
        function toggleDropdown() {
            var dropdownMenu = document.querySelector('.dropdown .menu');
            dropdownMenu.classList.toggle('menu-open');

            var caret = document.querySelector('.dropdown .caret');
            caret.classList.toggle('caret-rotate');
        }

        function selectRole(role) {
            var selectedText = document.querySelector('.dropdown .selected');
            selectedText.textContent = role;

            toggleDropdown(); // Close the dropdown after selecting an option
        }
    </script>
</body>

</html>