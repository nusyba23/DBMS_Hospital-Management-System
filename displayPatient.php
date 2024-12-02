<?php
    include("database.php");

    $sql = "SELECT * FROM Hospital";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    $needheaders = true;
    echo "<table border='1'>"; // Start an HTML table
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($needheaders){
                $needheaders = false;
                echo "<tr>"; // Start header row
                foreach($row as $key => $value){
                    echo "<th>{$key}</th>"; // Add table headers
                }
                echo "</tr>"; // End header row
            }
            echo "<tr>"; // Start data row
            foreach($row as $key => $value){
                echo "<td>{$value}</td>"; // Add table data
            }
            echo "</tr>"; // End data row
        }
    }
    echo "</table>"; // End HTML table
?>
