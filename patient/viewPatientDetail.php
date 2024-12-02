<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];

    $sql = "SELECT * FROM Patient WHERE Patient_ID = '$patient_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $patient = mysqli_fetch_assoc($result);
        echo "<h1>Patient Details</h1>";
        echo "Name: " . $patient['F_name'] . " " . $patient['L_name'] . "<br>";
        echo "DOB: " . $patient['DOB'] . "<br>";
        echo "Gender: " . $patient['Gender'] . "<br>";
        echo "Assigned Doctor: " . $patient['Doctor_ID'] . "<br>";
        echo "Assigned Nurse: " . $patient['Nurse_ID'] . "<br>";
        echo "Room ID: " . $patient['Room_ID'] . "<br>";
        echo "Bed ID: " . $patient['Bed_ID'] . "<br>";
    } else {
        echo "No patient found with ID: $patient_id";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>View Patient Details</title>
</head>
<body>
    <h1>View Patient Details</h1>
    <form method="POST" action="">
        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" required><br>

        <button type="submit">View Details</button>
    </form>
</body>
</html>
