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
}

//if url does not contain query string product id, go to page add product
if((!isset($_GET['id'])) || (($_GET['id']) == NULL)){
    header('Location: addproduct.php');
}else{
    $productID = $_GET['id'];
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
.not-allowed {
    cursor: not-allowed;
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
                <!--/search-right-->
                <div class="search-right">
                    <!-- search popup -->
                    <div id="deleteprodline" class="pop-overlay">
                        <div class="popup">
                            <h3>Are you sure you want to delete this product? &nbsp
                                <button type="button" class="btn btn-danger" onclick="deleteProductline('',2,<?php echo $productID;?>);">Confirm
                                    Delete</button>
                                <input type="text" class="text-white" id="prodlineToDelete" name="prodlineToDelete" disabled hidden/>
                            </h3>
                        </div>
                        <a class="close" href="addproductpricing.php?id=<?php echo $_GET['id'];?>">×</a>

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
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">Product Pricing</li>
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
                <div class="blog-inner-grids bg-light">
                    <div class="mag-post-left-hny">
                        <div class="mag-hny-content">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">

                                <?php
                            //get product id
                            
                            

                            $sql = "CALL sp_getProductDetails($productID);";
                            $result = $conn->query($sql);

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $petshopid = $row['petshopID'];
                                    $pname = $row['pname'];
                                    $bname = $row['bname'];
                                    $description = $row['description'];
                                    $imgpath = $row['imgPath'];
                                    $pcname = $row['pcname'];
                                    $prodCatName = $row['prodname'];

                                }
                            }
                             $result->close();
                             $conn->next_result();


                            ?>

                                <!-- Product -->
                                </br>
                                <h3 class="hny-title mb-0" id="prodDetails">Product <span>Details</span></h3>
                                <div class="maghny-gd-1 blog-pt-grid mb-lg-5 mb-4">
                                    </br>

                                    <!--<a href="#"><img class="img-fluid" src="assets/images/banner3.jpg" alt=""></a>-->

                                    <div class="sp-store-single-page row">
                                        <div class="col-lg-5 single-right-left">
                                            <div class="flexslider1">


                                                <div class="clearfix"></div>
                                                <div class="flex-viewport">
                                                    <img src="product/<?php echo $imgpath; ?>" data-imagezoom="false"
                                                        class="img-fluid" alt=" "></br></br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 single-right-left pl-lg-4">
                                            <h3><?php echo $bname . " | " . $pname ?></h3>

                                            <div class="caption">

                                                <ul class="rating-single">
                                                    <li>
                                                        <a href="#">
                                                            <p><?php echo $pcname ." " . $prodCatName?></p>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- <ul class="rating-single">
                                                    <li>
                                                        <a href="#">
                                                            <span class="fa fa-star yellow-star"
                                                                aria-hidden="true"></span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <h6>
                                                    <span class="item_price">$575</span>
                                                    <del>$1,199</del> Free Delivery
                                                </h6>-->
                                            </div>
                                            <!--  <div class="desc_single my-4">
                                                <ul class="emi-views">
                                                    <li><span>Special Price</span> Get extra 5% off (price inclusive of
                                                        discount)</li>
                                                    <li><span>Bank Offer</span> 5% Unlimited Cashback on Flipkart Axis
                                                        Bank Credit Card</li>
                                                    <li><span>Bank Offer</span> 5% Cashback* on HDFC Bank Debit Cards
                                                    </li>
                                                    <li><span>Bank Offer</span> Extra 5% off* with Axis Bank Buzz Credit
                                                        Card</li>
                                                </ul>
                                            </div>
                                            <div class="desc_single mb-4">
                                                <h5>Description:</h5>
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere,
                                                    ratione et ipsam velit
                                                    explicabo deleniti obcaecati a, numquam, unde quisquam quas quae
                                                    accusamus eveniet
                                                    magni.
                                                    Nobis iure et porro aut..</p>
                                            </div>
                                            <div class="description-apt d-grid mb-4">
                                                <div class="occasional">
                                                    <h5 class="sp_title mb-3">Highlights:</h5>
                                                    <ul class="single_specific">
                                                        <li>
                                                            Neck : Round Neck</li>
                                                        <li>
                                                            Fit : Regular</li>

                                                        <li> Sleeve : Half Sleeve
                                                        </li>
                                                        <li> Material : Pure Cutton</li>

                                                    </ul>

                                                </div>

                                                <div class="color-quality">
                                                    <h5 class="sp_title">Services:</h5>
                                                    <ul class="single_serv">
                                                        <li>
                                                            <a href="#">30 Day Return Policy</a>
                                                        </li>
                                                        <li class="gap">
                                                            <a href="#">Cash on Delivery available</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="description mb-4">
                                                <h5>Check delivery, payment options and charges at your location</h5>
                                                <form action="#" class="d-flex" method="post">
                                                    <input type="text" placeholder="Enter pincode" required="">
                                                    <button class="submit btn" type="submit">Check</button>
                                                </form>
                                            </div>-->
                                            <div class="description mb-4">
                                                <h5>Product Description</h5>
                                                <p><?php echo $description; ?></p>
                                            </div>

                                            <div class="description mb-4" id="tableprice">
                                                <h5>Product Price</h5>
                                                <table border="2" width="100%">
                                                    <thead class="bg-primary">
                                                        <th width="8%"> Unit </th>
                                                        <th width="17%"> Price </th>
                                                        <th width="20%"> Quantity Available </th>
                                                        <th width="13%"> Discount %</th>
                                                        <th width="18%"> Discount Date</th>
                                                        <th width="15%">Action</th>
                                                    </thead>

                                                    <?php
                                                    //fetch data from product line for this particular product
                                                    $sql = "CALL sp_getProductLine($productID);";
                                                    $result = $conn->query($sql);
                                                            $_unit ="";
                                                            $_number = "";
                                                            $_price ="";
                                                            $_qoh = "";
                                                            $_id="";
                                                            $update = false;
                        
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result->fetch_assoc()) {
                                                            $productLineID  = $row['productLineID'];
                                                            $unit = $row['unit'];
                                                            $number = $row['number'];
                                                            $qoh = $row['qoh'];
                                                            $price = $row['price'];
                                                            $priceDisplay = 'Rs'  . $price ;
                                                            $lastMDT = $row['lastModifiedDateTime'];

                                                            //get value of m from url
                                                            if(isset($_GET['m'])){
                                                                //get value
                                                                if(($_GET['m']) == $row['productLineID']){
                                                                $_unit =$row['unit'];
                                                                $_number = $row['number'];
                                                                $_price = $row['price'];
                                                                $_qoh = $row['qoh'];
                                                                $_id=$_GET['m'];
                                                                $update = true;
                                                                }
                                                            }

                                                            //get discount
                                                            $percentage = "";
                                                            $start = "";
                                                            $end = "";
                                                            $date = "";
                                                            $percentageDisplay="";
                                                            $arrayResult = getDiscount($productLineID, "active");
                                                            if ($arrayResult != null) {
                                                                if ($arrayResult -> num_rows > 0) {
                                                                    //output data for each row
                                                                    while ($row1 = $arrayResult->fetch_assoc()) {
                                                                        $percentage = $row1['percentage'];
                                                                        $percentageDisplay = $percentage . '%';
                                                                        $start = date('d M Y', strtotime($row1['startDate']));
                                                                        $end = date('d M Y', strtotime($row1['endDate']));
                                                                        $date = $start . " to " . $end;
                                                                        $newprice = (($price * (100 - $percentage))*0.01);
                                                                        $priceDisplay = '<del>'.$priceDisplay.'</del>' ." " .'<b class="text-danger">Rs'  . $newprice .'</b>';
                                                                    }
                                                                }
                                                                $arrayResult->close();
                                                                $conn->next_result();
                                                            }
                                                            

                                                            echo '
                                                            <input type="number" id="per'.$productLineID.'" value="'.$percentage.'" disabled hidden>
                                                            <input type="text" id="start'.$productLineID.'" value="'.$start.'" disabled hidden>
                                                            <input type="text" id="end'.$productLineID.'" value="'.$end.'" disabled hidden>
                                                            <tr id="rowNum'.$row['productLineID'].'">
                                                            <td>' . $number . " ". $unit . ' </td>
                                                            <td>'  . $priceDisplay . ' </td>
                                                            <td> '.$qoh.' </td>
                                                            <td> '.$percentageDisplay.'</td>
                                                            <td> '.$date.'</td>
                                                            <td class="text-center" width="25%">
                                                            <a href="addproductpricing.php?id='.$productID.'&m='.$productLineID.'#tableprice"  class="btn btn-warning" title="Edit Product-line" style="margin:1px"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                            <button type="button" class="btn btn-info" onclick="showDiscount(1, '.$productLineID.')" title="Add/Update Discount" style="margin:1px"><i class="fa fa-tag" aria-hidden="true"></i></button>
                                                            <button type="button" class="btn btn-danger" onclick=deleteProductline('.$productLineID.',1,'.$productID.') title="Delete"><i class="fa fa-trash iblack" aria-hidden="true"></i></a>
                                                            </td>
                                                            </tr>';
                        
                                                        }
                                                    }
                                                     $result->close();
                                                     $conn->next_result();
                                                    ?>

                                                </table>
                                                </br>
                                                <button type="button" class="btn btn-success" id="newProductLine"
                                                    onclick="showProductPricing(1)">New Product Line</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- Product -->

                                <div class="leave-comment-form mt-lg-5 mt-4" id="comment">
                                    <!-- <h3 class="hny-title mb-0">Product <span>Pricing</span></h3> -->
                                    <p class="mb-4">Required fields are marked
                                        *
                                    </p>

                                    <form action="" method="post" enctype="multipart/form-data">

                                        <p class="mb-4 text-white text-center bg-dark">
                                            Pricing Details
                                        </p>
                                        <input type="number" name="prodid" id="prodid" value="<?php echo $_id;?>"
                                            disabled hidden>
                                        <input type="number" name="productID" id="productID"
                                            value="<?php echo $productID;?>" disabled hidden>
                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Unit *</label>
                                                <select class="form-control" name="unit" id="unit" required>
                                                    <option value="" selected="true" disabled="disabled">Unit</option>
                                                    <option value="g" <?php if($_unit == "g"){echo "selected";}?>>g
                                                    </option>
                                                    <option value="kg" <?php if($_unit == "kg"){echo "selected";}?>>kg
                                                    </option>
                                                    <option value="ml" <?php if($_unit == "ml"){echo "selected";}?>>ml
                                                    </option>
                                                    <option value="cl" <?php if($_unit == "cl"){echo "selected";}?>>cl
                                                    </option>
                                                    <option value="l" <?php if($_unit == "l"){echo "selected";}?>>l
                                                    </option>

                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Amount * </label>
                                                <input type="text" name="amount" id="am" class="form-control"
                                                    placeholder="Amount" value="<?php echo $_number?>" required="">
                                            </div>
                                        </div>

                                        <div class="input-grids row">

                                            <div class="form-group col-lg-6">
                                                <label>Price * </label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend border border-dark rounded">
                                                        <div class="input-group-text">Rs</div>
                                                    </div>
                                                    <input type="number" name="price" id="price" class="form-control"
                                                        placeholder="Price" value="<?php echo $_price?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Quantity Available * </label>
                                                <input type="number" name="qoh" id="qoh" class="form-control"
                                                    placeholder="Quantity in stock" value="<?php echo $_qoh?>"
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="submit text-right mt-5">
                                            <button type="button" class="btn btn-warning"
                                                onclick="showProductPricing(0, <?php echo $_id;?>)">Cancel</button>
                                            <button type="submit" class="btn btn-primary" name="addProductpricing"
                                                id="addProductpricing" value="post product">
                                                Add</button>
                                            <button type="button" class="btn btn-primary" name="updateProductpricing"
                                                id="updateProductpricing" onclick="update()" value="Update product">
                                                Update</button>
                                        </div>
                                        <br>
                                    </form>

                                    <?php
                                    //submit form, fetch data from form, call function addProduct
                                    //go to another page to view posted product

                                    if (isset($_POST['addProductpricing'])) {
                                        
                                        //Fetch data from the fields
                                          
                                        $F_unit = $_POST['unit'];
                                        $F_amount = $_POST['amount'];
                                        $F_price = $_POST['price'];
                                        $F_qoh = $_POST['qoh'];
                                        //discount percentage and days
                                        //$val = $_POST['price'];
                                        //if($val == "0"){
                                        //    $percdis = 0;
                                        //    $discdays = 0;
                                        //}else{
                                        //    $percdis = $_POST['per'];
                                        //    $discdays = $_POST['day'];
                                        //}

                                        //$prodcatid = $_POST['prodcat'];
                                        //$specialityid = $_POST['petcat'];
                                        $F_status = 1;
                                        //$dateposted = date("Y/m/d G:i:s");
                                        $F_lastmodif = date("Y/m/d G:i:s");
                                        //$petshopid= getPetshopID($userid);

                                        

                                        
                                        $result = addProductLine($F_unit, $F_amount, $F_qoh, $F_price, $F_lastmodif, $F_status, $productID);
                                        if ($result) {
                                            //**********get add product success message, go to page to view posted product
                                            //Add product price => add to table productLine
                                            header('Location: addProductpricing.php?id='.$productID);
                                        } else {
                                            //**********get add product failed message
                                            header('Location: fail.php');
                                            //echo "<script>window.location.href='register.php';</script>";
                                        }
                                            
                                        
                                    }
                                    //submit form, fetch data from form, call function addProduct
                                    //go to another page to view posted product

                                    if (isset($_POST['updateProductpricing'])) {
                                        
                                        //Fetch data from the fields
                                        $z_id = $_POST['prodid'];
                                        $z_unit = $_POST['unit'];
                                        $z_amount = $_POST['amount'];
                                        $z_price = $_POST['price'];
                                        $z_qoh = $_POST['qoh'];
                                        $z_lastmodif = date("Y/m/d G:i:s");
                                        
                                        $result = updateProductLine($z_id, $z_unit, $z_amount, $z_qoh, $z_price, $z_lastmodif);
                                        if ($result) {
                                            //**********get add product success message, go to page to view posted product
                                            //Add product price => add to table productLine
                                            header('Location: addProductpricing.php?id='.$productID);
                                        } else {
                                            //**********get add product failed message
                                            header('Location: fail.php');
                                            //echo "<script>window.location.href='register.php';</script>";
                                        }
                                            
                                        
                                    }
                                    ?>
                                </div>


                                <div class="leave-comment-form mt-lg-5 mt-4" id="discount">
                                    <!-- <h3 class="hny-title mb-0">Product <span>Pricing</span></h3> -->
                                    <input type="number" name="disprodid" id="disprodid" value="" disabled hidden>
                                    <p class="mb-4">Required fields are marked
                                        *
                                    </p>

                                    <form action="" method="post" enctype="multipart/form-data">

                                        <p class="mb-4 text-white text-center bg-dark">
                                            Discount Pricing Details
                                        </p>
                                        <div class="input-grids row" id="discountDetails">

                                            <div class="form-group col-lg-6">
                                                <label>% Discount * </label>
                                                <input type="number" name="per" id="per" class="form-control"
                                                    placeholder="% Discount">
                                            </div>
                                        </div>
                                        <div class="input-grids row">

                                            <div class="form-group col-lg-6">
                                                <label>Start Date *</label>
                                                <input type="date" name="start" id="start" onchange="setDate()"
                                                    class="form-control" placeholder="Start Date">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>End Date *</label>
                                                <input type="date" name="end" id="end" onchange="setDate()"
                                                    class="form-control" placeholder="End Date">
                                            </div>
                                        </div>
                                        <label id="discountErrormsg" class="text-danger"></label>
                                        <div class="submit text-right mt-5">
                                            <button type="button" class="btn btn-warning"
                                                onclick="showDiscount(0,1)">Cancel</button>
                                            <button type="button" class="btn btn-primary" name="addDiscount"
                                                id="addDiscount" onclick="addDiscountfunc()">
                                                Add Discount</button>
                                        </div>
                                        </br>
                                    </form>

                                </div>
                                <!--//leave-->
                                <!--//mag-hny-content-4-->
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
/*
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
}*/
</script>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!--Price Range-->
<script src="assets/js/jquery-ui.js"></script>
<script>
//<![CDATA[ 
$(window).load(function() {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 9000,
        values: [50, 6000],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values",
        1));

}); //]]>
</script>


