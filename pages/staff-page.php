<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
}

include '../validate/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="..\style.css">
</head>
<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Center align the content */
        justify-content: flex-start;
        height: 100vh;
        background-color: #f0f0f0;
        margin: 0;
    }

    h1 {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .row {
        width: 75%;
        /* Ensure the row takes up 75% of the container width */
        display: flex;
        justify-content: space-between;
        /* Add space between the columns */
    }

    .card {
        display: flex;
        flex-direction: column;
        width: 100%;
        /* Make the card take up the full width of its container */
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: box-shadow 0.3s;
        text-decoration: none;
        color: inherit;
        margin-bottom: 20px;
        height: 450px;
        transition: transform 0.3s ease
    }

    .card img {
        width: 100%;
        /* Make the image take up the full width of the card */
        height: 366.38px;
    }

    .text-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: left;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: scale(1.09);
    }

    form {
        margin-top: 20px;
    }

    .services-image img {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 400px;
        border-radius: 10px;
    }

    .column {
        width: 48%;
        /* Make each column take up approximately half of the row */
    }
</style>

<body>
    <br><br>
    <?php
    echo "<h1>Welcome Back " . $_SESSION['username'] . "</h1>";
    ?>
    <br><br>
    <div class="row">
        <div class="column">
            <a href="../pages/computer-services-page.php" class="card">
                <div class="services-image"><img src="../frontend/computerservice.png" alt="Image"></div>
            </a> <!-- Closed the anchor tag here -->
        </div>

        <div class="column">
            <a href="../pages/menu-page.php" class="card">
                <div class="services-image"><img src="../frontend/foodorder.png" alt="Image"></div>
            </a> <!-- Closed the anchor tag here -->
        </div>
    </div>
    <br>
    <form action="..\validate\logout-validate.php" method="POST">
        <input type="submit" class="button" value="Logout">
    </form>

</body>

</html>