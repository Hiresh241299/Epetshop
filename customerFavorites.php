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
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'include/header.php';
    ?>

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
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Favorites</li>
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
                                    <!-- Datatable -->
                                    <table id="table_id" class="display" width="100%" border=2>
                                        <thead>
                                            <tr class="bg-warning">
                                                <th>No</th>
                                                <th>Specialities</th>
                                                <th>Date</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- repeat within body-->
                                            <?php
                                $count=0;
                            //fetch product from database, using session userid
                            $sql = "CALL 	sp_getUserFavorite($userid);";
                            $result = $conn->query($sql);
                            $output = "";

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $favoriteID = $row['FID'];
                                    $favoriteName = $row['name'];
                                    $date = date('d M Y h:m', strtotime($row['createdDateTime']));
                                    $count++;

                                    echo '<tr>
                                <td>'.$count.'</td>
                                <td>'.$favoriteName.'</td>
                                <td>'.$date.'</td>
                                <td>
                                <button class="btn btn-danger" title="Delete" onclick=deleteSpeciality('.$favoriteID.')><i class="fa fa-trash iblack"
                                aria-hidden="true"></i></button>
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
                                    <hr>
                                    <br>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">Speciality</p>
                                            <select id="favorite" name="favorite" class="form-control">
                                                <option value="" selected>Select Speciality</option>
                                                <?php
                                            $sql = "CALL 	sp_getUserFavoriteDropdown($userid);";
                                            $result = $conn->query($sql);
                
                                            if ($result -> num_rows > 0) {
                                                //output data for each row
                                                while ($row = $result->fetch_assoc()) {
                                                    $id = $row['petcatID'];
                                                    $name = $row['name'];
                                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                                }
                                            }
                                             $result->close();
                                             $conn->next_result();
                                            ?>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-success" name="addfavorite">Add
                                            speciality</button><br><br>
                                    </form>

                                    <?php
                                        
                                        if(isset($_POST['addfavorite'])){
                                            $sid = $_POST['favorite'];
                                            $status = 1;
                                            $date = date("Y/m/d G:i:s");
                                            addUserFavorite($userid,$sid, $date, $status);
                                            header('Location: customerFavorites.php');
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
<script>
//initialising datatable
$(document).ready(function() {
    $('#table_id').DataTable();
});
$('#table_id').DataTable().columns.adjust();
</script>
<script>
//default
//document.getElementById("editBTN").style.display = "inline";
//document.getElementById("cancelUpdate").style.display = "none";

function deleteSpeciality(favoriteID) {
    //call ajax to delete speciality
    $.ajax({
        url: 'ajax/productAction.php',
        data: {
            fid:favoriteID,
            action: "deleteFavorite"
        },
        type: 'post',
        success: function(data) {
            if (data == 1) {
                //reload();
            }
        }
    });
    window.location.href='customerFavorites.php';
}

function reload(){
    //reload page
    window.location.href='customerFavorites.php';
}
</script>