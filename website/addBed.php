<?php
    session_start();
    $sql = "INSERT INTO Bed (Room_ID)
    VALUES({$_SESSION["Room_ID"]})";

    //submit to database
    include("database.php");
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: roomDash.php");
?>