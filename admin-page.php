<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <?php
        echo "<h1>Welcome back " . $_SESSION['username'] . "</h1>";
    ?>
    
    <form action = "index.php" method = "POST">
        <input type = "submit" value = "Logout">
    </form>
</body>
</html>