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
                    <input type="text" name="F_name"
                        placeholder="John" required>
                        <br>

                    <label for="first" class="txt">Last Name</label>
                    <input type="text" name="L_name"
                        placeholder="Smith" required>
                        <br>
                    
                    <label for="first" class="txt">Gender</label>
                    <input type="radio" name= "Gender" value ="M">
                    M<br>
                    <input type="radio" name= "Gender" value ="F">
                    F<br>

                    <label for="first" class="txt">Department</label>
                    <input type="text" name="Department_ID"
                        placeholder="required">
                        <br>
                    
                    <label for="first" class="txt">Specialization</label>
                    <input type="text" name="Type"
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
        //Variables from submit
        
        $F_name = filter_input(INPUT_POST, "F_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $L_name = filter_input(INPUT_POST, "L_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Gender = filter_input(INPUT_POST, "Gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $Department_ID = filter_input(INPUT_POST, "Department_ID", FILTER_VALIDATE_INT);
        $Type = filter_input(INPUT_POST, "Type", FILTER_SANITIZE_SPECIAL_CHARS);

        $input_valid = true;

        if(strlen($F_name) > 20){
            echo "First name too long";
            $input_valid = false;
        }

        if(strlen($L_name) > 20){
            echo "Last too long";
            $input_valid = false;
        }

        if(strlen($Type) > 20){
            echo "Type too long";
            $input_valid = false;
        }

        if(empty($Department_ID)){
            echo "Depatment_ID expect Int";
            $input_valid = false;
        }

        if($input_valid){

            $sql;
        
            if($Type == null){
                $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Department_ID)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', {$Department_ID})";
            }
            else{
                $sql = "INSERT INTO Doctor(F_name, L_name, Gender, Type, Department_ID)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Type}',{$Department_ID})";
            }
            include("database.php");
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

            header("Location: createPassword.php");
            exit;
        }
    }

?>