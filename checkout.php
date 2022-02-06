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
$userID = 0;
if(isset($_SESSION["userid"])){
    $userID = $_SESSION["userid"];
}else{
    header('Location: cart.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'include/header.php';
    ?>
    <style type="text/css">
    #map {
        width: 300px;
        height: 300px;
    }
    </style>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRgy7_Ok-92VGq375mOuQIuGg5QHF7nBs"></script>

    <style>
    .pimg {
        width: 300px;
        height: 300px;
        overflow: hidden;
    }

    .cardbg {
        background-color: #f4f4f4;
    }
    </style>
</head>

<style>
.not-allowed {
    cursor: not-allowed;
}
</style>

<body>

    <!--Banner-->
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
                    <!--/search-right-->
                    <div class="search-right">
                        <!-- search popup -->
                        <div id="paymentCancelled" class="pop-overlay">
                            <div class="popup">
                                <h3 class="text-center">Payment Cancelled</h3>
                            </div>
                            <a class="close" href="#">×</a>

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
                            <h2 class="hny-title text-center">My Cart</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Banner-->

    <!--Cart
	 <div class="container">
	 	<div class="col-md-12 get_cart my-5">
	 		
	 	</div>
	 </div>-->
    <!--//Cart-->

    <section class="blog-post-main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5">
            <div class="container py-lg-5 px-lg-5">
                <div class="blog-inner-grids row ">
                    <!--Select Delivery location, address etc-->
                    <div class="mag-post-left-hny col-lg-8 cardbg">

                        <div class="side-bar-hny-recent mb-5">
                            </br>
                            <h4 class="side-title">Delivery <span>Details</span></h4>
                            <hr>
                            </h5>
                            <div class="mag-small-post">
                                <form id="register" action="" method="post">
                                    <div class="form-group">
                                        <p class="login-texthny mb-2 text-dark">Mobile</p>
                                        <input type="text" class="form-control col-3" id="fname" placeholder=""
                                            name="mobile" disabled>
                                    </div>
                                    <div class="form-group">
                                        <p class="login-texthny mb-2 text-dark">Full Address</p>
                                        <input type="text" class="form-control col-6" id="address" placeholder=""
                                            name="mobile" disabled>
                                    </div>
                                    <div class="form-group">
                                    <p class="login-texthny mb-2 text-dark">Select Map Location</p>
                                        <!--map div-->
                                        <div id="map"></div>

                                        <!--our form-->
                                        <h2>Chosen Location</h2>
                                        <form method="post">
                                            <input type="text" id="lat" readonly="yes"><br>
                                            <input type="text" id="lng" readonly="yes">
                                        </form>

                                        <div class="mapouter">
                                            <div class="gmap_canvas">
                                                <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=dy%20fish&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                    <a href="https://123movies-to.org"></a>
                                                    <br>
                                                    <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style>
                                                    <a href="https://www.embedgooglemap.net">embed google maps in web page</a>
                                                    <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>

                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                    <!--Select Delivery location, address etc-->

                    <!--Display total-->
                    <div class="mag-post-right-hny col-lg-4">
                        <aside>
                            <div class="blog-sidebar-bg">
                                <div class="side-bar-hny-recent mb-5">
                                    <?php
                                    if ((isset($_SESSION['total_price'])) &&($_SESSION['total_price'] != 0)) {
                                            echo '<h4 class="side-title">Order <span>Summary</span></h4>';
                                    }else{
                                        echo '<p>No product in cart</p>';
                                    }
                                    ?>

                                    <hr>
                                    <h5>Total <p class="float-right">
                                        <h4 id="total"></h4>
                                        </p>
                                    </h5>
                                    <div class="mag-small-post">
                                        <!--<a href="stripe/"> <button class="btn btn-success btn-block"><b>Checkout</b></button></a>
                                        </br>-->
                                        <?php
                                        if (isset($_SESSION['total_price'])) {
                                            if ($_SESSION['total_price'] > 0) {
                                                //check if user is logged in
                                                if ($userID > 0) {
                                                    echo '<div id="paypal-payment-button"></div>
                                        <input id="totalValue" value="'.$_SESSION['total_price'].'" hidden disabled>
                                        ';
                                                } else {
                                                    //user not logged in
                                                    echo '<p>Please 
                                                <a class="text-warning" href="login.php"><b>Login</b></a>
                                                 or
                                                <a class="text-warning" href="register.php"><b>Register</b></a> for payment</p>';
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <!--Display total-->

                </div>
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

<script
    src="https://www.paypal.com/sdk/js?client-id=AbWcm8GgWdLQvjia0I1vJWaa2F6GsxpX_KOWGWOOlY4uSPzOUyPTJDSs0PRk9urbdVaodQnv9WGjLIdm&disable-funding=credit,card">
</script>
<script src="paypal/index.js"></script>
<script type="text/javascript" src="map.js"></script>
<?php include "bottomScripts.php"; ?>