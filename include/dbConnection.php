<?php

$useLocal = true;

if($useLocal == true){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petshopdb";
}

else{
    $servername = "localhost";
    $username = "id18445428_epetshopuser";
    $password = "D>]L-o4j67GXg!I!";
    $dbname = "id18445428_epetshopdb";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//set Appropriate timezone
date_default_timezone_set("Indian/Mauritius");
?>