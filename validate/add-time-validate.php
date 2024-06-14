<?php
    session_start();

    include 'db.php';

    if (!isset($_POST['submit-addtime'])) {
            header('Location: ../index.php');
            session_destroy();
    } else {

        $userId = $_POST['user_id'];
        $statusId = $_POST['status_id'];
        $time = 0;

        $services = "SELECT * FROM services WHERE service_name = '$statusId'";
        $time = ($_POST['status_id'] == "Regular") ? $time = $_POST['add_hrs_regular'] : $time = $_POST['add_hrs_vip'];

        $services_query = $conn->query($services);
        $service_row = $services_query->fetch_assoc();
        $service_id = $service_row['services_id'];
        $service_date = date(DATE_COOKIE);

        $amount = $time * $service_row['service_rate'];
        $transaction = "INSERT INTO `transactions`(`user_id`, `services_id`, `amount`, `hours_added`, `date`) VALUES ('$userId','$service_id','$amount', '$time', '$service_date')";
        $transaction_query = $conn->query($transaction);

        $query = "SELECT time FROM account WHERE user_id = $userId";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        if (!$row) {
            echo "Error fetching current hours: " . $conn->error;
        }

        $currentHours = $row['time'];
        $newHours = $currentHours + ($time * 3600);

        $update = "UPDATE account SET time = $newHours WHERE user_id = $userId";
        $update_query = $conn->query($update);
        if ($update_query === FALSE) {
            echo "Error updating hours: " . $conn->error;
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        $_SESSION['registration_message'] = "Time Added";
    }
    ?>