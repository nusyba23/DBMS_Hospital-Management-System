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
            <p class="login-subtitle">Update Password</p>
        </div>
                <form class="login-form" action= "updatePassword.php" method = "post">
                    <label for="first" class="txt">ID</label>
                    <!--ID not specific so it can be compared in verification-->
                    <input type="text" name="ID" class="fields"
                        placeholder="xxxx" required>
                    
                    <label for="password" class="txt">Password</label>
                    <input type="password" name="password" class="fields"
                        placeholder="Password" required>
                        <br>
                    <label for="password" class="txt">New Password</label>
                    <input type="password" name="pass1"
                        placeholder="Password" required>
                        <br>
                    <label for="password" class="txt">Re-Enter New Password</label>
                    <input type="password" name="pass2"
                        placeholder="Password" required>
                        <br>

                    <button type="submit" name="login" class="sign-in-button">Update</button>

                    <p>
                        <a href="index.php" class="new-emp-link">Login Page</a>
                    </p>
                </form>
            
        
    </div>
    
</body>
</html>

<?php
    session_start();
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
    $sql_put;
    if($valid_password){
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_SPECIAL_CHARS);

        if(strcmp($pass1, $pass2) == 0){

            $Password = password_hash($pass1, PASSWORD_DEFAULT);
            $sql;

            if($doctor){
                echo "here";
                $sql = "UPDATE Doctor_Passwords
                        SET Password = '{$Password}'
                        WHERE Doctor_ID = {$ID}";
            }else{
                $sql = "UPDATE Nurse_Passwords
                        SET Password = '{$Password}'
                        WHERE Nurse_ID = {$ID}";
            }
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            if($doctor)
                header("Location: doctor/dash.php");
            else
                header("Location: nurse/dash.php");
            exit;
        }
        else{
            echo "Passwords do not match";
        }
    }
    else{
        echo "Invalid ID and/or password";
    }
    exit;
?>