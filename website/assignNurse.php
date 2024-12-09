<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-Assign Nurse</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Assign Nurse</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Nurse ID</label>
                    <input type="text" name="Nurse_ID" class="fields"
                     required>
                        <br>
                    <button type="submit" class="register-button" name="Table"  value= "Patient">Add</button>       
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
        $Nurse_ID = filter_input(INPUT_POST, "Nurse_ID", FILTER_VALIDATE_INT);
        $Patient_ID = $_SESSION["Patient_ID"];
        $Table = $_POST["Table"];
        
        //Determined to be valid
        if($input_valid){

            //sql statement to update
            $sql = "UPDATE {$Table} SET Nurse_ID = {$Nurse_ID} WHERE Patient_ID = {$Patient_ID}";
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            
            header("Location: patientDash.php");
            
        }
    }
?>