<?php
session_start();

include '../validate/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 80%;
            max-width: 800px;
        }

        h1,h3{
            font-family: monospace;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
    </style>
    <title>Receipt</title>
</head>

<body>
    <div class="main-container">
        <h1>Receipt</h1>
        <h3>Customer: <?php echo $_SESSION['customer']; ?></h3>
        <table>
            <tr>
                <th>Qty</th>
                <th>Product</th>
                <th>Type</th>
                <th>Price</th>
            </tr>
            <!-- php for table -->
            <?php
            if (isset($_SESSION['orderSummary'])) {
                foreach ($_SESSION['orderSummary'] as $item) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($item['qty']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['product']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['type']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['price']) . '</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<td colspan="3">Total</td>';
                echo '<td>' . htmlspecialchars($_SESSION['total']) . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <!-- php for inserting values into database -->
        <?php
        if (isset($_SESSION['orderSummary'])) {
            // Fetch user_id from the database based on username stored in session
            $customerTransaction = $_SESSION['customer'];
            $userQuery = "SELECT user_id FROM account WHERE username = '$customerTransaction'";
            $userResult = $conn->query($userQuery);

            if ($userResult->num_rows > 0) {
                $userRow = $userResult->fetch_assoc();
                $user_id = $userRow['user_id'];
            } 

            // Capture the current date
            $service_date = date(DATE_COOKIE);

            foreach ($_SESSION['orderSummary'] as $item) {
                $quantity = $item['qty'];
                $product = $item['type'] . " " . $item['product']; //since products are labeled type + name in the database
                $price = $item['price'];

                // Fetch food_id based on product name
                $foodQuery = "SELECT food_id FROM foods WHERE food_name = '$product'";
                $foodResult = $conn->query($foodQuery);

                if ($foodResult->num_rows > 0) {
                    $foodRow = $foodResult->fetch_assoc();
                    $food_id = $foodRow['food_id'];
                } else {
                    die("Invalid product name: $product");
                }

                // Insert each order item into the food_transactions table
                $transactionQuery = "INSERT INTO food_transactions (user_id, food_id, quantity, amount, date)
                                 VALUES ('$user_id', '$food_id', '$quantity', '$price', '$service_date')";
                if ($conn->query($transactionQuery) !== TRUE) {
                    echo "Error: " . $transactionQuery . "<br>" . $conn->error;
                }
            }

            echo "<p>Order processed successfully</p>";

            // Clear the session order summary after processing
            unset($_SESSION['orderSummary']);
            unset($_SESSION['total']);
            unset($_SESSION['customer']);

        } else {
            echo '<p>No orders to display</p>';
        }
        ?>

        <a class="btn" href="../pages/menu-page.php">Make Another Transaction</a>
    </div>
</body>

</html>