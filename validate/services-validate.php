<?php
    session_start();

    include 'db.php';

    if (!isset($_POST['submit_edit_time'])) {
        header("../index.php");
    } else {

        $service_id = $_POST['service_name'];
        $service_rate = ($_POST['service_name'] == 1) ? $service_rate = $_POST['edit_hrs_regular'] : $service_rate = $_POST['edit_hrs_vip'];
        
        $update = "UPDATE `services` SET `service_rate` = $service_rate WHERE `services_id` = $service_id";
        $update_query = $conn->query($update);
        if ($update_query === FALSE) {
            echo "Error updating hours: " . $conn->error;
        }
        echo "<script language = 'JavaScript'>
                            alert('Successfully Edited Rate');
                            window.location = \"../pages/admin-page.php\";
                            </script>";
    }
    ?>