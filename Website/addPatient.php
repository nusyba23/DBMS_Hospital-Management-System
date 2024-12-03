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
    <form method="POST" action="">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select><br>

        <label for="doctor_id">Assigned Doctor:</label>
        <input type="number" name="doctor_id" required><br>

        <label for="nurse_id">Assigned Nurse:</label>
        <input type="number" name="nurse_id" required><br>

        <label for="room_id">Room ID:</label>
        <input type="number" name="room_id" required><br>

        <label for="bed_id">Bed ID:</label>
        <input type="number" name="bed_id" required><br>

        <button type="submit">Add Patient</button>
    </form>
</body>
</html>