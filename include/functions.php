<?php
//Create database connection
header('Access-Control-Allow-Origin: *');
include "dbConnection.php";
include "cookies.php";
//check connection
if ($conn -> connect_error) {
    die("connection failed:" . $conn->connect_error);
}

//auto update discount status
updateDiscountStatusAuto();

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

//verify all product Delivered
function verifyAllProductDelivered($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_verifyAllProductDelivered('$orderID');";
    $result = $conn->query($sql);
    $output = 0;
    //result
    if ($result -> num_rows > 0) {
        //output password form db
        while ($row = $result->fetch_assoc()) {
            if($row['status'] == "Delivered"){
                $output = 1;
            }else{
                $output = 0;
            }
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

//get location name given location ID
function getLocationName($locationID)
{
    include "dbConnection.php";
    $output= 0;
    $sql = "CALL sp_verifyLocation('$locationID');";

    $result = $conn->query($sql);

    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            $output = $row['name'];
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
function addPetshop($pname,$brn, $desc, $postcode, $street, $locality, $town, $district, $long, $lat, $status, $userID, $dateReg)
{
    include "dbConnection.php";
    $sql = "CALL sp_addPetshop('$pname', '$brn', '$desc', '$postcode', '$street', '$locality', '$town', '$district', '$long', '$lat', '$status', '$userID', '$dateReg');";
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

//add user favorite
function addUserFavorite($userid, $petcatID, $date, $status){
    include "dbConnection.php";
    $sql = "CALL sp_addUserFavorite('$userid', '$petcatID', '$date', '$status');";
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

//add product view
function addProductReview($review, $date, $status, $userID, $productID)
{
    include "dbConnection.php";
    $sql = "CALL sp_addProductReview('$review', '$date', '$status', '$userID', '$productID');";
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

//add notification
//status 1 send, 2 read
function addNotif($userID, $title, $message, $date, $status){
    include "dbConnection.php";
    $sql = "CALL sp_addNotification('$userID', '$title', '$message', '$date', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add delivery schedule
function addDeliverySchedule($street, $locality, $town, $district, $postcode, $long, $lat, $date, $status, $orderID){
    include "dbConnection.php";
    $sql = "CALL sp_addDeliverySchedule('$street', '$locality', '$town','$district', '$postcode', '$long', '$lat', '$date', '$status', '$orderID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//add discount
function addDiscount($per, $start, $end, $status, $productLineID){
    include "dbConnection.php";
    $sql = "CALL sp_addDiscount('$per', '$start', '$end', '$status', '$productLineID');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//get array customer favorites
function getCustomerFavorite($userID){
    include "dbConnection.php";
    $sql = "CALL sp_getUserFavorite('$userID');";
    $result = $conn->query($sql);
    $favorite = array();
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($favorite, $row['petCatID']);
        }
    }

    return $favorite;
}


//get admin id
//works for only 1 admin
function getAdminID()
{
    include "dbConnection.php";
    $adminID = "";
    //fetch petshop id from db
    $sql = "CALL sp_getAdminID();";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $adminID = $row['userID'];
        }
    }
    return $adminID;
}


//update user status
function updateUserStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateUserStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update product review status
function updateProductReviewStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateProductReview('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update petshop speciality status
function updateSpecialityStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateSpecialityStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update productline status
function updateProductLineStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateProductLineStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update product status
function updateProductStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateProductStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update customer favorite
function updateFavoriteStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateFavoriteStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update my customer order details status to delivered
function updateMyCustomerOrderDetailsStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateMyCustomerOrderDetailsStatus('$id', '$status');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update Delivery Schedule Status
function updateDeliveryScheduleStatus($id, $status){
    include "dbConnection.php";
    $sql = "CALL sp_updateDeliveryScheduleStatus('$id', '$status');";
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

//update productline
function updateProductLine($prodLineID, $unit, $num, $qoh, $price, $date){
    include "dbConnection.php";
    $sql = "CALL sp_updateProductLine('$prodLineID', '$unit', '$num', '$qoh', '$price', '$date');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update userDetails
function updateUser($userID, $fname, $lname, $email, $nic, $mobile, $postcode,  $street, $locality, $town, $district, $lastmodif){
    include "dbConnection.php";
    $sql = "CALL sp_updateUser('$userID','$fname', '$lname', '$email', '$nic', '$mobile', '$postcode', '$street', '$locality', '$town', '$district', '$lastmodif');";
    $result = mysqli_query($conn, $sql);

    return $result;
}

//update petshop
function updatePetshop($userID, $pname, $brn, $desc, $img, $street, $locality, $town, $district, $lastmodif){
    include "dbConnection.php";
    $sql = "CALL sp_updatePetshop('$userID', '$pname', '$brn', '$desc', '$img', '$street', '$locality', '$town', '$district', '$lastmodif');";
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

//update productline quantity on hand
function updateProductLineQOH($productLineID, $quantity){
    include "dbConnection.php";
    $sql = "CALL sp_updateProductLineQOH('$productLineID', '$quantity');";
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

//update discount status Expired
function updateDiscountStatus($productLineID){
    include "dbConnection.php";
    $sql = "CALL sp_updateDiscountStatus('$productLineID');";
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

//get discounted productline
function DiscountedProductLine()
{
    include "dbConnection.php";
    $petshopid = "";
    //fetch petshop id from db
    $sql = "CALL sp_getDiscountedProductLine();";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        return $result;
    }
    return 0;
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
            $count++;
        }
    }
    return $count;
}

//count my products by petshopID
function getCountMyProductsByPetshopID($pid)
{
    include "dbConnection.php";
    $count = "";
    //fetch petshop id from db
    $sql = "CALL sp_countMyProducts($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count++;
        }
    }
    return $count;
}

//count my petshop specialities
function getCountMyPetshopSpecialities($uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getPetshopSpecialities($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count++;
        }
    }
    return $count;
}

//count my petshop Orders
function getCountMyPetshopDeliveries($uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getCountMyDeliveries($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == "Delivered") {
                $count++;
            }
        }
    }
    return $count;
}

//count my petshop Orders
function getCountMyPetshopOrders($uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getCountMyOrders($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                $count++;
        }
    }
    return $count;
}

//count my petshop Orders
function getCountMyPetshopCustomers($uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getCountMyCustomers($pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count++;
        }
    }
    return $count;
}

//count my petshop Orders
function countProductLineInOrder($orderID, $uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_countProductLineInOrder($orderID,$pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count = $row['countID'];
        }
    }
    return $count;
}

//count my petshop Orders Delivvered
function countProductLineInOrderDelivered($orderID, $uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_countProductLineInOrderDelivered($orderID,$pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count = $row['countID'];
        }
    }
    return $count;
}

