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
<?php
    include 'include/header.php';
    ?>
    <!-- Template CSS -->

    <style>
    .iblack {
        color: black;
    }
    </style>

</head>

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
                <!--/search-right-->
                <div class="search-right">
                    <!-- search popup -->
                    <div id="deleteprod" class="pop-overlay">
                        <div class="popup">
                            <h3>Are you sure you want to delete this product? &nbsp
                                <button type="button" class="btn btn-danger" onclick="deleteProduct('',2);">Confirm
                                    Delete</button>
                                <input type="text" id="prodToDelete" name="prodToDelete" disabled hidden/>
                            </h3>
                        </div>
                        <a class="close" href="viewAllMyProducts.php">×</a>

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
                                    $name = $row['name'];
                                    echo '<h2 class="hny-title text-center">'.$name.'</h2>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                            ?>
                            <ol class="breadcrumb mb-0">
                                <li><a href="petshopHome.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //w3l-banner-slider-main -->

    <section class="main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5">
            <div class="container py-lg-5">
                <div class="blog-inner-grids">

                    <h3 class="hny-title mb-0">My <span>Products</span></h3>
                    <p class="mb-4">List of all your products
                    </p>

                    <!-- Datatable -->
                    <table id="table_id" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Name</th>
                                <th width="20%">Description</th>
                                <th>Category</th>
                                <!--<th>Quantity</th>
                                <th>Price</th>-->
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- repeat within body-->
                            <?php
                                
                                //fetch product from database, using session userid
                                $psid = getPetshopID($userid);
                                $sql = "CALL sp_getMyProductDetails($psid);";
                            $result = $conn->query($sql);

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $productID = $row['productID'];
                                    $img = $row['imgPath'];
                                    $name = $row['pname'];
                                    $brand = $row['bname'];
                                    $desc = $row['description'];
                                    $pcname = $row['pcname'];
                                    $sname = $row['sname'];
                                    $qoh = " ";
                                    $price = " ";

                                                                                       
                                   
                                    echo '<tr>
                                <td width="16%"><img src="product/'.$img.'" alt="Img" width="100%"
                                        height="100%"></td>
                                <td><b><span style="text-transform:uppercase">'.$brand.'</span></b> - '.$name.'</td>
                                <td>'.$desc.'</td>
                                <td>'.$sname.' '.$pcname.'</td>
                                <!--<td>'.$qoh.'</td>
                                <td>'.$price.'</td>-->
                                <td width="15%">
                                    <a  href="addproductpricing.php?id='.$productID.'"  class="btn btn-primary" title="View"><i class="fa fa-eye iblack"
                                            aria-hidden="true"></i></a>
                                    <a href="addproduct.php?id='.$productID.'" class="btn btn-warning" title="Edit"><i class="fa fa-edit iblack"
                                            aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-danger" onclick=deleteProduct('.$productID.',1) title="Delete"><i class="fa fa-trash iblack"
                                            aria-hidden="true"></i></a>

                                </td>
                                </tr>';
                                }
                            }
                             $result->close();
                             $conn->next_result();
                                ?>
                            <!-- //repeat body-->
                        </tbody>

                    </table>
                    <!-- //Datatable -->
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

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script>
//initialising datatable
$(document).ready(function() {
    $('#table_id').DataTable();
});
$('#table_id').DataTable().columns.adjust();
</script>



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

<script>
function deleteProduct(id, action) {
    //set value in input prodToDelete
    //pop up
    if (action == 1) {
        document.getElementById('prodToDelete').value = id;
        window.location.href = 'viewAllMyProducts.php#deleteprod';
    }

    //get value in input prodToDelete
    //ajax call
    if (action == 2) {
        IDtoDelete = document.getElementById('prodToDelete').value;
        //ajax call
        $.ajax({
            url: 'ajax/productAction.php',
            data: {
                productID: IDtoDelete,
                action: "deleteProduct"
            },
            type: 'post',
            success: function(data) {
                toastr.success("Product Deleted");
                    window.location.href = 'viewAllMyProducts.php';
            }
        });
    }

}
</script>