<?php
include 'include/common.php';
include 'include/functions.php';
//solves header issue
ob_start();
if(!isset($_SESSION)){
    session_start();
}
//when session roleid does not exists or session roleid is not 2 (Not vendor) redirect to login page
if ((!isset($_SESSION["roleid"]))  || (!isset($_SESSION["userid"]))) {
    header('Location: login.php');
} else {
    $userid = $_SESSION["userid"];
    $roleid = $_SESSION["roleid"];
}

//if url does not contain query string product id, go to page add product
/*$isUpdate = false;
if((!isset($_GET['id'])) || (($_GET['id']) == NULL)){
    $isUpdate = false;
}else{
    $isUpdate = true;
    $productId = $_GET['id'];
}*/

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title?></title>
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <!-- Template CSS -->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,500,600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/image/icon/icon.jpg">
    <!-- Template CSS -->

</head>

<body>

    <?php
//get user details
$sql = "CALL sp_getUserDetails($userid);";
$result = $conn->query($sql);
if($result -> num_rows >0){
    //output data for each row
    while($row = $result->fetch_assoc()){
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $nic = $row['nic'];
        $street = $row['street'];
        $locality = $row['locality'];
        $town = $row['town'];
        $district = $row['district'];
        $discrictName = getLocationName($district);
        $email = $row['email'];
        $mobile = $row['mobile'];
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
        $registrationDate = date('d M Y h:m', strtotime($row['registrationDate']));
        $lastmodified = date('d M Y h:m', strtotime($row['lastModifiedDateTime']));
    }
}
$result->close();
$conn->next_result();

