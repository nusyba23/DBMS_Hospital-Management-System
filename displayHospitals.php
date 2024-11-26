<?php
    include("database.php");

    $sql = "SELECT * FROM Hospital";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    $needheaders = true;
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($needheaders){
                $needheaders = false;
                foreach($row as $key => $value){
                    //within quotes need proper html for table hearder $key = attribute
                    echo "{$key}   ";
                }
                echo "<br>";
            }
            foreach($row as $key => $value){
                //within quotes need proper html for tuple display $value
                echo "{$value}   ";
            }
            echo "<br>";
        }
    }
?>