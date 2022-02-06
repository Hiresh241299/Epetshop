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
    .cardbg{
        background-color:#f4f4f4;
    }
    </style>
</head>

<body>
    <!--Navbar & Carousel-->
    <section class="w3l-banner-slider-main">
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
            <div class="bannerhny-content-main">

                <!--/banner-slider-->
                <div class="content-baner-inf">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <!--<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>-->
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h3>Fish and Pond accessories
                                            <br>50% Off
                                        </h3>
                                        <a href="#" class="shop-button btn">
                                            Shop Now
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item item2">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h3>Bird and Cage
                                            <br>60% Off
                                        </h3>
                                        <a href="#" class="shop-button btn">
                                            Shop Now
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="carousel-item item3">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h3>Women's
                                            Fashion
                                            <br>50% Off
                                        </h3>
                                        <a href="#" class="shop-button btn">
                                            Shop Now
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item item4">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h3>Men's
                                            Fashion
                                            <br>60% Off
                                        </h3>
                                        <a href="#" class="shop-button btn">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

    </section>
    <!--//Navbar & Carousel -->

    <!--Posters-->
    <section class="w3l-ecommerce-main">
        <!-- /products-->
        <div class="ecom-contenthny py-5">
            <div class="container py-lg-5">
                <h3 class="hny-title mb-0 text-center">Latest <span>Products</span></h3>
                <p class="text-center">Varieties of product available for all pets</p>
                <!-- /row-->
                <div class="ecom-products-grids row mt-lg-5 mt-3">


                    <!-- Post Starts-->
                    <?php

                    //Load product details from database
                    //gets error details
                    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$sql = "CALL sp_getAllProductLineDetailsWithLimits(0,12);";
$result = $conn->query($sql);
$arrayPosted = array();

