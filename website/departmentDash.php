<?php
    include("header.php");

    //BUTTONS REDIRECT
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["Room_ID"])){
            $_SESSION["Room_ID"] = $_POST["Room_ID"];
            header("Location: roomDash.php"); 
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

    // DISPLAY Department_Heads    
    include("database.php");
    $sql = "SELECT L_name, F_name, Type FROM Doctor
            WHERE Doctor_ID IN
            (SELECT (Doctor_ID) FROM Department_Heads 
            WHERE Department_ID = {$_SESSION["Department_ID"]})";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'updateHeads.php'\">Update Head Doctor</button>";
    echo "<h1>Department Head</h1>";
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

        }
    }
    echo "</table>";
// DISPLAY Depatment Heads DONE

// DISPLAY MY PATIENTS    
include("database.php");
$sql = "SELECT * FROM Patient 
        WHERE Patient_ID IN
        (SELECT (Patient_ID)
        FROM Patient_Room
        WHERE Room_ID IN
        (SELECT (Room_ID) FROM Room 
        WHERE Department_ID = {$_SESSION["Department_ID"]}))";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

echo "<h1>Patients</h1>";
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
                echo "<th><form action=\"myPatients.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"PID\" value=\"{$value}\"></form></th>";
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
echo "<br><br>";
// DISPLAY MY Rooms    
include("database.php");
$sql = "SELECT * FROM Room 
        WHERE Department_ID = {$_SESSION["Department_ID"]}";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
echo "<button class=\"table-button\" onclick=\"window.location.href = 'addRoom.php'\">Add Room</button>";
echo "<h1>Rooms</h1>";
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
                echo "<th><form action=\"departmentDash.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Room_ID\" value=\"{$value}\"></form></th>";
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
// DISPLAY MY Rooms DONE





?>