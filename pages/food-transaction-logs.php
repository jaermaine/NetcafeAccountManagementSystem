<?php
session_start();

include '../validate/db.php';

if (!isset($_SESSION['login'])) {
    header("Location ../index.php");
}

// read all row from the database table
$sql = "SELECT food_transactions.food_transac_id AS TransactionID, 
               food_transactions.user_id AS UserID, 
               account.username AS Username, 
               foods.food_name AS Product, 
               food_transactions.quantity AS ProductQuantity, 
               food_transactions.amount AS Amount, 
               food_transactions.date AS Date
        FROM food_transactions 
        JOIN account ON food_transactions.user_id = account.user_id 
        JOIN foods ON food_transactions.food_id = foods.food_id
        ORDER BY food_transactions.date DESC";
        $row_results = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class='text-center'>Transactions</h1>;

        <table class="tablee">
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Product</th>
                <th>Product Quantity</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <?php


            while ($row = $row_results->fetch_assoc()) {
                echo " <tr>
                        <td>$row[TransactionID]</td>
                        <td>$row[UserID]</td>
                        <td>$row[Username]</td>
                        <td>$row[Product]</td>
                        <td>$row[ProductQuantity]</td>
                        <td>$row[Amount]</td>
                        <td>$row[Date]</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <form action="menu-page.php" method="POST">
                <input type="submit" name="done" class="button" value="Done">
            </form>
        </div>
    </div>
</body>

</html>