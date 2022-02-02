<?php
if(!isset($_SESSION)){
    session_start();
}
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
//Check if session roleid exists
if (isset($_SESSION["roleid"])) {
    $session_roleID = $_SESSION["roleid"];
}else{
    $session_roleID = 0;
}
//if login as owner, send to petshopHome.php
if ($session_roleID == 2) {
    header('Location: petshopHome.php');
}
?>
<!doctype html>
<html lang="en">


<head>
    <?php
    include 'include/header.php';
    ?>
    <style>
    .pimg {
        width: 300px;
        height: 300px;
        overflow: hidden;
    }

    .bimg {
        width: 200px;
        height: 200px;
    }

    .cardbg {
        background-color: #f4f4f4;
    }
    </style>
</head>

<body>
    <!--Navbar & Carousel-->
    <section class="w3l-banner-slider-main inner-pagehny">
        <div class="breadcrumb-infhny">

            <div class="top-header-content">
                <header class="tophny-header">
                    <!-- Include Navbar -->
                    <?php
            if ($session_roleID == 3) {
                include 'include/navbarCustomer.php';
            }else{
                include 'include/navbar.php';
            }
            ?>
                </header>
                <div class="breadcrumb-contentnhy">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <h2 class="hny-title text-center">Products</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">View Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//Navbar & Carousel -->

    <section class="w3l-ecommerce-main-inn">

        <div class="ecomrhny-content-inf py-5">
            <div class="container py-lg-5">
                <!--/row1-->
                <div class="sp-store-single-page row">
                    <div class="col-lg-5 single-right-left">
                        <div class="flexslider1">


                            <div class="clearfix"></div>
                            <div class="flex-viewport" style="overflow: hidden; position: relative;">
                                <ul class="slides"
                                    style="width: 1200%; transition-duration: 0.6s; transform: translate3d(-1780px, 0px, 0px);">
                                    <li data-thumb="assets/images/cart4.jpg" class="clone"
                                        style="width: 445px; float: left; display: block;">
                                        <div class="thumb-image"> <img src="assets/images/cart4.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                    <li data-thumb="assets/images/cart1.jpg" class=""
                                        style="width: 445px; float: left; display: block;">
                                        <div class="thumb-image"> <img src="assets/images/cart1.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                    <li data-thumb="assets/images/cart2.jpg"
                                        style="width: 445px; float: left; display: block;" class="">
                                        <div class="thumb-image"> <img src="assets/images/cart2.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                    <li data-thumb="assets/images/cart3.jpg"
                                        style="width: 445px; float: left; display: block;" class="">
                                        <div class="thumb-image"> <img src="assets/images/cart3.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                    <li data-thumb="assets/images/cart4.jpg"
                                        style="width: 445px; float: left; display: block;" class="flex-active-slide">
                                        <div class="thumb-image"> <img src="assets/images/cart4.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                    <li data-thumb="assets/images/cart1.jpg" class="clone"
                                        style="width: 445px; float: left; display: block;">
                                        <div class="thumb-image"> <img src="assets/images/cart1.jpg"
                                                data-imagezoom="true" class="img-fluid" alt=" "> </div>
                                    </li>
                                </ul>
                            </div>
                            <ol class="flex-control-nav flex-control-thumbs">
                                <!--<li><img src="assets/images/cart1.jpg" class=""></li>
                                <li><img src="assets/images/cart2.jpg" class=""></li>
                                <li><img src="assets/images/cart3.jpg" class=""></li>-->
                                <li><img src="assets/images/cart4.jpg" class="flex-active"></li>
                            </ol>
                            <ul class="flex-direction-nav">
                                <li><a class="flex-prev" href="#">Previous</a></li>
                                <li><a class="flex-next" href="#">Next</a></li>
                            </ul>
                        </div>
                        <div class="eco-buttons mt-5">

                            <div class="transmitv single-item">
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="transmitv_item" value="Yellow T-Shirt">
                                    <input type="hidden" name="amount" value="599.99">
                                    <button type="submit" class="transmitv-cart ptransmitv-cart add-to-cart read-2">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                            <div class="buyhny-now"> <a href="#buy" class="action btn">Buy Now </a></div>

                        </div>
                    </div>
                    <div class="col-lg-7 single-right-left pl-lg-4">
                        <h3>Striped Men Round Neck Yellow T-Shirt
                        </h3>
                        <div class="caption">

                            <ul class="rating-single">
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star-half-o yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star-half yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                            </ul>

                            <h6>
                                <span class="item_price">$575</span>
                                <del>$1,199</del> Free Delivery
                            </h6>
                        </div>
                        <div class="desc_single my-4">
                            <ul class="emi-views">
                                <!--<li><span>Special Price</span> Get extra 5% off (price inclusive of discount)</li>-->
                            </ul>
                        </div>
                        <div class="desc_single mb-4">
                            <h5>Description:</h5>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere, ratione et ipsam velit
                                explicabo deleniti obcaecati a, numquam, unde quisquam quas quae accusamus eveniet
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
                        </div>

                    </div>
                </div>
            </div>
            <!--//row1-->
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
<script type="text/javascript">
$(document).ready(function() {

    load_data();

    function load_data(page) {


        $.ajax({
            url: "ajax/load_data.php",
            method: "POST",
            data: {
                page: page
            },
            dataType: "JSON",
            success: function(data) {
                $(".show_data").html(data.output);
                $("#pagination").html(data.pagination);
            }
        });
    }

    $(document).on("click", ".pagination a", function(event) {
        event.preventDefault();
        var id = $(this).attr("id");
        load_data(id);
    });

    function show_mycart() {
        $.ajax({
            url: "ajax/show_mycart.php",
            method: "POST",
            dataType: "JSON",
            success: function(data) {
                $("#cart").text(data.da);
            }
        });
    }

});

$(document).on("click", ".add_cart", function(event) {
    event.preventDefault();
    //alert("test");
    var id = $(this).attr("id");
    var name = $("#name" + id + "").val();
    var quantity = $("#quantity" + id + "").val();
    var price = $("#price" + id + "").val();
    //var id = 1;
    //var name = "";
    //var quantity = 1;
    //var price = 1;
    var action = "add";
    $.ajax({
        url: "ajax/cart_action.php",
        method: "POST",
        dataType: "JSON",
        data: {
            id: id,
            name: name,
            price: price,
            quantity: quantity,
            action: action
        },
        success: function(data) {

        }
    });
    toastr.success('Product added');
});
</script>