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

    .cardbg {
        background-color: #f4f4f4;
    }

    .textorange{
        color: #ff7315;
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
                            <h2 class="hny-title text-center">Petshop</h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">Petshop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//Navbar & Carousel -->

    <!-- View Petshop -->
    <section class="w3l-ecommerce-main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5 ">
            <div class="container py-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->


                </div>
                <div class="blog-inner-grids ">
                    <div class="mag-post-left-hny ">
                        <div class="mag-hny-content ">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">

                                <?php
                                        //load petshop where status = 1
                                        //-1 pending request
                                        //1 accepted
                                        //0 rejected
                                        //Load all users from database
                                        $sql = "CALL sp_getAllPetshop('1');";
                                        $result = $conn->query($sql);
                                        $bg=0;
                    
                                        if ($result -> num_rows > 0) {
                                            //output data for each row
                                            while ($row = $result->fetch_assoc()) {
                                                $psid = $row['petshopID'];
                                                $name = $row['name'];
                                                $brn = $row['brn'];
                                                $desc = $row['description'];
                                                $street = $row['street'];
                                                $town = $row['town'];
                                                $district = $row['district'];
                                                $long = $row['longitude'];
                                                $lat = $row['latitude'];
                                                $status = $row['status'];
                                                $userID = $row['userID'];
                                                //$img
                                                $img="";

                                                if($img == ""){
                                                    $outputImg = '<div class="text-center"></br></br><h1 class="text-center">'.$name.'</h1><span class="text-center"><i class="fa fa-home" style="font-size:75px"></i></span></div>';
                                                }else{
                                                    $outputImg = '<img class="img-fluid" src="petshop/'.$img.'" alt="Aquatic Showroom">';
                                                }

                                                

                                                //get owner number for whatsapp
                                                $result1 = getUserDetails($userID);
                                                if($result1 != null){
                                                    if ($result1 -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result1->fetch_assoc()) {
                                                            //load user Details
                                                            $email = $row['email'];
                                                            $mobile = $row['mobile'];
                                                        }
                                                    }
                                                }

                                                //specialities
                                                $specialities = "";
                                                $result2 = getPetshopSpecialities($psid);
                                                if($result2 != null){
                                                    if ($result2 -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result2->fetch_assoc()) {
                                                            //load specialities
                                                            $specialities .= '<li>'.$row['name'].'</li>';
                                                        }
                                                    }
                                                }

                                                //available brands
                                                $availableBrands = "";
                                                $result3 = getavailableBrandsAtPetshop($psid);
                                                if($result3 != null){
                                                    if ($result3 -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result3->fetch_assoc()) {
                                                            //load specialities
                                                            $availableBrands .= '<img src="brand/'.$row['imgPath'].'" style="width="65px" height=65px">&nbsp';
                                                        }
                                                    }
                                                }


                                                if($bg == 0){
                                                    $bg = 1;
                                                }else{
                                                    $bg = 0;
                                                }

                                                echo '
                                                <!--/Petshop-->
                                <div class="row author-listhny mt-lg-0 mt-4 '.(($bg == 1)?"cardbg":"").' border rounded">
                                    <div class="author-left col-sm-3 mb-sm-0 mb-4">
                                        <a href="#">

                                            '.$outputImg.'

                                        </a>
                                    </div>
                                    <div class="author-right col-sm-5 pr-lg-0 ">
                                        </br>
                                        <h4><a href="viewPetshopDetails.php?psid='.$psid.'" class="title-team-28"><b>'.strtoupper($name).'</b></a>
                                            &nbsp<a href="https://api.whatsapp.com/send?phone=230'.$mobile.'&text=&source=&data=" target="_blank" class="whatsapp text-success"><span class="fa fa-whatsapp"></span></a>
                                            <!--&nbsp<a href="https://mail.google.com/mail/#inbox?compose=new" target="_blank" class="email text-danger"><span class="fa fa-envelope"></span></a>-->
                                        </h4>
                                        <p>Address: '.$street.", ".$town.", ".$district.'
                                        </br>
                                        <a href="https://www.google.com/maps/search/?api=1&query='.$long.','.$lat.'" target="_blank">OPEN MAP</a></p>
                                        <h5 class="sp_title mb-3">Description</h5>
                                        <p class="para-team">'.$desc.'</p>
                                        <div class="occasional">
                                        <h5 class="sp_title mb-3">Specialities</h5>
                                        <ul class="single_specific">
                                            '.$specialities.'
                                        </ul>

                                        </div>
                                        
                                    </div>

                                    <div class="author-right col-sm-4 pr-lg-0 ">
                                    </br>
                                    <div class="occasional">
                                        <h5 class="sp_title mb-3">Available Brands</h5>
                                        <p class="single_specific">
                                            '.$availableBrands.'
                                        </p>
                                    </div>
                                    <a href="viewPetshopDetails.php?psid='.$psid.'" class="btn btn-info mt-auto" style="position:absolute; right:10px; bottom:10px;"> View Store</a>
                                    </div>

                                </div>
                                <!--//Petshop-->
                                </br>                                               
                                                ';
                                            }
                                        }
                                        $result->close();
                                        $conn->next_result();
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->

                </div>

            </div>
        </div>
    </section>
    <!--View Petshop-->

    <section class="w3l-footer-22">
        <!-- Include Footer -->
        <?php
     include 'include/footer.php';
     ?>

    </section>


</body>

</html>
<?php include "bottomScripts.php"; ?>