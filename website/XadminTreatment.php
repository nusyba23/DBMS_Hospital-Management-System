<?php
    include("header.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)){
     
        //addTreatment variables
        $Date = "current_date()";
        $Doctor_ID = $_SESSION["ID"];
        $Patient_ID = $_SESSION["Patient_ID"];
        $Time = "current_time()";
        $type = "Pharmecuetical";

        //specific type variables
        $Treatment_ID;
        $Drug_name = filter_input(INPUT_POST, "Drug_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Frequency = filter_input(INPUT_POST, "Frequency", FILTER_VALIDATE_INT);
        $Frequency *= 3600;
        $Dosage = filter_input(INPUT_POST, "Dosage", FILTER_VALIDATE_INT);
        //assume valid input
        $input_valid = true;

        if(strlen($Drug_name) > 20){
            echo "Drug_name 20 chars or less";
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

            $sql = "INSERT INTO Pharmecuetical_Treatment(Treatment_ID, Drug_name, Frequency, Dosage)
            VALUES({$Treatment_ID},'{$Drug_name}',{$Frequency}, {$Dosage})";
    
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("Location: patientDash.php");

        }
        
    }

?>