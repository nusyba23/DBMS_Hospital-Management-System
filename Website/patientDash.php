<?php 
    include("header.php");
    
    $PID = $_SESSION["Patient_ID"];
    if($_SESSION["ID"]> 1999)
        echo "<button class=\"table-button\" onclick=\"window.location.href = 'treatmentType.php'\">Add Treatment</button>";
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'myTreatments.php'\">Treatments</button>";
    include("myTreatments.php");
    
    
    $results = array();

    include("database.php");
    $sql = "SELECT * FROM Patient
            WHERE Patient_ID = {$PID}";
    $Patient = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Patient);

    include("database.php");
    $sql = "SELECT * FROM Medical_Record
            WHERE Patient_ID = {$PID}";
    $Medical_Record = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Medical_Record);
    
    include("database.php");
    $sql = "SELECT * FROM Allergy
            WHERE Patient_ID = {$PID}";
    $Allery = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Allery);
    
    include("database.php");
    $sql = "SELECT * FROM Immunization
            WHERE Patient_ID = {$PID}";
    $Immunization = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Immunization);
    
    include("database.php");
    $sql = "SELECT * FROM Medication
            WHERE Patient_ID = {$PID}";
    $Medication = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Medication);
    
    include("database.php");
    $sql = "SELECT * FROM Test_Report
            WHERE Patient_ID = {$PID}";
    $Test_Report = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Test_Report);

    //need to add table tags
    
    foreach($results as $result){
        echo "<table border = \"1\">";
        $needheaders = true;
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($needheaders){
                    $needheaders = false;
                    echo "<tr>";
                    foreach($row as $key => $value){
                        //within quotes need proper html for table hearder $key = attribute
                        echo "<th>{$key}</th>";
                    }
                    echo "</tr>";
                }
                echo "<tr>";
                foreach($row as $key => $value){
                    echo "<th>{$value}</th>";
                    }
                echo "</tr>";
            }
        }
        echo "</table>";
    }










        
?>