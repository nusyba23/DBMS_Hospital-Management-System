<?php
include("database.php");
include("header.php");

if (isset($_GET['Patient_ID'])) {
    $Patient_ID = $_GET['Patient_ID'];

    // Fetch test reports for the patient
    $sql = "SELECT * FROM Test_Report WHERE Patient_ID = '$Patient_ID'";
    $result = mysqli_query($conn, $sql);
} else {
    die("Patient ID not provided.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>View Test Reports</title>
</head>
<body>
    <h1>Test Reports</h1>
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Report ID</th>
            <th>Test Name</th>
            <th>Result</th>
            <th>Test Date</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['Report_ID']}</td>
                        <td>{$row['Test_Name']}</td>
                        <td>{$row['Result']}</td>
                        <td>{$row['Test_Date']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No test reports found.</td></tr>";
        }
        ?>
    </table>
    <a href="patientdashboard.php">Back to Dashboard</a>
</body>
</html>

<?php
mysqli_close($conn);
?>
