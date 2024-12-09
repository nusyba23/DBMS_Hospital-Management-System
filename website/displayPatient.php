<?php
    include("header.php");
    include("database.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["PID"])){
            $_SESSION["Patient_ID"] = $_POST["PID"];
            header("Location: patientDash.php"); 
        }
    }

    include("database.php");
    $sql = "SELECT * FROM Patient";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

    <!DOCTYPE html>
    <html lang="en">
    <button class="table-button" onclick="window.location.href = 'addPatient.php'">Add Patient</button>
    <form class="search"action="displayPatient.php" method="post">
    <div class="search-bar-container">
        <input type="search" class="query" name="PID" placeholder="Patient ID"required>
        <input type="submit" class="table-button" value="View Patient"></input>
    </div>
    </form>
    </html>

<?php

    echo "<h2 style='color:black; font-family: Cairo, sans-serif;'>All Patients</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px;'>";
    $needheaders = true;
    if(mysqli_num_rows($result) > 0){
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
                    echo "<th><form action=\"displayPatient.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"PID\" value=\"{$value}\"></form></th>";
                    $needButton = false;
                }else{
                    echo "<th>{$value}</th>";
                }
            }
            echo "</tr>";
            $needButton = true;
        }
    }
    echo "</table>";

    
?>