//get totals
function getPaidOrderDetailsTotalsByPetshopID($orderID, $uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getPaidOrderDetailsTotalsByPetshopID($orderID,$pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return  $row['total'];
        }
    }
    return $count;
}

//get totals for delivered orders
function getPaidOrderDetailsTotalsByPetshopIDDelivered($orderID, $uid)
{
    include "dbConnection.php";
    $pid = getPetshopID($uid);
    $count = 0;
    //fetch petshop id from db
    $sql = "CALL sp_getPaidOrderDetailsTotalsByPetshopIDDelivered($orderID,$pid);";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return  $row['total'];
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

//get petshop specialities
function getPetshopSpecialities($petshopID){
    include "dbConnection.php";
    $sql = "CALL sp_getPetshopSpecialities('$petshopID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}

//get user Details by userID
function getUserDetails($userID){
    include "dbConnection.php";
    $sql = "CALL sp_getUserDetails('$userID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}

//get available brands at a petshop
function getavailableBrandsAtPetshop($petshopID){
    include "dbConnection.php";
    $sql = "CALL sp_getavailableBrandsAtPetshop('$petshopID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}

//get delivery schedule
function getDeliverySchedule($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getDeliverySchedule('$orderID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}

//get discount
function getDiscount($productLineID, $status){
    include "dbConnection.php";
    $sql = "CALL sp_getDiscount('$productLineID', '$status');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}

//get delivery schedule
function getDeliveryScheduleStatus($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getDeliverySchedule('$orderID');";
    $result = $conn->query($sql);
    $output = "Pending";

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output = $row['status'];
        }
    }
    return $output;
}

//get productline
function getProductLine($productID){
    include "dbConnection.php";
    $sql = "CALL sp_getProductLine('$productID');";
    $result = $conn->query($sql);
    $output = 0;

    if ($result -> num_rows > 0) {
        return $result;
    }
    return null;
}



//get customer productline
//load Cart from dataabase
function loadCart($orderID){
    include "dbConnection.php";
    $sql = "CALL sp_getProductLineDetailsByOrderIDActive($orderID,'active');";
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
                        $createdDT= date("Y/m/d G:i:s");
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


//get number of days left
function daysleft($endDate){
    $now = time(); // or your date as well
    $your_date = strtotime($endDate);
    $datediff = $now - $your_date;
    
    return round(-$datediff / (60 * 60 * 24));
}

//auto update discount status
function updateDiscountStatusAuto(){
    include "dbConnection.php";
    $sql = "CALL sp_updateDiscountStatusbyendDate();";
    $result = mysqli_query($conn, $sql);

    return $result;
}