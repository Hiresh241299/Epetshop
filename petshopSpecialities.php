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
    $psid = getPetshopID($userid);
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
                                <li><a href="index.php">Home</a>
                                    <span class="fa fa-angle-double-right"></span>
                                </li>
                                <li class="active">My Specialites</li>
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
                            $sql = "CALL sp_getPetshopSpecialities($psid);";
                            $result = $conn->query($sql);
                            $output = "";

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $specialityID = $row['SID'];
                                    $spacialityName = $row['name'];
                                    $date = date('d M Y h:m', strtotime($row['createdDateTime']));
                                    $count++;

                                    echo '<tr>
                                <td>'.$count.'</td>
                                <td>'.$spacialityName.'</td>
                                <td>'.$date.'</td>
                                <td>
                                <button class="btn btn-danger" title="Delete" onclick=deleteSpeciality('.$specialityID.')><i class="fa fa-trash iblack"
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
                                            <select id="specialityv" name="specialityv" class="form-control">
                                                <option value="" selected>Select Speciality</option>
                                                <?php
                                            $sql = "CALL sp_getPetCategoriesNotInpetshop($psid);";
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

                                        <button type="submit" class="btn btn-success" name="addspeciality">Add
                                            speciality</button><br><br>
                                    </form>

                                    <?php
                                        
                                        if(isset($_POST['addspeciality'])){
                                            $sid = $_POST['specialityv'];
                                            $status = 1;
                                            $date = date("Y/m/d G:i:s");
                                            addPetshopSpeciality($psid,$sid, $date, $status);
                                            header('Location: petshopSpecialities.php');
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

function deleteSpeciality(specialityID) {
    //call ajax to delete speciality
    $.ajax({
        url: 'ajax/productAction.php',
        data: {
            sid:specialityID,
            action: "deleteSpeciality"
        },
        type: 'post',
        success: function(data) {
            if (data == 1) {
                //reload();
            }
        }
    });
    window.location.href='petshopSpecialities.php';
}

function reload(){
    //reload page
    window.location.href='petshopSpecialities.php';
}
</script>