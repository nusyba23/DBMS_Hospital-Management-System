<?php 
    include("header.php");
    
    $PID = $_SESSION["Patient_ID"];
    if($_SESSION["ID"]> 1999)
        echo "<button class=\"table-button\" onclick=\"window.location.href = 'treatmentType.php'\">Add Treatment</button>";
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'myTreatments.php'\">Treatments</button>";
    // Medical Records button
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'ViewMedicalRecords.php?Patient_ID={$PID}'\">Medical Records</button>";
    $results = array();

    //Test_reports Button
    echo "<button class=\"table-button\" onclick=\"window.location.href = 'ViewTestReports.php?Patient_ID={$PID}'\">View Test Reports</button>";


    include("database.php");
    $sql = "SELECT * FROM Patient
            WHERE Patient_ID = {$PID}";
    $Patient = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Patient);

    include("database.php");
    $sql = "SELECT * FROM medicalrecord
            WHERE Patient_ID = {$PID}";
    $Medical_Record = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Medical_Record);
    
    include("database.php");
    $sql = "SELECT * FROM allergy
            WHERE Patient_ID = {$PID}";
    $Allery = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Allery);
    
    include("database.php");
    $sql = "SELECT * FROM immunization
            WHERE Patient_ID = {$PID}";
    $Immunization = mysqli_query($conn, $sql);
    mysqli_close($conn);
    array_push($results, $Immunization);
    
    include("database.php");
    $sql = "SELECT * FROM medication
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
        echo "<div style='margin-bottom: 20px;'>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px; margin-bottom: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden;'>";
        $needheaders = true;
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($needheaders){
                    $needheaders = false;
                    echo "<tr style='background-color: #E9E4E4; color: black; font-size: 15px;'>";
                    foreach($row as $key => $value){
                        //within quotes need proper html for table hearder $key = attribute
                        echo "<th style='padding: 12px; text-align: center; font-weight: bold; font-size: 16px; border-bottom: 2px solid #000;'>{$key}</th>";
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
    }










        
?>