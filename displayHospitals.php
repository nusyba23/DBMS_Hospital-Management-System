<?php
    include("database.php");

    $sql = "SELECT * FROM Hospital";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    $needheaders = true;
    if(mysqli_num_rows($result) > 0){
        echo "<table border=1, style='border-collapse: collapse; width: 100%; font-family: Cairo, sans-serif; border-radius: 20px;'>";
        while($row = mysqli_fetch_assoc($result)){
            if($needheaders){
                $needheaders = false;
                echo "<tr style='background-color: #E9E4E4, color: black, font-size: 15px;>";
                foreach($row as $key => $value){
                    //within quotes need proper html for table hearder $key = attribute
                    echo "<th style = 'padding: 10px; text-align: center; color: black, font-size: 15px; '{$key}</th> ";
                }
                echo "<tr>";
            }
            foreach($row as $key => $value){
                echo "<th style='background-color: #E9E4E4, color: black, font-size: 15px; font-family: Cairo, sans-serif;";
                //within quotes need proper html for tuple display $value
                echo "<th style = 'text-align: center; padding: 10px'{$value}</th>";
            }
            echo "<tr>";
        }
        echo "</table>";
    }
?>