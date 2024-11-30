<?php
    session_start();
    echo "\$_SESSION ARRAY<br>";
    foreach($_SESSION as $key => $value){
        echo "{$key} = {$value}" . "  |  ";
    }
    echo "<br>";
    echo "\$_POST ARRAY<br>";
    foreach($_POST as $key => $value){
        echo "{$key} = {$value}"."  |  ";
    }
?>