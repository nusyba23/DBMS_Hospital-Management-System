<?php
    include("header.php");

// DISPLAY Departments    
    include("database.php");
    $sql = "SELECT * FROM Department 
            WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'addDepartment.php'\">Add Department</button>";
    echo "<h1>Departments</h1>";
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
                    echo "<th><form action=\"hospitalDash.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Department_ID\" value=\"{$value}\"></form></th>";
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

//BUTTONS REDIRECT
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["Department_ID"])){
            $_SESSION["Department_ID"] = $_POST["Department_ID"];
            header("Location: departmentDash.php"); 
        }
    }
//BUTTONS REDIRECT
?>