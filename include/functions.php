<?php
//Create database connection
header('Access-Control-Allow-Origin: *');
include "dbConnection.php";
include "cookies.php";
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

//verify User email
//sp_verifyUserCredentials
function verifyEmail($email){
    include "dbConnection.php";
    $sql = "CALL sp_verifyUserCredentials('$email');";
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

//verify User Phone
function verifyMobile($mobile){
    include "dbConnection.php";
    $sql = "CALL sp_verifyUserMobile('$mobile');";
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

//Verify User NIC
function verifyNIC($nic){
    include "dbConnection.php";
    $sql = "CALL sp_verifyUserNIC('$nic');";
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

//verify business name
function verifyBusinessName($pname){
    include "dbConnection.php";
    $sql = "CALL sp_verifyPetshopName('$pname');";
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

//verify brn
function verifyBRN($brn){
    include "dbConnection.php";
    $sql = "CALL sp_verifyPetshopBRN('$brn');";
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
function addUser($fname, $lname,$nic, $gender, $dob, $street, $town, $district, $email, $mobile, $reg, $pass, $status, $long, $lat, $lastLogin, $role)
{
    include "dbConnection.php";

    $sql = "CALL sp_addUser('$fname', '$lname', '$nic', '$gender', '$dob', '$street', '$town', '$district', '$email', '$mobile', '$reg', '$pass', '$status', '$long', '$lat', '$lastLogin', '$role');";
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
function addPetshop($pname,$brn, $desc, $street, $town, $district, $long, $lat, $status, $userID, $dateReg)
{
    include "dbConnection.php";
    $sql = "CALL sp_addPetshop('$pname', '$brn', '$desc', '$street', '$town', '$district', '$long', '$lat', '$status', '$userID', '$dateReg');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add petshop speciality
function addPetshopSpeciality($petshopid, $petcatID, $date, $status){
    include "dbConnection.php";
    $sql = "CALL sp_addPetshopSpeciality('$petshopid', '$petcatID', '$date', '$status');";
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

//add payment
function addPayment($dateTime, $remark, $status, $orderID){
    include "dbConnection.php";
    $sql = "CALL sp_addPayment('$dateTime', '$remark', '$status', '$orderID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update user status
function updateUserStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateUserStatus('$id', '$status');";
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

//update orders Status
function updateOrderStatus($orderID, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateOrderStatus('$orderID', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update orderDetails Status
function updateOrderDetailsStatus($orderID, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateOrderDetailsStatus('$orderID', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update single order details status
function updateSingleOrderDetailsStatus($orderID, $productLineID, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateSingleOrderDetailsStatus('$orderID', '$productLineID', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update user lastLoginDateTime
function updateUserLogin($lastLogin, $userID){
    include "dbConnection.php";
    $sql = "CALL sp_updateUserLogin('$lastLogin', '$userID');";
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

//get No of products in paid order details by orderID
function getPaidOrderDetailsNoOFProducts($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getPaidOrderDetailsNoOFProducts('$orderID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
    //output data for each row
        while ($row = $result->fetch_assoc()) {
             //check for active orders for this user
            $output = $row['qty'];
        }
    }
    return $output;
}

//get total price in paid order details by orderID
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

//get product details by productID
function getProductDetailsByProductID($productID){
    include "dbConnection.php";
    $sql = "CALL sp_getProductDetails('$productID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return $output;
}


//get customer productline
//load Cart from dataabase
function loadCart($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getProductLineDetailsByOrderID($orderID,'active');";
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

//save cookie['cart'] in database
function saveCartInDb($userID){
    //cart is not empty => login => save in database, delete session, cookies
                //check cookies cart
                if(isset($_COOKIE['cart'])){

                    $cart = $_COOKIE["cart"];
                    $cart = json_decode($cart);

                    //check if order exists
                    if (getActiveUserOrder($userID) > 0) {
                        $orderID = getActiveUserOrder($userID);
                    } else {
                        //create a new order for this user
                        $createdDT= date("Y/m/d h:i:s");
                        $status="active";
                        $result = addOrder($createdDT, $status, $userID);
                    }
				    while($orderID <= 0){
				    	$orderID = getActiveUserOrder($userID);
				    }
                    //get data from cookies
                    foreach($cart as $key => $value){
                            //key1 = field nname
                            //value1 = data
                            //check if productLineID exists in order
                            //update product quantity
                            //add product
                            //check if there is an active order else create an order
                            //check if productDetailID avail => add quantity
                            //else add productdetailsID
                            if ($orderID > 0) {
                                //get productLineDetails
                                $productLineID = $value->id;
                                $quantity = $value->quantity;
                                $price = $value->price;
                                $remark =$value->name;
                                $status= "active" ;
                                //if productLineID already exists, add quantity then update quantity only
                                $existingQuantity = verifyOrderDetails($orderID, $productLineID);
                                if ($existingQuantity > 0) {
                                    //already exists
                                    $quantity += $existingQuantity;
                                    updateOrderDetailsQuantity($orderID, $productLineID, $quantity);
                                } else {
                                    //add productline
                                    addOrderDetails($quantity, $price, $remark, $status, $orderID, $productLineID);
                                }
                            }
                    }
                    
                }
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