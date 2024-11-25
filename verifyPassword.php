<?php

    include("database.php");
    
    $ID = $_POST["ID"];
    $attempt = $_POST["password"];
    $sql_get;
    
    //need to update to 200000000
    if($ID >= 0){
        $sql_get = "SELECT *
                    FROM Doctor_Passwords
                    WHERE Doctor_ID = {$ID}";
    }
    else{
        $sql_get = "SELECT *
                    FROM Nurse_Passwords
                    WHERE Nurse_ID = {$ID}";
    }
        
    $result = mysqli_query($conn, $sql_get);
    $row = mysqli_fetch_assoc($result);
    $Password = $row["Password"];
    mysqli_close($conn);

    if(password_verify($attempt, $Password)){
        if($ID >=200000000){
            header("Location: doctor/dash.html");
        }else{
            header("Location: nurse/nursePage.html");
        }
    }else{
        header("Location: index.html");
    }
    exit;
?>