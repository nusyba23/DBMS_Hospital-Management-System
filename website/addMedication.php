<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Medication</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Medication</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Name</label>
                    <input type="text" name="Name" class="fields"
                     required>
                        <br>
                    <button type="submit" class="register-button" name="Table"  value= "Medication">Add</button>       
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
        $Patient_ID = $_SESSION["Patient_ID"];
        $Table = $_POST["Table"];

        //Ensure not too long and right types for DB
        if(strlen($Name) > 20){
            echo "Name too long";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
            
            //sql statement
            $sql = "INSERT INTO {$Table}(Medication, Patient_ID)
                    VALUES('{$Name}','{$Patient_ID}')";

            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: patientDash.php");
            
        }
    }
?>