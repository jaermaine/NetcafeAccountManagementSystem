<?php
session_start();

if (!isset($_SESSION['login'])) {
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
            <form action="..\validate\modify-validate.php" method="POST">
                <div class="Login">
                    <div class="TextFields1">
                        <input type="text" id="Uname" name="user_id" value=<?php echo $user_id; ?> hidden>
                        <input type="text" id="Uname" name="status_id" value=<?php echo $status; ?> hidden>

                        <input type="text" id="Uname" name="first_name" value="<?php echo $first_name ?>" required><br>
                        <br>

                        <input type="text" id="Uname" name="last_name" value="<?php echo $last_name ?>" required><br>
                        <br>

                        <input type="text" id="Uname" name="username" placeholder="<?php echo $username ?>" value = ""><br>
                        <br>

                        <input type="text" id="Uname" name="default_username" value="<?php echo $username ?>" hidden>
                        <br>
                    </div>

                    <div class="statusaccount">
                        <input name="status" type="radio" id="normal" class="statusaccount__input" value="1">
                        <label for="normal" class="statusaccount__label">Normal</label>
                        <input name="status" type="radio" id="vip" class="statusaccount__input" value="2">
                        <label for="vip" class="statusaccount__label">VIP</label>
                        <input name="status" type="radio" id="non-customer" class="statusaccount__input"  <?php if ($status != '3') : ?> disabled checked<?php endif; ?> value="3">
                        <label for="non-customer" class="statusaccount__label">Non-Customer</label>
                    </div>
                    <br>


                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <form action="../pages/modify-password.php" method="POST">
                <input type="text" id="Uname" name="user_id" value=<?php echo $user_id; ?> hidden>
                <input type="submit" class="button" name="Change" value="Change Password">
            </form>

            <form action="../pages/admin-page.php" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>


    </div>
</body>

</html>