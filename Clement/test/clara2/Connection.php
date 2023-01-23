<?php
function Connection()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "madeth";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli($host,$user,$password,$dbname);
    return $mysqli;
}
    
?>
