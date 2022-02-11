<?php
include 'admininclude/verifyLogin.php';
$_SESSION['NavActive']="adminPetshop";

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

        <section class="w3l-specification-6">
            <!-- /specification-6-->
            <div class="specification-6-mian py-5">
                <div class="container py-lg-5">
                    <div class="row story-6-grids text-left">
                        <div class="col-lg-12 story-gd">
                            <div class="cards__heading">
                                <h3>Petshop Join Requests</h3>
                            </div>

                            <!-- Repeat-->
                            <?php
                                        //load petshop where status = 1
                                        //-1 pending request
                                        //1 accepted
                                        //0 rejected
                                        //Load all users from database

                                        //sql param
                                        $sqlparam = -1;
                                        if(isset($_GET['type'])){
                                            if($_GET['type'] == "request"){
                                                $sqlparam = -1;
                                            }
                                            if($_GET['type'] == "show"){
                                                $sqlparam = 1;
                                            }
                                        }else{
                                            $sqlparam = 1;
                                        }
                                        $sql = "CALL sp_getAllPetshop($sqlparam);";
                                        $result = $conn->query($sql);
                    
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
                                                $prodIm =$row['imgPath'];
                                                //$img

                                                //add btn accept reject or block
                                                //check for query string
                                                $acceptRejecttBtn = '
                                                        <button id="btnAccept" onclick="petshopStatus('.$psid.',1)" class="btn btn-style btn-success" >Accept</button>
                                                        <button id="btnReject" onclick="petshopStatus('.$psid.',-1)" class="btn btn-style btn-danger" >Reject</button>
                                                ';

                                                $block = '
                                                <button id="btnBlock" onclick="petshopStatus('.$psid.',0)" class="btn btn-style btn-warning" >Block</button>
                                                ';

                                                //default
                                                $btn = $acceptRejecttBtn;

                                                if((isset($_GET['type']))){
                                                    if($_GET['type'] == "request"){
                                                        $btn = $acceptRejecttBtn;
                                                    }
                                                    if($_GET['type'] == "show"){
                                                        $btn = $block;
                                                    }
                                                }else{
                                                    $btn = $block;
                                                }

                                                $displayPetshop = '
                                                <div class="card card_border p-lg-5 p-3 mb-4">
                                                    <div class="card-body py-3 p-0">
                                                        <div class="row">
                                                            <div class="col-lg-6 pr-lg-4">
                                                            <div class="text-center"></br></br><h1 class="text-center">'.$name.'</h1><span class="text-center"><i class="fa fa-home" style="font-size:75px"></i></span></div>
                                                            </div>
                                                            <div class="col-lg-6 align-self pl-lg-4 mt-lg-0 mt-4">
                                                            <h3 class="block__title mb-lg-4">'.$name." (" .$brn.")".'</h3>
                                                            <p class="mb-3">Address: '.$street.", ".$town.", ".$district.'
                                                            </br>
                                                            <a href="https://www.google.com/maps/search/?api=1&query='.$long.','.$lat.'" target="_blank">OPEN MAP</a></p>
                                                            <p class="mb-3">'.$desc.'</p>
                                                            <p class="mb-lg-5 mb-3">Speciality:</p>
                                                            '.$btn.'
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';

                                                //check for query string
                                                if(isset($_GET['psid'])){
                                                    if($_GET['psid'] == $psid){
                                                        //echo once
                                                        echo $displayPetshop;
                                                    }
                                                }else{
                                                    echo $displayPetshop;
                                                }
                                            }
                                        }
                                        $result->close();
                                        $conn->next_result();
                                        ?>
                            <!-- //Repeat-->

                        </div>
                    </div>
                </div>
            </div>
        </section>
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