<?php
include 'admininclude/verifyLogin.php';
$_SESSION['NavActive'] = "adminviewuser";

if(!isset($_SESSION)){
    session_start();
}
if (isset($_GET['rid'])){
    $rid = $_GET['rid'];
    if($rid == 2){
        $viewUserTitle = "Petshop Owner Info";
    }
    if($rid == 3){
        $viewUserTitle = "Customer Info";
    }
    if($rid != 2 && $rid != 3){
        $viewUserTitle = "User Info";
    }
}else{
    $rid = 0;
    $viewUserTitle = "User Info";
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
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $viewUserTitle;?></li>
                    </ol>
                </nav>
                <div class="welcome-msg pt-3 pb-4">
                    <!--<h1>Hi <span class="text-primary">John</span>, Welcome back</h1>
                    <p>Very detailed & featured admin.</p>-->
                </div>

                <!-- Datatable-->
                <div class="data-tables">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card card_border p-4">
                                <h3 class="card__title position-absolute"><?php echo $viewUserTitle;?></h3>
                                <div class="table-responsive">
                                    <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="dataTables_length" id="example_length"><label></label></div>
                                        <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                            <div class="dataTables_length" id="example_length"><label></label></div>
                                            <!--<div id="example_filter" class="dataTables_filter"><label><input
                                                        type="search" class="" placeholder="Search"
                                                        aria-controls="example"></label></div> -->
                                            <table id="example" class="display dataTable no-footer" style="width:100%"
                                                role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column descending"
                                                            style="width: 239px;" aria-sort="ascending">Ref</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column descending"
                                                            style="width: 239px;" aria-sort="ascending">User Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Designation: activate to sort column ascending"
                                                            style="width: 362px;">Joining Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Joining date: activate to sort column ascending"
                                                            style="width: 188px;">Last Login</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Emp. Status: activate to sort column ascending"
                                                            style="width: 195px;">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Emp. Status: activate to sort column ascending"
                                                            style="width: 195px;">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //get all users
                                                    //sp_getAllUsers (where roleID != '')

                                                    //Load all users from database
                                                    $sql = "CALL sp_getAllUsers('1');";
                                                    $result = $conn->query($sql);
                                
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result->fetch_assoc()) {

                                                            $fname = $row['firstName'];
                                                            $lname = $row['lastName'];
                                                            $joinDate = date('d-m-Y h:m:s', strtotime($row['registrationDate']));
                                                            //$status = $row['status'];

                                                            if($row['status'] == -1){
                                                                $status = '<td><span class="badge badge-danger">Invalid</span></td>';
                                                            }
                                                            if($row['status'] == 0){
                                                                $status = '<td><span class="badge badge-warning">Inactive</span></td>';
                                                            }
                                                            if($row['status'] == 1){
                                                                $status = '<td><span class="badge badge-success">Active</span></td>';
                                                            }

                                                            $lastLogin = date('d-m-Y h:m:s', strtotime($row['lastLoginDateTime']));
                                                            if($row['roleID'] == 1){
                                                                $userRole = "Admin";
                                                            }
                                                            if($row['roleID'] == 2){
                                                                $userRole = "Petshop Owner";
                                                            }
                                                            if($row['roleID'] == 3){
                                                                $userRole = "Customer";
                                                            }
                                                        
                                                            $display = '
                                                            <tr role="row" class="odd">
                                                                <td>'.$userRole.'</span></td>
                                                                <td class="sorting_1">'.$fname . " ". $lname.'</td>
                                                                <td class="">'.$joinDate.'</td>
                                                                <td class="">'.$lastLogin.'</td>
                                                                '.$status.'
                                                                <td>BTN</span></td>
                                                            </tr>
                                                            ';
                                                            
                                                            if($rid == 2){
                                                                if($row['roleID'] == 2){
                                                                    echo $display;
                                                                }
                                                            }
                                                            if($rid == 3){
                                                                if($row['roleID'] == 3){
                                                                    echo $display;
                                                                }
                                                            }
                                                            if($rid != 2 && $rid != 3){
                                                                echo $display;
                                                            }
                                                            
                                                        
                                                        }
                                                    }
                                                    $result->close();
                                                    $conn->next_result();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                            Showing 1 to 5 of 19 entries</div>
                                        <div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a
                                                class="paginate_button previous disabled" aria-controls="example"
                                                data-dt-idx="0" tabindex="-1" id="example_previous">Previous</a><span><a
                                                    class="paginate_button current" aria-controls="example"
                                                    data-dt-idx="1" tabindex="0">1</a><a class="paginate_button "
                                                    aria-controls="example" data-dt-idx="2" tabindex="0">2</a><a
                                                    class="paginate_button " aria-controls="example" data-dt-idx="3"
                                                    tabindex="0">3</a><a class="paginate_button "
                                                    aria-controls="example" data-dt-idx="4" tabindex="0">4</a></span><a
                                                class="paginate_button next" aria-controls="example" data-dt-idx="5"
                                                tabindex="0" id="example_next">Next</a></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Datatable-->
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