?>

    <section class="w3l-banner-slider-main inner-pagehny">
        <div class="breadcrumb-infhny">

            <div class="top-header-content">
                <header class="tophny-header">
                    <!-- Include Navbar -->
                    <?php
            if ($roleid == 3) {
                include 'include/navbarCustomer.php';
            }else{
                include 'include/navbarVendor.php';
            }
            
            ?>
                </header>
                <div class="breadcrumb-contentnhy">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <h2 class="hny-title text-center"><?php echo $firstName . " " . $lastName?></h2>
                            <ol class="breadcrumb mb-0">
                                <li><a href="index.html">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //w3l-banner-slider-main -->

    <section class="blog-post-main">
        <!--/mag-content-->
        <div class="mag-content-inf py-5">
            <div class="container py-lg-5">
                <div style="margin: 8px auto; display: block; text-align:center;">

                    <!---728x90--->


                </div>
                <div class="blog-inner-grids bg-light">
                    <div class="mag-post-left-hny border">
                        <div class="mag-hny-content ">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content ">
                                <!--/leave-->
                                <div class="leave-comment-form mt-lg-5 mt-4" id="comment">
                                    <br>
                                    <!--<h3 class="hny-title mb-0">My <span>Product</span></h3>
                                    <p class="mb-4">Required fields are marked
                                        *
                                    </p>-->

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <!--<p class="mb-4 text-white text-center bg-dark">
                                            Product Details
                                        </p> -->
                                        <div class="input-grids row">
                                            <p class="text-danger">Account created on : <?php echo $registrationDate;?> &nbsp &nbspLast modified on: <?php echo $lastmodified;?> </p>
                                        </div>

                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>First Name</label>
                                                <input list="pname" type="text" name="firstName" id="firstName"
                                                    class="form-control" placeholder="First Name"
                                                    value="<?php echo $firstName;?>" required disabled>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Last Name</label>
                                                <input list="pname" type="text" name="lastName" id="lastName"
                                                    class="form-control" placeholder="Last Name"
                                                    value="<?php echo $lastName;?>" required disabled>
                                            </div>
                                        </div>

                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Email</label>
                                                <input type="text" name="email" id="email" class="form-control"
                                                    required="" value="<?php echo $email;?>" placeholder="Email"
                                                    disabled>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>NIC</label>
                                                <input type="text" name="nic" id="nic" class="form-control"
                                                    placeholder="NIC" value="<?php echo $nic;?>" required="" disabled>
                                            </div>
                                        </div>
                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    placeholder="Mobile" value="<?php echo $mobile;?>" required=""
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Street</label>
                                                <input list="pname" type="text" name="street" id="street"
                                                    class="form-control" placeholder="Street"
                                                    value="<?php echo $street;?>" required disabled>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Locality</label>
                                                <input list="pname" type="text" name="locality" id="locality"
                                                    class="form-control" placeholder="Locality"
                                                    value="<?php echo $locality;?>" required disabled>
                                            </div>
                                        </div>

                                        <div class="input-grids row">
                                            <div class="form-group col-lg-6">
                                                <label>Town</label>
                                                <input list="pname" type="text" name="town" id="town"
                                                    class="form-control" placeholder="Town" value="<?php echo $town;?>"
                                                    disabled required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>District</label>
                                                <select class="form-control" name="district" id="district" required=""
                                                    disabled>
                                                    <option value="" selected="true" disabled="disabled">District
                                                    </option>
                                                    <?php
                                                    $sql = "CALL sp_getAllLocation();";
                                                    $result = $conn->query($sql);

                                                    if($result -> num_rows >0){
                                                        //output data for each row
                                                        while($row = $result->fetch_assoc()){
                                                            $id = $row['locationID'];
                                                            $name = $row['name'];
                                                            if($district == $id){
                                                                echo '<option value="'.$id.'" selected="true">'.$name.'</option>';
                                                            }else{
                                                                echo '<option value="'.$id.'">'.$name.'</option>';
                                                            }
                                                        }
                                                    }
                                                    $result->close();
                                                    $conn->next_result();
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="submit text-right mt-5">
                                            <div>
                                                <button type="button" class="btn btn-info" name="editBTN" id="editBTN"
                                                    onclick="updateProfile(1)" formnovalidate>
                                                    Edit</button>
                                            </div>
                                            <div id="cancelUpdate">
                                                <button type="button" class="btn btn-danger" name="btncancel"
                                                    id="btncancel" onclick="updateProfile(2)" formnovalidate>
                                                    Cancel</button>
                                                <button type="submit" class="btn btn-primary" name="updateuser"
                                                    id="updateuser" value="update User">
                                                    Update</button>
                                            </div>
                                        </div>
                                        <br>
                                    </form>

                                    <?php
                                    //submit form, fetch data from form, call function addProduct
                                    //go to another page to view posted product

                                    if (isset($_POST['updateuser'])) {
                                        
                                        //Fetch data from the fields
                                          
                                        $fistname = $_POST['firstName'];
                                        $lastname = $_POST['lastName'];
                                        $email = $_POST['email'];
                                        $nic = $_POST['nic'];
                                        $mobile = $_POST['mobile'];
                                        $street = $_POST['street'];
                                        $locality = $_POST['locality'];
                                        $town = $_POST['town'];
                                        $district = $_POST['district'];
                                        $lastmodified= date("Y/m/d G:i:s");

                                     
                                                $result = updateUser($userid, $fistname, $lastname, $email, $nic, $mobile, $street, $locality, $town, $district, $lastmodified);
                                                if ($result) {
                                                    //**********get add product success message, go to page to view posted product
                                                    //Add product price => add to table productLine
                                                    //$prodID = getLatestProductId($userid);
                                                    header('Location: userProfile.php');
                                                } else {
                                                    //**********get add product failed message
                                                    header('Location: fail.php');
                                                    //echo "<script>window.location.href='register.php';</script>";
                                                }
                                            
                                    }
                                    
                                    ?>
                                </div>
                                <!--//leave-->
                                <!--//mag-hny-content-4-->
                            </div>
                        </div>
                    </div>
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
<?php include "bottomScripts.php"; ?>
<script>
//default
document.getElementById("editBTN").style.display = "inline";
document.getElementById("cancelUpdate").style.display = "none";

function updateProfile(btn) {
    if (btn == 1) {
        document.getElementById("editBTN").style.display = "none";
        document.getElementById("cancelUpdate").style.display = "block";

        //enable all btn
        document.getElementById("firstName").disabled = false;
        document.getElementById("lastName").disabled = false;
        document.getElementById("email").disabled = false;
        document.getElementById("nic").disabled = false;
        document.getElementById("mobile").disabled = false;
        document.getElementById("street").disabled = false;
        document.getElementById("locality").disabled = false;
        document.getElementById("town").disabled = false;
        document.getElementById("district").disabled = false;
    }
    if (btn == 2) {
        document.getElementById("editBTN").style.display = "inline";
        document.getElementById("cancelUpdate").style.display = "none";

        //disable all btn
        document.getElementById("firstName").disabled = true;
        document.getElementById("lastName").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("nic").disabled = true;
        document.getElementById("mobile").disabled = true;
        document.getElementById("street").disabled = true;
        document.getElementById("locality").disabled = true;
        document.getElementById("town").disabled = true;
        document.getElementById("district").disabled = true;
    }
    if (btn == 3) {
        //btn update update user and reload page
    }
}
</script>