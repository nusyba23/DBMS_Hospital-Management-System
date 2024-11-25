<?php
    // the file that estabishes the connection to database
    include("database.php");
    //Variables from submit
    $F_name = $_POST["F_name"];
    $L_name = $_POST["L_name"];
    $Gender = $_POST["Gender"];
    $Type = $_POST["Type"];

    $sql;
    
    if($Type == null){
        $sql = "INSERT INTO Doctor(F_name, L_name, Gender)
                VALUES('{$F_name}','{$L_name}', '{$Gender}')";
    }
    else{
        $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Type)
                VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Type}')";
    }
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    header("Location: ../createPassword.html");
    exit;

?>