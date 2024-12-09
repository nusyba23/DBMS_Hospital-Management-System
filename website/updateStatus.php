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
            <p class="login-subtitle">Update Status</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Status</label>
                    <input type="text" name="Status" class="fields"
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
        $Status = filter_input(INPUT_POST, "Status", FILTER_SANITIZE_SPECIAL_CHARS);
        echo "Status is{$Status}";
        //Ensure not too long and right types for DB
        if(strlen($Status) > 15){
            echo "Invalid Input";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
            
            //sql statement
            $sql = "UPDATE Room
                    SET Status = '{$Status}'
                    WHERE Room_ID = {$_SESSION["Room_ID"]}";
            echo "sql is{$sql}";
            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: departmentDash.php");
            
        }
    }
?>