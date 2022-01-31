<?php
header('Access-Control-Allow-Origin: *');
include "dbConnection.php";
if ($conn -> connect_error) {
    die("connection failed:" . $conn->connect_error);
}
//admin functionalities
function getPaidOrderDetailsTotals($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getPaidOrderDetailsTotals('$orderID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
    //output data for each row
        while ($row = $result->fetch_assoc()) {
             //check for active orders for this user
            $output = $row['total'];
        }
    }
    return $output;
}

//verify brand
//sp_verifyBrand
function verifyBrand($brandID){
    include "dbConnection.php";
    $sql = "CALL sp_verifyBrand('$brandID');";
    $output = false;
    //query Sql
    $result = $conn->query($sql);
    //result
    
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
                $output = true;
        }
    }

    return $output;
}

//verify petcategory
//sp_verifyPetCategory
function verifyPetCat($id){
    include "dbConnection.php";
    $sql = "CALL sp_verifyPetCategory('$id');";
    $output = false;
    //query Sql
    $result = $conn->query($sql);
    //result
    
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
                $output = true;
        }
    }

    return $output;
}

//verify location
function verifyLocation($id){
    include "dbConnection.php";
    $sql = "CALL sp_verifyLocation('$id');";
    $output = false;
    //query Sql
    $result = $conn->query($sql);
    //result
    
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
                $output = true;
        }
    }

    return $output;
}


//add pet category
function addPetCat($name, $img, $date, $status)
{
    include "dbConnection.php";

    $sql = "CALL sp_addPetCategory('$name', '$img', '$date', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add brand
function addBrand($name, $img, $date, $status)
{
    include "dbConnection.php";

    $sql = "CALL sp_addBrand('$name', '$img', '$date', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add location
function addLocation($name, $status)
{
    include "dbConnection.php";

    $sql = "CALL sp_addLocation('$name', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update petCategory
function updatePetCategory($id,$name, $img, $date, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updatePetCategory('$id','$name', '$img', '$date', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update brand
function updateBrand($id,$name, $img, $date, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateBrand('$id','$name', '$img', '$date', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update location
function updateLocation($id,$name, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateLocation('$id','$name','$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update location
function updateNotif($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateNotif('$id','$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//get userdetials
function getUserDetails($userID,$field){
    include "dbConnection.php";
    $sql = "CALL sp_getUserDetails($userID);";
    $result = $conn->query($sql);
    $output = "";

    if ($result -> num_rows > 0) {
    //output data for each row
        while ($row = $result->fetch_assoc()) {
             //check for active orders for this user
             if ($field == "fullName") {
                 $output = $row['firstName'] . " " . $row['lastName'];
             }
             if ($field == "lastname") {
                $output = $row['lastName'];
            }
        }
    }
    return $output;
}



function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(' ', $string) . ' ago' : 'just now';
}
?>