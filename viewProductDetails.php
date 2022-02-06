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
}

//get query string
if (isset($_GET['prodid'])) {
    //check if this product exists
    //to create function

    //get prod details
    $sql = "CALL sp_getAllProductLineDetailsWithLimits(0, 1000000);";
    $result = $conn->query($sql);

    $output = "";
    if ($result -> num_rows < 1) {
        $output .="<h3>No products available</h3>";
    } else {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            if (($row['plID']) == ($_GET['prodid'])) {
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
                $productID = $row['productID'];
            }
        }
    }
    $result->close();
    $conn->next_result();

    $sql = "CALL sp_getProductReview($productID);";
    $result = $conn->query($sql);
    $Reviews=0;

    $output = "";
    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            $Reviews++;
        }
    }
    $result->close();
    $conn->next_result();
}

if(isset($_GET['r']) &&($_GET['r'] == 1)){
    header("Location: viewProductDetails.php?prodid=$pid#review");
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

    .cardbg {
        background-color: #f4f4f4;
    }

    #btnminus {
        background-color: #ff7315;
    }

    #btnplus {
        background-color: #ff7315;
    }

    /* -- quantity box -- */

    .quantity {
        display: inline-block;
    }

    .quantity .input-text.qty {
        width: 35px;
        height: 39px;
        padding: 0 5px;
        text-align: center;
        background-color: transparent;
        border: 1px solid #efefef;
    }

    .quantity.buttons_added {
        text-align: left;
        position: relative;
        white-space: nowrap;
        vertical-align: top;
    }

    .quantity.buttons_added input {
        display: inline-block;
        margin: 0;
        vertical-align: top;
        box-shadow: none;
    }

    .quantity.buttons_added .minus,
    .quantity.buttons_added .plus {
        padding: 7px 10px 8px;
        height: 41px;
        background-color: #ffffff;
        border: 1px solid #efefef;
        cursor: pointer;
    }

    .quantity.buttons_added .minus {
        border-right: 0;
    }

    .quantity.buttons_added .plus {
        border-left: 0;
    }

    .quantity.buttons_added .minus:hover,
    .quantity.buttons_added .plus:hover {
        background: #eeeeee;
    }

    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        margin: 0;
    }

    .quantity.buttons_added .minus:focus,
    .quantity.buttons_added .plus:focus {
        outline: none;
    }


    /*Alignment*/
    .align-items-center {
        display: flex;
        align-items: center;
        /*Aligns vertically center */
        justify-content: center;
        /*Aligns horizontally center */
    }
    </style>
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
                            <h2 class="hny-title text-center">Products</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li><a href="displayAllProducts.php">Products</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li><a href="viewProductDetails.php?prodid=<?php echo $pid;?>"><?php echo $pname;?></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//Navbar & Carousel -->

    <section class="w3l-ecommerce-main-inn">

        <div class="ecomrhny-content-inf py-5">
            <div class="container py-lg-5 bg-light">
                <!--/row1-->
                <div class="sp-store-single-page row">
                    <div class="col-lg-5 single-right-left">
                        <div class="flexslider1">
                            <div class="thumb-image"> <img src="product/<?php echo $img;?>" class="img-fluid" alt=" ">
                            </div>

                            <div class="clearfix"></div>

                        </div>
                        <div class="eco-buttons mt-5">

                            <div class="transmitv single-item">
                                <form action="#" method="post">
                                    <input type="hidden" name="id" value="<?php echo $pid;?>" id="<?php echo $pid;?>">
                                    <!--<input type="hidden" name="quantity" value="1" id="quantity<?php echo $pid;?>">-->
                                    <input type="hidden" name="name"
                                        value="<?php echo $pname. " ".$number. " " .$unit;?>"
                                        id="name<?php echo $pid;?>">
                                    <input type="hidden" name="price" value="<?php echo $price;?>"
                                        id="price<?php echo $pid;?>">
                                    <button type="submit"
                                        class="transmitv-cart ptransmitv-cart add-to-cart read-2 add_cart" name="add"
                                        id="<?php echo $pid;?>">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                            <div class="buyhny-now align-items-center">
                                <p class="login-texthny mb-2 text-dark"><b>Quantity: &nbsp</b></p>
                                <div class="quantity buttons_added">
                                    <input type="button" id="btnminus" value="-" class="minus col-4">&nbsp<input
                                        type="number" step="1" min="1" max="<?php echo $qoh?>" name="quantity"
                                        id="quantity<?php echo $pid;?>" value="1" title="Qty"
                                        class="input-text qty text bg-white col-4" size="4" pattern=""
                                        inputmode="">&nbsp<input type="button" id="btnplus" value="+"
                                        class="plus col-4">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-7 single-right-left pl-lg-4">
                        <h3 class="title"><?php echo $pname ." | ". $brand;?>
                        </h3>

                        <div class="caption">

                            <ul class="rating-single">
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star-half-o yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-star-half yellow-star" aria-hidden="true"></span>
                                    </a>
                                </li>
                            </ul>
                            <!--Reviews-->
                            <a href="#review"><?php echo $Reviews;?> Reviews</a></br>

                        </div>
                        <!--Price-->
                        <h6>

                            <select name="productline" id="productline" onchange="productlinePrice()">
                                <?php
                                //get all productline given prodID
                                $sql = "CALL sp_getProductLine($productID);";
                                $result = $conn->query($sql);
    
                                if ($result -> num_rows > 0) {
                                    //output data for each row
                                    while ($row = $result->fetch_assoc()) {
                                        $_productLineID = $row['productLineID'];
                                        $_unit = $row['unit'];
                                        $_number = $row['number'];
                                        $_qoh = $row['qoh'];
                                        $_price = $row['price'];
                                        $_lastMDT = $row['lastModifiedDateTime'];

                                        $selected="";
                                        if($_productLineID == $_GET['prodid']){
                                            $selected="selected";
                                        }

                                        echo '
                                        <option value="'.$_productLineID.'" '.$selected.'>'.$_number.$_unit.'</option>
                                        ';
    
                                    }
                                }
                                 $result->close();
                                 $conn->next_result();
                                ?>
                            </select>
                            <!--<del>$1,199</del>-->
                            <span class="item_price"> Rs<?php echo $price?></span>
                            <p>Quantity available: <?php echo $qoh . (($qoh>1)?" Units":" Unit")?></p>
                        </h6>
                        <div class="desc_single my-4">
                            <ul class="emi-views">
                                <!--<li><span>Special Price</span> Get extra 5% off (price inclusive of discount)</li>-->
                            </ul>
                        </div>
                        <div class="desc_single mb-4">
                            <h5>Description:</h5>
                            <p><?php echo $desc;?></p>
                        </div>
                        <div class="description-apt d-grid mb-4">
                            <div class="occasional">
                                <h5 class="sp_title mb-3">
                                    <p><a
                                            href="viewPetshops.php#petshop<?php echo $petshopID?>"><u><?php echo $petshopName?></u></a>
                                    </p>
                                </h5>
                                <ul class="single_specific">

                                    <!--<li>
                                        Neck : Round Neck</li>
                                    <li>
                                        Fit : Regular</li>

                                    <li> Sleeve : Half Sleeve
                                    </li>
                                    <li> Material : Pure Cutton</li>-->

                                </ul>

                            </div>

                            <div class="color-quality">
                                <!--<h5 class="sp_title">Services:</h5>
                                <ul class="single_serv">
                                    <li>
                                        <a href="#">30 Day Return Policy</a>
                                    </li>
                                    <li class="gap">
                                        <a href="#">Cash on Delivery available</a>
                                    </li>
                                </ul>-->
                            </div>
                        </div>
                        <div class="description mb-4">
                            <?php
                            if($userID > 0){
                                echo '
                                <h5>Add Your Review</h5>
                                <p id="reviewError" class="text-danger"></p>
                                <form action="#" class="d-flex" method="post">
                                    <input type="text" class="form-control border bg-white" id="review" name="review" placeholder="" required="">
                                    <button class="submit btn" type="button" onclick="addProductReview('.$userID.','.$productID.', '.$pid.')">Review</button>
                                </form>
                                ';
                            }else{
                                echo '
                                <p><a class="text-warning" href="login.php"><b>Login</b></a> or <a class="text-warning" href="register.php"><b>Register</b></a> To Add Your Review About This Product.</p>
                                ';
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
            <!--//row1-->
        </div>
    </section>
    <!--Review-->
    <?php
    //get prod details
    $sql = "CALL sp_getProductReview($productID);";
    $result = $conn->query($sql);
    $count=1;
    $indicators = "";
    $slide = 0;
    $carouselItem = "";
    $item = "";

    //$output = "";
    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
                $prid = $row['prID'];
                $review = $row['review'];
                $date = date('d-m-Y h:m:s', strtotime($row['createdDateTime']));
                $status = $row['status'];
                $userID = $row['userID'];
                $fname = $row['firstName'];
                $lname = $row['lastName'];

                //Delete review btn
                $deleteReview="";
                if (isset($_SESSION['userid'])) {
                    if ($_SESSION['userid'] == $userID) {
                        $deleteReview = '<a href="#review" onclick="deleteReview('.$prid.', '.$pid.')"><span class="fa fa-times text-danger text-right" style="margin-top:-30px; margin-right:-10px;"></span></a>';
                    }
                }
                $item = '<div class="col-md-3" id="item'.$prid.'">
                <div class="customer-info text-center">
                    <div class="feedback-hny">

                    '.$deleteReview.'
                        <p class="feedback-para"><b>'.$review.'</b></p>
                        </br>
                        <small class="text-white">'.$date.'</small>
                    </div>
                    <div class="feedback-review mt-4">
                        <h5>'.$fname." ".$lname.'</h5>
                    </div>
                </div>
                </div>';

                if($count == 1){
                    $indicators .= '<li data-target="#customerhnyCarousel" data-slide-to="'.$slide.'" class="active"></li>';
                    $carouselItem .= '<div class="carousel-item active">
                    <div class="row">';
                }
                if(($count % 5) == 0){
                    //$carouselItem .='</div></div>';
                    $slide++;
                    $carouselItem .= '<div class="carousel-item">
                    <div class="row">';
                    $indicators .= '<li data-target="#customerhnyCarousel" data-slide-to="'.$slide.'" class=""></li>';
                    
                    //$item = "";
                }

                $carouselItem .= $item;
                
                if(($count % 4) == 0){
                    $carouselItem .='</div></div>';
                    //$slide++;
                    //$carouselItem .= '<div class="carousel-item">
                    //<div class="row">';
                    //$indicators .= '<li data-target="#customerhnyCarousel" data-slide-to="'.$slide.'" class=""></li>';
                    
                    //$item = "";
                }
                $count++;
                
                
                

        }
    }else{
        $carouselItem = "<h4 class='text-center'>No Reviews about this product</h4>";
    }
    $result->close();
    $conn->next_result();
    ?>
    <section class="w3l-customers-sec-6">
        <div class="customers-sec-6-cintent py-5">
            <!-- /customers-->
            <div class="container py-lg-5">
                <h3 class="hny-title text-center mb-0" id="review">Product <span>Reviews</span></h3>
                <div class="row customerhny my-lg-5 my-4">
                    <div class="col-md-12">
                        <div id="customerhnyCarousel" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                                <!--Review button (4 Reviews)-->
                                <?php echo $indicators;?>
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">

                                <!--4 Reviews-->
                                <?php echo $carouselItem;?>

                            </div>
                            <!--.carousel-inner-->
                        </div>
                        <!--.Carousel-->

                    </div>
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

