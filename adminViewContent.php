<?php
include 'admininclude/verifyLogin.php';
include "admininclude/functions.php";
//solves header issue
ob_start();
$_SESSION['NavActive']="content";


if(!isset($_SESSION)){
    session_start();
}
if (isset($_GET['content'])){
    $contentid = $_GET['content'];
    if($contentid == "br"){
        $ContentTitle = "Brands";
        $Content = 1;
        if(isset($_GET['br'])){
            $AddOrUpdate = "Update Brand";
            $btnAddOrUpdate = "Update";
            $show = "show";
        }else{
            $AddOrUpdate = "Add Brand";
            $btnAddOrUpdate = "Insert";
            $show = "";
        }
    }
    else if($contentid == "p"){
        $ContentTitle = "Pet Category";
        $Content = 2;
        if(isset($_GET['p'])){
            $AddOrUpdate = "Update Pet Category";
            $btnAddOrUpdate = "Update";
            $show = "show";
        }else{
            $AddOrUpdate = "Add Pet Category";
            $btnAddOrUpdate = "Insert";
            $show = "";
        }
    }
    else if($contentid == "pro"){
        $ContentTitle = "Product Category";
        $Content = 3;
        if(isset($_GET['pro'])){
            $AddOrUpdate = "Update Product Category";
            $btnAddOrUpdate = "Update";
            $show = "show";
        }else{
            $AddOrUpdate = "Add Product Category";
            $btnAddOrUpdate = "Insert";
            $show = "";
        }
    }
    else if($contentid == "loc"){
        $ContentTitle = "Location";
        $Content = 4;
        if(isset($_GET['loc'])){
            $AddOrUpdate = "Update Location";
            $btnAddOrUpdate = "Update";
            $show = "show";
        }else{
            $AddOrUpdate = "Add Location";
            $btnAddOrUpdate = "Insert";
            $show = "";
        }
    }else{
        header('Location: adminDashboard.php');
    }
}else{
    header('Location: adminDashboard.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'admininclude/headScripts.php';
?>
</head>

<body class="sidebar-menu-collapsed">
    <section>

        <!-- Side bar -->
        <?php
        include 'admininclude/sidebar.php';
        ?>
        <!-- //Side bar -->

        <!-- Navbar -->
        <?php
        include 'admininclude/navbar.php';
        ?>
        <!-- //Navbar -->


        <!-- main content start -->
        <div class="main-content">
            <!-- content -->
            <div class="container-fluid content-top-gap">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-breadcrumb">
                        <li class="breadcrumb-item"><a href="adminDashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Content</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $ContentTitle;?></li>
                    </ol>
                </nav>
                <div class="welcome-msg pt-3 pb-4">
                    <!--<h1>Hi <span class="text-primary">John</span>, Welcome back</h1>
                    <p>Very detailed & featured admin.</p>-->
                </div>


                <!-- Petshop join request -->
                <div class="accordions">
                    <div class="row">
                        <!-- accordion style 1 -->
                        <div class="col-lg-12 mb-4 accordion" id="accordionExample">
                            <div class="card card_border">
                                <div class="card-header chart-grid__header card__title">
                                    <a href="#" class="" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne"><?php echo $AddOrUpdate;?></a>
                                </div>
                                <div class="card-body col-lg-6 mb-4">
                                    <div class="collapse <?php echo $show;?>" id="collapseOne"
                                        data-parent="#accordionExample" aria-labelledby="headingOne">
                                        <!--Include appropriate file-->
                                        <?php
                                        if($Content == 1){
                                            include 'contentBrandTop.php';
                                        }
                                        if($Content == 2){
                                            include 'contentPetTop.php';
                                        }
                                        if($Content == 3){
                                            include 'contentProductTop.php';
                                        }
                                        if($Content == 4){
                                            include 'contentLocationTop.php';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //accordion style 1 -->
                    </div>
                </div>
                <!-- //Petshop join request -->

                <!-- Pet category -->
                <div class="accordions">
                    <div class="row">
                        <!-- accordion style 1 -->
                        <div class="col-lg-12 mb-4 accordion" id="accordionExample">
                            <div class="card card_border">
                                <div class="card-header chart-grid__header card__title">
                                    <a href="#" class="" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="true" aria-controls="collapseTwo"><?php echo $ContentTitle;?></a>
                                </div>
                                <div class="card-body">
                                    <div class="collapse show" id="collapseTwo" data-parent="#accordionExample"
                                        aria-labelledby="headingTwo">

                                        <!--Include approprate file-->
                                        <?php
                                        if($Content == 1){
                                            include 'contentBrandButtom.php';
                                        }
                                        if($Content == 2){
                                            include 'contentPetButtom.php';
                                        }
                                        if($Content == 3){
                                            include 'contentProductButtom.php';
                                        }
                                        if($Content == 4){
                                            include 'contentLocationButtom.php';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //accordion style 1 -->
                    </div>
                </div>
                <!-- //Pet Category -->


            </div>
            <!-- //content -->



        </div>
        <!-- main content end-->
    </section>
    <!--footer section start-->
    <?php
    include 'admininclude/footer.php';
    ?>
    <!--footer section end-->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
</body>

</html>
<?php
    include 'admininclude/buttomScripts.php';
?>

<script>
//ajax to load data in order to update pet
/*function loadpet(id, field) {

    if (id != "") {
        $.ajax({
            url: 'ajax/adminAction.php',
            data: {
                adminAction: field,
                v: id
            },
            type: 'post',
            success: function(data) {
            $('#' + field + 'AjaxErrorMsg').html(data);
            }
        });
    }

}*/
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#addimg').attr('src', e.target.result);
        }
        document.getElementById('addimg').style.display = "block"
        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {
    readURL(this);
});
</script>