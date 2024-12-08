<?php
    include("header.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)){
     
        //addTreatment variables
        $Date = "current_date()";
        $Doctor_ID = $_SESSION["ID"];
        $Patient_ID = $_SESSION["Patient_ID"];
        $Time = "current_time()";
        $type = "Phychological";

        //specific type variables
        $Treatment_ID;
        $Therapy_Type = filter_input(INPUT_POST, "Therapy_Type", FILTER_SANITIZE_SPECIAL_CHARS);
        $Frequency = filter_input(INPUT_POST, "Frequency", FILTER_VALIDATE_INT);
        $Frequency *= 3600;
        //assume valid input
        $input_valid = true;

        if(strlen($Therapy_Type) > 20){
            echo "Therapy_Type 20 chars or less";
            $input_valid = false;
        }
        
        if($input_valid){
            echo "here";
            $sql = "INSERT INTO Treatment(Date, Doctor_ID, Patient_ID, Time, type)
                    VALUES({$Date},{$Doctor_ID},{$Patient_ID},{$Time},'{$type}')";
            
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            $sql_get = "SELECT * FROM Treatment
                        WHERE Treatment_ID = (SELECT MAX(Treatment_ID)
                                            FROM Treatment)";
            
            include("database.php");
            $result = mysqli_query($conn, $sql_get);
            mysqli_close($conn);
            $row = mysqli_fetch_assoc($result);
            $Treatment_ID = $row["Treatment_ID"];

            $sql = "INSERT INTO Phychological_Treatment(Treatment_ID, Therapy_Type, Frequency)
            VALUES({$Treatment_ID},'{$Therapy_Type}',{$Frequency})";
    
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("Location: patientDash.php");

        }
        
    }

?>

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
            <h1 class = "login-title">Patient <?php echo$_SESSION["Patient_ID"]?></h1>
            <p class="login-subtitle">New Treatment</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Therapy_Type</label>
                    <input type="text" name="Therapy_Type" class="fields"
                        required>
                        <br>

                    <label for="first" class="txt">Frequency</label>
                    <input type="text" name="Frequency" class="fields"
                        placeholder="Hours" required>
                        <br>
                    <button type="submit" class="sign-in-button" >Add</button>       
                </form>  
    </div>  
</body>
</html>