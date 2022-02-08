<?php
include 'include/common.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
}
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"])) || ($_SESSION["roleid"] != 2) || (!isset($_SESSION["userid"]))) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
    $psid = getPetshopID($userid);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'include/header.php';
    ?>

</head>

<style>
.bgrow {
    background-color: #BEBEBE;
}
</style>

<body>

    <section class="w3l-banner-slider-main inner-pagehny">
        <div class="breadcrumb-infhny">

            <div class="top-header-content">
                <header class="tophny-header">
                    <!-- Include Navbar -->
                    <?php
            include 'include/navbarVendor.php';
            ?>
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
                                    $petshopID = $row['petshopID'];
                                    $name = $row['name'];
                                    echo '<h2 class="hny-title text-center">'.$name.'</h2>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                            ?>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>

                                <li class="active">Orders & Delivery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //w3l-banner-slider-main -->



    <section class="blog-post-main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5">
            <div class="container py-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->

                </div>
                <h3 class="hny-title mb-0 border text-center">Orders &<span> Delivery</span></h3>
                <div class="blog-inner-grids">
                    <div class="mag-post-left-hny">
                        <div class="">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">
                                <!--Table-->
                                <div class="rounded bg-light" id="corders">
                                    <h2>
                                        <?php
                         $NoOfOrders = getCountMyPetshopOrders($userid);
                         if($NoOfOrders > 1){
                            echo $NoOfOrders . " " . "Customer Orders";
                         }else{
                            echo $NoOfOrders . " " . "Customer Order";
                         }
                         
                         ?>
                                    </h2>

                                    <div class="">
                                        <div class="card card-body col-12">
                                            <!--place content here-->
                                            <!-- Datatable -->
                                            <table id="table_id" class="display" width="100%">
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
                                $sql = "CALL sp_getMyCustomerOrdersDelivery($psid);";
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
                                <!--Table-->
                            </div>
                        </div>
                    </div>
                </div>
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
<script>
var disc = document.getElementById('disc');
var discDetails = document.getElementById('discountDetails');

//by default, invisible
discDetails.style.display = "none";

//on discount yes, make 2 text box visible
function switchDisc() {
    var discValue = document.getElementById('disc').value;
    var per = document.getElementById('per');
    var day = document.getElementById('day');

    if (discValue == 0) {
        discDetails.style.display = "none";
        per.required = false;
        day.required = false;

    } else if (discValue == 1) {
        discDetails.style.display = "block";
        per.required = true;
        day.required = true;
    }
}
</script>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<!--pop-up-box-->
<script src="assets/js/jquery.magnific-popup.js"></script>
<!--//pop-up-box-->
<script>
$(document).ready(function() {
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

});
</script>
<!--//search-bar-->
<!-- disable body scroll which navbar is in active -->

<script>
$(function() {
    $('.navbar-toggler').click(function() {
        $('body').toggleClass('noscroll');
    })
});
</script>
<!-- disable body scroll which navbar is in active -->
<script src="assets/js/bootstrap.min.js"></script>
<?php
include 'buttonScripts.php';
?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script>
//initialising datatable
$(document).ready(function() {
    $('#table_id').DataTable();
});
$('#table_id').DataTable().columns.adjust();
</script>