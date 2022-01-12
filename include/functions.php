<?php
//Create database connection
header('Access-Control-Allow-Origin: *');
include "dbConnection.php";

//check connection
if ($conn -> connect_error) {
    die("connection failed:" . $conn->connect_error);
}

//verify user credentials
function verifyUserCredentials($email, $passw)
{
    global $conn;
    
    //sql to verify user credentials
    //$sql = "SELECT email, password
    //FROM user
    //WHERE email = '$email'
    //AND password = '$password' ";

    //$sql = "CALL sp_checkUser('paul@gmail.com', '12345');";
    $sql = "CALL sp_verifyUserCredentials('$email');";

    $output = false;

    //query Sql
    $result = $conn->query($sql);
    //result
    
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
            if (password_verify($passw, $row['password'])) {
                $output = true;
            }
        }
    }

    return $output;
}

//verify order Details
function verifyOrderDetails($orderID, $productLineID){
    include "dbConnection.php";
    $sql = "CALL sp_verifyOrderDetails('$orderID', '$productLineID');";
    $result = $conn->query($sql);
    $output = 0;
    //result
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
            $output = $row['quantity'];
        }
    }

    return $output;
}

//add user
function addUser($fname, $lname, $gender, $dob, $street, $town, $district, $email, $mobile, $reg, $pass, $status, $role)
{
    include "dbConnection.php";

    $sql = "CALL sp_addUser('$fname', '$lname', '$gender', '$dob', '$street', '$town', '$district', '$email', '$mobile', '$reg', '$pass', '$status', '$role');";
    $result = mysqli_query($conn, $sql);

    return $result;
    //if($result){
        //**********get registration success message
        //header('Location: login.php');
        //echo "<script>window.location.href='login.php';</script>";
    //}else{
        //**********get registration failed message
        //header('Location: ecommerce.php');
        //echo "<script>window.location.href='register.php';</script>";
    //}
}

//get user role
function getUserRole($email)
{
    include "dbConnection.php";
    $output= 0;
    //$sql = "SELECT roleID
    //FROM user
    //WHERE email = '$email' ";
    $sql = "CALL sp_getUserRole('$email');";

    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            $output = $row['roleID'];
        }
    }
    
    return $output;
}

//get user ID
function getUserID($email)
{
    include "dbConnection.php";
    $output= 0;
    $sql = "CALL sp_getUserID('$email');";

    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            $output = $row['userID'];
        }
    }
    
    return $output;
}

//get product line details
//function getProductLineDetailsByOrderID($orderID){
//
//}

//add petshop
//by default petshop status is 0
//admin must accept petshop, then vendor can post product etc.
function addPetshop($pname, $desc, $street, $town, $district, $long, $lat, $status, $userID, $specialityID, $dateReg)
{
    include "dbConnection.php";
    $sql = "CALL sp_addPetshop('$pname', '$desc', '$street', '$town', '$district', '$long', '$lat', '$status', '$userID', '$specialityID', '$dateReg');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add product
function addProduct($prodname, $brandID, $desc, $img, $prodcatid, $specialityid, $status, $dateposted, $lastmodif, $petshopid)
{
    include "dbConnection.php";
    $sql = "CALL sp_addProduct('$prodname', '$brandID', '$desc', '$img','$prodcatid', '$specialityid', '$status', '$dateposted','$lastmodif', '$petshopid');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add product line
function addProductLine($unit, $amount, $qoh, $price, $lastmodif, $status, $productID){
    include "dbConnection.php";
    $sql = "CALL sp_addProductLine('$unit', '$amount', '$qoh', '$price', '$lastmodif', '$status', '$productID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add order
function addOrder($createdDT, $status, $userID){
    include "dbConnection.php";
    $sql = "CALL sp_addOrder('$createdDT', '$status', '$userID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add order details
function addOrderDetails($quantity, $price, $remark, $status, $orderID, $productLineID){
    include "dbConnection.php";
    $sql = "CALL sp_addOrderDetails('$quantity', '$price', '$remark', '$status', '$orderID', '$productLineID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update product
function updateProduct($productID,$name, $brandID, $description, $imgpath, $prodCatID, $petCatID, $status, $lastMDT){
    include "dbConnection.php";
    $sql = "CALL sp_updateProduct('$productID','$name', '$brandID', '$description', '$imgpath', '$prodCatID', '$petCatID', '$status', '$lastMDT');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update orderDetails Quantity
function updateOrderDetailsQuantity($orderID, $productLineID, $quantity){
    include "dbConnection.php";
    $sql = "CALL sp_updateOrderDetailsQuantity('$orderID', '$productLineID', '$quantity');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//get petshopID
function getPetshopID($uid)
{
    include "dbConnection.php";
    $petshopid = "";
    //fetch petshop id from db
    $sql = "CALL sp_getPetshopID($uid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $petshopid = $row['petshopID'];
        }
    }
    return $petshopid;
}

//get recently added product id by petshop 
function getLatestProductId($uid){
    include "dbConnection.php";
    $petshopid = getPetshopID($uid);
    $sql = "CALL sp_getProductID($petshopid)";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prodID = $row['productID'];
        }
    }
    return $prodID;
}

//get active user order
function getActiveUserOrder($userID){
    include "dbConnection.php";
    $sql = "CALL sp_getActiveUserOrder($userID);";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
    //output data for each row
        while ($row = $result->fetch_assoc()) {
             //check for active orders for this user
            $output = $row['orderID'];
        }
    }
    return $output;
}

//count my products
function getCountMyProducts($uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = "";
    //fetch petshop id from db
    $sql = "CALL sp_countMyProducts($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count = $row['COUNT(petshopID)'];
        }
    }
    return $count;
}

//get customer productline
function loadCart($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getProductLineDetailsByOrderID($orderID);";
    $result = $conn->query($sql);
    $output = false;
    if ($result -> num_rows > 0) {
        //output data for each row
        //all productline details from that order
        //create session cart
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['quantity'];
            $price = $row['price'];
            $remark = $row['remark'];
            $status = $row['status'];
            $plID = $row['productLineID'];

             //Create cart
            $item_array = array(
                'id'  => $plID,
                'name' => $remark,
                'price' => $price,
                'quantity' => $quantity
            );
            $_SESSION['mycart'][] = $item_array;
            $output = true;
        }
    }
   return $output;
}

//send email
//[send email to admin when customer or vendor register]
//[send email to vendor when admin accept request]
//[send email to customer and vendor when successfully register to E-Petshop]
function sendEmail($email, $fname, $lname, $subject, $body)
{
    include 'sendMail.php';
    return $mailstatus;
}

//check email

//check number

//create user