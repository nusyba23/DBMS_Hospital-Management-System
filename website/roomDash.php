<?php
    include("header.php");
    //BUTTONS REDIRECT
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["Patient_ID"])){
            $_SESSION["Patient_ID"] = $_POST["Patient_ID"];
            header("Location: patientDash.php"); 
        }
    }
    include("database.php");
    $sql = "SELECT Name FROM Hospital
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    $Name = $row["Name"];
    echo "<h1>{$Name}</h1>";

    include("database.php");
    $sql = "SELECT Name FROM Department
            WHERE Department_ID = {$_SESSION["Department_ID"]}";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    $Name = $row["Name"];
    echo "<h1>{$Name}</h1>";

    echo "<h1>Room {$_SESSION["Room_ID"]}</h1>";

// DISPLAY Beds    
    include("database.php");
    $sql = "SELECT * FROM Patient_Bed
            WHERE Bed_ID IN
            (SELECT (Bed_ID) FROM Bed
            WHERE Room_ID = {$_SESSION["Room_ID"]})";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'addBed.php'\">Add Bed</button>";
    echo "<h1>Beds</h1>";
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
                    echo "<th><form action=\"roomDash.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Patient_ID\" value=\"{$value}\"></form></th>";
                    $needButton = false;
                }else{
                    echo "<td style='background-color: #ffffff; text-align: center; padding: 10px; font-size: 15px;'>{$value}</td>";;
                }
            }
            echo "</tr>";
            $needButton = true;
        }
    }
    echo "</table>";
// DISPLAY MY PATIENTS DONE

include("database.php");
    $sql = "SELECT(Bed_ID)
            From Bed
            WHERE Bed_ID NOT IN
            (SELECT (Bed_ID)FROM Patient_Bed
            WHERE Bed_ID IN
            (SELECT (Bed_ID) FROM Bed
            WHERE Room_ID = {$_SESSION["Room_ID"]}))";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<h1>Available Beds</h1>";
    echo "<table border = \"1\">";
    $needheaders = true;
    if(mysqli_num_rows($result) > 0){
        echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px;'>";
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
                    echo "<td style='background-color: #ffffff; text-align: center; padding: 10px; font-size: 15px;'>{$value}</td>";
            }
            echo "</tr>";
            $needButton = true;
        }
    }
    echo "</table>";

?>