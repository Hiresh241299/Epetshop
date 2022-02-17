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

    /*saveCartInDb($userID);
    //clear cookies
    //clear session if exists
    unset($_SESSION['mycart']);
    $_SESSION['total_price'] = 0;
    setcookie("cart", null, -1, '/');
    //load cart
    //check if user have active order
    if (getActiveUserOrder($userID) > 0) {
        $orderID = getActiveUserOrder($userID);
        loadcart($orderID);
    }*/
    
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
    </style>
</head>

<style>
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


#btnminus {
    background-color: #ff7315;
}

#btnplus {
    background-color: #ff7315;
}

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
                                                    /*echo '<div id="paypal-payment-button"></div>
                                        <input id="totalValue" value="'.$_SESSION['total_price'].'" hidden disabled>
                                        ';*/
                                        echo '
                                        <a href="displayAllProducts.php" class="col-12 btn btn-info border rounded-pill"><b>Continue Shopping</b></a>
                                        <button type="button" onclick=payment() id="checkoutBTN" class="col-12 btn btn-success border rounded-pill"><b>Checkout</b></button>
                                        <input type="text" id="valid" hidden disabled>
                                        ';
                                                } else {
                                                    //user not logged in
                                                    echo '
                                        <a href="displayAllProducts.php" class="col-12 btn btn-info border rounded-pill"><b>Continue Shopping</b></a>
                                        <button type="button" class="col-12 btn btn-success border rounded-pill not-allowed" disabled><b>Checkout</b></button>
                                        ';
                                                    echo '<p class="text-dark">Please 
                                                <a class="text-warning" href="login.php"><b>Login</b></a>
                                                 or
                                                <a class="text-warning" href="register.php"><b>Register</b></a> for checkout</p>';
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

<script>
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
            $("#valid").val(data.valid);
            checkValidity();
        }
    });
}
$(document).on("click", ".addQTY", function(event) {
    event.preventDefault();
    //alert("test");
    var id = $(this).attr("name");
    //var id = 1;
    //var name = "";
    //var quantity = 1;
    //var price = 1;
    var action = "addQTY";
    $.ajax({
        url: "ajax/cart_action.php",
        method: "POST",
        dataType: "JSON",
        data: {
            id: id,
            action: action
        },
        success: function(data) {

        }
    });
    show_mycart();
    toastr.success('Quantity added');
});

$(document).on("click", ".reduceQTY", function(event) {
    event.preventDefault();
    //alert("test");
    var id = $(this).attr("name");
    //var id = 1;
    //var name = "";
    //var quantity = 1;
    //var price = 1;
    var action = "reduceQTY";
    $.ajax({
        url: "ajax/cart_action.php",
        method: "POST",
        dataType: "JSON",
        data: {
            id: id,
            action: action
        },
        success: function(data) {

        }
    });
    show_mycart();
    toastr.success('Quantity reduced');
});
</script>


<script
    src="https://www.paypal.com/sdk/js?client-id=AbWcm8GgWdLQvjia0I1vJWaa2F6GsxpX_KOWGWOOlY4uSPzOUyPTJDSs0PRk9urbdVaodQnv9WGjLIdm&disable-funding=credit,card">
</script>
<script src="paypal/index.js"></script>

<?php include "bottomScripts.php"; ?>

<script>
function checkQuantity(id, qoh) {
    quantity = document.getElementById('quantity' + id).value;
    if (quantity == 1) {
        document.getElementById('btnminus' + id).disabled = true;
    } else {
        document.getElementById('btnminus' + id).disabled = false;
    }
    if (quantity == qoh) {
        document.getElementById('btnplus' + id).disabled = true;
    } else {
        document.getElementById('btnplus' + id).disabled = false;
    }

}

function checkValidity() {
    isvalid = document.getElementById('valid').value;
    if (isvalid == 1) {
        document.getElementById('checkoutBTN').disabled = false;
    }
    if (isvalid == 0) {
        document.getElementById('checkoutBTN').disabled = true;
    }
}

function payment() {
    window.location.href = 'checkout.php#checkout';
}
//disable buttons - and +
//get values
/*document.getElementById('btnminus10').disabled = true;
function checkQuantity(id){
//quantity = document.querySelector('input[name=quantity'+id+']').value
quantity = document.getElementById('quantity'+id).value;
alert(quantity);
if(quantity == 1){
document.getElementById('btnminus'+id).disabled = true;
}*/
</script>