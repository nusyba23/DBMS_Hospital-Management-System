<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Create Password</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class = "login-title">Create Password</h1>
            <p class="login-subtitle">Please Log In</p>
        </div>
                <form class="login-form" action="createPassword.php" method="post">
                    <label for="password" class="txt">Password</label>
                    <input type="password" name="pass1" class="text-input"
                        placeholder="Password" required>
                        <br>
                    <label for="password" class="txt">Re-Enter Password</label>
                    <input type="password" name="pass2" class="text-input"
                        placeholder="Password" required>
                        <br>
                <button type="submit" name="login" class="sign-in-button">Create</button>
                </form>  
    </div>
    
</body>
</html>

<?php
    session_start();
    $doctor = false;
    $Doctor_ID;
    $Nurse_ID;
    if(strlen($_SESSION["Doctor_ID"])==4){
        $doctor = true;
        $Doctor_ID = $_SESSION["Doctor_ID"];
        echo "Your new ID is {$_SESSION["Doctor_ID"]}";
    }else{
        $Nurse_ID = $_SESSION["Nurse_ID"];
        echo "Your new ID is {$_SESSION["Nurse_ID"]}";
    }
    //start session to carry ID to diplay for them
    if(isset($_POST["login"])){

        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_SPECIAL_CHARS);

        include("database.php");
        if(strcmp($pass1, $pass2) == 0){

            $Password = password_hash($pass1, PASSWORD_DEFAULT);
            $sql;

            if($doctor){
                $sql = "INSERT INTO Doctor_Passwords(Doctor_ID, Password)
                        VALUES('{$Doctor_ID}','{$Password}')";
            }else{
                $sql = "INSERT INTO Nurse_Passwords(Nurse_ID, Password)
                        VALUES('{$Nurse_ID}','{$Password}')";
            }

            mysqli_query($conn, $sql);
            mysqli_close($conn);
            session_destroy();
        
            header("Location: index.php");
            exit;
        }
        else{
            echo "Passwords do not match";
        }
    }

?>