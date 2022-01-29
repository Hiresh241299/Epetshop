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
?>