<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!--top three lines above, font download-->
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Database</title>
</head>
<body>
    <div class = "login-container">
        <div class="heading-container">
            <h1 class = "login-title">Treatment Type</h1>
            <p class="login-subtitle">Please Select:</p>
        </div>
        <div class="login-form">
            <div class="employee-button-container">
            <button class="employee-button" onclick="window.location.href='treatmentPharmecuetical.php'">Pharmecuetical
                <img class="employee-img" src="images/doctor.png" alt="Doctor Icon"/>
            </button>
            <button class="employee-button" onclick="window.location.href='treatmentPhychological.php'">Phychological
                <img class="employee-img" src="images/nurse.png" alt="Nurse Icon"/>
            </button>
            <button class="employee-button" onclick="window.location.href='treatmentPhysical.php'">Physical
                <img class="employee-img" src="images/doctor.png" alt="Doctor Icon"/>
            </button>
            
            </div>
        </div>

    </div>
</body>
</html>