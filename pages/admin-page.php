<?php
session_start();
$_SESSION['referer'] = "../pages/admin-page.php";

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}

include '../validate/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="..\style.css">
</head>

<body>
    <div class="container mt-5">
        <?php
        echo "<h1 class='text-center'>Welcome Back " . $_SESSION['username'] . "</h1>";
        if (isset($_SESSION['registration_message'])) echo "<p class='text-center'>" . $_SESSION['registration_message'] . "</p>";
        ?>

        <h2 class="text-center mt-4">List of Users</h2>

        <table class="tablee">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Remaining Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT DISTINCT account.user_id AS 'user_id', account.username AS 'Username', account.first_name AS 'FirstName', account.last_name AS 'LastName', roles.role_name AS Role, status.status_name AS Status, account.time AS Time 
                        FROM account 
                        JOIN roles ON account.role_id = roles.role_id 
                        JOIN status ON account.status_id = status.status_id
                        ORDER BY Role ASC";
                $results = $conn->query($sql);

                if (!$results) {
                    die("Invalid query: " . $conn->error);
                }

                while ($row = $results->fetch_assoc()) {
                    echo " <tr>
                        <td>$row[user_id]</td>
                        <td>$row[Username]</td>
                        <td>$row[FirstName]</td>
                        <td>$row[LastName]</td>
                        <td>$row[Role]</td>
                        <td>$row[Status]</td>
                        <td>$row[Time]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='../pages/modification-page.php?user_id=$row[user_id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='../validate/delete-validate.php?user_id=$row[user_id]'>Delete</a>
                            <button class='btn btn-primary btn-sm add-time-btn' 
                                data-user-id='{$row['user_id']}' 
                                data-username='{$row['Username']}' 
                                data-role='{$row['Role']}' 
                                data-status='{$row['Status']}'>Add Time</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <form action="registration-page.php" method="POST">
                <input type="submit" name="register" class="button" value="<?php echo $_SESSION['register'] = 'Create'; ?>">
            </form>

            <form action="..\validate\logout-validate.php" method="POST">
                <input type="submit" name="logout" class="button" value="Logout">
            </form>
        </div>
    </div>

    <!-- Test -->
    <!-- The Modal for regular users -->
    <div id="Regular-Modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal-title-regular">Add Time</h3>
            <p id="text-regular"></p>
            <form method="POST">
                <input type="hidden" id="user_id_regular" name="user_id">
                <input type="hidden" id="status_id_regular" name="status_id" value="Regular">
                <p>Rate: 50php/hour</p>
                <label for="add_hrs_regular">Enter additional hours:</label>
                <input type="number" id="add_hrs_regular" name="add_hrs_regular" min="0" required>
                <br><br>
                <p>Amount to be paid: ₱<span id="regular-amount">0</span></p>
                <br>
                <input type="submit" name="submit-addtime" class ="button" value="Submit">
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
            <form method="POST">
                <input type="hidden" id="user_id_vip" name="user_id">
                <input type="hidden" id="status_id_vip" name="status_id" value="VIP">
                <p>Rate: 30php/hour</p>
                <label for="add_hrs_vip">Enter additional hours:</label>
                <input type="number" id="add_hrs_vip" name="add_hrs_vip" min="0" required>
                <br><br>
                <p>Amount to be paid: ₱<span id="vip-amount">0</span></p>
                <br>
                <input type="submit" name="submit-addtime" value="Submit">
            </form>
        </div>
    </div>

    <!-- The Modal for employees -->
    <div id="Employee-Modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal-title-employee"> </h3>
            <p id="text-employee"></p>
        </div>
    </div>



    <!-- JS -->
    <script>
        // Get the modal
        var RegularModal = document.getElementById("Regular-Modal");
        var VIPModal = document.getElementById("VIP-Modal");
        var EmployeeModal = document.getElementById("Employee-Modal");

        // Get the <span> element that closes the modal
        var RegularSpan = RegularModal.getElementsByClassName("close")[0];
        var VIPSpan = VIPModal.getElementsByClassName("close")[0];
        var employeeSpan = EmployeeModal.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        RegularSpan.onclick = function () {
            RegularModal.style.display = "none";
        }
        VIPSpan.onclick = function () {
            VIPModal.style.display = "none";
        }
        employeeSpan.onclick = function () {
            EmployeeModal.style.display = "none";
        }

        // Get all the buttons that open the modal
        var buttons = document.getElementsByClassName("add-time-btn");

        // Add event listener to each button
        Array.from(buttons).forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id');
                var username = this.getAttribute('data-username');
                var role = this.getAttribute('data-role');
                var status = this.getAttribute('data-status');

                // for Regular
                if (status == "Regular") {
                    document.getElementById('user_id_regular').value = userId;
                    document.getElementById('modal-title-regular').innerText = "Add Time: " + username + " | Role: " + role + " | Status: " + status;
                    RegularModal.style.display = "block";

                    // Listen for changes in the add_hrs_regular input field
                    document.getElementById('add_hrs_regular').addEventListener('input', function () {
                        var reg_hours = this.value;
                        var reg_rate = 50; // 50php/hour
                        var reg_amount = reg_hours * reg_rate;
                        document.getElementById('regular-amount').innerText = reg_amount;
                    });
                }
                // for VIP
                else if (status == "VIP") {
                    document.getElementById('user_id_vip').value = userId;
                    document.getElementById('modal-title-vip').innerText = "Add Time: " + username + " | Role: " + role + " | Status: " + status;
                    VIPModal.style.display = "block";

                    // Listen for changes in the add_hrs_vip input field
                    document.getElementById('add_hrs_vip').addEventListener('input', function () {
                        var vip_hours = this.value;
                        var vip_rate = 30; // 30php/hour
                        var vip_amount = vip_hours * vip_rate;
                        document.getElementById('vip-amount').innerText = vip_amount;
                    });
                }
                // for employees
                else if (status == "Non-Customer") {
                    document.getElementById('modal-title-employee').innerText = "Add Time: " + username + " | Role: " + role + " | Status: " + status;
                    document.getElementById('text-employee').innerText = "Cannot add time to Employees";
                    EmployeeModal.style.display = "block";
                }
            });
        });
    </script>

    <!-- Wala pa kong gets sa validate at hindi pupunta sa ibang page pag nag submit sa form so ito muna -->
    <?php
    if (isset($_POST['submit-addtime'])) {
        $userId = $_POST['user_id'];
        $time = 0;

        if ($_POST['status_id'] == "Regular") {
            $time = $_POST['add_hrs_regular'];
            $rate = 50;

        } else if ($_POST['status_id'] == "VIP") {
            $time = $_POST['add_hrs_vip'];
            $rate = 30;
        }

        $amount = $time * $rate;

        // Fetch current hours
        $query = "SELECT time FROM account WHERE user_id = $userId";
        $result = $conn->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            $currentHours = $row['time'];
            $newHours = $currentHours + $time;

            // Update the new hours in the database
            $updateQuery = "UPDATE account SET time = $newHours WHERE user_id = $userId";
            if ($conn->query($updateQuery) === TRUE) {
                echo "<script language = 'JavaScript'>
                    alert('Successfully Added Time');
                    window.location = \"../pages/admin-page.php\";
                    </script>";
            } else {
                echo "Error updating hours: " . $conn->error;
            }
        } else {
            echo "Error fetching current hours: " . $conn->error;
        }

    }
    ?>

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
            text-decoStion: none;
            cursor: pointer;
        }
    </style>
</body>

</html>