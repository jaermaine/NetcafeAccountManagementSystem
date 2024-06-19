<?php
session_start();

include '../validate/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\food.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Menu</title>
    <!-- back button -->
    <a class='btn btn-primary btn-sm' href='../pages/staff-page.php'><img src='../frontend/return.png' width="auto" height="40" alt='Return'></a>
    <a class='btn btn-primary btn-sm' href='../pages/food-transaction-logs.php'><img src='../frontend/transactions.png' width="auto" height="30" alt='Transactions'></a>



    <!-- wala pang design need ko lang itago muna modal -->
    <style>
        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<style>
    .column {
        float: left;
        width: 50%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }



    /* Add rounded corners to the top left and the top right corner of the image */
    img {
        border-radius: 5px 5px 0 0;
    }

    /* CSS for table */
    #order-table {
        border-collapse: separate;
        /* Separate border model */
        border-spacing: 10px;
        /* Adjust this value to set the gap between cells */
        width: 100%;
        /* Set the table width */
    }

    /* CSS for table cells */
    #order-table th,
    #order-table td {
        padding: 8px;
        /* Set padding inside cells */
    }
</style>

<body>
    <div class="row">
        <div class="column">
            <!-- Kung kaninong User -->
            <br>
            <div class="menu">
                <form method="POST">
                    <!-- Coffee -->
                    <div class="card" data-aos="fade-right" data-aos-delay="250">
                        <div class="icons">
                            <label for="coffee">
                                <input type="checkbox" id="coffee" name="coffee" value="Coffee">
                                <img src="../frontend/coffee.png" alt="Coffee">
                            </label>
                        </div>

                        <div class="container">

                            <div class="statsAcc">
                                <br>
                                <div class="tabs">
                                    <input type="radio" id="small_coffee" name="coffee_size" value="Small">
                                    <label for="small_coffee" class="statusaccount__label">Small</label>

                                    <input type="radio" id="med_coffee" name="coffee_size" value="Medium">
                                    <label for="med_coffee" class="statusaccount__label">Medium</label>

                                    <input type="radio" id="large_coffee" name="coffee_size" value="Large">
                                    <label for="large_coffee" class="statusaccount__label">Large</label>

                                </div>
                            </div><br>
                            <input type="number" min="0" max="99" id="coffee_qty" name="coffee_qty" value="0">
                            <p>Prices: S=₱60 M=₱80 L=₱120</p>
                        </div>
                    </div>
                    
                    <br>
                    <!-- Pancit Canton -->
                    <div class="card" data-aos="fade-right" data-aos-delay="500">
                        <div class="icons">
                            <label for="pancit_canton">
                                <input type="checkbox" id="pancit_canton" name="pancit_canton" value="pancit_canton">
                                <img src="../frontend/noodles.png" alt="pancit_cantoon">
                            </label>
                        </div>
                        <div class="container">
                            <div class="statsAcc">
                                <br>
                                <div class="tabs">
                                    <input type="radio" id="original_PC" name="pancit_canton_flavor" value="Original">
                                    <label for="original_PC" class="statusaccount__label">Original</label>

                                    <input type="radio" id="calamasi_PC" name="pancit_canton_flavor" value="Calamansi">
                                    <label for="calamasi_PC" class="statusaccount__label">Calamansi</label>

                                    <input type="radio" id="chilimasi_PC" name="pancit_canton_flavor" value="Chilimansi">
                                    <label for="chilimasi_PC" class="statusaccount__label">Chilimansi</label>
                                </div>
                            </div><br>
                            <input type="number" min="0" max="99" id="PC_qty" name="PC_qty" value="0">
                            <p>Price: ₱30 Php per serving</p>
                        </div>
                    </div>
                    <br>
                    <!-- Softdrinks -->
                    <div class="card" data-aos="fade-right" data-aos-delay="750">
                        <div class="icons">
                            <label for="soda">
                                <input type="checkbox" id="soda" name="soda" value="pancit_canton">
                                <img src="../frontend/soda.png" alt="pancit_cantoon">
                            </label>
                        </div>
                        <div class="container">
                            <div class="statsAcc">
                                <br>
                                <div class="tabs">
                                    <input type="radio" id="Coke" name="soda_type" value="Coke">
                                    <label for="Coke" class="statusaccount__label">Coke</label>

                                    <input type="radio" id="Sprite" name="soda_type" value="Sprite">
                                    <label for="Sprite" class="statusaccount__label">Sprite</label>

                                    <input type="radio" id="Mountain Dew" name="soda_type" value="Mountain Dew">
                                    <label for="Mountain Dew" class="statusaccount__label">Mountain Dew</label>
                                </div>
                            </div><br>
                            <input type="number" min="0" max="99" id="soda_qty" name="soda_qty" value="0">
                            <p>Price: ₱20 Php</p>
                        </div>
                    </div>

                    <!-- selection of customer -->
                    <?php
                    // Query to fetch customers
                    $sql = "SELECT DISTINCT account.user_id AS 'user_id', account.username AS 'Username', account.first_name AS 'FirstName', account.last_name AS 'LastName', status.status_name AS Status, account.time AS Time 
                            FROM account 
                            JOIN status ON account.status_id = status.status_id
                            WHERE account.role_id NOT IN (1, 2) 
                            ORDER BY Status DESC";
                    $results = $conn->query($sql);

                    if (!$results) {
                        die("Invalid query: " . $conn->error);
                    }
                    ?>
                    <br>
                    <br>
                    <div class="dropdown-place">
                        <div class="dropdown" data-aos="fade" data-aos-delay="1000">
                            <div class="select" onclick="toggleDropdown()">
                                <span class="selected" id="selectedCustomer">Select a customer</span>
                                <input type="hidden" id="customerid" name="customer" required>
                                <div class="caret"></div>
                            </div>
                            <ul class="test">
                                <?php
                                // Assuming $results is your fetched data array
                                while ($row = $results->fetch_assoc()) {
                                    echo "<li data-id='{$row['Username']}' data-name='{$row['FirstName']} {$row['LastName']} ({$row['Username']})'>{$row['FirstName']} {$row['LastName']}</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="button-place" data-aos="fade" data-aos-delay="1250">
                        <input type="submit" id="order-complete" name="order-complete" class="button" value="Submit">
                    </div>
                </form>
            </div>

        </div>
        <div class="column">
            <div class="receipt" data-aos="fade" data-aos-delay="1250">
                <h1>Order Summary</h1>
                <table id="order-table">
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Price</th>
                    </tr>

                    <?php
                    if (isset($_POST['order-complete'])) {
                        //initialize 
                        $total = 0;
                        $orderSummary = []; //this will store data for the receipt page 
                        $customer = $_POST['customer'];
                        // Function to fetch price from the database based on food name
                        function getPrice($conn, $food_name)
                        {
                            $sql = "SELECT food_price FROM foods WHERE food_name = '$food_name'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                return $row['food_price'];
                            } else {
                                return 0; // or handle the case when no results are found
                            }
                        }
                        if (isset($_POST['coffee']) && $_POST['coffee_qty'] != 0) {
                            $coffee_size = isset($_POST['coffee_size']) ? $_POST['coffee_size'] : 'None';
                            $coffee_qty = isset($_POST['coffee_qty']) ? $_POST['coffee_qty'] : 0;
                            $coffee_name = $coffee_size . " Coffee";

                            // Fetch price for coffee from the database
                            $coffee_price = getPrice($conn, $coffee_name);
                            $total += ($coffee_price * $coffee_qty);

                            //for the receipt 
                            $orderSummary[] = [
                                'qty' => $coffee_qty,
                                'product' => 'Coffee',
                                'type' => $coffee_size,
                                'price' => $coffee_price * $coffee_qty
                            ];

                            echo '<tr>';
                            echo '<td>' . $coffee_qty . '</td>';
                            echo '<td>Coffee</td>';
                            echo '<td>' . $coffee_size . '</td>';
                            echo '<td>' . ($coffee_price * $coffee_qty) . '</td>';
                            echo '</tr>';
                        }

                        if (isset($_POST['pancit_canton']) && $_POST['PC_qty'] != 0) {
                            $pancit_canton_flavor = isset($_POST['pancit_canton_flavor']) ? $_POST['pancit_canton_flavor'] : 'None';
                            $pancit_canton_qty = isset($_POST['PC_qty']) ? $_POST['PC_qty'] : 0;
                            $pancit_canton_name = $pancit_canton_flavor . " Pancit Canton";

                            // Fetch price for pancit canton from the database
                            $pancit_canton_price = getPrice($conn, $pancit_canton_name);
                            $total += ($pancit_canton_price * $pancit_canton_qty);

                            //for the receipt 
                            $orderSummary[] = [
                                'qty' => $pancit_canton_qty,
                                'product' => 'Pancit Canton',
                                'type' => $pancit_canton_flavor,
                                'price' => $pancit_canton_price * $pancit_canton_qty
                            ];

                            echo '<tr>';
                            echo '<td>' . $pancit_canton_qty . '</td>';
                            echo '<td>Pancit Canton</td>';
                            echo '<td>' . $pancit_canton_flavor . '</td>';
                            echo '<td>' . ($pancit_canton_price * $pancit_canton_qty) . '</td>'; // Price column
                            echo '</tr>';
                        }

                        if (isset($_POST['soda']) && $_POST['soda_qty'] != 0) {
                            $soda_type = isset($_POST['soda_type']) ? $_POST['soda_type'] : 'None';
                            $soda_qty = isset($_POST['soda_qty']) ? $_POST['soda_qty'] : 0;
                            $soda_name = $soda_type . " Soda";
                            echo $soda_name;

                            // Fetch price for soda from the database
                            $soda_price = getPrice($conn, $soda_name);
                            $total += ($soda_price * $soda_qty);

                            //for the receipt 
                            $orderSummary[] = [
                                'qty' => $soda_qty,
                                'product' => 'Soda',
                                'type' => $soda_type,
                                'price' => $soda_price * $soda_qty
                            ];

                            echo '<tr>';
                            echo '<td>' . $soda_qty . '</td>';
                            echo '<td>Soda</td>';
                            echo '<td>' . $soda_type . '</td>';
                            echo '<td>' . ($soda_price * $soda_qty) . '</td>'; // Price column
                            echo '</tr>';
                        }
                        //for the receipt
                        $_SESSION['orderSummary'] = $orderSummary;
                        $_SESSION['total'] = $total;
                        $_SESSION['customer'] = $customer;


                        echo " <h3>TOTAL AMOUNT: ₱ " . $total . "";
                        echo " For " . $customer;
                    }
                    ?>
                </table>
                <!-- Reset Button -->
                <button onclick="resetTable()" class="button">Reset Order</button>
            </div>
            <script>
                // Reset button for table 
                function resetTable() {
                    // Find the table
                    var table = document.getElementById("order-table");

                    // Clear all rows except header
                    for (var i = table.rows.length - 1; i > 0; i--) {
                        table.deleteRow(i);
                    }
                }
            </script>

            <!-- Payment Button -->
            <button id="paymentBtn" class="button btn btn-primary"data-aos="fade" data-aos-delay="1250">Process Payment</button>
        </div>
    </div>

    <!-- The Modal for payment-->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Payment</h3>
            <h3>Total Amount: ₱<span id="total-amount"><?php global $total;
                                                        echo $total; ?></span></h3>
            <form id="paymentForm">
                <label for="payment-amount">Enter Payment Amount:</label>
                <input type="number" id="payment-amount" name="payment-amount" min="0" required>
                <br><br>
                <button id="payment-button" type="button" onclick="calculateChange(event)" class="button">Pay</button>
                <br><br>
                <h3>Change: ₱ <span id="change">0</span></h>
            </form>
            <button type="button" id="completeTransaction" style="display: none;" onclick="redirectToReceipt()" class="button">Complete
                Transaction</button>
        </div>
    </div>
    <!-- Functions -->
    <script>
        function calculateChange() {
            var money = parseFloat(document.getElementById("payment-amount").value);
            var amount_to_pay = <?php echo $total; ?>;

            if (isNaN(money) || money <= 0) {
                document.getElementById("change").innerText = "Enter a valid payment amount.";
            } else if (money < amount_to_pay) {
                document.getElementById("change").innerText = "Insufficient Funds";
            } else {
                var change = money - amount_to_pay;
                document.getElementById("change").innerText = change;
                document.getElementById("completeTransaction").style.display = "block";
            }
        }

        function redirectToReceipt() {
            // Redirect to receipt page
            window.location.href = "../pages/receipt-page.php";
        }
    </script>

    <script>
        // Get the modal
        var paymentModal = document.getElementById("paymentModal");

        // Get the button that opens the modal
        var paymentBtn = document.getElementById("paymentBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        paymentBtn.onclick = function() {
            paymentModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            paymentModal.style.display = "none";
            document.getElementById("paymentForm").reset();
            document.getElementById("change").innerText = "0";
        }

        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown .test');
            dropdown.classList.toggle('active');
        }

        document.querySelectorAll('.dropdown .test li').forEach(item => {
            item.addEventListener('click', function() {
                var customerid = this.getAttribute('data-id');
                var customerName = this.getAttribute('data-name');

                document.querySelector('#selectedCustomer').textContent = customerName;
                document.querySelector('#customerid').value = customerid;

                toggleDropdown();
            });
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
</body>

</html>