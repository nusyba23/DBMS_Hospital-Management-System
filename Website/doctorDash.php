<?php 
    include("../header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
</head>

<body>
        <div class="action-buttons">
        <button class="doctor-action" onclick="window.location.href = 'logOut.php'">Log out
            <img class="icon-img" src="images/mag-glass.png" alt="Magnifying Glass Icon"/>
        </button>
       
        <button class="doctor-action" onclick="window.location.href = 'updatePassword.php'">Update Password
            <img class="icon-img" src="images/patient.png" alt="Patient Icon"/>
        </button>
        
        <button class="doctor-action" onclick="window.location.href = 'managetreatment.html'">Manage Treatment
            <img class="icon-img" src="images/medicine.png" alt="Medicine Icon"/>
        </button>
       
    </div>

</body>
</html>

<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: index.php");
    }
      
?>