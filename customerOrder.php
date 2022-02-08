<?php
include 'include/common.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
}
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"])) || ($_SESSION["roleid"] != 3) || (!isset($_SESSION["userid"]))) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
}

//get query string 'p' from url [to test if a false value is entered]
if(isset($_GET['p'])){
    if(($_GET['p']) == 1 ){

        //get active order
        $orderID = getActiveUserOrder($userid);
        //set order status to order paid
        updateOrderStatus($orderID, 'Order Paid');
        //set order details status to paid
        updateOrderDetailsStatus($orderID, 'Order Paid');

        // clear session if exists to prevent error
        if (isset($_SESSION['mycart'])){unset($_SESSION['mycart']);}
        if (isset($_SESSION['total_price'])){$_SESSION['total_price'] = 0;}
        
        //clear cookies
        setcookie("cart", null, -1, '/');

        //save in payment
        $dateTime = date("Y/m/d G:i:s");
        $remark = "";
        $status = "Payment Completed";
        addPayment($dateTime, $remark, $status, $orderID);

    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title?></title>
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <!-- Template CSS -->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,500,600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/image/icon/icon.jpg">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
    <!-- Template CSS -->

    <style>
    .iblack {
        color: black;
    }

    .cardbg {
        background-color: #f4f4f4;
    }
    </style>

</head>

<body>

    <section class="w3l-banner-slider-main inner-pagehny">
        <div class="breadcrumb-infhny">

            <div class="top-header-content">
                <header class="tophny-header">
                    <!-- Include Navbar -->
                    <?php
            include 'include/navbarCustomer.php';
            ?>

                    <!--/search-right-->
                    <div class="search-right">

                        <div id="paymentCompleted" class="pop-overlay">
                            <div class="popup">
                                <h3 class="text-center">Payment Completed</h3>
                            </div>
                            <a class="close" href="#">×</a>

                        </div>
                        <!-- /search popup -->
                    </div>
                    <!--//search-right-->
                </header>
                <div class="breadcrumb-contentnhy">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <h2 class="hny-title text-center">My Orders</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //w3l-banner-slider-main -->

    <section class="main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5">
            <div class="container py-lg-5">
                <div class="blog-inner-grids">

                    <h3 class="hny-title mb-0">My <span>Orders</span></h3>
                    <p class="mb-4">List of all your order
                    </p>

                    <!-- Datatable -->
                    <table id="table_id" class="display" width="100%" border=2>
                        <thead>
                            <tr class="bg-warning">
                                <th>Order No</th>
                                <th>Date Paid</th>
                                <th>Product(Qty)</th>
                                <th>Total price</th>
                                <th>Remark</th>
                                <th>Delivery</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- repeat within body-->
                            <?php
                                
                            //fetch product from database, using session userid
                            $sql = "CALL sp_getPaidOrderByUserID($userid);";
                            $result = $conn->query($sql);

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $orderNo = $row['orderID'];
                                    $date = date('d-m-Y h:m:s', strtotime($row['createdDateTime']));
                                    $remark = $row['status'];
                                    $qty = getPaidOrderDetailsNoOFProducts($orderNo);
                                    $total = getPaidOrderDetailsTotals($orderNo);

                                    $delivery = getDeliveryScheduleStatus($orderNo);

                                                                                       
                                   
                                    echo '<tr>
                                <td>'.$orderNo.'</td>
                                <td>'.$date.'</td>
                                <td>'.$qty.'</td>
                                <td>Rs '.$total.'</td>
                                <td>'.$remark.'</td>
                                <td>'.$delivery.'</td>
                                <td class="text-center">
                                    <a  href="CustomerOrder.php?viewOrderDetails='.$orderNo.'#orderdetails"  class="btn btn-primary" title="View Order"><i class="fa fa-eye iblack"
                                            aria-hidden="true"></i></a>
                                </td>
                                </tr>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                                ?>
                            <!-- //repeat body-->
                        </tbody>

                    </table>
                    <!-- //Datatable -->
                </div>

                <!--View order details-->
                <?php
                if(isset($_GET['viewOrderDetails'])){
                    $orderID = $_GET['viewOrderDetails'];
                    echo'</br></br><div class="blog-inner-grids">

                    <h3 class="hny-title mb-0" id="orderdetails">Order['.$orderID.'] <span>Details</span>
                    <a href="CustomerOrder.php" class="float-right bg-danger border rounded">&nbsp x &nbsp</a>
                    </h3>
                    </br>
                    <!-- Datatable -->
                    <table id="" class="display" width="100%" >
                        <thead>
                            <tr class="bg-warning">
                                <th>Product IMG</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>price</th>
                                <th>Delivery</th>
                            </tr>
                        </thead>
                        <tbody>';
                            //repeat within body
                                
                                //fetch product from database, using session userid
                                $sql = "CALL sp_getProductLineDetailsByOrderID($orderID, 'Order paid');";
                                $result = $conn->query($sql);
                                $bg=0;
                                $oldpetshop = 0;

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $qty = $row['quantity'];
                                    $price = $row['price'];
                                    $pid = $row['productID'];
                                    $unit = $row['unit'];
                                    $number = $row['number'];
                                    $status = $row['status'];
                                    if($status == "Order Paid"){
                                        $status = "Pending";
                                    }
                                    //$qty = getPaidOrderDetailsNoOFProducts($orderNo);
                                    //$total = getPaidOrderDetailsTotals($orderNo);

                                    //Get product detail
                                    $resultArr = getProductDetailsByProductID($pid);
                                    
                                    
                                    if ($resultArr -> num_rows > 0) {
                                        //output data for each row
                                        while ($row = $resultArr->fetch_assoc()) {
                                            $pname = $row['pname'];
                                            $bname = $row['bname'];
                                            $desc = $row['description'];
                                            $img = $row['imgPath'];
                                            $pcname = $row['pcname'];
                                            $pdname = $row['prodname'];
                                            //petshop details
                                            $psname = $row['psname'];
                                            $psid = $row['petshopID'];

                                        
                                        }
                                    }
                                    $resultArr->close();
                                    $conn->next_result();
                                    
                                    //background
                                    if($bg == 0){
                                        $bg = 1;
                                    }else{
                                        $bg = 0;
                                    }

                                    if ($oldpetshop != $psid){
                                        $oldpetshop = $psid;
                                        echo '
                                    <tr class="text-center bg-dark"><td colspan="6"><a class="text-white" href="viewPetshops.php#petshop'.$psid.'">'.strtoupper($psname).'</a></td></tr>';
                                    }

                                    echo '
                                    <tr class="'.(($bg == 1)?"cardbg":"").'">
                                <td width="16%"><img src="product/'.$img.'" alt="Img" width="100%" height="100%"></td>
                                <td>'.$number." ".$unit." ".$pname. " | " .$bname.'</td>
                                <td>'.$pcname." " .$pdname.'</td>
                                <td>'.$qty.'</td>
                                <td>'.$price.'</td>
                                <td>'.$status.'</td>
                                </tr>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                            echo'
                            <!-- repeat body-->
                        </tbody>

                    </table>
                    <!-- Datatable -->
                </div>';

                //fetch product from database, using session userid
                $sql = "CALL sp_getPaidOrderByUserID($userid);";
                $result = $conn->query($sql);
                $output = "<h3>This order NO is not available!</h3>";

                if ($result -> num_rows > 0) {
                    //output data for each row
                    while ($row = $result->fetch_assoc()) {
                        if($row['orderID']  == $_GET['viewOrderDetails']){
                            $output=  "";
                        }
                    }
                    echo $output;
                }
                
                }
                ?>

                <!--View order details-->





                <!--//mag-content-->
                <div style="margin: 8px auto; display: block; text-align:center;">
                    <!---728x90--->
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-footer-22">
        <!-- Include Footer -->
        <?php
     include 'include/footer.php';
     ?>

    </section>


</body>

</html>

<?php include "bottomScripts.php"; ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script>
//initialising datatable
$(document).ready(function() {
    $('#table_id').DataTable();
});
$('#table_id').DataTable().columns.adjust();
</script>