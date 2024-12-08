<?php
include("database.php");
include("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $doctor_id = $_POST['doctor_id'];
    $nurse_id = $_POST['nurse_id'];
    $room_id = $_POST['room_id'];
    $bed_id = $_POST['bed_id'];

    $sql = "INSERT INTO Patient (F_name, L_name, DOB, Gender, Room_ID, Doctor_ID, Nurse_ID, Bed_ID) 
            VALUES ('$first_name', '$last_name', '$dob', '$gender', '$room_id', '$doctor_id', '$nurse_id', '$bed_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Patient added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Add Patient</title>
</head>
<body>
    <h1>Add New Patient</h1>
    <form class="login-form" method="POST" action="">
        <label for="first_name" class="txt">First Name:</label>
        <input type="text" class="text-input" name="first_name" required><br>
        
        <label for="last_name" class="txt">Last Name:</label>
        <input type="text" name="last_name" class="text-input" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" class="text-input" required><br>

        <label for="gender" class="txt" >Gender:</label>
        <select name="gender" required>
            <option value="M" class="txt" >Male</option>
            <option value="F" class="txt" >Female</option>
        </select><br>

        <label for="doctor_id" class="txt">Assigned Doctor:</label>
        <input type="number" class="text-input" name="doctor_id" required><br>

        <label for="nurse_id" class="txt">Assigned Nurse:</label>
        <input type="number" class="text-input" name="nurse_id" required><br>

        <label for="room_id" class="txt">Room ID:</label>
        <input type="number"  class="text-input" name="room_id" required><br>

        <label for="bed_id" class="txt">Bed ID:</label>
        <input type="number" class="text-input" name="bed_id" required><br>

        <button type="submit" class="register-button">Add Patient</button>

    
    </form>
</body>
</html>