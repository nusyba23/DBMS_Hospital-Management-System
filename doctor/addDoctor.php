<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Doctor</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">New Doctor Registration</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">First Name</label>
                    <input type="text" name="F_name" class="text-input"
                        placeholder="John" required>
                        <br>

                    <label for="first" class="txt">Last Name</label>
                    <input type="text" name="L_name" class="text-input"
                        placeholder="Smith" required>
                        <br>
                    
                        <label for="gender" class="txt">Gender</label>
                        <div class="gender-choice">
                            <label>
                            <input type="radio" name="Gender" value="M" class="txt"> M
                            </label>
                            <label>
                            <input type="radio" name="Gender" value="F" class="txt"> F
                            </label>
                        </div>
                        <br>

                    
                    <label for="first" class="txt">Specialization</label>
                    <input type="text" name="Type" class="text-input"
                        placeholder="not required">
                        <br>
                        
                    <button type="submit" class="register-button" >Register</button>       
                </form>  
    </div>  
</body>
</html>

<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // the file that estabishes the connection to database
        include("database.php");
        //Variables from submit
        $F_name = $_POST["F_name"];
        $L_name = $_POST["L_name"];
        $Gender = $_POST["Gender"];
        $Type = $_POST["Type"];

        $sql;
        
        if($Type == null){
            $sql = "INSERT INTO Doctor(F_name, L_name, Gender)
                    VALUES('{$F_name}','{$L_name}', '{$Gender}')";
        }
        else{
            $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Type)
                    VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Type}')";
        }
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        include("database.php");
        //get max ID = new doc
        $sql_get = "SELECT * FROM Doctor
                    WHERE Doctor_ID = (SELECT MAX(Doctor_ID)
                                        FROM Doctor)";

        $result = mysqli_query($conn, $sql_get);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["Doctor_ID"] = $row["Doctor_ID"];
        
        header("Location: ../createPassword.php");
        exit;
    }

?>