<?php
session_start();

include '../validate/db.php';

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}
$username = $_GET['user_id'];

// read all row from the database table
$sql = "SELECT transactions.transaction_id as TransactionID, account.username AS Username, services.service_name as Services, transactions.hours_added AS Hours, transactions.amount AS Amount, transactions.date AS Date
FROM transactions 
JOIN account ON transactions.user_id = account.user_id 
JOIN services ON transactions.services_id = services.services_id
WHERE transactions.user_id = '$username'
ORDER BY transactions.date DESC";
$row_results = $conn->query($sql);
$username_result = $conn->query($sql);
$username = $username_result->fetch_column(1);

if (!$row_results || !$username_result) {
    die("Invalid query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "../style.css">
</head>
<body>
<div class="container mt-5">
    <h1 class='text-center'>Transactions</h1>;

        <h2 class="text-center mt-4">List of Transactions for <?php echo "(" . $username . ")";?></h2>
        <br>
        <table class="tablee">
            <tr>
                <th>Transaction ID</th>
                <th>Username</th>
                <th>Service</th>
                <th>Hours</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <?php
            

            while ($row = $row_results->fetch_assoc()) {
                echo " <tr>
                        <td>$row[TransactionID]</td>
                        <td>$row[Username]</td>
                        <td>$row[Services]</td>
                        <td>$row[Hours]</td>
                        <td>$row[Amount]</td>
                        <td>$row[Date]</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <form action="admin-page.php" method="POST">
                <input type="submit" name="register" class="button" value="Done">
            </form>
        </div>
    </div>
</body>
</html>