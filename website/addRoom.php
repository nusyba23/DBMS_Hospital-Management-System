
<?php
    session_start();
    $sql = "INSERT INTO Room (Department_ID)
    VALUES({$_SESSION["Department_ID"]})";

    //submit to database
    include("database.php");
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: departmentDash.php");
?>