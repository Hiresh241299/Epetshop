<?php
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
if(!isset($_SESSION)){
    session_start();
}
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
			include 'include/navbar.php';
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
    <!-- //w3l-banner-slider-main -->

    <section class="w3l-ecommerce-main-inn">
        <!--/mag-content-->
        <div class="ecomrhny-content-inf py-5">
            <div class="container py-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->


                </div>
                <!--/row1-->
                <div class="ecommerce-grids row">
                    <div class="ecommerce-left-hny col-lg-4">
                        <!--Filters-->
                        <aside>
                            <div class="sider-bar">
                                <div class="single-gd mb-5">

                                    <h4>Search <span>here</span></h4>
                                    <form action="#" method="post" class="search-trans-form">
                                        <input class="form-control" type="search" name="search"
                                            placeholder="Search here..." required="">
                                        <button class="btn read-2">
                                            <span class="fa fa-search"></span>
                                        </button>

                                    </form>
                                </div>
                                <!-- /Gallery-imgs -->

                                <div class="single-gd mb-5">
                                    <h4>Product <span>Categories</span></h4>
                                    <ul class="list-group single">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accessories
                                            <span class="badge badge-primary badge-pill">14</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Suits
                                            <span class="badge badge-primary badge-pill">18</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Footwear
                                            <span class="badge badge-primary badge-pill">12</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Blazers
                                            <span class="badge badge-primary badge-pill">10</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--
                                <div class="single-gd mb-5">
                                    <h4>Filter by <span>Price</span></h4>

                                    <ul class="dropdown-vjm-transitu6">
                                        <li>

                                            <div id="slider-range"
                                                class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                
                                            </div>
                                            <input type="text" id="amount"
                                                style="border: 0; color: #ffffff; font-weight: normal;">
                                        </li>
                                    </ul>
                                </div>

                                
                                <div class="single-gd mb-5">
                                    <h4>Discount </h4>
                                    <div classes="box-hny">
                                        <label class="containerhny-checkbox">15% or More
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">20% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">35% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">55% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>

                                        <label class="containerhny-checkbox">65% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">75% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="single-gd left-side mb-5">
                                    <h4>Customer Ratings</h4>
                                    <ul class="ratingshyny">
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span>5.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>4.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>3.5</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>3.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>2.5</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div> 

                                <div class="single-gd mb-5 border-0">
                                    <h4>Recent <span>Products</span></h4>
                                    <div class="row special-sec1 mt-4">
                                        <div class="col-4 img-deals">
                                            <a href="ecommerce-single.html"><img src="assets/images/shop-88.jpg"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="col-8 img-deal1">
                                            <h5 class="post-title">
                                                <a href="ecommerce-single.html">Blue Sweater</a>
                                            </h5>

                                            <a href="ecommerce-single.html" class="price-right">$499.00</a>
                                        </div>

                                    </div>
                                    <div class="row special-sec1 mt-4">
                                        <div class="col-4 img-deals">
                                            <a href="ecommerce-single.html"><img src="assets/images/shop-77.jpg"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="col-8 img-deal1">
                                            <h5 class="post-title">
                                                <a href="ecommerce-single.html">White T-Shirt</a>
                                            </h5>
                                            <a href="ecommerce-single.html" class="price-right">$575.00</a>
                                        </div>

                                    </div>

                                </div>
                                -->
                            </div>
                        </aside>
                        <!--Filters-->
                    </div>
                    <div class="ecommerce-right-hny col-lg-8">
                        <!--Sort results-->
                        <div class="row ecomhny-topbar">
                            <div class="col-6 ecomhny-result">
                                <h4 class="ecomhny-result-count" hidden> Showing all 9 Results</h4>
                            </div>
                            <div class="col-6 ecomhny-topbar-ordering">

                                <div class="ecom-ordering-select d-flex">
                                    <span class="fa fa-angle-down" aria-hidden="true"></span>
                                    <select>
                                        <option value="menu_order" selected="selected">Default Sorting</option>
                                        <option value="popularity">Sort by Popularity</option>
                                        <option value="rating">Sort by Average rating</option>
                                        <option value="date">Sort by latest</option>
                                        <option value="price">Sort by Price: low to high</option>
                                        <option value="price-desc">Sort by Price: high to low</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!--Sort results-->

                        <!-- Products-->
                        <div class="ecom-products-grids row">
                            <!-- Product -->
                            <!-- Post Starts-->
                            <?php

                            //Load product details from database
                            //gets error details
                            //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                            $sql = "CALL sp_getAllProductLineDetails();";
                            $result = $conn->query($sql);

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $pid = $row['productID'];
                                    $pname = $row['pname'];
                                    $brand = $row['bname'];
                                    $desc= $row['description'];
                                    $img = $row['imgPath'];
                                    $prodcat = $row['pcname'];
                                    $petCat = $row['sname'];
                                    $postedDT = $row['postedDateTime'];
                                    $lastMDT = $row['lastModifiedDateTime'];
                                    $petshopID = $row['petshopID'];
                                    $petshopName = $row['petshop'];
                                    $unit = $row['unit'];
                                    $number = $row['number'];
                                    $qoh = $row['qoh'];
                                    $price = $row['price'];

                                    echo '<div class="col-lg-4 col-6 product-incfhny mb-4">
                                <div class="product-grid2 transmitv">
                                    <div class="product-image2">
                                        <a href="ecommerce-single.html">
                                            <img class="pic-1 img-fluid" src="product/'.$img.'">
                                            <img class="pic-2 img-fluid" src="product/'.$img.'">
                                        </a>
                                        <ul class="social">
                                            <li><a href="#" data-tip="Quick View"><span class="fa fa-eye"></span></a>
                                            </li>

                                            <li><a href="ecommerce.html" data-tip="Add to Cart"><span
                                                        class="fa fa-shopping-bag"></span></a>
                                            </li>
                                        </ul>
                                        <div class="transmitv single-item">
                                        <form action="#" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="add" value="1">
                                            <input type="hidden" name="transmitv_item" value="'.$pname. " ".$number. " " .$unit.'">
                                            <input type="hidden" name="amount" value="'.$price.'">
                                            <button type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">'.$pname . " ".$number. " " .$unit.'</a> | <a href="#">'.$brand.'</a></h3>
                                    <!-- <span class="price"><del>$975.00</del>Rs2200</span> 
                                    <a href="#">'.$petshopName.'</a></br>-->
                                    <span class="price">Rs '.$price.'</span>
                                </div>
                            </div>
                        </div>';
                                }
                            }
                            $result->close();
                            $conn->next_result();
                            ?>

                            <!-- Product -->

                        </div>
                        <!-- Products-->

                        <!--/row2
                        <div class="ecom-slider-hny">
                            <div class="ecommerce-banv covers-9">
                                <div class="csslider infinity" id="slider1">
                                    <input type="radio" name="slides" checked="checked" id="slides_1">
                                    <input type="radio" name="slides" id="slides_2">
                                    <input type="radio" name="slides" id="slides_3">

                                    <ul class="banner_slide_bg">
                                        <li>
                                            <div class="wrapper">
                                                <div class="cover-top-center-9">
                                                    <div class="w3ls_cover_txt-9">
                                                        <h6 class="tag-cover-9">30% Off</h6>
                                                        <h3 class="title-cover-9">Men's Suit</h3>

                                                        <div class="read-more-button">
                                                            <a href="ecommerce-single.html" class="read-btn btn">Shop
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="wrapper">
                                                <div class="cover-top-center-9">
                                                    <div class="w3ls_cover_txt-9">
                                                        <h6 class="tag-cover-9">50% Off</h6>
                                                        <h3 class="title-cover-9">Men's Footerwear</h3>

                                                        <div class="read-more-button">
                                                            <a href="ecommerce-single.html" class="read-btn btn">Shop
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="wrapper">
                                                <div class="cover-top-center-9">
                                                    <div class="w3ls_cover_txt-9">
                                                        <h6 class="tag-cover-9">50% Off</h6>
                                                        <h3 class="title-cover-9">Women's Footwear</h3>

                                                        <div class="read-more-button">
                                                            <a href="ecommerce-single.html" class="read-btn btn">Shop
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    <div class="arrows">
                                        <label for="slides_1"></label>
                                        <label for="slides_2"></label>
                                        <label for="slides_3"></label>
                                    </div>
                                    <div class="navigation">
                                        <div>
                                            <label for="slides_1"></label>
                                            <label for="slides_2"></label>
                                            <label for="slides_3"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!--//row22-->
                    </div>
                </div>
                <!--//row1-->

                <!--/pagination-->
                <div class="pagination">
                    <ul>
                        <li class="prev"><a href="#page-number"><span class="fa fa-angle-double-left"></span></a></li>
                        <li><a href="#page-number" class="active">1</a></li>
                        <li><a href="#page-number">2</a></li>
                        <li><a href="#page-number">3</a></li>

                        <li class="next"><a href="#page-number"><span class="fa fa-angle-double-right"></span></a></li>
                    </ul>
                </div>
                <!--//pagination-->

            </div>
        </div>
        <!--//mag-content-->
    </section>




    <section class="w3l-footer-22">
        <!-- Include Footer -->
        <?php
	 include 'include/footer.php';
	 ?>

    </section>


</body>

</html>

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