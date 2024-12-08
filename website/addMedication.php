<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB - Add Medication</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class="login-title">Hospital Database</h1>
            <p class="login-subtitle">Add Medication for an Existing Patient</p>
        </div>
        <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="patient_id" class="txt">Patient ID</label>
            <input type="number" name="Patient_ID" class="text-input"
                placeholder="Enter Patient ID" required>
            <br>

            <label for="medication_name" class="txt">Medication Name</label>
            <input type="text" name="Medication_Name" class="text-input"
                placeholder="Enter Medication Name" required>
            <br>

            <label for="dosage" class="txt">Dosage</label>
            <input type="text" name="Dosage" class="text-input"
                placeholder="e.g., 500mg" required>
            <br>

            <label for="frequency" class="txt">Frequency</label>
            <input type="text" name="Frequency" class="text-input"
                placeholder="e.g., Twice a day" required>
            <br>

            <label for="start_date" class="txt">Start Date</label>
            <input type="date" name="Start_Date" class="text-input" required>
            <br>

            <label for="end_date" class="txt">End Date</label>
            <input type="date" name="End_Date" class="text-input">
            <br>

            <label for="prescribed_by" class="txt">Prescribed By</label>
            <input type="text" name="Prescribed_By" class="text-input"
                placeholder="Doctor's Name">
            <br>

            <label for="notes" class="txt">Notes</label>
            <textarea name="Notes" class="text-input"
                placeholder="Enter additional notes"></textarea>
            <br>

            <button type="submit" class="register-button">Add Medication</button>       
        </form>  
    </div>  
</body>
</html>

<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variables from form
        $Patient_ID = filter_input(INPUT_POST, "Patient_ID", FILTER_VALIDATE_INT);
        $Medication_Name = filter_input(INPUT_POST, "Medication_Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Dosage = filter_input(INPUT_POST, "Dosage", FILTER_SANITIZE_SPECIAL_CHARS);
        $Frequency = filter_input(INPUT_POST, "Frequency", FILTER_SANITIZE_SPECIAL_CHARS);
        $Start_Date = filter_input(INPUT_POST, "Start_Date", FILTER_SANITIZE_SPECIAL_CHARS);
        $End_Date = filter_input(INPUT_POST, "End_Date", FILTER_SANITIZE_SPECIAL_CHARS);
        $Prescribed_By = filter_input(INPUT_POST, "Prescribed_By", FILTER_SANITIZE_SPECIAL_CHARS);
        $Notes = filter_input(INPUT_POST, "Notes", FILTER_SANITIZE_SPECIAL_CHARS);

        $input_valid = true;

        if (empty($Patient_ID)) {
            echo "Patient ID is required and must be a number.";
            $input_valid = false;
        }

        if (strlen($Medication_Name) > 100) {
            echo "Medication name is too long.";
            $input_valid = false;
        }

        if ($input_valid) {
            $sql = "INSERT INTO Medication (Patient_ID, Medication_Name, Dosage, Frequency, Start_Date, End_Date, Prescribed_By, Notes)
                    VALUES ('{$Patient_ID}', '{$Medication_Name}', '{$Dosage}', '{$Frequency}', '{$Start_Date}', '{$End_Date}', '{$Prescribed_By}', '{$Notes}')";

            include("database.php");
            if (mysqli_query($conn, $sql)) {
                echo "New medication record added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
?>
