<?php
include 'admininclude/verifyLogin.php';
include "admininclude/functions.php";
$_SESSION['NavActive']="content";


if(!isset($_SESSION)){
    session_start();
}
if (isset($_GET['content'])){
    $contentid = $_GET['content'];
    if($contentid == "br"){
        $ContentTitle = "Brands";
        $Content = 1;
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
    }
    else if($contentid == "loc"){
        $ContentTitle = "Location";
        $Content = 4;
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

                                        <!--Form-->
                                        <?php
                                        //check if there is query string and check if the id exists
                                        $petexists = false;
                                        if(isset($_GET['p'])){
                                            if(verifyPetCat($_GET['p'])){
                                                //load in form
                                                $petexists = true;

                                            $sql = "CALL sp_getPetCategories();";
                                            $result = $conn->query($sql);
                                            if ($result -> num_rows > 0) {
                                                //output data for each row
                                                while ($row = $result->fetch_assoc()) {
                                                    if($row['petcatID'] == $_GET['p']){
                                                    $petid = $row['petcatID'];
                                                    $name = $row['name'];
                                                    $img = $row['imgPath'];
                                                    }
                                                }
                                            }
                                            $result->close();
                                            $conn->next_result();

                                            }
                                        }
                                        ?>
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <label class="input__label">Name</label>
                                                <input type="text" class="form-control input-style" id="petname"
                                                    value='<?php (($petexists)?$x=$name:$x=" "); echo $x;?>'
                                                    placeholder="Enter Pet Name">
                                            </div>
                                            <!-- Load Image -->
                                            <img class="rounded" src='<?php (($petexists)?$x=$img:$x=" "); echo "category/".$x;?>'
                                                alt="pet image" />
                                            <input type="text" value='<?php (($petexists)?$x=$img:$x=" "); echo $x;?>'
                                                disabled hidden>
                                            </br>
                                            </br>
                                            <div class="custom-file">
                                                <label class="input__label">Image</label>
                                                <input type="file" class="custom-file-input" id="validatedCustomFile">
                                                <label class="custom-file-label">Choose
                                                    image...</label>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary btn-style mt-4"><?php echo $btnAddOrUpdate;?></button>
                                            <?php
                                            if($petexists){
                                                echo'
                                                <a href="adminviewContent.php?content=p"  class="btn btn-warning btn-style mt-4">Cancel</a>
                                                <button type="button"  class="btn btn-danger btn-style mt-4" onclick="DeleteContent('.$petid.', '.$_GET['p'].')">Delete</button>
                                                ';
                                            }
                                            ?>
                                        </form>
                                        <!--Form-->
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
                                        aria-expanded="true" aria-controls="collapseTwo">Pet Category</a>
                                </div>
                                <div class="card-body">
                                    <div class="collapse show" id="collapseTwo" data-parent="#accordionExample"
                                        aria-labelledby="headingTwo">

                                        <!--Table -->
                                        <div class="card-body">
                                            <div class="teams mb-4">
                                                <div class="row px-2">
                                                    <!--Repeat-->
                                                    <?php
                                        
                                            $sql = "CALL sp_getPetCategories();";
                                            $result = $conn->query($sql);
                                            $count = 0;
                                            if ($result -> num_rows > 0) {
                                                //output data for each row
                                                while ($row = $result->fetch_assoc()) {
                                                    $count++;
                                                    $petid = $row['petcatID'];
                                                    $name = $row['name'];
                                                    $img = $row['imgPath'];

                                                    echo '
                                                    <div class="col-lg-3 col-md-6 mb-0 px-2 rounded text-center">
                                                <div class="item">
                                                    <div class="d-team-grid team-info">
                                                        <div class="column"><a href="adminviewContent.php?content=p&p='.$petid.'"><img class="border rounded"
                                                                    src="category/'.$img.'" alt="pet image" style="width:75%"/></a>
                                                        </div>
                                                        <div class="container">
                                                            <h5 class="name-pos mb-0">'.$name.'
                                                            </h5>
                                                            <!--<input class="btn btn-warning rounded" type="button" value="'.$name.'" style="width:75%"/>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    ';
                                                }
                                            }
                                            $result->close();
                                            $conn->next_result();
                                        
                                        
                                            ?>
                                                    <!--Repeat-->

                                                </div>
                                            </div>
                                        </div>
                                        <!--Table -->
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
</script>