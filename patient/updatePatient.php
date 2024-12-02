<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $room_id = $_POST['room_id'];
    $doctor_id = $_POST['doctor_id'];
    $nurse_id = $_POST['nurse_id'];

    $sql = "UPDATE Patient SET Room_ID = '$room_id', Doctor_ID = '$doctor_id', Nurse_ID = '$nurse_id' WHERE Patient_ID = '$patient_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Patient details updated successfully!";
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
    <title>Update Patient</title>
</head>
<body>
    <h1>Update Patient Details</h1>
    <form method="POST" action="">
        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" required><br>

        <label for="room_id">Room ID:</label>
        <input type="number" name="room_id"><br>

        <label for="doctor_id">Assigned Doctor:</label>
        <input type="number" name="doctor_id"><br>

        <label for="nurse_id">Assigned Nurse:</label>
        <input type="number" name="nurse_id"><br>

        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
