<?php
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
if(!isset($_SESSION)){
    session_start();
}
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"])) || ($_SESSION["roleid"] != 2)) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
}
?>
<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <!-- CSS -->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,500,600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/image/icon/icon.jpg">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
    <!-- CSS -->

    <style>
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        color: white;
    }

    .tinted {
        filter: brightness(50%);
    }

    .cardbg {
        background-color: black;
    }

    .bgrow{
        background-color:#BEBEBE;
    }
    </style>
</head>

<body>
    <!--Navbar-->
    <section class="w3l-banner-slider-main inner-pagehny">
        <div class="breadcrumb-infhny">

            <div class="top-header-content">
                <header class="tophny-header">
                    <!-- Include Navbar -->
                    <?php
                        include 'include/navbarVendor.php';
                    ?>
                    <!--/search-right-->
                    <div class="search-right">
                        <!-- search popup -->
                        <div id="delivery" class="pop-overlay">
                            <div class="popup">
                                <h3>Please Click to confirm the delivery &nbsp
                                    <button type="button" class="btn btn-success"
                                        onclick="itemDelivered()">Confirm Delivery</button>
                                </h3>
                            </div>
                            <a class="close" href="petshopHome.php#corders">×</a>

                        </div>

                        <!--<div id="paymentCompleted" class="pop-overlay">
                            <div class="popup">
                                <h3 class="text-center">Payment Completed</h3>
                            </div>
                            <a class="close" href="#">×</a>
                            
                        </div>-->
                        <!-- /search popup -->
                    </div>
                    <!--//search-right-->
                </header>
                <div class="breadcrumb-contentnhy">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <?php
                            //get petshop name from db using session userID
                            
                            $sql = "CALL sp_getPetshopDetails($userid);";
                            $result = $conn->query($sql);

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['name'];
                                    echo '<h2 class="hny-title text-center">'.$name.'</h2>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                            ?>

                            <ol class="breadcrumb mb-0">
                                <li><a href="petshopHome.php">Home</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//Navbar -->

    <!-- Main content : Vendor Dashboard, gets notif, product sold, number of products, profits, customer messages -->

    <!-- //Main Content -->
    <section class="w3l-post-grids-6">
        <!--/mag-content-->
        <div class="post-6-mian py-5">
            <div class="container py-lg-5">
                <div class="blog-inner-grids">

                    <!-- statistics collapsible -->
                    <div class="rounded bg-light">
                        <h2>
                            Statistics
                            <button class="btn btn-primary rounded float-right" id="statBtn" data-toggle="collapse"
                                href="#collapseExample" aria-expanded="true" onclick="changeSign('stat');"
                                aria-controls="collapseExample">
                                <i class="fa fa-minus" id="stat"></i>
                            </button>
                        </h2>

                        <div class="collapse show " id="collapseExample">
                            <div class="card card-body">
                                <!--place content here-->
                                <!--stats card row-->
                                <div class="post-hny-grids row mt-5">
                                    <?php
                        //create an array (PRODUCTs, CUSTOMERs, SPECIALITIES, SALES)
                        //loop and echo the code below

                        $countProduct = getCountMyProducts($userid);
                        $countCustomer = getCountMyPetshopCustomers($userid);
                        $countSpecialities = getCountMyPetshopSpecialities($userid);
                        $countOrders = getCountMyPetshopOrders($userid);

                        $staName = array("PRODUCTS", "CUSTOMERS", "SPECIALITIES", "ORDERS");
                        $staCount = array($countProduct, $countCustomer, $countSpecialities, $countOrders);
                        $imgName = array("s1", "s2", "s3", "s4");

                        for($i = 0; $i < sizeof($staCount); $i++){
                        echo '<div class="col-lg-3 col-md-6 grids5-info column-img" id="zoomIn">
                        <a href="#">
                            <figure>
                                <img class="img-fluid rounded tinted " src="assets/images/'.$imgName[$i].'.jpg" alt="blog-image">
                                <div class="centered">
                                    <h3 class="text-center"><a class="text-white" href="#">'. $staCount[$i].' <br>
                                    '. $staName[$i].'</a></h3>
                                </div>
                            </figure>
                        </a>
                    </div>';
                        }
                        ?>
                                </div>
                                <!--stats card-->
                                <!--//place content here-->
                            </div>
                        </div>
                    </div>

                    <!-- //statistics collapsible -->

                    <br><br>

                    <!-- Customer Order Collapsible-->
                    <div class="rounded bg-light" id="corders">
                        <h2>
                            Customer Orders
                            <button class="btn btn-primary rounded float-right" id="orderplus" data-toggle="collapse"
                                href="#collapseExample2" aria-expanded="true" onclick="changeSign('order');"
                                aria-controls="collapseExample2">
                                <i class="fa fa-minus" id="order"></i>
                            </button>
                        </h2>

                        <div class="collapse show " id="collapseExample2">
                            <div class="card card-body col-12">
                                <!--place content here-->
                                <!-- Datatable -->
                                <table id="" class="display" width="100%">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th width="12%">&nbspCustomer</th>
                                            <th width="18%">Address</th>
                                            <th width="18%">Product</th>
                                            <th width="8%">Quantity</th>
                                            <th width="8%">price</th>
                                            <th width="8%">Total</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- repeat within body-->
                                        <?php
                                        
                                
                                //fetch product from database, using session userid
                                $psid = getPetshopID($userid);
                                $sql = "CALL sp_getMyCustomerOrders($psid);";
                            $result = $conn->query($sql);
                            $output = "";
                            $rowSpan = 1 ;
                            $previousID = 0;
                            $bg = 0;
                            $total = 0;

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    //$img = $row['imgPath'];
                                    $_id = $row['id'];
                                    $_pname = $row['name'];
                                    //$brand = $row['brand'];
                                    //$desc = $row['description'];
                                    //$pcname = $row['pcname'];
                                    //$sname = $row['sname'];
                                    $_unit = $row['unit'];
                                    $_number = $row['number'];
                                    $_price = $row['price'];
                                    $_quantity = $row['quantity'];
                                    $_img = $row['imgPath'];
                                    $_CustomerName = $row['firstName'] . " " . $row['lastName'];

                                //get delivery schedule for address and maps location
                                        $street = "";
                                        $town = "";
                                        $district = "";
                                        $postcode = "";
                                        $longitude = "";
                                        $latitude = "";
                                        $fulladdress = "";
                                $arrayResult = getDeliverySchedule($_id);
                                if ($arrayResult != null) {
                                    if ($arrayResult -> num_rows > 0) {
                                        //output data for each row
                                        while ($row1 = $arrayResult->fetch_assoc()) {
                                            $street = $row1['street'];
                                            $town = $row1['town'];
                                            $district = $row1['name'];
                                            $postcode = $row1['postcode'];
                                            $longitude = $row1['longitude'];
                                            $latitude = $row1['latitude'];
                                            $fulladdress = $street. " ".$town.", ". $district;
                                        }
                                    }
                                    $arrayResult->close();
                                    $conn->next_result();
                                }
                                

                                if ($previousID != $_id) {
                                    if ($bg == 0) {
                                        $bg = 1;
                                    } else {
                                        $bg = 0;
                                    }
                                }
                                $rowSpan =  countProductLineInOrder($_id,$userid);
                                $total = getPaidOrderDetailsTotalsByPetshopID($_id,$userid);
                                $firstRow = '
                                        <tr class="'.(($bg == 1)?"bgrow":"bg-light").'">
                                            <td rowspan="'.$rowSpan.'">&nbsp'.$_CustomerName.'</td>
                                            <td rowspan="'.$rowSpan.'">'.$fulladdress.'</td>
                                            <td><img src="product/'.$_img.'" style="width:18%; height:18%;">
                                            '.$_pname. " ".$_number . $_unit.'
                                            </td>
                                            <td>'.$_quantity.'</td>
                                            <td>Rs'.$_price.'</td>
                                            <td rowspan="'.$rowSpan.'">Rs'.$total.'</td>
                                            <td rowspan="'.$rowSpan.'">
                                            <a href="https://www.google.com/maps/search/?api=1&query='.$longitude.','.$latitude.'" target="_blank" class="btn btn-info text-center col-6" style="padding:2px; margin:1px;" title="Get map direction"><i class="fa fa-map-marker text-center" aria-hidden="true"></i></a>
                                            <a href="petshopHome.php#delivery" class="btn btn-success text-center col-6" onclick="setOrderid('.$_id.')" title="Delivery completed" style="padding:2px; margin:1px;"><i class="fa fa-check text-center"  aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                ';

                                $addons = '
                                        <tr class="'.(($bg == 1)?"bgrow":"bg-light").'">
                                            <td><img src="product/'.$_img.'" style="width:18%; height:18%;">'.$_pname. " ".$_number . $_unit.'</td>
                                            <td>'.$_quantity.'</td>
                                            <td>Rs'.$_price.'</td>
                                            <!--<td><button type="button" class="btn btn-success" onclick="itemDelivered('.$_id.')">Deliver</button></td>-->
                                        </tr>
                                ';

                                if($previousID == $_id){
                                    $output .= $addons;
                                }else{
                                    $output .= $firstRow;
                                }
                                $previousID = $_id;
                                }
                            }
                            echo $output;
                             $result->close();
                             $conn->next_result();

                                ?>
                                        <!-- //repeat body-->
                                    </tbody>

                                </table>
                                <!-- //Datatable -->
                                <!--//place content here-->
                            </div>
                        </div>
                    </div>
                    <!-- Customer Order collapsible-->

                    <br><br>
                    <input type="text" id="setorderID" name="setorderID" disabled hidden>

                    <!-- collapsible-->
                    <div class="sing-post-thumb mb-lg-5 mb-4 row">
                        <div class="col-12">
                            <!-- Low stock collapsible -->
                            <div class="rounded bg-light">
                                <h2>
                                    Low Stock product
                                    <button class="btn btn-primary rounded float-right" id="lowStockBtn"
                                        data-toggle="collapse" href="#collapseLowStock" aria-expanded="true"
                                        onclick="changeSign('lowStock');" aria-controls="collapseLowStock">
                                        <i class="fa fa-minus" id="lowStock"></i>
                                    </button>
                                </h2>

                                <div class="collapse show " id="collapseLowStock">
                                <div class="card card-body col-12">
                                <!--place content here-->
                                <!-- Datatable -->
                                <table id="" class="display" width="100%">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th width="20%">&nbsp Product</th>
                                            <th width="14%">Unit</th>
                                            <th width="14%">Price</th>
                                            <th width="12%">Quantity Available</th>
                                            <th width="20%">Last Restock Date</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- repeat within body-->
                                        <?php
                                        $sql = "CALL sp_countMyProducts($psid);";
                                        $result = $conn->query($sql);
                                        $bg = 0;
            
                                        if ($result -> num_rows > 0) {
                                            //output data for each row
                                            while ($row = $result->fetch_assoc()) {
                                                $pid_ = $row['plid'];
                                                $name_ = $row['name'];
                                                $img_ = $row['imgPath'];
                                                $unit_ = $row['unit'];
                                                $number_ = $row['number'];
                                                $qoh_ = $row['qoh'];
                                                $price_ = $row['price'];
                                                $date_ = date('d-m-Y h:m:s', strtotime($row['lastModifiedDateTime']));


                                                if ($qoh_ < 5) {

                                                    if ($bg == 0) {
                                                        $bg = 1;
                                                    } else {
                                                        $bg = 0;
                                                    }
                                                    echo'
                                                <tr class="'.(($bg == 1)?"bgrow":"bg-light").'">
                                                <td><img src="product/'.$img_.'" style="width:25%; height:25%;"> &nbsp '.$name_.'</td>
                                                <td>'.$number_ . " " . $unit_.'</td>
                                                <td>Rs'.$price_.'</td>
                                                <td>'.$qoh_.'</td>
                                                <td>'.$date_.'</td>
                                                <td>
                                                <input type="number" id="inputQOH'.$pid_.'" class="col-4" name="productQOH" style="display:none;">
                                                <Button type="button" id="YesQOH'.$pid_.'" onclick="updateProductStock('.$pid_.')" class="btn btn-success col-3" style="padding:2px; margin:1px; display:none;" ><i class="fa fa-check text-center"  aria-hidden="true"></i></Button>
                                                <Button type="cancel" id="NoQOH'.$pid_.'" onclick="hideButtons('.$pid_.')" class="btn btn-danger col-3" style="padding:2px; margin:1px; display:none;" ><i class="fa fa-times text-center" aria-hidden="true"></i></Button>
                                                <Button type="button" id="ReStockQOH'.$pid_.'" onclick="showButtons('.$pid_.')" class="btn btn-success">Re Stock</Button>
                                                <Button type="button" id="Details'.$pid_.'" class="btn btn-info">View Details</Button>
                                                </td>
                                                </tr>
                                                ';
                                                }
                                            }
                                        }
                                        $result->close();
                                        $conn->next_result();
                                        ?>
                                        <!-- //repeat body-->
                                    </tbody>

                                </table>
                                <!-- //Datatable -->
                                <!--//place content here-->
                            </div>
                                </div>
                            </div>
                            <!-- //Low stock collapsible -->
                        </div>
                    </div>
                    <!-- collapsible-->
                </div>
                <!--//mag-content-->
                <div style="margin: 8px auto; display: block; text-align:center;">
                    <!---728x90--->
                </div>
            </div>
        </div>
    </section>
    <!-- //Main-->



    <!-- //Main content -->




    <section class="w3l-footer-22">
        <!-- Include Footer -->
        <?php
     include 'include/footer.php';
     ?>

    </section>


