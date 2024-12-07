<?php
include("header.php");
include("database.php");

$sql = "SELECT * FROM Room INNER JOIN Bed ON Room.RoomID = Bed.RoomID";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
$needheaders = true;
echo "<h2 style='color:black; font-family: Cairo, sans-serif;'>Rooms and Beds</h2>";
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 10px;'>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($needheaders) {
            $needheaders = false;
            echo "<tr style='background-color: #E9E4E4; color: black; font-size: 15px;'>";
            foreach ($row as $key => $value) {
                echo "<th style='padding: 10px; text-align: center; color: black; font-size: 15px;'>{$key}</th>";
            }
            echo "</tr>";
        }
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td style='background-color: #ffffff; text-align: center; padding: 10px; font-size: 15px;'>{$value}</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>