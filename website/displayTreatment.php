<?php

    //BUTTONS REDIRECT
    if(isset($_POST["Admin"])){
        session_start();
        $Time = "current_time()";
        $Treatment_ID = $_SESSION["Treatment_ID"];
        $Date = "current_date()";

        if($_SESSION["ID"]>1999){
            $Doctor_ID = $_SESSION["ID"];
            $sql = "INSERT INTO Doctor_Administers(Date, Doctor_ID, Treatment_ID, Time)
                VALUES({$Date},{$Doctor_ID},{$Treatment_ID},{$Time})";
        }
        else{
            $Nurse_ID = $_SESSION["ID"];
            $sql = "INSERT INTO Nurse_Administers(Date, Nurse_ID, Treatment_ID, Time)
                VALUES({$Date},{$Nurse_ID},{$Treatment_ID},{$Time})";
        }
        echo "{$sql}";
        include("database.php");
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: patientDash.php");
    }

    if(isset($_POST["Delete"])){
        session_start();
        $Treatment_ID = $_SESSION["Treatment_ID"];
        $sql = "DELETE FROM Treatment WHERE Treatment_ID = {$Treatment_ID}";
        echo "{$sql}";
        include("database.php");
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: patientDash.php");
    }

    include("header.php");
    
    $Type = "Pharmecuetical";
    include("database.php");

    
    $sql = "SELECT * FROM Pharmecuetical_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
    
	$result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) <= 0){
        $Type = "Psychological";
        include("database.php");
        $sql = "SELECT * FROM Psychological_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
	    $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    if(mysqli_num_rows($result) <= 0){
        $Type = "Physical";
        include("database.php");
        $sql = "SELECT * FROM Physical_Treatment 
            WHERE Treatment_ID = {$_SESSION["Treatment_ID"]}";
	    $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    
   
    echo "<h1>{$Type} Treatment</h1>";
    echo "<table border = \"1\">";

    $needheaders = true;
    if(mysqli_num_rows($result) > 0){
        echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px;'>";
        $needButton = true;
        while($row = mysqli_fetch_assoc($result)){
            if($needheaders){
                $needheaders = false;
                echo "<tr style='background-color: #E9E4E4; color: black; font-size: 15px;'>";
                foreach($row as $key => $value){
                    //within quotes need proper html for table hearder $key = attribute
                    echo "<th style='padding: 10px; text-align: center; color: black; font-size: 15px;'>{$key}</th>";
                }
                echo "</tr>";
            }
            echo "<tr>";
            foreach($row as $key => $value){
                
                if($needButton){
                    echo "<th><form action=\"displayTreatment.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Admin\" value=\"Admin {$value}\"></form>
                        <form action=\"displayTreatment.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Delete\" value=\"Delete {$value}\"></form></th>";
                    $needButton = false;
                }else{
                    echo "<td style='background-color: #ffffff; text-align: center; padding: 10px; font-size: 15px;'>{$value}</td>";
                }
            }
            echo "</tr>";
            $needButton = true;
        }
    }
    echo "</table>";

?>