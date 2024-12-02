<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css"> <!-- Adjust the path as needed -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital DB - Add Patient</title>
</head>
<body>
    <div class="login-container">
        <div class="heading-container">
            <h1 class="login-title">Hospital Database</h1>
            <p class="login-subtitle">New Patient Registration</p>
        </div>
        <form class="login-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <!-- Patient Personal Details -->
            <label for="first" class="txt">First Name</label>
            <input type="text" name="F_name" placeholder="John" required><br>

            <label for="last" class="txt">Last Name</label>
            <input type="text" name="L_name" placeholder="Doe" required><br>

            <label for="dob" class="txt">Date of Birth</label>
            <input type="date" name="DOB" required><br>

            <label for="gender" class="txt">Gender</label>
            <input type="radio" name="Gender" value="M"> M
            <input type="radio" name="Gender" value="F"> F<br>

            <!-- Assigned Doctor and Nurse -->
            <label for="doctor" class="txt">Assigned Doctor ID</label>
            <input type="number" name="Doctor_ID" placeholder="2000" required><br>

            <label for="nurse" class="txt">Assigned Nurse ID</label>
            <input type="number" name="Nurse_ID" placeholder="1000" required><br>

            <!-- Room and Bed Assignment -->
            <label for="room" class="txt">Room ID</label>
            <input type="number" name="Room_ID" placeholder="101" required><br>

            <label for="bed" class="txt">Bed ID</label>
            <input type="number" name="Bed_ID" placeholder="1" required><br>

            <button type="submit" class="register-button">Register</button>
        </form>
    </div>
</body>
</html>

<?php
// Start session to store patient information if needed
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("C:\Users\nusyb\OneDrive\Desktop\Cpsc 471\Project\DBMS_Hospital-Management-System\database.php"); // Adjust the path to match your project structure

    // Retrieve form data
    $F_name = $_POST["F_name"];
    $L_name = $_POST["L_name"];
    $DOB = $_POST["DOB"];
    $Gender = $_POST["Gender"];
    $Room_ID = $_POST["Room_ID"];
    $Doctor_ID = $_POST["Doctor_ID"];
    $Nurse_ID = $_POST["Nurse_ID"];
    $Bed_ID = $_POST["Bed_ID"];

    // Insert patient data into the Patient table
    $sql = "INSERT INTO Patient (F_name, L_name, DOB, Gender, Room_ID, Doctor_ID, Nurse_ID, Bed_ID)
            VALUES ('$F_name', '$L_name', '$DOB', '$Gender', '$Room_ID', '$Doctor_ID', '$Nurse_ID', '$Bed_ID')";

    // Execute the query and handle errors
    if (mysqli_query($conn, $sql)) {
        // Retrieve the Patient_ID of the newly added patient
        $patient_id = mysqli_insert_id($conn);

        // Store the Patient_ID in the session
        $_SESSION["Patient_ID"] = $patient_id;

        echo "<script>alert('Patient added successfully with ID: $patient_id');</script>";

        // Optionally redirect to a patient dashboard or another page
        // header("Location: patient_dashboard.php");
        // exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
