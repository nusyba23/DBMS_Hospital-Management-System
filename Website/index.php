<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-Doctor</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Please Log In</p>
        </div>
                <form class="login-form" action= "index.php" method = "post">
                    <label for="first" class="txt">ID</label>
                    <!--ID not specific so it can be compared in verification-->
                    <input type="text" name="ID" class="fields"
                        placeholder="xxxxxxxxxx" required>
                    
                    <label for="password" class="txt">Password</label>
                    <input type="password" name="password" class="fields"
                        placeholder="Password" required>
                        <br>

                    <button type="submit" name="login" class="sign-in-button">Sign In</button>

                    <p>
                        <a href="doctorOrNurse.html" class="new-emp-link">New Employee? Register Here</a>
                    </p>
                </form>
            
        
    </div>
    
</body>
</html>

<?php
    session_start();
    foreach($_SESSION as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    foreach($_POST as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    //sanitize input to prevent x-site script
    $ID = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_SPECIAL_CHARS);
    $attempt = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    //assume input valid
    $valid_input = true;
    $sql_get;
    $doctor = false;
    if(isset($_POST["login"])){
        //sanitze and validate input
        if((strlen($ID) == 4 && is_numeric($ID))){
            if($ID >= 2000){
                $doctor = true;
                $sql_get = "SELECT *
                            FROM Doctor_Passwords
                            WHERE Doctor_ID = {$ID}";
            }
            else{
                $sql_get = "SELECT *
                            FROM Nurse_Passwords
                            WHERE Nurse_ID = {$ID}";
            }
        }
        else{
            echo "Invalid ID and/or password";
            $valid_input = false;
        }
    }
    include("database.php");
    $result = mysqli_query($conn, $sql_get);
    mysqli_close($conn);
    $row;

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        echo "Invalid ID and/or password";
            $valid_input = false;
    }

    $valid_password = false;
    if($valid_input){
        $password = $row["Password"];
        $valid_password = password_verify($attempt, $password);
    }
    $attempt = "";
    $sql_get_name;
    if($valid_password){
        if($doctor){
            $sql_get_name = "SELECT *
                            FROM Doctor
                            WHERE Doctor_ID = {$ID}";
            
        }else{
            $sql_get_name = "SELECT *
                            FROM Nurse
                            WHERE Nurse_ID = {$ID}";
        }
        include("database.php");
        
        $result = mysqli_query($conn, $sql_get_name);
        $tuple = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        $_SESSION["Name"] = $tuple["F_name"] . ' ' . $tuple["L_name"];
        $_SESSION["ID"] = $ID; 
        $_SESSION["Gender"] = $tuple["Gender"];
        $_SESSION["Department"] = $tuple["Department_ID"];
        if($doctor)
            $_SESSION["Doctor_type"] = $tuple["Type"];

        $sql_get = "SELECT *
                    FROM Department
                    WHERE Department_ID = {$_SESSION["Department"]}";
       
        include("database.php");
        $result = mysqli_query($conn, $sql_get);
        $tuple = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        $_SESSION["Hospital_ID"] = $tuple["Hospital_ID"];

        $sql_get = "SELECT *
                    FROM Hospital
                    WHERE Hospital_ID = {$_SESSION["Hospital_ID"]}";
       
        include("database.php");
        $result = mysqli_query($conn, $sql_get);
        $tuple = mysqli_fetch_assoc($result);
        mysqli_close($conn);


        $_SESSION["Hospital"] = $tuple["Name"];
        $_SESSION["Address"] = $tuple["Street_Num"]. ' ' . $tuple["Street"];
        $_SESSION["City"] = $tuple["City"];

        if($doctor){
            header("Location: doctorDash.php");
        }   
        else{
            header("Location: nurseDash.php");
        }
    }
    else{
        echo "Invalid ID and/or password";
    }
    exit;
?>