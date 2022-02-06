<?php
include 'include/common.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
}
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"])) || ($_SESSION["roleid"] != 2) || (!isset($_SESSION["userid"]))) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
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

<style>
.bgrow {
    background-color: #BEBEBE;
}
</style>

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
                                    $petshopID = $row['petshopID'];
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
                                <li class="active">My Petshop</li>
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
                <h3 class="hny-title mb-0 border text-center">Products <span>Available</span></h3>
                <div class="blog-inner-grids">
                    <div class="mag-post-left-hny">
                        <div class="mag-hny-content">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">
                                <!-- Product -->
                                </br>
                                <div class="maghny-gd-1 blog-pt-grid mb-lg-5 mb-4">
                                    </br>

                                    <!--<a href="#"><img class="img-fluid" src="assets/images/banner3.jpg" alt=""></a>-->

                                    <?php
                            //get product id
                            
                            

                            $sql = "CALL sp_getMyProductDetails($petshopID);";
                            $result = $conn->query($sql);
                            $output="";
                            $bg = 0;

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $pname = $row['pname'];
                                    $bname = $row['bname'];
                                    $description = $row['description'];
                                    $imgpath = $row['imgPath'];
                                    $pcname = $row['pcname'];
                                    $prodCatName = $row['sname'];
                                    $productID = $row['productID'];

                                                    $result1 = getProductLine($productID);
                                                    if ($result1 -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result1->fetch_assoc()) {
                                                            $unit = $row['unit'];
                                                            $number = $row['number'];
                                                            $qoh = $row['qoh'];
                                                            $price = $row['price'];
                                                            $lastMDT = $row['lastModifiedDateTime'];

                                                            $output.= '<tr>
                                                            <td> ' . $number . " ". $unit . ' </td>
                                                            <td> Rs'  . $price . ' </td>
                                                            <td> '.$qoh.' </td>
                                                            <td>btn</td>
                                                            </tr>';
                        
                                                        }
                                                    }
                                                     $result1->close();
                                                     $conn->next_result();

                                                     if ($bg == 0) {
                                                        $bg = 1;
                                                    } else {
                                                        $bg = 0;
                                                    }

                                                     echo '
                                                     </br>
                                                     <div class="sp-store-single-page row '.(($bg == 1)?"":"bg-light").'"">
                                        <div class="col-lg-5 single-right-left">
                                            <div class="flexslider1">


                                                <div class="clearfix"></div>
                                                <div class="flex-viewport"
                                                    style="overflow: hidden; position: relative;">
                                                    <ul>
                                                        <li data-thumb="product/'.$imgpath.'" class="clone"
                                                            style="width: 90%;  display: block;">
                                                            <div class="thumb-image"> <img
                                                                    src="product/'.$imgpath.'"
                                                                    data-imagezoom="true" class="img-fluid" alt=" ">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 single-right-left pl-lg-4">
                                            <h3>'.$bname . " | " . $pname.'</h3>

                                            <div class="caption">

                                                <ul class="rating-single">
                                                    <li>
                                                        <a href="#">
                                                            <p>'.$pcname ." " . $prodCatName.'</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="description mb-4">
                                                <h5>Product Description</h5>
                                                <p><?php echo $description; ?></p>
                                </div>

                                <div class="description mb-4">
                                    <h5>Product Price</h5>
                                    <table border="3" width="100%">
                                        <thead class="bg-primary">
                                            <td> Unit </td>
                                            <td> Price </td>
                                            <td> Quantity in stock </td>
                                            <td>Action</td>
                                        </thead>

                                        '.$output.'

                                    </table>
                                </div>

                            </div>
                        </div></br>
                        ';
                        $output="";

                        }
                        }
                        $result->close();
                        $conn->next_result();


                        ?>
                    </div>
                    <!-- Product -->
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