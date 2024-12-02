<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];

    $sql = "DELETE FROM Patient WHERE Patient_ID = '$patient_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Patient deleted successfully!";
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
    <title>Delete Patient</title>
</head>
<body>
    <h1>Delete Patient</h1>
    <form method="POST" action="">
        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" required><br>

        <button type="submit">Delete Patient</button>
    </form>
</body>
</html>
