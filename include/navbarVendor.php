<div class="container-fluid">
    <div class="top-right-strip row">
        <!--/left-->
        <div class="top-hny-left-content col-lg-6 pl-lg-0">
            <!-- <h6>Upto 30% off on All styles , <a href="#" target="_blank"> Click here for <span
                        class="fa fa-hand-o-right hand-icon" aria-hidden="true"></span> <span class="hignlaite">More
                        details</span></a></h6> -->
        </div>
        <!--//left-->
        <!--/right-->
        <ul class="top-hnt-right-content col-lg-6">
            <!-- Open Login form
            <li class="button-log usernhy">
               <a class="btn-open" href="#">
                    <span class="fa fa-bell" aria-hidden="true"></span> 
                </a>
            </li> -->
            <!-- Cart -->
            <li class="transmitvcart galssescart2 cart cart box_1">
                <!-- <form action="#" method="post" class="last">
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="display" value="1">
                    <button class="top_transmitv_cart" type="submit" name="submit" value="">
                        My Cart
                        <span class="fa fa-shopping-cart"></span>
                    </button>
                </form> -->
            </li>
        </ul>
        <!--//right-->
        <!-- Close Login Form -->
        <div class="overlay-login text-left">
            <button type="button" class="overlay-close1">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <!-- Login Form -->
            <?php
                        include 'include/login.php';
            ?>
        </div>
        <!-- Close Register Form -->
        <div class="overlay-register text-left">
            <button type="button" class="overlay-close2">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <!-- Register Form -->
            <?php
                        include 'include/Register.php';
            ?>
        </div>
    </div>
</div>
<!--/nav-->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid serarc-fluid">
        <a class="navbar-brand" href="petshopHome.php">
            <span class="lohny">E</span> PetShop</a>
        <!-- if logo is image enable this   
							<a class="navbar-brand" href="#index.html">
								<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
							</a> -->
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fa fa-bars"> </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item active">
								<a class="nav-link" href="index.php">Home</a>
							</li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="addProduct.php">Add Product</a>
                        <a class="dropdown-item" href="viewAllMyProducts.php">View Products</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewMyPetshop.php">Store</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Orders & Delivery
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item btn-open" href="viewMyOrderDelivery.php">Pending</a>
                            <a class="dropdown-item btn-open" href="viewMyOrderDeliveryCompleted.php">Delivered</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item btn-open" href="userProfile.php">Profile</a>
                            <a class="dropdown-item btn-open" href="petshopProfile.php">Petshop</a>
                            <a class="dropdown-item btn-open" href="petshopSpecialities.php">Specialities</a>
                            <a class="dropdown-item btn-open2 bg-secondary text-white" href="Logout.php"><b>Logout</b></a>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</nav>
<!--//nav-->