<!--Reload page when quantity is selected-->
<script>
function productlinePrice() {
    //get value of dropdown
    var prodid = document.getElementById('productline').value;
    window.location.href = "viewProductDetails.php?prodid=" + prodid;
}

//ajax add reviews
function addProductReview(userid, productid, prodid) {
    review = document.getElementById('review').value;
    if (review != "") {
        document.getElementById('reviewError').innerHTML = "";
        $.ajax({
            url: 'ajax/productAction.php',
            data: {
                action: "add",
                reviewValue: review,
                useridValue: userid,
                productidValue: productid
            },
            type: 'post',
            success: function(data) {
                if (data == 1) {
                    toastr.success('Review added');
                    document.getElementById('review').value = "";
                    window.location.href = "viewProductDetails.php?r=1&prodid=" + prodid;
                }
            }
        });
    } else {
        //review cannot be blank
        document.getElementById('reviewError').innerHTML = "Cannot submit empty review!!!";
    }

}

//Delete Review
function deleteReview(prid, prodid) {
    $.ajax({
        url: 'ajax/productAction.php',
        data: {
            action: "delete",
            reviewidval: prid
        },
        type: 'post',
        success: function(data) {
            if (data == 1) {
                toastr.success('Review Deleted');
                window.location.href = "viewProductDetails.php?r=1&prodid=" + prodid;
            }
        }
    });
}
</script>