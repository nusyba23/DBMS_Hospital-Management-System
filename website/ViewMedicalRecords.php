<?php
include("database.php");
include("header.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Patient_ID'])) {
    $Patient_ID = $_GET['Patient_ID'];

    // Fetch patient details
    $patient_query = "SELECT F_name, L_name FROM Patient WHERE Patient_ID = '$Patient_ID'";
    $patient_result = mysqli_query($conn, $patient_query);
    $patient = mysqli_fetch_assoc($patient_result);

    // Fetch medical records
    $sql = "SELECT * FROM MedicalRecord WHERE Patient_ID = '$Patient_ID' ORDER BY Record_Date DESC";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>View Medical Records</title>
</head>
<body>
    <h1>Medical Records</h1>

    <?php if (isset($patient)): ?>
        <h2>Patient: <?= $patient['F_name'] . " " . $patient['L_name'] ?></h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table border="1" class="records-table">
                <tr>
                    <th>Record Date</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Medications</th>
                    <th>Doctor</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['Record_Date'] ?></td>
                        <td><?= $row['Diagnosis'] ?></td>
                        <td><?= $row['Treatment'] ?></td>
                        <td><?= $row['Medications'] ?></td>
                        <td><?= $row['Doctor_ID'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No medical records found for this patient.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Invalid Patient ID.</p>
    <?php endif; ?>

    <a href="AddPatient.php">Back to Add Patient</a>
</body>
</html>

<?php
mysqli_close($conn);
?>
