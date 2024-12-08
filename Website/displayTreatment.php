<?php
// DISPLAY MY Treatments 

    session_start();
  
    $Type = "Pharmecuetical";

    foreach($_SESSION as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    include("database.php");
    
    $sql = "SELECT * FROM Pharmecuetical_Treatment 
            WHERE Treatment_ID = {$_POST["Treatment_ID"]}";
    
	$result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) <= 0){
        $Type = "Phychological";
        include("database.php");
        $sql = "SELECT * FROM Phychological_Treatment 
            WHERE Treatment_ID = {$_POST["Treatment_ID"]}";
	    $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    if(mysqli_num_rows($result) <= 0){
        $Type = "Physical";
        include("database.php");
        $sql = "SELECT * FROM Physical_Treatment 
            WHERE Treatment_ID = {$_POST["Treatment_ID"]}";
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
                    echo "<th><form action=\"displayTreatment.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Treatment\" value=\"{$value}\"></form></th>";
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
// DISPLAY MY PATIENTS DONE

//BUTTONS REDIRECT
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["Treatment"])){
            header("Location: editTreatment.php"); 
        }
    }
//BUTTONS REDIRECT
?>