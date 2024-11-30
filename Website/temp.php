<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB-Doctor</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class = "login-title">Hospital Database</h1>
            <p class="login-subtitle">Please Log In</p>
        </div>
                <form class="login-form" action= "index.php" method = "post">
                    <label for="first" class="txt">ID</label>
                    <!--ID not specific so it can be compared in verification-->
                    <input type="text" name="ID" class="fields"
                        placeholder="xxxxxxxxxx" required>
                    
                    <label for="password" class="txt">Password</label>
                    <input type="password" name="password" class="fields"
                        placeholder="Password" required>
                        <br>

                    <button type="submit" name="login" class="sign-in-button">Sign In</button>

                    <p>
                        <a href="doctorOrNurse.html" class="new-emp-link">New Employee? Register Here</a>
                    </p>
                </form>
            
        
    </div>
    
</body>
</html>

addHopital old

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
