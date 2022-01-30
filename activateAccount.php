<?php
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
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
</head>

<body>
    <section class="w3l-specification-6">
        <!-- /specification-6-->
        <div class="specification-6-mian py-5">
            <div class="container py-lg-5">
                <div class="row story-6-grids text-left">
                    <div class="col-lg-5 story-gd">
                        <!-- <img src="assets/images/left2.jpg" class="img-fluid" alt="/"> -->
                        <div class="wrap bg-dark">
                            </br>
                            <h4 class="text-center text-white mb-4">Activate Account</h4>
                            <div class="login-bghny p-md-5 p-4 mx-auto mw-100">
                                <!--/login-form-->
                                <h5 class="text-white">Please click the activation link we sent to your email.</h5>
                                <p class="login-texthny mb-2 text-white"><span class="text-warning">If you do not click the link your account will remain inactive.<span></p>
                                <!--//login-form-->
                                <a class="btn btn-success" href="login.php">Proceed to Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 story-gd pl-lg-4">
                        <a class="navbar-brand" href="index.php">
                            <h3 class="hny-title"><span>E </span>Petshop</h3>
                        </a>
                        <!-- Add text here -->
                        <p></p>

                        <div class="row story-info-content mt-md-5 mt-4">

                            <div class="col-md-6 story-info">
                                <h5> <a href="#">01. Visit E-Petshop</a></h5>
                                <p>A wide range of products for all pets availabe.</p>


                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">02. Add To Cart</a></h5>
                                <p>Select the products you need for your pets and add them to your shopping cart.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">03. Checkout</a></h5>
                                <p>Checkout when you finish your shopping.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">04. Fast Delivery</a></h5>
                                <p>You products are deliered at your door step within 2 business days.</p>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- //specification-6-->
</body>

</html>
<?php include "bottomScripts.php"; ?>