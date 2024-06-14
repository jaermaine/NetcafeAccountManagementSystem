<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: ../index.php');
    session_destroy();
}

include '../validate/db.php';
include '../validate/functions.php';

$services_rows = retrieveServices($conn);

$regular = $services_rows[0][2];
$vip = $services_rows[1][2];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="..\style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>
    <div class="container">
        <div class="card-container">
            <div class="card" data-aos="fade-down" data-aos-delay="250">
                <div class="card-image"><img src="../frontend/normal.jfif" alt="Profile"></div>
                <div>
                    <br>
                    <div class="text-container">
                        <a class='text-center'>Regular Rate: <?php echo $regular; ?><br></a>
                        <h5>GTX 1660</h5>
                        <h5>I5 9600K</h5>
                        <h5>16GB RAM</h5>
                        <h5>256GB SSD</h5>
                        <h5>1TB HDD</h5>
                        <h5>24" 1080p Monitor</h5>
                    </div>
                    <div class="button-container">
                        <button id="edit-regular" class="button" name="regular-submit">Edit</button>
                    </div>

                    <div id="Regular-Modal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h3 id="modal-title-regular">Edit Time</h3>
                            <p id="text-regular"></p>
                            <form action="../validate/services-validate.php" method="POST">
                                <a class='text-center'>Rate: </a>
                                <a class='text-center'><?php echo $regular; ?>PHP</a><br>
                                <label for="edit_hrs_regular">Edit services rate:</label>
                                <input type="number" id="edit_hrs_regular" name="edit_hrs_regular" min="0" required>
                                <br><br>
                                <input type="text" name="service_name" value='1' hidden>
                                <input type="submit" name="submit_edit_time" class="button" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" data-aos="fade-down" data-aos-delay="500">
                <div class="card-image"><img src="../frontend/vip.jpg" alt="Profile"></div>
                <div>
                    <br>
                    <div class="text-container">
                        <a class='text-center'>VIP Rate:<?php echo $vip; ?><br></a>
                        <h5>RTX 3090</h5>
                        <h5>I9 12600K</h5>
                        <h5>32GB RAM</h5>
                        <h5>1TB NVMe SSD</h5>
                        <h5>2TB HDD</h5>
                        <h5>27" 1440p Monitor</h5>
                    </div>
                    <div class="button-container">
                        <button id="edit-vip" class="button" name="vip-submit">Edit</button>
                    </div>

                    <div id="VIP-Modal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h3 id="modal-title-vip">Edit Time</h3>
                            <p id="text-vip"></p>
                            <form action="../validate/services-validate.php" method="POST">
                                <a class='text-center'>Rate: </a>
                                <a class='text-center'><?php echo $vip; ?>PHP</a><br>
                                <label for="edit_hrs_vip">Edit services rate:</label>
                                <input type="number" id="edit_hrs_vip" name="edit_hrs_vip" min="0" required>
                                <br><br>
                                <input type="text" name="service_name" value='2' hidden>
                                <input type="submit" name="submit_edit_time" class="button" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4" data-aos="fade" data-aos-delay="850">
            <form action="../pages/admin-page.php" method="POST">
                <input type="submit" class="button" name="back" value="Back">
            </form>
        </div>
    </div>
</body>


<script>
    // Get the modal
    var modalRegular = document.getElementById("Regular-Modal");
    var modalVip = document.getElementById("VIP-Modal");

    // Get the button that opens the modal
    var btnRegular = document.getElementById("edit-regular");
    var btnVip = document.getElementById("edit-vip");

    // Get all the <span> elements that close the modal
    var spans = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal 
    btnRegular.onclick = function(event) {
        event.preventDefault(); // Prevent form submission
        modalRegular.style.display = "block";
    }

    btnVip.onclick = function(event) {
        event.preventDefault(); // Prevent form submission
        modalVip.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function() {
            modalRegular.style.display = "none";
            modalVip.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modalRegular) {
            modalRegular.style.display = "none";
        }
        if (event.target == modalVip) {
            modalVip.style.display = "none";
        }
    }
</script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>