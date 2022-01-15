<?php
include "functions.php";

//verify user credentials
if (verifyUserCredentials("hireshmh24@gmail.com","12345")){
    echo "user exists \n";
}else{
    echo "user does not exists\n";
    echo password_hash(12345, PASSWORD_DEFAULT) . "<br>";
}
//Verify order Details
//verifyOrderDetails($orderID, $productLineID);
if(verifyOrderDetails(51868, 1) > 0){
    echo "Product exists in cart" . "<br>";
}else{
    echo "Product does exists in cart" . "<br>";
}


//add user
//$res = addUser("newtest", "test", "Male", "1999-08-08", "test", "test", "test", "test@gmail.com", "52345678", "1999-08-08", password_hash("test123",PASSWORD_DEFAULT), 1, 1);
//echo "Add User :" . $res;

//get user role
echo getUserRole("hireshmh24@gmail.com") . "<br>";

echo "\n";
//get user id
echo getUserID("hiresh@gmail.com"). "<br>";

//add petshop
//$addpetsh = addPetshop("Dy", "breeding", "tt", "tt", "tt", 12 , 12 , 1 , 31 , 1, "1999-08-08");
//echo $addpetsh;


//add product
//addProduct($prodname, $brandID, $desc, $img, $prodcatid, $specialityid, $status, $dateposted, $lastmodif, $petshopid)
/*$result = addProduct("Pimafix", 1, "Medication", "x",2, 1, 1, "2021-09-14 09:22:26", "2021-09-14 09:22:26",1);
if ($result == 1){
    echo "Product added" . "<br>";
}else{
    echo "Product failed to add" . "<br>";
}*/

//add product line
//addProductLine($F_unit, $F_amount, $F_qoh, $F_price, $F_lastmodif, $F_status, $productID);
/*$result = addProductLine('kg', 5, 2, 1000, "2021-09-14 09:22:26", 1, 26);
if ($result == 1){
    echo "Product Line added" . "<br>";
}else{
    echo "Product Line failed to add" . "<br>";
}*/

//add order
//addOrder($createdDT, $status, $userID){
$result = addOrder("2021-09-14 09:22:26", "active", 164);
if($result == 1){
    echo "Order added !!" . "<br>";
}else if ($result == 0){
    echo "Fail to add order!!!!" . "<br>";
}

//add order Details
//addOrderDetails($quantity, $price, $remark, $status, $orderID, $productLineID)
    $result = addOrderDetails(3, 200, "", "1", 1, 5);
    if($result == 1){
        echo "Order details added !!" . "<br>";
    }else if ($result == 0){
        echo "Fail to add order details!!!!" . "<br>";
    }
//get petshop id
echo "petshop id is" . getPetshopID(31). "<br>";

//send email (email, fname, lname, subject, body)
$result = sendEmail("hireshmh24@gmail.com", "Hiresh", "Mohun", "E-petshop Registration", "Please view the terms and conditions before
accepting! 
");
if($result == 1){
    echo "\n mail sent!!" . "<br>";
}else if ($result == 0){
    echo "\n mail not sent!!!!" . "<br>";
}

//add admin
//$res = addUser("newtest", "test", "Male", "1999-08-08", "test", "test", "test", "test@gmail.com", "52345678", "1999-08-08", password_hash("test123",PASSWORD_DEFAULT), 1, 1);
//$result = addUser("Hiresh", "Mohun", "Male", "1999-12-24", "", "", "", "admin@gmail.com", 59251209, "2021-09-14 09:22:26", password_hash("admin",PASSWORD_DEFAULT), 1,1);

//if ($result == 1){
//    echo "\n admin created successfully" . "<br>";
//}else{
//    echo "\n admin not created" . "<br>";
//}


//update product
//updateProduct($productID,$name, $brandID, $description, $imgpath, $prodCatID, $petCatID, $status, $lastMDT)
$result = updateProduct(62 ,"testnew", 2, "NewDesc", "x", 1, 1, 1, "2021-09-14 09:22:26");
if($result == 1){
    echo "Product Updated!!" . "<br>";
}else if ($result == 0){
    echo "Product not Updated!!" . "<br>";
}

//update order details quantity
//updateOrderDetailsQuantity($orderID, $productLineID, $quantity);
$result = updateOrderDetailsQuantity(1, 5, 10);
if($result == 1){
    echo "Product Line Quantity updated" . "<br>";
}else if ($result == 0){
    echo "Product Line Quantity Not updated" . "<br>";
}

//update order status
//updateOrderStatus($orderID, $status)
$result = updateOrderStatus(51877, 'disactive');
if($result == 1){
    echo "Order status Updated!!" . "<br>";
}else if ($result == 0){
    echo "Order status not Updated!!" . "<br>";
}

//update order details status
//updateOrderDetailsStatus($orderID, $status)
$result = updateOrderDetailsStatus(51877, 'order cancelled');
if($result == 1){
    echo "Order Details status Updated!!" . "<br>";
}else if ($result == 0){
    echo "Order Details status not Updated!!" . "<br>";
}

//get No of products in paid order details by orderID
//getPaidOrderDetailsNoOFProducts($orderID);
$result = getPaidOrderDetailsNoOFProducts(51889);
if($result > 0){
    echo "No of products:". $result . "<br>";
}else if ($result == 0){
    echo "No of products:0 !!" . "<br>";
}

//get total price in paid order details by orderID
//getPaidOrderDetailsTotals($orderID);
$result = getPaidOrderDetailsTotals(51889);
if($result > 0){
    echo "Totals : !!" .$result. "<br>";
}else if ($result == 0){
    echo "Total:0!!" . "<br>";
}

//getProductDetailsByProductID($productID)
$resultArr = getProductDetailsByProductID(24);
if ($resultArr -> num_rows > 0) {
    //output data for each row
        while ($row = $resultArr->fetch_assoc()) {
            $pname = $row['pname'];
            $bname = $row['bname'];
            $desc = $row['description'];
            $img = $row['imgPath'];
            $pcname = $row['pcname'];
            $pdname = $row['prodname'];

        }
}
$resultArr->close();
$conn->next_result();
if($resultArr =! null){
    echo $pname. "</br>";
}else{
    echo "Empty product array!!" . "<br>";
}

//load cart
$result=loadCart(1);
if($result){
    echo "cart loaded";

}else{
    echo "cart not loaded";
}
?>