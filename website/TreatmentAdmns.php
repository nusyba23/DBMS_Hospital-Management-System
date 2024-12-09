<?php
include("database.php");

// Step 1: Create the table
$create_table_query = "
CREATE TABLE IF NOT EXISTS Treatment_Administers (
    Treatment_Administer_ID INT AUTO_INCREMENT PRIMARY KEY,
    Treatment_ID INT NOT NULL,
    Doctor_Name VARCHAR(50),
    Doctor_Administer_Date DATE,
    Doctor_Administer_Time TIME,
    Nurse_Name VARCHAR(50),
    Nurse_Administer_Date DATE,
    Nurse_Administer_Time TIME,
    FOREIGN KEY (Treatment_ID) REFERENCES Treatment(Treatment_ID) ON DELETE CASCADE
)";
if (mysqli_query($conn, $create_table_query)) {
    echo "Table Treatment_Administers created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Step 2: Populate the table with query results
$treatment_id = 123; // Replace with the actual Treatment_ID
$populate_query = "
INSERT INTO Treatment_Administers (Treatment_ID, Doctor_Name, Doctor_Administer_Date, Doctor_Administer_Time, Nurse_Name, Nurse_Administer_Date, Nurse_Administer_Time)
SELECT 
    t.Treatment_ID,
    CONCAT(d.F_name, ' ', d.L_name) AS Doctor_Name,
    da.Date AS Doctor_Administer_Date,
    da.Time AS Doctor_Administer_Time,
    CONCAT(n.F_name, ' ', n.L_name) AS Nurse_Name,
    na.Date AS Nurse_Administer_Date,
    na.Time AS Nurse_Administer_Time
FROM Treatment t
LEFT JOIN Doctor_Administers da ON t.Treatment_ID = da.Treatment_ID
LEFT JOIN Doctor d ON da.Doctor_ID = d.Doctor_ID
LEFT JOIN Nurse_Administers na ON t.Treatment_ID = na.Treatment_ID
LEFT JOIN Nurse n ON na.Nurse_ID = n.Nurse_ID
WHERE t.Treatment_ID = $treatment_id";

if (mysqli_query($conn, $populate_query)) {
    echo "Data inserted into Treatment_Administers successfully.<br>";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
