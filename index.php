<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <form action="validate/login-validate.php" method="POST">
        <div class="parent" data-aos="zoom-in-up" data-aos-delay="1000" class="form">
            <div class="child">
                <div class="Login">
                    <div class="LogoImage">
                        <img src="frontend/profile.png" alt="Profile" class="profile">
                    </div>
                    <input type="text" id="Uname" name="username" placeholder="Username" autocomplete="off" required><br>

                    <input type="password" id="Pass" name="password" placeholder="Password" autocomplete="off" required><br>
                    <?php
                    if (!empty($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                    ?>
                    <input type="submit" class="button" name="submit" value="Login">
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>

<?php
session_destroy();
?>