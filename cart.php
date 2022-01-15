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
    <!-- CSS -->

    <style>
    .pimg {
        width: 300px;
        height: 300px;
        overflow: hidden;
    }
    </style>
</head>

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
                    <!--Display carts-->
                    <div class="mag-post-left-hny col-lg-8 get_cart">


                    </div>
                    <!--Display carts-->

                    <!--Display total-->
                    <div class="mag-post-right-hny col-lg-4">
                        <aside>
                            <div class="blog-sidebar-bg">
                                <div class="side-bar-hny-recent mb-5">
                                    <?php
                                    if (isset($_SESSION['total_price'])) {
                                        if ($_SESSION['total_price'] > 0) {
                                            echo '<h4 class="side-title">Order <span>Summary</span></h4>';
                                        }
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
                                                <a href="login.php">Login</a>
                                                 or
                                                <a href="register.php">Register</a> for payment</p>';
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

<?php include "bottomScripts.php"; ?>

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


<script
    src="https://www.paypal.com/sdk/js?client-id=AbWcm8GgWdLQvjia0I1vJWaa2F6GsxpX_KOWGWOOlY4uSPzOUyPTJDSs0PRk9urbdVaodQnv9WGjLIdm&disable-funding=credit,card">
</script>
<script src="paypal/index.js"></script>

</html>