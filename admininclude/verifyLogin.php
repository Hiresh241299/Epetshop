<?php
//verify admin session
include "functions.php";
include "dbConnection.php";
if(!isset($_SESSION)){
    session_start();
}
//Check if session roleid exists
//else login.php
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"])) || ($_SESSION["roleid"] != 1)) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
}

$_SESSION['sidebarActive']="home";
?>