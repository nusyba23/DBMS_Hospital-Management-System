<?php
include("header.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["Hospital_ID"])){
        $_SESSION["Hospital_ID"] = $_POST["Hospital_ID"];
        header("Location: hospitalDash.php"); 
    }
}

$sql = "SELECT * FROM Hospital";
include("database.php");
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

$needheaders = true;
echo "<button class=\"table-button\" onclick=\"window.location.href = 'addHospital.php'\">Add Hospital</button>";
echo "<h2 style='color:black; font-family: Cairo, sans-serif;'>Hospitals</h2>";
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px;'>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($needheaders) {
            $needheaders = false;
            echo "<tr style='background-color: #E9E4E4; color: black; font-size: 15px;'>";
            foreach ($row as $key => $value) {
                echo "<th style='padding: 10px; text-align: center; color: black; font-size: 15px;'>{$key}</th>";
            }
            echo "</tr>";
        }
        echo "<tr>";
        $needButton = true;
        foreach($row as $key => $value){
            if($needButton){
                echo "<th><form action=\"displayHospitals.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"Hospital_ID\" value=\"{$value}\"></form></th>";
                $needButton = false;
            }else{
                echo "<th>{$value}</th>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>