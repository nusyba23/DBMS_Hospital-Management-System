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
                    <input type="password" name="pass1"
                        placeholder="Password" required>
                        <br>
                    <label for="password" class="txt">Re-Enter Password</label>
                    <input type="password" name="pass2"
                        placeholder="Password" required>
                        <br>
                <button type="submit" class="sign-in-button">Create</button>
                </form>  
    </div>
    
</body>
</html>

<?php
    session_start();
    echo "Your new ID is {$_SESSION["Doctor_ID"]}";
    //start session to carry ID to diplay for them
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_SPECIAL_CHARS);

        include("database.php");
        if(strcmp($pass1, $pass2) == 0){

            $Password = password_hash($pass1, PASSWORD_DEFAULT);

            //get max ID = new doc
            $sql_get = "SELECT *
                        FROM Doctor
                        WHERE Doctor_ID = (SELECT MAX(Doctor_ID)
                                            FROM Doctor)";

            $result = mysqli_query($conn, $sql_get);
            $row = mysqli_fetch_assoc($result);
            $Doctor_ID = $row["Doctor_ID"];

            $sql = "INSERT INTO Doctor_Passwords(Doctor_ID, Password)
                    VALUES('{$Doctor_ID}','{$Password}')";

            mysqli_query($conn, $sql);
            mysqli_close($conn);
        
            header("Location: index.php");
            exit;
        }
        else{
            echo "Passwords do not match";
        }
    }

?>