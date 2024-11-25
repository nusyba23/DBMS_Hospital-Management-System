<?php

    include("database.php");

    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];

    if(strcmp($pass1, $pass2) == 0){

        $Password = password_hash($pass1, PASSWORD_DEFAULT);

        //get max ID = new doc
        $sql_get = "SELECT *
                    FROM Doctor
                    WHERE Doctor_ID = (SELECT MAX(Doctor_ID)
                                        FROM Doctor)";

        $result = mysqli_query($conn, $sql_get);
        $row = mysqli_fetch_assoc($result);
        $Doctor_ID = $row["Doctor_ID"];

        $sql = "INSERT INTO Doctor_Passwords(Doctor_ID, Password)
                VALUES('{$Doctor_ID}','{$Password}')";
    
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    
        header("Location: index.html");
        exit;
    }
    else
        header("Location: createPassword.html");

?>