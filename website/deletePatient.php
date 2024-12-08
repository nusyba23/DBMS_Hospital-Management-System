<?php
    include("header.php");     
        //sql statement
    $sql = "DELETE FROM Patient WHERE Patient_ID = {$_SESSION["Patient_ID"]}";
    include("database.php");
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: displayPatient.php");
    
        
?>