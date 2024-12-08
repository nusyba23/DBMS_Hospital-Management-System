<?php
    session_start();
?>

<!-- need update -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Hospital</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class="login-title">Hospital Database</h1>
            <p class="login-subtitle">New Hospital Registration</p>
        </div>
        <form class="login-form" action="addHospital.php" method="post">
            <label for="first" class="txt">Name</label>
            <input type="text" name="Name" class="fields"
                placeholder="Hospital Name" required>
            <br>

            <label for="first" class="txt">City</label>
            <input type="text" name="City" class="fields"
                placeholder="City" required>
            <br>

            <label for="first" class="txt">Street Number</label>
            <input type="text" name="Street_Num" class="fields"
                placeholder="Street Number" required>
            <br>

            <label for="first" class="txt">Street</label>
            <input type="text" name="Street" class="fields"
                placeholder="Street" required>
            <br>
                
            <button type="submit" class="register-button">Register</button>       
        </form>  
    </div>  
</body>
</html>
<!-- doesn't need updating -->
<?php
    // Runs when the button is pressed
    if ($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)) {
        
        // Assume valid input
        $input_valid = true;

        // Sanitize inputs
        $Name = filter_input(INPUT_POST, "Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $City = filter_input(INPUT_POST, "City", FILTER_SANITIZE_SPECIAL_CHARS);
        $Street = filter_input(INPUT_POST, "Street", FILTER_SANITIZE_SPECIAL_CHARS);
        $Street_Num = filter_input(INPUT_POST, "Street_Num", FILTER_SANITIZE_SPECIAL_CHARS);

        // Validate inputs
        if (strlen($Name) > 50) {
            echo "Name too long";
            $input_valid = false;
        }

        if (strlen($City) > 20) {
            echo "City too long";
            $input_valid = false;
        }

        if (strlen($Street) > 20) {
            echo "Street too long";
            $input_valid = false;
        }

        if (empty($Street_Num)) {
            echo "Street_Num expects an integer";
            $input_valid = false;
        }

        if (strlen($Street_Num) > 5) {
            echo "Street_Num too long";
            $input_valid = false;
        }
        
        // If input is valid
        if ($input_valid) {
            // SQL statement to insert hospital
            $sql_hospital = "INSERT INTO Hospital(Name, City, Street, Street_Num)
                             VALUES('{$Name}','{$City}','{$Street}','{$Street_Num}')";

            // SQL statement to create the Patient table
            $sql_patient = "
                CREATE TABLE IF NOT EXISTS Patient (
                    Patient_ID INT AUTO_INCREMENT,
                    F_name VARCHAR(20) NOT NULL,
                    L_name VARCHAR(20) NOT NULL,
                    DOB DATE NOT NULL,
                    Gender CHAR NOT NULL,
                    Room_ID INT,
                    Doctor_ID INT,
                    Nurse_ID INT,
                    Bed_ID INT,
                    PRIMARY KEY (Patient_ID),
                    FOREIGN KEY (Room_ID)
                        REFERENCES Room (Room_ID)
                        ON DELETE SET NULL,
                    FOREIGN KEY (Bed_ID)
                        REFERENCES Bed (Bed_ID)
                        ON DELETE SET NULL,
                    FOREIGN KEY (Doctor_ID)
                        REFERENCES Doctor (Doctor_ID)
                        ON DELETE SET NULL,
                    FOREIGN KEY (Nurse_ID)
                        REFERENCES Nurse (Nurse_ID)
                        ON DELETE SET NULL
                );
            ";

            // Connect to the database
            include("database.php");

            // Submit to the database
            mysqli_query($conn, $sql_hospital);
            mysqli_query($conn, $sql_patient);

            // Close the connection
            mysqli_close($conn);

            // Redirect based on user ID
            $ID = $_SESSION["ID"];
            if (($ID > 1999) && ($ID < 3000)) {
                header("Location: doctorDash.php");
            } else if (($ID > 999) && ($ID < 2000)) {
                header("Location: nurseDash.php");
            } else {
                header("Location: index.php");
            }
            exit;
        }
    }
?>
