<div class="sidebar-menu sticky-sidebar-menu">

    <!-- logo start -->
    <div class="logo">
        <h1><a href="adminDashboard.php">Dashboard</a></h1>
    </div>

    <div class="logo-icon text-center">
        <a href="adminDashboard.php" title="Dashboard"><img src="adminassets/images/logo.png" alt="logo-icon"> </a>
    </div>
    <!-- //logo end -->


    <div class="sidebar-menu-inner">

        <!-- sidebar nav start -->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <!--<li class="menu-list">
                <a href="#"><i class="fa fa-cogs"></i>
                    <span>Elements <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                    <li><a href="carousels.html">Carousels</a> </li>
                    <li><a href="cards.html">Default cards</a> </li>
                    <li><a href="people.html">People cards</a></li>
                </ul>
            </li>-->
            <li class='menu-list <?php (($_SESSION['NavActive'] == "adminviewuser")? $x ="active":$x =""); echo $x;?>'>
                <a href="#"><i class="fa fa-user"></i>
                    <span>User <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                    <li><a href="adminviewUsers.php">All Users</a> </li>
                    <li><a href="adminviewUsers.php?rid=2">Petshop</a></li>
                    <li><a href="adminviewUsers.php?rid=3">Customer</a></li>
                </ul>
            </li>
            <li class='menu-list <?php (($_SESSION['NavActive'] == "adminPetshop")? $x ="active":$x =""); echo $x;?>'>
                <a href="#"><i class="fa fa-store"></i>
                    <span>Petshop<i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                    <li><a href="adminviewpetshop.php">All Petshop</a> </li>
                    <li><a href="adminviewpetshopRequests.php?type=request">Petshop Join Requests</a></li>
                </ul>
            </li>
            <!--<li class='<a href="adminviewpetshop.php"><i class="fa fa-store"></i> <span>Petshop</span></a></li>-->
            <li class='menu-list <?php (($_SESSION['NavActive'] == "adminContent")? $x ="active":$x =""); echo $x;?>'><a
                    href="#"><i class="fa fa-th"></i>
                    <span>Content<i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                    <li><a href="adminviewContent.php?content=br">Brands</a> </li>
                    <li><a href="adminviewContent.php?content=p">Pet Category</a></li>
                    <li><a href="adminviewContent.php?content=pro">Product Category</a></li>
                    <li><a href="adminviewContent.php?content=loc">Location</a></li>
                </ul>
            </li>
            <li class='menu-list <?php (($_SESSION['NavActive'] == "adminFiles")? $x ="active":$x =""); echo $x;?>'><a
                    href="#"><i class="fa fa-file-text"></i>
                    <span>Document<i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                    <li><a href="adminviewUsers.php">Terms and Conditions</a>
                </ul>
            </li>
        </ul>
        <!-- //sidebar nav end -->
        <!-- toggle button start -->
        <a class="toggle-btn">
            <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
            <i class="fa fa-angle-double-right menu-collapsed__right"></i>
        </a>
        <!-- //toggle button end -->
    </div>

</div>