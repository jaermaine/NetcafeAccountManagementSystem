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
    <title>Staff</title>
</head>
<body>
    <?php
        echo "<h1>Welcome back " . $_SESSION['username'] . "</h1>";
    ?>
    
    <form action = "..\validate\logout-validate.php" method = "POST">
        <input type = "submit" value = "Logout">
    </form>
    
</body>
</html>