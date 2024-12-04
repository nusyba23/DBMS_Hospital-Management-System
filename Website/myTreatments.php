<?php
    session_start();
?>
<!-- PATIENT SEARCH -->
    <!DOCTYPE html>
    <html lang="en">
    <form class="search"action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    </html>
<!-- PATIENT SEARCH DONE -->
<?php
// DISPLAY MY PATIENTS    
    include("database.php");
    $Patients = "SELECT * FROM Patient 
            WHERE Patient_ID IN
					        ((SELECT (Patient_ID) FROM Patient 
					        WHERE Nurse_ID = {$_SESSION["ID"]})
                            UNION
                            (SELECT (Patient_ID) FROM Patient 
					        WHERE Doctor_ID = {$_SESSION["ID"]}))";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "<h1>MY PATIENTS</h1>";
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
                echo "<td style='background-color: #ffffff; text-align: center; padding: 10px; font-size: 15px;'>{$value}</td>";
                if($needButton){
                    echo "<th><form action=\"myTreatments.php\" method=\"post\"> <input type=\"submit\" class=\"sign-in-button\" name=\"PID\" value=\"{$value}\"></form></th>";
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
// DISPLAY MY PATIENTS DONE

//BUTTONS REDIRECT
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["PID"])){
            $_SESSION["Patient_ID"] = $_POST["PID"];
            header("Location: patientDash.php"); 
        }
    }
//BUTTONS REDIRECT
?>