<!--/login-->
<script>
$(document).ready(function() {
    $(".button-log a").click(function() {
        $(".overlay-login").fadeToggle(200);
        $(this).toggleClass('btn-open').toggleClass('btn-close');
    });
});
$('.overlay-close1').on('click', function() {
    $(".overlay-login").fadeToggle(200);
    $(".button-log a").toggleClass('btn-open').toggleClass('btn-close');
    open = false;
});
</script>
<!--//login-->
<script>
// optional
$('#customerhnyCarousel').carousel({
    interval: 5000
});
</script>
<!-- cart-js -->
<script src="assets/js/minicart.js"></script>
<script>
transmitv.render();

transmitv.cart.on('transmitv_checkout', function(evt) {
    var items, len, i;

    if (this.subtotal() > 0) {
        items = this.items();

        for (i = 0, len = items.length; i < len; i++) {}
    }
});
</script>

<!-- //cart-js -->
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
if(!isset($_GET['m'])){
 echo '
 <script>
//default hide
document.getElementById(\'comment\').style.display = "none";
document.getElementById(\'addProductpricing\').style.display = "inline";
document.getElementById(\'updateProductpricing\').style.display = "none";
document.getElementById(\'newProductLine\').style.display = "block";

</script>
 ';
}else{
    echo '
 <script>
//default hide
document.getElementById(\'comment\').style.display = "block";
document.getElementById(\'addProductpricing\').style.display = "none";
document.getElementById(\'updateProductpricing\').style.display = "inline";
document.getElementById(\'newProductLine\').style.display = "none";
//get row, add bg color
document.getElementById("rowNum'.$_GET['m'].'").style.backgroundColor = "grey";
</script>
';
}
?>

<script>
function showProductPricing(num, id) {
    if (num == 1) {
        document.getElementById('comment').style.display = "block";
        document.getElementById('newProductLine').style.display = "none";
        document.getElementById('updateProductpricing').style.display = "none";
        document.getElementById('addProductpricing').style.display = "inline";

        //set values blank
        document.getElementById('unit').value = "";
        document.getElementById('am').value = "";
        document.getElementById('price').value = "";
        document.getElementById('qoh').value = "";

    }
    if (num == 0) {
        document.getElementById('comment').style.display = "none";
        document.getElementById('newProductLine').style.display = "block";
        //get row, add bg color
        document.getElementById("rowNum" + id).style.backgroundColor = "white";
    }
}

//default hide discount
document.getElementById('discount').style.display = "none";

function showDiscount(num, id) {
    if (num == 1) {
        document.getElementById('discount').style.display = "block";
        //get row, add bg color
        document.getElementById("rowNum" + id).style.backgroundColor = "grey";
        //set input
        document.getElementById('disprodid').value = id;

        //get value
        var date = new Date();
        document.getElementById("per").value = document.getElementById("per" + id).value;
        document.getElementById("end").value = formatDate(document.getElementById("end" + id).value);
        document.getElementById("start").value = formatDate(document.getElementById("start" + id).value);
    }
    if (num == 0) {
        document.getElementById('discount').style.display = "none";
        //get row, add bg color
        thisid = document.getElementById('disprodid').value;
        document.getElementById("rowNum" + thisid).style.backgroundColor = "white";
        //clear value
        document.getElementById("start").value = "";
        document.getElementById("end").value = "";
        document.getElementById("per").value = "";

    }
}
//test
function reload2() {
    id = document.getElementById('productID').value;
    window.location.href = "addproductpricing.php?id=" + id;
}


function update(id) {

    _id = document.getElementById('prodid').value;
    _price = document.getElementById('price').value;
    _unit = document.getElementById('unit').value;
    _number = document.getElementById('qoh').value;
    _amount = document.getElementById('am').value;

    $.ajax({
        url: 'ajax/productAction.php',
        data: {
            productlineID: _id,
            price: _price,
            unit: _unit,
            amount: _amount,
            qoh: _number,
            action: "updateProductline"
        },
        type: 'post',
        success: function(data) {
            if (data == 1) {

            }
            toastr.success('Updated');
            reload2();
        }
    });
}
</script>

<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
    dd = '0' + dd;
}

if (mm < 10) {
    mm = '0' + mm;
}

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("start").setAttribute("min", today);

//document.getElementById("end").disabled = true;
//document.getElementById("addDiscount").disabled = true;

function setDate() {
    document.getElementById("end").disabled = false;
    Endmin = document.getElementById("start").value;
    document.getElementById("end").setAttribute("min", Endmin);

    //get values
    start = document.getElementById("start").value;
    end = document.getElementById("end").value;

    if (start > end) {
        //give error msg
        //block add discount btn
        document.getElementById("addDiscount").disabled = true;
        document.getElementById("addDiscount").classList.add("not-allowed");
        document.getElementById("discountErrormsg").innerHTML = "Start Date must be less than End Date";
    } else {
        document.getElementById("addDiscount").disabled = false;
        document.getElementById("discountErrormsg").innerHTML = "";
    }

}

function addDiscountfunc() {
    //get values of per, start, end
    start = document.getElementById("start").value;
    end = document.getElementById("end").value;
    per = document.getElementById("per").value;
    productLineID = document.getElementById("disprodid").value;
    id = document.getElementById('prodid').value;
    // if not empty, ajax call else error msg

    if (per < 0 || per == "" || start == "" || end == "" || productLineID <= 0) {
        document.getElementById("discountErrormsg").innerHTML = "Invalid Values";
        document.getElementById("addDiscount").classList.add("not-allowed");
    } else {
        document.getElementById("discountErrormsg").innerHTML = "";

        //ajax call to add discount
        $.ajax({
            url: 'ajax/productAction.php',
            data: {
                start: start,
                end: end,
                per: per,
                productLineID: productLineID,
                action: "addDiscount"
            },
            type: 'post',
            success: function(data) {
                if (data == 1) {

                }
                toastr.success('Discount Added');
                reload2();
            }
        });
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}
</script>

<script>
function deleteProductline(id, action, prodID) {
    //set value in input prodToDelete
    //pop up
    if (action == 1) {
        document.getElementById('prodlineToDelete').value = id;
        window.location.href = 'addproductpricing.php?id=' + prodID + "#deleteprodline";
    }

    //get value in input prodToDelete
    //ajax call
    if (action == 2) {
        IDtoDelete = document.getElementById('prodlineToDelete').value;
        //ajax call
        $.ajax({
            url: 'ajax/productAction.php',
            data: {
                productLineID: IDtoDelete,
                delete:1,
                action: "deleteProductLine"
            },
            type: 'post',
            success: function(data) {
                toastr.success("Product Deleted");
                window.location.href = 'addproductpricing.php?id=' + prodID;
            }
        });
    }

}
</script>