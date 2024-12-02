<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-New Nurse</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">New Nurse Registration</p>
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
                    
                    <label for="first" class="txt">Department</label>
                    <input type="text" name="Department_ID" class="text-input"
                        placeholder="required">
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
        include("../database.php");
        //Variables from submit
        $F_name = $_POST["F_name"];
        $L_name = $_POST["L_name"];
        $Gender = $_POST["Gender"];
        $Department_ID = $_POST["Department_ID"];

        $sql = "INSERT INTO Nurse(F_name, L_name, Gender, Department_ID)
                VALUES('{$F_name}','{$L_name}', '{$Gender}', '{$Department_ID}')";
        
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        include("../database.php");
        //get max ID = new doc
        $sql_get = "SELECT * FROM Nurse
                    WHERE Nurse_ID = (SELECT MAX(Nurse_ID)
                                        FROM Nurse)";

        $result = mysqli_query($conn, $sql_get);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["Nurse_ID"] = $row["Nurse_ID"];
        
        header("Location: ../createPassword.php");
        exit;
    }

?>