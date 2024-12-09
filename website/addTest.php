<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Test Report</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Test_Report</p>
        </div>
                <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <label for="first" class="txt">Result</label>
                    <input type="text" name="Test_Result" class="fields"
                     required>
                        <br>
                    <label for="first" class="txt">Type</label>
                    <input type="text" name="Test_Type" class="fields"
                     required>
                        <br>
                    <label for="first" class="txt">Date</label>
                    <input type="date" name="Test_Date" class="fields"
                     required>
                        <br>
                    <button type="submit" class="register-button" name="Test"  value= "Test">Add</button>       
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
        $Test_Result = filter_input(INPUT_POST, "Test_Result", FILTER_SANITIZE_SPECIAL_CHARS);
        $Test_Type = filter_input(INPUT_POST, "Test_Type", FILTER_SANITIZE_SPECIAL_CHARS);
        $Test_date = filter_input(INPUT_POST, "Test_Date", FILTER_SANITIZE_SPECIAL_CHARS);
        $Patient_ID = $_SESSION["Patient_ID"];

        //Ensure not too long and right types for DB
        if(strlen($Test_Result) > 20){
            echo "Result too long";
            $input_valid = false;
        }
        if(strlen($Test_Type) > 20){
            echo "Type too long";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
            //sql statement
            $sql = "INSERT INTO Test_Report(Test_Type, Test_Result, Test_date, Patient_ID)
                    VALUES('{$Test_Type}','{$Test_Result}','{$Test_date}',{$Patient_ID})";
            echo "$sql";
            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: patientDash.php");
            
        }
    }
?>