<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-Update Head</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Update Head Doctor</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">ID</label>
                    <input type="text" name="Doctor_ID" class="fields"
                     required>
                        <br>
                    <button type="submit" class="register-button">Update</button>       
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
        $Doctor_ID = filter_input(INPUT_POST, "Doctor_ID", FILTER_SANITIZE_SPECIAL_CHARS);
        echo "ID is{$Doctor_ID}";
        //Ensure not too long and right types for DB
        if(strlen($Doctor_ID) != 4){
            echo "Invalid Input";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
            
            //sql statement
            $sql = "UPDATE Department_Heads
                    SET Doctor_ID = {$Doctor_ID}
                    WHERE Department_ID = {$_SESSION["Department_ID"]}";
            echo "sql is{$sql}";
            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: departmentDash.php");
            
        }
    }
?>