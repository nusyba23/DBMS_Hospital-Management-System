
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
</head>
<body>
   
    <h1 class="title">Hello Dr. X </h1>
    <h3 class="hospital-details">Hospital: <br> City: <br> Address: </h3>

    <div class="action-buttons">
        <button class="doctor-action" onclick="window.location.href = 'viewpatients.html'">View Patients
            <img class="icon-img" src="../images/mag-glass.png" alt="Magnifying Glass Icon"/>
        </button>
       
        <button class="doctor-action" onclick="window.location.href = 'managepatients.html'">Manage Patients
            <img class="icon-img" src="../images/patient.png" alt="Patient Icon"/>
        </button>
        
        <button class="doctor-action" onclick="window.location.href = 'managetreatment.html'">Manage Treatment
            <img class="icon-img" src="../images/medicine.png" alt="Medicine Icon"/>
        </button>
    </div>

</body>
</html>