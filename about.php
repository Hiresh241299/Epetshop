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
if (isset($_SESSION["userid"])) {
    $userID = $_SESSION["userid"];
}else{
    $userID = 0;
}?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'include/header.php';
    ?>
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
                            <h2 class="hny-title text-center">About Us</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li><a href="about.php">What We Offer</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//Navbar & Carousel -->

    <section class="w3l-wecome-content-6">
        <!-- /content-6-section -->
        <div class="ab-content-6-mian py-5">
            <div class="container py-lg-5">
                <div class="welcome-grids row text-center">
                    <div class="col-lg-2 mb-lg-0 mb-5">
                    </div>
                    <div class="col-lg-8 mb-lg-0 mb-5">
                        <h3 class="hny-title">
                            <span>E</span> PETSHOP
                        </h3>
                        <p class="my-4"><b>E- Petshop is an e-commerce platform, serving customers all around
                                Mauritius.</b></p>
                        <p class="mb-4"><b>Our misson is to help Petshop to succeed and to make it easy to do business
                                anywhere.</b></p>
                        <div class="read">
                            <a href="displayAllProducts.php" class="read-more btn">Need a product? Shop Now</a>
                            <a href="register.php" class="read-more btn">Have a petshop? Join Now</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- //content-6-section -->


    <section class="w3l-specification-6">
        <!-- /specification-6-->
        <div class="specification-6-mian py-5">
            <div class="container py-lg-5">
                <div class="row story-6-grids text-left">
                    <div class="col-lg-2 story-gd">
                        <!--<img src="assets/images/left2.jpg" class="img-fluid" alt="/">-->
                    </div>
                    <div class="col-lg-8 story-gd pl-lg-4">
                        <h3 class="hny-title ">What We <span>Offer</span></h3>
                        <p class="">Lorem illum facere aperiam sequi optio consectetur adipisicing elitFuga, suscipit
                            totam animi
                            consequatur saepe blanditiis.Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam
                            sequi optio consectetur adipisicing elit. Fuga, suscipit totam animi consequatur saepe
                            blanditiis.

                        </p>
                        <div class="read">
                            <a type="button" class="read-more btn rounded" id="btnCustomer"
                                onclick="show(0);">customer</a> &nbsp
                            <a type="button" class="read-more btn rounded" id="btnpetshop"
                                onclick="show(1);">Petshop</a>
                        </div>

                        <div id="cust">
                            <div class="row story-info-content mt-md-5 mt-4">

                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">01. Visit Store</a></h5>
                                    <p>A wide range of products for all pets availabe.</p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">02. Add To Cart</a></h5>
                                    <p>Select the products you need for your pets and add them to your shopping cart.
                                    </p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">03. Gift Cards</a></h5>
                                    <p>Checkout when you finish your shopping.</p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">04. Unique shop</a></h5>
                                    <p>You products are deliered at your door step within 2 business days.</p>
                                </div>
                            </div>
                        </div>

                        <div id="pet">
                            <div class="row story-info-content mt-md-5 mt-4">

                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">01. Setup your E-Petshop</a></h5>
                                    <p>Insert the required details about your petshop.</p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">02. Add Products</a></h5>
                                    <p>Add your products and categories them accordingly.</p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">03. Make Sales</a></h5>
                                    <p>Attract more customers to increase sales.</p>
                                </div>
                                <div class="col-md-6 story-info">
                                    <h5> <a href="#">04. Connect With Customers</a></h5>
                                    <p>Keep in touch with existing and prospect customers.</p>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- //specification-6-->

    <section class="w3l-services-6">
        <!-- /content-6-section -->
        <div class="services-grids-6 py-5">
            <div class="container py-lg-5">
                <div class="row w3-icon-grid-gap1">
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-codepen" aria-hidden="true"></span>
                            <h3>Let your footwear do the talking</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-mobile" aria-hidden="true"></span>
                            <h3>Trendy celebrity collections</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-hourglass" aria-hidden="true"></span>
                            <h3>Animation</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-modx" aria-hidden="true"></span>
                            <h3>Vast collection of Sports shoes</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-bar-chart" aria-hidden="true"></span>
                            <h3>Uniquely designed collection</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>
                    <div class="col-md-6 w3-icon-grid1">
                        <a href="#link">
                            <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                            <h3>
                                High Quality Footwear</h3>
                            <div class="clearfix"></div>
                        </a>
                        <p>Lorem sint occaecat non proident, sunt in culpa quis. Phasellus lacinia id erat eu
                            ullamcorper. Nunc id ipsum fringilla, gravida felis vitae. Phasellus lacinia id, sunt in
                            culpa quis. Phasellus lacinia.</p>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- //content-6-section -->
    <section class="features-4">
        <div class="features4-block py-5">
            <div class="container py-lg-5">
                <h6>We are the best</h6>
                <h3 class="hny-title text-center">What We <span>Offering</span></h3>

                <div class="features4-grids text-center row mt-5">
                    <div class="col-lg-3 col-md-6 features4-grid">
                        <div class="features4-grid-inn">
                            <span class="fa fa-bullhorn icon-fea4" aria-hidden="true"></span>
                            <h5><a href="#URL">Call Us Anytime</a></h5>
                            <p>Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio consectetur.
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 features4-grid sec-features4-grid">
                        <div class="features4-grid-inn">
                            <span class="fa fa-truck icon-fea4" aria-hidden="true"></span>
                            <h5><a href="#URL">Free Shipping</a></h5>
                            <p>Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio consectetur.
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 features4-grid">
                        <div class="features4-grid-inn">
                            <span class="fa fa-recycle icon-fea4" aria-hidden="true"></span>
                            <h5><a href="#URL">Free Returns</a></h5>
                            <p>Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio consectetur.
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 features4-grid">
                        <div class="features4-grid-inn">
                            <span class="fa fa-money icon-fea4" aria-hidden="true"></span>
                            <h5><a href="#URL">Secured Payments</a></h5>
                            <p>Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio consectetur.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features-4 -->

    <!--/team-sec-->
    <section class="w3l-team-main">
        <div class="team py-5">
            <div class="container py-lg-5">
                <h3 class="hny-title text-center">
                    Meet the <span>Team</span></h3>
                <div class="row team-row mt-5">
                    <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4 team-wrapper position-relative">
                        <a href="#"><img src="assets/images/team1.jpg" class="team_member img-fluid"
                                alt="Team Member"></a>
                        <div class="team_info mt-3 position-absolute">
                            <h3><a href="#" class="team_name">Suzan Lois</a></h3>
                            <span class="team_role">Founder & CEO</span>
                            <ul class="team-social mt-3">
                                <li><a href="#"><span class="fa fa-facebook icon_facebook"></span></a></li>
                                <li><a href="#"><span class="fa fa-twitter icon_twitter"></span></a></li>
                                <li><a href="#"><span class="fa fa-linkedin icon_linkedin"></span></a></li>
                                <li><a href="#"><span class="fa fa-google-plus icon_google-plus"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end team member -->

                    <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4 team-wrapper position-relative">
                        <a href="#"><img src="assets/images/team2.jpg" class="team_member img-fluid"
                                alt="Team Member"></a>
                        <div class="team_info mt-3 position-absolute">
                            <h3><a href="#" class="team_name">Suzan Kin</a></h3>
                            <span class="team_role">Designer</span>
                            <ul class="team-social mt-3">
                                <li><a href="#"><span class="fa fa-facebook icon_facebook"></span></a></li>
                                <li><a href="#"><span class="fa fa-twitter icon_twitter"></span></a></li>
                                <li><a href="#"><span class="fa fa-linkedin icon_linkedin"></span></a></li>
                                <li><a href="#"><span class="fa fa-google-plus icon_google-plus"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end team member -->
                    <div class="col-lg-4 col-sm-6 team-wrapper position-relative">
                        <a href="#"><img src="assets/images/team3.jpg" class="team_member img-fluid"
                                alt="Team Member"></a>
                        <div class="team_info mt-3 position-absolute">
                            <h3><a href="#" class="team_name">Kin Lois</a></h3>
                            <span class="team_role">Marketing</span>
                            <ul class="team-social mt-3">
                                <li><a href="#"><span class="fa fa-facebook icon_facebook"></span></a></li>
                                <li><a href="#"><span class="fa fa-twitter icon_twitter"></span></a></li>
                                <li><a href="#"><span class="fa fa-linkedin icon_linkedin"></span></a></li>
                                <li><a href="#"><span class="fa fa-google-plus icon_google-plus"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end team member -->
                </div>
            </div>
    </section>
    <!--//team-sec-->


    <section class="w3l-footer-22">
        <!-- Include Footer -->
        <?php
     include 'include/footer.php';
     ?>

    </section>

</body>

</html>
<?php include "bottomScripts.php"; ?>
<script>
//defaul
document.getElementById('pet').style.display = "none";
document.getElementById('cust').style.display = "block";
document.getElementById('btnCustomer').style.backgroundColor = "#ff7315";
document.getElementById('btnpetshop').style.backgroundColor = "black";

function show(ref) {
    if (ref == 0) {
        document.getElementById('pet').style.display = "none";
        document.getElementById('cust').style.display = "block";
        document.getElementById('btnCustomer').style.backgroundColor = "#ff7315";
        document.getElementById('btnpetshop').style.backgroundColor = "black";
    }
    if (ref == 1) {
        document.getElementById('pet').style.display = "block";
        document.getElementById('cust').style.display = "none";
        document.getElementById('btnpetshop').style.backgroundColor = "#ff7315";
        document.getElementById('btnCustomer').style.backgroundColor = "black";
    }
}
</script>