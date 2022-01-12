<?php 
session_start();
include '../include/functions.php';

if(isset($_SESSION['userid'])){
$userID = $_SESSION['userid'];
}
$orderID = 0;
$orderCreated = false;

if (isset($_POST['action'])) {


	if ($_POST['action'] == "clearall") {
		unset($_SESSION['mycart']);
	}

	if ($_POST['action'] == "delete") {
		
		foreach ($_SESSION['mycart'] as $key => $value) {
			
			if ($value['id'] == $_POST['id']) {
				unset($_SESSION['mycart'][$key]);
			}
		}
	}
	
	if ($_POST['action'] == "add") {
		
		//check if user is login
		//user login save in db
        if ($userID != null) {
            //create order if order not already exists
            //loop until OrderID is obtain to created OrderDetails
			
            //while ($orderID <= 0) {

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

            //create orderDetails using the OrderID obtain
            //Insert Into orderDetails
            if ($orderID > 0) {
                //get productLineDetails
				$productLineID = $_POST['id'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $remark =$_POST['name'];
                $status= 1 ;
                //if product ID already exists, add quantity then update quantity only
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

		//user not login save in cookies
		

		if (isset($_SESSION['mycart'])) {

			$is_available = 0;
		     
			//check if product in already in cart, then only update quantity
            foreach ($_SESSION['mycart'] as $key => $value) {
            	
            	if ($_SESSION['mycart'][$key]['id'] == $_POST['id'] ) {
            		$is_available++;

            		$_SESSION['mycart'][$key]['quantity'] = $_SESSION['mycart'][$key]['quantity'] + $_POST['quantity'];
            	}
            }
			// new product added to cart
            if ($is_available == 0) {
            	$item_array = array(
               'id'  => $_POST['id'],
               'name' => $_POST['name'],
               'price' => $_POST['price'],
               'quantity' => $_POST['quantity']
			);

            $_SESSION['mycart'][] = $item_array;

            }

		}else{
			//if cart does not exists(no product in cart)
			$item_array = array(
               'id'  => $_POST['id'],
               'name' => $_POST['name'],
               'price' => $_POST['price'],
               'quantity' => $_POST['quantity']
			);

            $_SESSION['mycart'][] = $item_array;
		}
	}
}

 ?>