</body>

</html>

<script>
function changeSign(docId) {
    var msgBtn = document.getElementById(docId);
    if (msgBtn.className == "fa fa-minus") {
        msgBtn.className = "fa fa-plus";
    } else {
        msgBtn.className = "fa fa-minus";
    }
}
</script>

<?php include "bottomScripts.php"; ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script>
//initialising datatable
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>

<script>
//Customer Orders
function setOrderid(id){
//set id input
document.getElementById('setorderID').value = id;
}

function itemDelivered(){
    //get id from input, should not be null
    orderID = document.getElementById('setorderID').value;
    alert(orderID);
    //ajax call to change status of delivery schedule
}


//Low Stock Product
function showButtons(id){
    document.getElementById('inputQOH'+id).style.display = "inline";
    document.getElementById('YesQOH'+id).style.display = "inline";
    document.getElementById('NoQOH'+id).style.display = "inline";
    document.getElementById('ReStockQOH'+id).style.display = "none";
    document.getElementById('Details'+id).style.display = "none";
}
function hideButtons(id){
    document.getElementById('inputQOH'+id).style.display = "none";
    document.getElementById('YesQOH'+id).style.display = "none";
    document.getElementById('NoQOH'+id).style.display = "none";
    document.getElementById('ReStockQOH'+id).style.display = "inline";
    document.getElementById('Details'+id).style.display = "inline";
}
function updateProductStock(id){
    document.getElementById('inputQOH'+id).style.display = "none";
    document.getElementById('YesQOH'+id).style.display = "none";
    document.getElementById('NoQOH'+id).style.display = "none";
    document.getElementById('ReStockQOH'+id).style.display = "inline";
    document.getElementById('Details'+id).style.display = "inline";

    //ajax call
    //give toastr msg
}
</script>