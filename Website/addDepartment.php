<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Department</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">New Department Registration</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Name</label>
                    <input type="text" name="Name" class="fields"
                        placeholder="Department Name" required>
                        <br>

                    <label for="first" class="txt">City</label>
                    <input type="text" name="Hospital_ID" class="fields"
                        placeholder="Hospital ID" required>
                        <br>
                    
                    <label for="first" class="txt">Street Number</label>
                    <input type="text" name="Head_Doctor_ID" class="fields"
                        placeholder="Head Doctor ID" required>
                        <br>    
                    <button type="submit" class="register-button" >Register</button>       
                </form>  
    </div>  
</body>
</html>

<?php
    //runs when button pressed
    if($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)){
        
        //assume valid input
        $input_valid = true;

        //Sanitize
        $Name = filter_input(INPUT_POST, "Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $Head_Doctor_ID = filter_input(INPUT_POST, "Head_Doctor_ID", FILTER_VALIDATE_INT);
        $Hospital_ID = filter_input(INPUT_POST, "Hospital_ID", FILTER_VALIDATE_INT);

        //Ensure not too long and right types for DB
        if(strlen($Name) > 50){
            echo "Name too long";
            $input_valid = false;
        }
    
        if(empty($Head_Doctor_ID)){
            echo "Head_Doctor_ID expect Int";
            $input_valid = false;
        }
    
        if(strlen($Head_Doctor_ID) > 4){
            echo "Head_Doctor_ID too long";
            $input_valid = false;
        }

        if(empty($Hospital_ID)){
            echo "Hospital_ID expect Int";
            $input_valid = false;
        }
    
        if(strlen($Hospital_ID) > 4){
            echo "Hospital_ID too long";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
            
            //sql statement
            $sql = "INSERT INTO Department(Name, Head_Doctor_ID, Hospital_ID)
                    VALUES('{$Name}','{$Head_Doctor_ID}','{$Hospital_ID}')";

            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            
            //redirect
            $ID = $_SESSION["ID"];
            //redirect
            if(($ID>1999) && ($ID<3000))
                header("Location: doctorDash.php");
            else if(($ID>999) && ($ID<2000))
                header("Location: nurseDash.php");
            else
                header("Location: index.php");
            exit;
        }
    }
?>