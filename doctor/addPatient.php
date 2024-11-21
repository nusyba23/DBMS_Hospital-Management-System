<?php
    // the file that estabishes the connection to database
    include("database.php");
    
    /* the query, the variables are from the array of key value pairs that is created
    when the html form is submited 

    <form class="login-form" action="addDoctor.php" method="post">

    <input type="text" name="F_name"

    the action makes this file run when button clicked and the $POST array contains
    the values entered in to that field. 
    */
    
    $sql = "INSERT INTO Patient(F_name, L_name, Gender)
	        VALUES('{$_POST["F_name"]}','{$_POST["L_name"]}', '{$_POST["Gender"]}')";

    //$conn is the connection variable from database.php

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    //redirect to page you need to goto and include exit for security
    header("Location: index.html");
    exit;