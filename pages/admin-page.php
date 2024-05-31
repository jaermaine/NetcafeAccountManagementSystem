<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        header('Location: ../index.php');
    }

    include '../validate/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel ="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
        echo "<h1>Welcome back " . $_SESSION['username'] . "</h1>";
    ?>
    
    <form action = "registration-page.php" method = "POST">
        <input type = "submit" name = "register" value = "Create">
    </form>

    <h2> List of Users</h2>
        <br>
        <table class="table">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role ID</th>
                <th>Status ID</th>
                <th>Remaining Time</th>
                <th>Actions</th>
            </tr>
            <?php
            // read all row from the database table
            $sql = "SELECT DISTINCT account.user_id AS 'user_id', account.username AS 'Username', account.first_name AS 'FirstName', account.last_name AS 'LastName', roles.role_name AS Role, status.status_name AS Status, account.time AS Time FROM account 
            JOIN roles ON account.role_id = roles.role_id 
            JOIN status ON account.status_id = status.status_id
            ORDER BY Role ASC";
            $results = $conn->query($sql);

            if (!$results) {
                die("Invalid query: " . $conn->error);
            }

            //read data from each row
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
                <a class='btn btn-primary btn-sm' href='../validate/delete-validate.php?user_id=$row[user_id]'>Delete</a>
                <a class='btn btn-primary btn-sm' href='../time.php?user_id=$row[user_id]'>Add Time</a>
            </td>
        </tr>
            ";
            }
            ?>

        </table>

    <form action = "..\validate\logout-validate.php" method = "POST">
        <input type = "submit" name = "logout" value = "Logout">
    </form>
</body>
</html>