<?php
// DISPLAY MY Treatments 
    session_start();
    include("database.php");
    $sql = "SELECT * FROM Treatment 
            WHERE Patient_ID = {$_SESSION["Patient_ID"]}";
					       
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "<h1 style='color:black; font-family: Cairo, sans-serif;'>My Treatments</h1>";
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
                    echo "<th><form action=\"displayTreatment.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Treatment_ID\" value=\"{$value}\"></form></th>";
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
        if(isset($_POST["Treatment_ID"])){
            $_SESSION["Treatment_ID"] = $_POST["Treatment_ID"];
            header("Location: displayTreatment.php"); 
        }
    }
//BUTTONS REDIRECT
?>