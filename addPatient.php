<?php
    // the file that estabishes the connection to database
    include("database.php");
    
    //$sql = "INSERT INTO Patient(F_name, L_name, Gender)
	        //VALUES('{$_POST["F_name"]}','{$_POST["L_name"]}', '{$_POST["Gender"]}')";

    //mysqli_query($conn, $sql);
    mysqli_close($conn);

    //redirect to page you need to goto and include exit for security
    header("Location: index.html");
    exit;