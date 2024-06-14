<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
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
            <form action="..\validate\password-validate.php" method="POST">
                <div class="Login">
                    <div class="TextFields1">

                        <input type="text" id="Uname" name="user_id" value=<?php echo $_POST['user_id']; ?> hidden>

                        <input type="password" id="Uname" name="password" placeholder="Change Password" required><br>
                        <br>

                        <input type="password" id="Uname" name="retyped_password" placeholder="Re-type Password" required><br>
                        <br>
                    </div>


                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <form action="../pages/modification-page.php" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>


    </div>
</body>

</html>