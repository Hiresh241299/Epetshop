<?php
include 'include/common.php';
include 'include/functions.php';
//solves header issue
ob_start();
session_start();
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
    <!-- Template CSS -->

</head>

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
                                <h3 class="hny-title mb-0">Product <span>Details</span></h3>
                                <div class="maghny-gd-1 blog-pt-grid mb-lg-5 mb-4">
                                    </br>

                                    <!--<a href="#"><img class="img-fluid" src="assets/images/banner3.jpg" alt=""></a>-->

                                    <div class="sp-store-single-page row">
                                        <div class="col-lg-5 single-right-left">
                                            <div class="flexslider1">


                                                <div class="clearfix"></div>
                                                <div class="flex-viewport"
                                                    style="overflow: hidden; position: relative;">
                                                    <ul>
                                                        <li data-thumb="product/<?php echo $imgpath; ?>" class="clone"
                                                            style="width: 445px; float: left; display: block;">
                                                            <div class="thumb-image"> <img
                                                                    src="product/<?php echo $imgpath; ?>"
                                                                    data-imagezoom="true" class="img-fluid" alt=" ">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 single-right-left pl-lg-4">
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

                                            <div class="description mb-4">
                                                <h5>Product Price</h5>
                                                <table border="3">
                                                    <thead class="bg-primary">
                                                        <td> Unit </td>
                                                        <td> Price </td>
                                                        <td> Quantity in stock </td>
                                                        <td>Action</td>
                                                    </thead>

                                                    <?php
                                                    //fetch data from product line for this particular product
                                                    $sql = "CALL sp_getProductLine($productID);";
                                                    $result = $conn->query($sql);
                        
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result->fetch_assoc()) {
                                                            $unit = $row['unit'];
                                                            $number = $row['number'];
                                                            $qoh = $row['qoh'];
                                                            $price = $row['price'];
                                                            $lastMDT = $row['lastModifiedDateTime'];

                                                            echo '<tr>
                                                            <td> ' . $number . " ". $unit . ' </td>
                                                            <td> Rs'  . $price . ' </td>
                                                            <td> '.$qoh.' </td>
                                                            <td>btn</td>
                                                            </tr>';
                        
                                                        }
                                                    }
                                                     $result->close();
                                                     $conn->next_result();
                                                    ?>

                                                </table>
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

                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Unit *</label>
                                                <select class="form-control" name="unit" id="unit" required>
                                                    <option value="" selected="true" disabled="disabled">Unit</option>
                                                    <option value="g">g</option>
                                                    <option value="kg">kg</option>
                                                    <option value="ml">ml</option>
                                                    <option value="cl">cl</option>
                                                    <option value="l">l</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Amount * </label>
                                                <input type="number" name="amount" class="form-control"
                                                    placeholder="Amount" required="">
                                            </div>
                                        </div>

                                        <div class="input-grids row">

                                            <div class="form-group col-lg-6">
                                                <label>Price * </label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend border border-dark rounded">
                                                        <div class="input-group-text">Rs</div>
                                                    </div>
                                                    <input type="number" name="price" class="form-control"
                                                        placeholder="Price" required="">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Quantity Available * </label>
                                                <input type="number" name="qoh" class="form-control"
                                                    placeholder="Quantity in stock" required="">
                                            </div>
                                        </div>

                                        <!-- Discount -->
                                        <!--<div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Discount</label>
                                                <select class="form-control" name="disc" id="disc"
                                                    onchange="switchDisc();" required>
                                                    <option value="0" selected="true">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="input-grids row" id="discountDetails">

                                            <div class="form-group col-lg-6">
                                                <label>% Discount * </label>
                                                <input type="number" name="per" class="form-control"
                                                    placeholder="% Discount">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Discount Days * </label>
                                                <input type="number" name="day" class="form-control"
                                                    placeholder="Discount Days">
                                            </div>
                                        </div> -->

                                        <div class="submit text-right mt-5">
                                            <Button class="btn btn-primary" name="addProductpricing"
                                                value="post product">
                                                Submit</button>
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
                                        //$dateposted = date("Y/m/d h:i:s");
                                        $F_lastmodif = date("Y/m/d h:i:s");
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
                                    
                                    ?>
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