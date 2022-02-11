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

                            <div class="card card_border mb-5">
                                <div class="cards__heading">
                                    <h3>Petshops</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-columns">
                                        <!--Card Repeat-->

                                        <?php
                                        //load petshop where status = 1
                                        //-1 pending request
                                        //1 accepted
                                        //0 rejected
                                        //Load all users from database
                                        $sql = "CALL sp_getAllPetshop('1');";
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
                                                if($row['status'] == 1){
                                                    $status = '<p class="card-text mb-4 btn btn-success">Active</p>';
                                                }
                                                if($row['status'] == 0){
                                                    $status = '<p class="card-text mb-4 btn btn-warning">Blocked</p>';
                                                }
                                                $userID = $row['userID'];
                                                //$img

                                                echo '
                                                <div class="card">
                                                <a href="adminviewpetshopRequests.php?psid='.$psid.'&type=show">
                                                <div class="text-center"></br></br><h1 class="text-center">'.$name.'</h1><span class="text-center"><i class="fa fa-home" style="font-size:75px"></i></span></div>
                                                </a>
                                                    <div class="card-body">
                                                        <a href="adminviewpetshopRequests.php?psid='.$psid.'&type=show"><h5 class="card-title">'.$name.'</h5></a>
                                                        <p class="card-text mb-4">'.$desc.'</p>
                                                        '.$status.'
                                                    </div>
                                                </div>
                                                ';
                                            }
                                        }
                                        $result->close();
                                        $conn->next_result();
                                        ?>
                                        <!--Card Repeat-->
                                    </div>
                                </div>
                            </div>

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