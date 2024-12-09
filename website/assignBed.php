<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-Assign Bed</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Assign Bed</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Bed ID</label>
                    <input type="text" name="Bed_ID" class="fields"
                     required>
                        <br>
                    <button type="submit" class="register-button" name="Table"  value= "Patient_Bed">Add</button>       
                </form>  
    </div>  
</body>
</html>

<?php
    //runs when button pressed
    if($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)){
        
        //assume valid input
        $input_valid = true;

        //Sanitize
        $Bed_ID = filter_input(INPUT_POST, "Bed_ID", FILTER_VALIDATE_INT);
        $Patient_ID = $_SESSION["Patient_ID"];
        $Table = $_POST["Table"];
        
        //Determined to be valid
        if($input_valid){

            //sql statement to delete old
            $sql = "DELETE FROM {$Table} WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            
            //sql statement to add current
            $sql = "INSERT INTO {$Table}(Bed_ID, Patient_ID)
                    VALUES({$Bed_ID},{$Patient_ID})";

            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: patientDash.php");

            $sql = "INSERT INTO Patient_Room (Room_ID, Patient_ID)
                    VALUES((SELECT Room_ID FROM Bed WHERE Bed_ID = {$Bed_ID}),{$Patient_ID})";

            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: patientDash.php");



            
        }
    }
?>