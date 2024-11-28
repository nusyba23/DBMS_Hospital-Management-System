<?php
    session_start();
    echo "\$_SESSION ARRAY<br>";
    foreach($_SESSION as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    echo "\$_POST ARRAY<br>";
    foreach($_POST as $key => $value){
        echo "{$key} = {$value} <br>";
    }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: index.php");
    }
    if(isset($_POST["dashboard"])){
        if($_SESSION["ID"]>1999)
            header("Location: doctorDash.php");
        else
            header("Location: nurseDash.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" name="dashboard" value="Dashboard">
    </form>
    <h1 class="title">Name: <?php echo$_SESSION["Name"]?> </h1>
    <h3 class="title">User Type: <?php echo$_SESSION["User_Type"]?> </h3>
    <h3 class="hospital-details">Hospital: <?php echo$_SESSION["Hospital"]?> <br> City: <?php echo$_SESSION["City"]?> <br> Address: <?php echo$_SESSION["Address"]?> </h3>
</head>