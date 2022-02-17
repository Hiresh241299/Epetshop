<?php

$useLocal = true;

if($useLocal == true){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petshopdb";
}

else{
    // $servername = "https://databases.000webhost.com";
    // $username = "id18445428_epetshopuser";
    // $password = "D>]L-o4j67GXg!I!";
    // $dbname = "id18445428_epetshopdb";

    //pass
    //4xxvn^uO(L5]}J>V
    //other pass
    //D>]L-o4j67GXg!I!

    $servername = "sql647.main-hosting.eu";
    $username = "u748674957_epetshopuser";
    $password = "Test12345";
    $dbname = "u748674957_epetshopdb";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//set Appropriate timezone
date_default_timezone_set("Indian/Mauritius");
?>