<?php
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <!-- CSS -->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,500,600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/image/icon/icon.jpg">
    <!-- CSS -->
</head>

<body>
    <section class="w3l-specification-6">
        <!-- /specification-6-->
        <div class="specification-6-mian py-5">
            <div class="container py-lg-5">
                <div class="row story-6-grids text-left">
                    <div class="col-lg-3 story-gd"></div>
                    <div class="col-lg-6 story-gd">
                        <!-- <img src="assets/images/left2.jpg" class="img-fluid" alt="/"> -->
                        <div class="wrap bg-dark">
                            </br>
                            <h4 class="text-center text-white mb-4"><a class="navbar-brand" href="index.php">
                                    <h3 class="hny-title text-white"><span>E </span>Petshop</h3>
                                </a></h4>
                            <div class="login-bghny p-md-5 p-4 mx-auto mw-100">


                            <?php
                            if(isset($_GET['key'])){
                                $key = $_GET['key'];
                                if(password_verify($key, 190)){
                                    echo "match";
                                }else{
                                    echo "NOT MATCH";
                                }
                                echo "test";

                                //search user by id and match with key
                                //Load all users from database
                                $sql = "CALL sp_getAllUsers('1');";
                                $result = $conn->query($sql);
                                if ($result -> num_rows > 0) {
                                    //output data for each row
                                    while ($row = $result->fetch_assoc()) {
                                        if(password_verify($key, 188)){
                                            //update status
                                            updateUserStatus(188, 1);
                                        }
                                    }
                                }

                            }
                            ?>
                                <!--/login-form-->
                                <h5 class="text-white">Please click the activation link we sent to your email.</h5>
                                <p class="login-texthny mb-2 text-white"><span class="text-warning">If you do not click
                                        the link your account will remain inactive.<span></p>
                                <!--//login-form-->
                                <a class="btn btn-success" href="login.php">Proceed to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //specification-6-->
</body>

</html>
<?php include "bottomScripts.php"; ?>