$output = "";
if ($result -> num_rows < 1) {
    $output .="<h3>No products available</h3>";
}else{
	//output data for each row
    while ($row = $result->fetch_assoc()) {
        $pid = $row['plID'];
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
        $postedProductID = $row['productID'];

        //check if not exists in array then post
        if (!in_array($postedProductID, $arrayPosted)) {
            echo '<div class="col-lg-2 col-6 product-incfhny mb-4 cardbg border border-white border-rounded">
                            </br>
                            <div class="product-grid2 transmitv">
                                <div class="product-image2">
                                    <a href="viewProductDetails.php?prodid='.$pid.'">
                                        <img class="pic-1 img-fluid" src="product/'.$img.'">
                                        <img class="pic-2 img-fluid" src="product/'.$img.'">
                                    </a>
                                    <ul class="social">
                                        <li><a href="viewProductDetails.php?prodid='.$pid.'" data-tip="Quick View"><span class="fa fa-eye"></span></a>
                                        </li>

                                        <!--<li><a href="ecommerce.html" data-tip="Add to Cart"><span
                                                    class="fa fa-shopping-bag"></span></a>
                                        </li>-->
                                    </ul>
                                    <div class="transmitv single-item">
                                    <form action="#" method="post">
                                        <input type="hidden" name="id" value="'.$pid.'" id="'.$pid.'">
                                        <input type="hidden" name="quantity" value="1" id="quantity'.$pid.'">
                                        <input type="hidden" name="name" value="'.$pname. " ".$number. " " .$unit.'" id="name'.$pid.'">
                                        <input type="hidden" name="price" value="'.$price.'" id="price'.$pid.'">
                                        <button type="submit" class="transmitv-cart ptransmitv-cart add-to-cart add_cart" name="add" id="'.$pid.'">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="viewProductDetails.php?prodid='.$pid.'">'.$pname . " ".$number. " " .$unit.'</a> | <a href="#">'.$brand.'</a></h3>
                                <!-- <span class="price"><del>$975.00</del>Rs2200</span>-->
                                <span class="price">Rs '.$price.'</span></br>
                                <small><a href="viewPetshops.php#petshop'.$petshopID.'"><u>'.$petshopName.'</u></a></small>
                            </div>
                        </div>
                    </div>';
        }
        //add $postedProductID in array
        array_push($arrayPosted, $postedProductID);
    }
                    }
                    $result->close();
                    $conn->next_result();
                    ?>
                    <!-- Post Ends-->


                </div>
                <!-- //row-->
            </div>
        </div>
    </section>
    <!-- //Posters-->

    <!--Pet Categories-->
    <section class="w3l-grids-hny-2">
        <div class="grids-hny-2-mian py-5">
            <div class="container py-lg-5">

                <h3 class="hny-title mb-0 text-center">Pet <span>Categories</span></h3>
                <p class="mb-4 text-center">Different pets available for you</p>
                <div class="welcome-grids row mt-5">
                    <!-- Pet Cat Start -->
                    <?php
                    //Load pet categories from database
                    $sql = "CALL sp_getPetCategories();";
                    $result = $conn->query($sql);

                    if ($result -> num_rows > 0) {
                        //output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $imgPath = $row['imgPath'];

                            echo '<div class="col-lg-2 col-md-4 col-6 welcome-image">
                            <div class="boxhny13">
                                <a href="#URL">
                                    <img src="category/'.$imgPath.'" class="img-fluid" alt=""/>
                                    <div class="boxhny-content">
                                        <h3 class="title"> '.$name.'</h3>
                                    </div>
                                </a>
                            </div>
                            <h4><a href="#URL">'.$name.'</a></h4>
                        </div>';

                        }
                    }
                    $result->close();
                    $conn->next_result();
                    ?>
                    <!-- Pet Cat End -->
                </div>

            </div>
        </div>
    </section>
    <!--//Pet Categories-->


    <!--Brands available-->
    <section class="w3l-grids-hny-2">
        <div class="grids-hny-2-mian py-5">
            <div class="container py-lg-5">

                <h3 class="hny-title mb-0 text-center">Available <span>Brands</span></h3>
                <p class="mb-4 text-center">A wide range of product available in various brands.</p>
                <div class="welcome-grids row mt-5">
                    <!-- Brand Start -->
                    <?php
                    //Load Brands from database
                    $sql = "CALL sp_getAllBrand();";
                    $result = $conn->query($sql);

                    if ($result -> num_rows > 0) {
                        //output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $imgPath = $row['imgPath'];

                            echo '<div class="col-lg-2 col-md-4 col-6 welcome-image">
                            <div class="boxhny13 bimg">
                                <a href="#URL">
                                    <img src="brand/'.$imgPath.'" class="img-fluid" alt=""/>
                                  <!--  <img src="" class="img-fluid" alt=""/>-->
                                    <div class="boxhny-content">
                                        <h3 class="title"> '.$name.'</h3>
                                    </div>
                                </a>
                            </div>
                            <h4><a href="#URL">'.$name.'</a></h4>
                        </div>';

                        }
                    }
                    $result->close();
                    $conn->next_result();
                    ?>
                    <!-- Pet Cat End -->
                </div>

            </div>
        </div>
    </section>
    <!--//Brands available-->


    <!-- //content-6-section
    <section class="w3l-post-grids-6">
        <div class="post-6-mian py-5">
            <div class="container py-lg-5">
                <h3 class="hny-title text-center mb-0 ">Famous <span>Brands</span></h3>
                <p class="mb-5 text-center">Top rated brands around the world</p>
                <div class="post-hny-grids row mt-5">
                    <div class="col-lg-3 col-md-6 grids5-info column-img" id="zoomIn">
                        <a href="#">
                            <figure>
                                <img class="img-fluid" src="assets/images/bg1.jpg" alt="blog-image">
                            </figure>
                        </a>

                        <div class="blog-thumbhny-caption">
                            <ul class="blog-info-list">
                                <li><a href="#admin">By admin</a></li>
                                <li class="date-post">
                                    Aug 10, 2020</li>
                            </ul>
                            <h4><a href="#">Here to bring your life style to the next level.</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 grids5-info column-img" id="zoomIn">
                        <a href="#">
                            <figure>
                                <img class="img-fluid" src="assets/images/bg2.jpg" alt="blog-image">
                            </figure>
                        </a>
                        <div class="blog-thumbhny-caption">
                            <ul class="blog-info-list">
                                <li><a href="#admin">By admin</a></li>
                                <li class="date-post">
                                    Aug 10, 2020</li>
                            </ul>
                            <h4><a href="#">Here to bring your life style to the next level.</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 grids5-info column-img" id="zoomIn">
                        <figure>
                            <img class="img-fluid" src="assets/images/bg3.jpg" alt="blog-image">
                        </figure>
                        <div class="blog-thumbhny-caption">
                            <ul class="blog-info-list">
                                <li><a href="#admin">By admin</a></li>
                                <li class="date-post">
                                    Aug 10, 2020</li>
                            </ul>
                            <h4><a href="#">Here to bring your life style to the next level.</a></h4>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 grids5-info column-img" id="zoomIn">
                        <figure>
                            <img class="img-fluid" src="assets/images/bg4.jpg" alt="blog-image">
                        </figure>
                        <div class="blog-thumbhny-caption">
                            <ul class="blog-info-list">
                                <li><a href="#admin">By admin</a></li>
                                <li class="date-post">
                                    Aug 10, 2020</li>
                            </ul>
                            <h4><a href="#">Here to bring your life style to the next level.</a></h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
     //post-grids-->


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

function show_mycart() {
    $.ajax({
        url: "ajax/show_mycart.php",
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            $(".get_cart").html(data.out);
            $("#cart").text(data.da);
            $("#total").text(data.total);
            $("#totalValue").val(data.totalValue);
        }
    });
}
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
    show_mycart();
    toastr.success('Product added');
});
</script>