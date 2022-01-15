<?php include 'include/common.php';?>
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
                            <h2 class="hny-title text-center">Blog Page</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">Blog</li>
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
            <div class="container py-lg-5 px-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->


                </div>
                <div class="blog-inner-grids row">
                    <div class="mag-post-left-hny col-lg-8">
                        <div class="mag-hny-content">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">
                                <div class="maghny-gd-1 blog-pt-grid mb-5 bg-light">
                                    <!--<a href="blog-single.html"><img class="img-fluid mt-2" src="assets/images/bg2.jpg"
                                            alt=""></a>-->
                                    <p>test</p>

                                    <div class="entry-meta d-flex mt-3"><span class="entry-author">By <a href="#">
                                                Admin</a></span><span class="meta-separator">|</span>
                                        <a href="#">Jan 22, 2020</a><span class="meta-separator">|</span>
                                        <a href="#"> 0 comment</a>
                                    </div>
                                </div>
                            </div>
                            <!--//set-1-->

                        </div>
                        <!--//mag-hny-content-4-->
                    </div>
                    <div class="mag-post-right-hny col-lg-4">
                        <aside>
                            <div class="blog-sidebar-bg">
                                <div class="side-bar-hny-recent mb-5">
                                    <h4 class="side-title">Subscribe to <span>Blog</span></h4>
                                    <div class="mag-small-post">
                                        <form action="#" class="subscribehny d-flex mb-3" method="post">
                                            <input type="email" name="email" placeholder="Email Address" required="">
                                            <button class="btn"><span class="fa fa-paper-plane"
                                                    aria-hidden="true"></span></button>
                                        </form>
                                        <p>Subscribe to our mailing list and get updates to your email inbox.</p>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
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

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- disable body scroll which navbar is in active -->
<script src="assets/js/bootstrap.min.js"></script>