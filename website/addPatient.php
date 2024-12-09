<?php
    include("header.php");
?>

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
            <p class="login-subtitle">New Patient Registration</p>
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

                    <label for="first" class="txt">Date of Birth</label>
                    <input type="date" name="DOB" class="text-input"
                        placeholder="required">
                        <br>
                        
                    <button type="submit" class="register-button" >Register</button>       
                </form>  
    </div>  
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Variables from submit
        
        $F_name = filter_input(INPUT_POST, "F_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $L_name = filter_input(INPUT_POST, "L_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Gender = filter_input(INPUT_POST, "Gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $DOB = filter_input(INPUT_POST, "DOB", FILTER_SANITIZE_SPECIAL_CHARS);

        $input_valid = true;

        if(strlen($F_name) > 20){
            echo "First name too long";
            $input_valid = false;
        }

        if(strlen($L_name) > 20){
            echo "Last too long";
            $input_valid = false;
        }

        if($input_valid){

        
            $sql = "INSERT INTO Patient(F_name, L_name, Gender, DOB)
                        VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$DOB}')";

            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            include("database.php");
            //get max ID = new patient
            $sql_get = "SELECT * FROM Patient
                        WHERE Patient_ID = (SELECT MAX(Patient_ID)
                                            FROM Patient)";
            $result = mysqli_query($conn, $sql_get);
            $row = mysqli_fetch_assoc($result);
            $_SESSION["Patient_ID"] = $row["Patient_ID"];


            header("Location: patientDash.php");
            exit;
        }
    }

?>