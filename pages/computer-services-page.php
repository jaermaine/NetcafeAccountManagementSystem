<?php
session_start();

include '../validate/db.php';
include '../validate/functions.php';

$time_result = retrieveServices($conn);

$regular = $time_result[0][2];
$vip = $time_result[1][2];
?>
<!DOCTYPE html>
<html lang="en">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Computer Services - Staff</title>
    <!-- CSS -->
    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            /* Could be more or less, depending on screen size */
        }

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

    <body>
        <div class="container mt-5">

            <?php
            if (isset($_SESSION['registration_message'])) echo "<h4 class='text-center'>(" . $_SESSION['registration_message'] . ")</h4><br>";
            ?>
            <h2> List of Users</h2><br>
            <div class="InputContainer">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="myInput" name="myInput">
        </div>

        <br>
        <table class="tablee" id="userTable">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status ID</th>
                <th>Remaining Time</th>
                <th>Action</th>
            </tr>
            <?php
            // read all row from the database table
            $sql = "SELECT DISTINCT account.user_id AS 'user_id', account.username AS 'Username', account.first_name AS 'FirstName', account.last_name AS 'LastName', roles.role_name AS Role, status.status_name AS Status, account.time AS Time FROM account 
            JOIN roles ON account.role_id = roles.role_id 
            JOIN status ON account.status_id = status.status_id
            -- query to exclude non - customer in status and role is admin and staff to limit staff actions
            WHERE account.role_id NOT IN (1, 2) 
            ORDER BY Status DESC";
            $results = $conn->query($sql);

            if (!$results) {
                die("Invalid query: " . $conn->error);
            }

            //read data from each row
            while ($row = $results->fetch_assoc()) {
                $row['Time'] = number_format(($row['Time'] / 3600));
                echo " <tr>
            <td>$row[user_id]</td>
            <td>$row[Username]</td>
            <td>$row[FirstName]</td>
            <td>$row[LastName]</td>
            <td>$row[Status]</td>
            <td>$row[Time] hr/s</td>
            <td>
                <button class='btn btn-primary btn-sm add-time-btn' 
                data-user-id='{$row['user_id']}' 
                data-username='{$row['Username']}'
                data-role='{$row['Role']}' 
                data-status='{$row['Status']}'>Add Time</button>
            </td>
        </tr>
            ";
            }
            ?>
            </tbody>
        </table>
        <!-- back button -->
        <a class='button' href='../pages/staff-page.php'>Return</a>
        </div>

        <!-- JS for search functionality -->
        <script>
            function myFunction() {
                // Declare variables
                var input, filter, table, tr, td, i, j, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("userTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                    tr[i].style.display = "none"; // Default to hide the row
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) { // Loop through all columns
                        if (td[j]) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break; // Show the row and exit loop if a match is found
                            }
                        }
                    }
                }
            }
        </script>

        <!-- The Modal for regular users -->
        <div id="Regular-Modal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 id="modal-title-regular">Add Time</h3>
                <p id="text-regular"></p>
                <form action="../validate/add-time-validate.php" method="POST">
                    <input type="hidden" id="user_id_regular" name="user_id">
                    <input type="hidden" id="status_id_regular" name="status_id" value="Regular">
                    <p>Rate: <?php echo $regular; ?>php/hour</p>
                    <label for="add_hrs_regular">Enter additional hours:</label>
                    <input type="number" id="add_hrs_regular" name="add_hrs_regular" min="0" required>
                    <br><br>
                    <p>Amount to be paid: ₱<span id="regular-amount">0</span></p>
                    <input type="submit" name="submit-addtime" class="button" value="Submit">
                </form>
            </div>
        </div>

        <!-- The Modal for VIP users -->
        <div id="VIP-Modal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 id="modal-title-vip">Add Time</h3>
                <p id="text-vip"></p>
                <form action="../validate/add-time-validate.php" method="POST">
                    <input type="hidden" id="user_id_vip" name="user_id">
                    <input type="hidden" id="status_id_vip" name="status_id" value="VIP">
                    <p>Rate: <?php echo $vip; ?>php/hour</p>
                    <label for="add_hrs_vip">Enter additional hours:</label>
                    <input type="number" id="add_hrs_vip" name="add_hrs_vip" min="0" required>
                    <br><br>
                    <p>Amount to be paid: ₱<span id="vip-amount">0</span></p>
                    <br>
                    <input type="submit" class="button" name="submit-addtime" value="Submit">
                </form>
            </div>
        </div>

        <!-- JS -->
        <script>
            // Get the modal
            var RegularModal = document.getElementById("Regular-Modal");
            var VIPModal = document.getElementById("VIP-Modal");

            // Get the <span> element that closes the modal
            var RegularSpan = RegularModal.getElementsByClassName("close")[0];
            var VIPSpan = VIPModal.getElementsByClassName("close")[0];

            // Get the forms inside the modals
            var RegularForm = document.getElementById("RegularForm");
            var VIPForm = document.getElementById("VIPForm");

            // When the user clicks on <span> (x), close the modal
            RegularSpan.onclick = function() {
                RegularModal.style.display = "none";
            }
            VIPSpan.onclick = function() {
                VIPModal.style.display = "none";
            }

            // Get all the buttons that open the modal
            var buttons = document.getElementsByClassName("add-time-btn");

            // Add event listener to each button
            Array.from(buttons).forEach(function(button) {
                button.addEventListener('click', function() {
                    var userId = this.getAttribute('data-user-id');
                    var username = this.getAttribute('data-username');
                    var role = this.getAttribute('data-role');
                    var status = this.getAttribute('data-status');

                    // for Regular
                    switch (status) {
                        case "Regular":
                            document.getElementById('user_id_regular').value = userId;
                            document.getElementById('modal-title-regular').innerText = "Add Time: " + username + " | Role: " + role + " | Status: " + status;
                            RegularModal.style.display = "block";

                            // Listen for changes in the add_hrs_regular input field
                            document.getElementById('add_hrs_regular').addEventListener('input', function() {
                                var reg_hours = this.value;
                                var reg_rate = <?php echo $regular; ?>; // 50php/hour
                                var reg_amount = reg_hours * reg_rate;
                                document.getElementById('regular-amount').innerText = reg_amount;
                            });
                            break;

                            // for VIP
                        case "VIP":
                            document.getElementById('user_id_vip').value = userId;
                            document.getElementById('modal-title-vip').innerText = "Add Time: " + username + " | Role: " + role + " | Status: " + status;
                            VIPModal.style.display = "block";

                            // Listen for changes in the add_hrs_vip input field
                            document.getElementById('add_hrs_vip').addEventListener('input', function() {
                                var vip_hours = this.value;
                                var vip_rate = <?php echo $vip; ?>; // 30php/hour
                                var vip_amount = vip_hours * vip_rate;
                                document.getElementById('vip-amount').innerText = vip_amount;
                            });
                            break;
                    }
                });
            });
        </script>
    </body>

</html>