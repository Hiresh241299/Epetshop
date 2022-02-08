<?php
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
if(!isset($_SESSION)){
    session_start();
}
//Check if session roleid exists
if (isset($_SESSION["roleid"])) {
    $session_roleID = $_SESSION["roleid"];
}else{
    $session_roleID = 0;
}

//get petshop id if click on view store
if (isset($_GET["psid"])) {
    $petshopID = $_GET["psid"];

    //load petshop details from db
    $sql = "CALL sp_getAllPetshop('1');";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            if ($petshopID == $row['petshopID']) {
                $__psid = $row['petshopID'];
                $__name = $row['name'];
            }
        }
    }
        
    $result->close();
    $conn->next_result();
}else{
    $petshopID = 0;
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'include/header.php';
    ?>
</head>
<style>
.cardbg {
    background-color: #f4f4f4;
}
</style>

<body>

    <!--Set petshopID in input hidden -->
    <?php
echo '<input type="text" value="'.$petshopID.'" name="petshop" id="petshop" disabled hidden>'
?>
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
                            <h2 class="hny-title text-center"><?php echo $__name;?> Products</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li><a href="viewPetshops.php">Petshop</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li><a
                                        href="viewPetshopDetails.php?psid=<?php echo $petshopID;?>"><?php echo $__name;?></a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //w3l-banner-slider-main -->

    <section class="w3l-ecommerce-main-inn">
        <!--/mag-content-->
        <div class="ecomrhny-content-inf py-5">
            <div class="container py-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->


                </div>
                <!--/row1-->
                <div class="ecommerce-grids row">
                    <div class="ecommerce-left-hny col-lg-4">
                        <!--Filters-->
                        <aside>
                            <div class="sider-bar">
                                <div class="single-gd mb-5">

                                    <h4>Search <span>here</span></h4>
                                    <form action="#" method="post" class="search-trans-form">
                                        <input class="form-control" name="searchcriterie" id="searchcriterie"
                                            placeholder="Search by product, brand, category, petshop .."
                                            title="Search by product name, brand, category, petshop .." value=""
                                            onkeyup="reloadData();">
                                        <button type="button" class="btn read-2" onclick="reloadData();">
                                            <span class="fa fa-search"></span>
                                        </button>

                                    </form>
                                </div>
                                <!-- /Gallery-imgs 

                                <div class="single-gd mb-5">
                                    <h4>Product <span>Categories</span></h4>
                                    <ul class="list-group single">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accessories
                                            <span class="badge badge-primary badge-pill">14</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Suits
                                            <span class="badge badge-primary badge-pill">18</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Footwear
                                            <span class="badge badge-primary badge-pill">12</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Blazers
                                            <span class="badge badge-primary badge-pill">10</span>
                                        </li>
                                    </ul>
                                </div>-->
                                <!--
                                <div class="single-gd mb-5">
                                    <h4>Filter by <span>Price</span></h4>

                                    <ul class="dropdown-vjm-transitu6">
                                        <li>

                                            <div id="slider-range"
                                                class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                
                                            </div>
                                            <input type="text" id="amount"
                                                style="border: 0; color: #ffffff; font-weight: normal;">
                                        </li>
                                    </ul>
                                </div>

                                
                                <div class="single-gd mb-5">
                                    <h4>Discount </h4>
                                    <div classes="box-hny">
                                        <label class="containerhny-checkbox">15% or More
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">20% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">35% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">55% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>

                                        <label class="containerhny-checkbox">65% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">75% or More
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="single-gd left-side mb-5">
                                    <h4>Customer Ratings</h4>
                                    <ul class="ratingshyny">
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span>5.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>4.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>3.5</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>3.0</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star" aria-hidden="true"></span>
                                                <span class="fa fa-star-half-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span class="fa fa-star-o" aria-hidden="true"></span>
                                                <span>2.5</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div> 

                                <div class="single-gd mb-5 border-0">
                                    <h4>Recent <span>Products</span></h4>
                                    <div class="row special-sec1 mt-4">
                                        <div class="col-4 img-deals">
                                            <a href="ecommerce-single.html"><img src="assets/images/shop-88.jpg"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="col-8 img-deal1">
                                            <h5 class="post-title">
                                                <a href="ecommerce-single.html">Blue Sweater</a>
                                            </h5>

                                            <a href="ecommerce-single.html" class="price-right">$499.00</a>
                                        </div>

                                    </div>
                                    <div class="row special-sec1 mt-4">
                                        <div class="col-4 img-deals">
                                            <a href="ecommerce-single.html"><img src="assets/images/shop-77.jpg"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="col-8 img-deal1">
                                            <h5 class="post-title">
                                                <a href="ecommerce-single.html">White T-Shirt</a>
                                            </h5>
                                            <a href="ecommerce-single.html" class="price-right">$575.00</a>
                                        </div>

                                    </div>

                                </div>
                                -->
                            </div>
                        </aside>
                        <!--Filters-->
                    </div>
                    <div class="ecommerce-right-hny col-lg-8">
                        <!--Sort results-->
                        <div class="row ecomhny-topbar">
                            <div class="col-6 ecomhny-result">
                                <h4 class="ecomhny-result-count"> Showing all <span id="showingResult"></span> Results
                                </h4>
                            </div>
                            <div class="col-3 ecomhny-topbar-ordering float-right">
                            </div>
                            <div class="col-3 ecomhny-topbar-ordering float-right">

                                <div class="ecom-ordering-select d-flex">
                                    <span class="fa fa-angle-down" aria-hidden="true"></span>
                                    <select onchange="reloadData()" id="perpage">
                                        <option value="" disabled>No of products</option>
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <!--Sort results-->

                        <!-- Products-->
                        <div class="ecom-products-grids row show_data">
                            <!-- Product -->


                            <!-- Product -->

                        </div>
                        <!-- Products-->
                    </div>
                </div>
                <!--//row1-->
                <div class="" id="pagination">

                </div>
                <!--//pagination-->

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

<!-- cart -->
<script type="text/javascript">
$(document).ready(function() {

    load_data();

    function load_data(page) {

        perpage_ = document.getElementById("perpage").value;
        search_ = document.getElementById("searchcriterie").value;
        psid = document.getElementById('petshop').value;
        //toastr.success(search_);

        $.ajax({
            url: "ajax/load_data.php",
            method: "POST",
            data: {
                page: page,
                searchv: search_,
                perpage: perpage_,
                petshopID: psid
            },
            dataType: "JSON",
            success: function(data) {
                $(".show_data").html(data.output);
                $("#pagination").html(data.pagination);
                $("#showingResult").html(data.showresult);
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

<script>
function load_data(page) {

    perpage_ = document.getElementById("perpage").value;
    search_ = document.getElementById("searchcriterie").value;
    psid = document.getElementById('petshop').value;
    $.ajax({
        url: "ajax/load_data.php",
        method: "POST",
        data: {
            page: page,
            searchv: search_,
            perpage: perpage_,
            petshopID: psid
        },
        dataType: "JSON",
        success: function(data) {
            $(".show_data").html(data.output);
            $("#pagination").html(data.pagination);
            $("#showingResult").html(data.showresult);
        }
    });
}

function reloadData() {
    load_data();
}
</script>

<!--Price Range-->
<script src="assets/js/jquery-ui.js"></script>
<!--/login
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
</script>-->
<!-- disable body scroll which navbar is in active -->
<?php include "bottomScripts.php"; ?>