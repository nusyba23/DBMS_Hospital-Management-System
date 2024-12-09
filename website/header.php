<?php
    session_start();
    //include("echoVars.php");

    $sql = "SELECT Degree
            FROM Doctor_Degree
            WHERE Doctor_ID = {$_SESSION["ID"]}";
    include("database.php");
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    

    $Degree = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Degree = $Degree . " " . $row["Degree"];
        }
    }

//actions on button press
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
    if(isset($_POST["patients"])){
        header("Location: displayPatient.php");
    }
//end actions on button press
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<!-- BUTTONS TABLE -->
<table>
    <tr>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" class="table-button" name="logout" value="Logout">
    </form>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" class="table-button" name="dashboard" value="Dashboard">
    </form>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="submit" class="table-button" name="patients" value="Patients">
    </form>
    <button class="table-button" onclick="window.location.href = 'displayHospitals.php'">Hospitals</button>
    <button class="table-button" onclick="window.location.href = 'updatePassword.php'">Update Password</button>
    </tr>
</table>
<!-- BUTTONS TABLE END -->
<!-- INFO DISPLAY -->
    <h1 class="title">Name: <?php echo$_SESSION["Name"]?><?php echo$Degree ?></h1>
    <h3 class="title">User Type: <?php echo$_SESSION["User_Type"]?> </h3>
    <h3 class="hospital-details">Hospital: <?php echo$_SESSION["Hospital"]?> <br>
                                Department: <?php echo$_SESSION["Department_Name"]?> <br>
                                 City: <?php echo$_SESSION["City"]?> <br> 
                                 Address: <?php echo$_SESSION["Address"]?> 
    </h3>
<!-- INFO DISPLAY END -->
</head>
