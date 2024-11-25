<?php
    include("database.php");

    $sql = "INSERT INTO Hospital(Name, City, Street, Street_Num)
            VALUES('{$_POST["Name"]}','{$_POST["City"]}','{$_POST["Street"]}','{$_POST["Street_Num"]}')";
    
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    header("Location: index.html");
    exit;

?>