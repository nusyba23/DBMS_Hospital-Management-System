<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB - New Allergy Record</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class="login-title">Hospital Database</h1>
            <p class="login-subtitle">New Allergy Record</p>
        </div>
        <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="patient_id" class="txt">Patient ID</label>
            <input type="number" name="Patient_ID" class="text-input"
                placeholder="Enter Patient ID" required>
            <br>

            <label for="allergy_name" class="txt">Allergy Name</label>
            <input type="text" name="Allergy_Name" class="text-input"
                placeholder="Enter Allergy Name" required>
            <br>

            <label for="severity" class="txt">Severity</label>
            <select name="Severity" class="text-input">
                <option value="">Select Severity</option>
                <option value="Mild">Mild</option>
                <option value="Moderate">Moderate</option>
                <option value="Severe">Severe</option>
            </select>
            <br>

            <label for="reaction_description" class="txt">Reaction Description</label>
            <textarea name="Reaction_Description" class="text-input"
                placeholder="Describe the Reaction"></textarea>
            <br>

            <label for="allergy_onset_date" class="txt">Allergy Onset Date</label>
            <input type="date" name="Allergy_Onset_Date" class="text-input">
            <br>
            
            <button type="submit" class="register-button">Add Allergy</button>       
        </form>  
    </div>  
</body>
</html>

<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variables from form
        $Patient_ID = filter_input(INPUT_POST, "Patient_ID", FILTER_VALIDATE_INT);
        $Allergy_Name = filter_input(INPUT_POST, "Allergy_Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Severity = filter_input(INPUT_POST, "Severity", FILTER_SANITIZE_SPECIAL_CHARS);
        $Reaction_Description = filter_input(INPUT_POST, "Reaction_Description", FILTER_SANITIZE_SPECIAL_CHARS);
        $Allergy_Onset_Date = filter_input(INPUT_POST, "Allergy_Onset_Date", FILTER_SANITIZE_SPECIAL_CHARS);

        $input_valid = true;

        if (empty($Patient_ID)) {
            echo "Patient ID is required and must be a number.";
            $input_valid = false;
        }

        if (strlen($Allergy_Name) > 100) {
            echo "Allergy name is too long.";
            $input_valid = false;
        }

        if ($input_valid) {
            $sql = "INSERT INTO Allergy (Patient_ID, Allergy_Name, Severity, Reaction_Description, Allergy_Onset_Date)
                    VALUES ('{$Patient_ID}', '{$Allergy_Name}', '{$Severity}', '{$Reaction_Description}', '{$Allergy_Onset_Date}')";

            include("database.php");
            if (mysqli_query($conn, $sql)) {
                echo "New allergy record added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
?>
