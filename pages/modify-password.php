<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}

$userid = $_POST['user_id'];
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

                        <input type="text" id="Uname" name="user_id" value=<?php echo $userid; ?> hidden>

                        <input type="password" id="Uname" name="password" placeholder="Change Password"><br>
                        <br>

                        <input type="password" id="Uname" name="retyped_password" placeholder="Re-type Password"><br>
                        <br>
                    </div>


                    <input type="submit" class="button" name="submit" value="Confirm">
            </form>

            <a class='button' href='../pages/modification-page.php?user_id=<?php echo $userid;?>'>Back</a>
        </div>


    </div>
</body>

</html>