<?php
foreach($_SESSION as $key => $value){
    echo "{$key} = {$value} <br>";
}
foreach($_POST as $key => $value){
    echo "{$key} = {$value} <br>";
}

$_SERVER["REQUEST_METHOD"] == "POST";
?>