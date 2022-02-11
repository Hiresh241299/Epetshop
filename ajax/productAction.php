<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../include/functions.php';
$output = "";

if (isset($_POST['action'])) {
    if ((isset($_POST['action'])) == "add") {
        if ((isset($_POST['reviewValue'])) && (isset($_POST['useridValue'])) && (isset($_POST['productidValue']))) {

    //call function add product review
            //get value of session
            $review = $_POST['reviewValue'];
            $date= date("Y/m/d G:i:s");
            $status = 1;
            $userID = $_POST['useridValue'];
            $productID = $_POST['productidValue'];

            if (addProductReview($review, $date, $status, $userID, $productID)) {
                $output ="1";
            }
        }
    }
    //delete review
    if ((isset($_POST['action'])) == "delete") {
        if (isset($_POST['reviewidval'])) {
            //change review status = 0
            $id = $_POST['reviewidval'];
            $status = 0;
            if (updateProductReviewStatus($id, $status)) {
                $output = "1";
            }
        }
    }
    //delete petshop speciality
    if ((isset($_POST['action'])) == "deleteSpeciality") {
        if (isset($_POST['sid'])) {
            //change review status = 0
            $id = $_POST['sid'];
            $status = 0;
            if (updateSpecialityStatus($id, $status)) {
                $output = "1";
            }
        }
    }

    //delete customer favorite
    if ((isset($_POST['action'])) == "deleteFavorite") {
        if (isset($_POST['fid'])) {
            //change review status = 0
            $id = $_POST['fid'];
            $status = 0;
            if (updateFavoriteStatus($id, $status)) {
                $output = "1";
            }
        }
    }

    //delete product
    if ((isset($_POST['action'])) == "deleteProduct") {
        if (isset($_POST['productID'])) {
            //change review status = 0
            $id = $_POST['productID'];
            $status = 0;
            if (updateProductStatus($id, $status)) {
                $output = "1";
            }
        }
    }

    //delete product line
    if ((isset($_POST['action'])) == "deleteProductLine") {
        if (isset($_POST['delete'])) {
            if (isset($_POST['productLineID'])) {
                //change review status = 0
                $id = $_POST['productLineID'];
                $status = 0;
                if (updateProductLineStatus($id, $status)) {
                    $output = "1";
                }
            }
        }
    }

    //PetshopHome
    if ((isset($_POST['action'])) == "updateOrderDetailsStatus") {
        if ((isset($_POST['pid'])) && (isset($_POST['oid'])) && (isset($_POST['status']))) {

            //get value of session
            $petshopID = $_POST['pid'];
            $orderID = $_POST['oid'];
            $status = $_POST['status'];

            $sql = "CALL sp_getMyCustomerOrders($petshopID);";
            $result = $conn->query($sql);
            if ($result -> num_rows > 0) {
                //output data for each row
                while ($row = $result->fetch_assoc()) {
                    //$img = $row['imgPath'];
                    $orderDetailsID = $row['orderDetailsID'];

                    //call function update status
                    // param in orderDetailsId and status
                    if ($orderID == $row['id']) {
                        updateMyCustomerOrderDetailsStatus($orderDetailsID, $status);
                        $output = "1";
                    }
                }
            }
            //call funncion to change status of delivery schedule
            if (verifyAllProductDelivered($orderID)) {

                //table orders
                //table delivery schedule
                updateDeliveryScheduleStatus($orderID, "Delivered");
                $output = "1";
            }
        }
    }
    
    if ((isset($_POST['action'])) == "addDeliverySchedule") {
        //if ((isset($_POST['oid'])) && (isset($_POST['mobile'])) && (isset($_POST['street']))&& (isset($_POST['locality']))&& (isset($_POST['town']))&& (isset($_POST['district'])) && (isset($_POST['postcode']))&& (isset($_POST['lng']))&& (isset($_POST['lat']))) {

        //get value of session
        $oid = $_POST['oid'];
        $mobile = $_POST['mobile'];
        $street = $_POST['street'];
        $locality = $_POST['locality'];
        $town = $_POST['town'];
        $district = $_POST['district'];
        $postcode = $_POST['postcode'];
        $lng = $_POST['lng'];
        $lat = $_POST['lat'];

        $date=date("Y/m/d G:i:s");
        $status = "Pending";

        //add delivery achedule
        //addDeliverySchedule($street, $locality, $town, $district, $postcode, $long, $lat, $date, $status, $orderID);

        if (addDeliverySchedule($street, $locality, $town, $district, $postcode, $lat, $lng, $date, $status, $oid)) {
            $output =1;
        }
        //}
    }

    //update product quantity
    if ((isset($_POST['action'])) == "updateProductlineQuantity") {
        if ((isset($_POST['productlineID'])) && (isset($_POST['qoh']))) {

            //get value of session
            $productLineID = $_POST['productlineID'];
            $quantity = $_POST['qoh'];

            //get quantity
            //add to existing quantity
            //update
            if (updateProductLineQOH($productLineID, $quantity)) {
                $output = 1;
            }
        }
    }

    //update productline
    if ((isset($_POST['action'])) == "updateProductline") {
        if ((isset($_POST['productlineID'])) && (isset($_POST['price']))&& (isset($_POST['unit']))&& (isset($_POST['amount']))&& (isset($_POST['qoh']))) {

            //get value of session
            $productLineID = $_POST['productlineID'];
            $price = $_POST['price'];
            $unit = $_POST['unit'];
            $amount= $_POST['amount'];
            $qoh = $_POST['qoh'];
            $lastmodif =date("Y/m/d G:i:s");
            //get quantity
            //add to existing quantity
            //update
            if (updateProductLine($productLineID, $unit, $amount, $qoh, $price, $lastmodif)) {
                $output = 1;
            }
        }
    }

    //Add discount
    if ((isset($_POST['action'])) == "addDiscount") {
        if ((isset($_POST['start'])) && (isset($_POST['end']))&& (isset($_POST['per']))&& (isset($_POST['productLineID']))) {

            //get value of session
            $start = $_POST['start'];
            $end = $_POST['end'];
            $per = $_POST['per'];
            $productLineID = $_POST['productLineID'];
            $status = "active";

            //get quantity
            //add to existing quantity
            //set status expired for other with same productlineID
            updateDiscountStatus($productLineID);
            //add/update
            if (addDiscount($per, $start, $end, $status, $productLineID)) {
                $output = 1;
            }
        }
    }
}

echo $output;
