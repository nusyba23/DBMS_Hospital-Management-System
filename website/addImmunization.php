<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Immunization</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class="login-title">Hospital Database</h1>
            <p class="login-subtitle">New Immunization Record</p>
        </div>
        <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="patient_id" class="txt">Patient ID</label>
            <input type="number" name="Patient_ID" class="text-input"
                placeholder="Enter Patient ID" required>
            <br>

            <label for="vaccine_name" class="txt">Vaccine Name</label>
            <input type="text" name="Vaccine_Name" class="text-input"
                placeholder="Enter Vaccine Name" required>
            <br>

            <label for="batch_no" class="txt">Vaccine Batch No</label>
            <input type="text" name="Vaccine_Batch_No" class="text-input"
                placeholder="Enter Batch Number">
            <br>

            <label for="date_administered" class="txt">Date Administered</label>
            <input type="date" name="Date_Administered" class="text-input"
                required>
            <br>

            <label for="next_due_date" class="txt">Next Due Date</label>
            <input type="date" name="Next_Due_Date" class="text-input">
            <br>

            <label for="administered_by" class="txt">Administered By</label>
            <input type="number" name="Administered_By" class="text-input"
                placeholder="Staff ID">
            <br>

            <label for="location" class="txt">Location Administered</label>
            <input type="text" name="Location_Administered" class="text-input"
                placeholder="Enter Location">
            <br>

            <label for="allergies" class="txt">Allergies or Reactions</label>
            <textarea name="Allergies_Or_Reactions" class="text-input"
                placeholder="Enter Any Allergies or Reactions"></textarea>
            <br>
            
            <button type="submit" class="register-button">Add Record</button>       
        </form>  
    </div>  
</body>
</html>

<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variables from submit
        $Patient_ID = filter_input(INPUT_POST, "Patient_ID", FILTER_VALIDATE_INT);
        $Vaccine_Name = filter_input(INPUT_POST, "Vaccine_Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Vaccine_Batch_No = filter_input(INPUT_POST, "Vaccine_Batch_No", FILTER_SANITIZE_SPECIAL_CHARS);
        $Date_Administered = filter_input(INPUT_POST, "Date_Administered", FILTER_SANITIZE_SPECIAL_CHARS);
        $Next_Due_Date = filter_input(INPUT_POST, "Next_Due_Date", FILTER_SANITIZE_SPECIAL_CHARS);
        $Administered_By = filter_input(INPUT_POST, "Administered_By", FILTER_VALIDATE_INT);
        $Location_Administered = filter_input(INPUT_POST, "Location_Administered", FILTER_SANITIZE_SPECIAL_CHARS);
        $Allergies_Or_Reactions = filter_input(INPUT_POST, "Allergies_Or_Reactions", FILTER_SANITIZE_SPECIAL_CHARS);

        $input_valid = true;

        if (empty($Patient_ID)) {
            echo "Patient ID is required and must be a number.";
            $input_valid = false;
        }

        if (strlen($Vaccine_Name) > 100) {
            echo "Vaccine name too long.";
            $input_valid = false;
        }

        if ($input_valid) {
            $sql = "INSERT INTO Immunization (Patient_ID, Vaccine_Name, Vaccine_Batch_No, Date_Administered, Next_Due_Date, Administered_By, Location_Administered, Allergies_Or_Reactions)
                    VALUES ('{$Patient_ID}', '{$Vaccine_Name}', '{$Vaccine_Batch_No}', '{$Date_Administered}', '{$Next_Due_Date}', '{$Administered_By}', '{$Location_Administered}', '{$Allergies_Or_Reactions}')";

            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("Location: successPage.php");
            exit;
        
    }
?>
