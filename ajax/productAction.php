<?php 
if(!isset($_SESSION)){
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
    if ((isset($_POST['action'])) == "delete") {
        if (isset($_POST['reviewidval'])) {
            //change review status = 0
            $id = $_POST['reviewidval'];
            $status = 0;
            if(updateProductReviewStatus($id, $status)){
                $output = "1";
            }
        }
    }
}

echo $output;
?>