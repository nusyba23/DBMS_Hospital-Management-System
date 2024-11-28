<!-- FILE TEMPLATE NEED BACK END COMPLETED
TAKES INPUT FROM FORM FOR ALL ATTRIBUTES IN PATEINT NOT ID! ID IS AUTO!  -->

<?php
    session_start();
?>

<!-- need update -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Hospital</title>
</head>
<body>
    <div class="login-container-hospital">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">New Hospital Registration</p>
        </div>
                <form class="login-form" action="addHospital.php" method="post">
                    <label for="first" class="txt">Name</label>
                    <input type="text" name="Name" class="fields"
                        placeholder="Hospital Name" required>
                        <br>

                    <label for="first" class="txt">City</label>
                    <input type="text" name="City" class="fields"
                        placeholder="City" required>
                        <br>
                    
                    <label for="first" class="txt">Street Number</label>
                    <input type="text" name="Street_Num" class="fields"
                        placeholder="Street Number" required>
                        <br>
                    
                    <label for="first" class="txt">Street</label>
                    <input type="text" name="Street" class="fields"
                        placeholder="Street" required>
                        <br>
                        
                    <button type="submit" class="register-button" >Register</button>       
                </form>  
    </div>  
</body>
</html>
<!-- doesn't need updating -->
<?php
    //runs when button pressed
    if($_SERVER["REQUEST_METHOD"] == "POST" && (strlen($_SESSION["ID"]) == 4)){
        
        //assume valid input
        $input_valid = true;

//Update from here


        //Sanitize
        $Name = filter_input(INPUT_POST, "Name", FILTER_SANITIZE_SPECIAL_CHARS);
        $City = filter_input(INPUT_POST, "City", FILTER_SANITIZE_SPECIAL_CHARS);
        $Street = filter_input(INPUT_POST, "Street", FILTER_SANITIZE_SPECIAL_CHARS);
        $Street_Num = filter_input(INPUT_POST, "Street_Num", FILTER_SANITIZE_SPECIAL_CHARS);

        //Ensure not too long and right types for DB
        if(strlen($Name) > 50){
            echo "Name too long";
            $input_valid = false;
        }
    
        if(strlen($City) > 20){
            echo "City too long";
            $input_valid = false;
        }
    
        if(strlen($Street) > 20){
            echo "Street too long";
            $input_valid = false;
        }
    
        if(empty($Street_Num)){
            echo "Street_Num expect Int";
            $input_valid = false;
        }
    
        if(strlen($Street_Num) > 5){
            echo "Street_Num too long";
            $input_valid = false;
        }
        
        //Determined to be valid
        if($input_valid){
//needs updateing           
            //sql statement
            $sql = "INSERT INTO Hospital(Name, City, Street, Street_Num)
                    VALUES('{$Name}','{$City}','{$Street}','{$Street_Num}')";
//same each file

            //submit to database
            include("database.php");
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            


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