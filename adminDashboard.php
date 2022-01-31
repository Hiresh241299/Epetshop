<?php
include 'admininclude/verifyLogin.php';
$_SESSION['NavActive']="adminhome";

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
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <div class="welcome-msg pt-3 pb-4">
                    <!-- <h1>Hi <span class="text-primary">John</span>, Welcome back</h1>
                    <p>Very detailed & featured admin.</p>-->
                </div>

                <?php
                //count customer.petshop
                $sql = "CALL sp_getAllUsers('1');";
                $result = $conn->query($sql);
                $userCount = 0;
                $customerCount = 0;
                $vendorCount = 0;
                if ($result -> num_rows > 0) {
                    //output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $userCount++;
                        if($row['roleID'] == 2){
                            $vendorCount++;
                        }
                        if($row['roleID'] == 3){
                            $customerCount++;
                        }
                    }
                }
                $result->close();
                $conn->next_result();

                //Count Orders/Payment
                $sql = "CALL sp_getAllPayment();";
                $result = $conn->query($sql);
                $orderCount = 0;
                $total = 0;
                $percentgeIncome = 10;
                if ($result -> num_rows > 0) {
                    //output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $orderCount++;
                        $total += getPaidOrderDetailsTotals($row['orderID']);
                    }
                }
                $result->close();
                $conn->next_result();

                //calculate total income 10% of all sales
                ?>
                <!-- statistics data -->
                <div class="statistics">
                    <div class="row">
                        <div class="col-xl-6 pr-xl-2">
                            <div class="row">
                                <div class="col-sm-6 pr-sm-2 statistics-grid">
                                    <div class="card card_border border-primary-top p-4">
                                        <i class="lnr lnr-users"> </i>
                                        <h3 class="text-primary number"><?php echo $customerCount;?></h3>
                                        <p class="stat-text">Customers</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 pl-sm-2 statistics-grid">
                                    <div class="card card_border border-primary-top p-4">
                                        <i class="lnr lnr-store"> </i>
                                        <h3 class="text-secondary number"><?php echo $vendorCount;?></h3>
                                        <p class="stat-text">Petshops</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 pl-xl-2">
                            <div class="row">
                                <div class="col-sm-6 pr-sm-2 statistics-grid">
                                    <div class="card card_border border-primary-top p-4">
                                        <i class="lnr lnr-cart"> </i>
                                        <h3 class="text-success number"><?php echo $orderCount;?></h3>
                                        <p class="stat-text">Orders</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 pl-sm-2 statistics-grid">
                                    <div class="card card_border border-primary-top p-4">
                                        <i class="lnr lnr-briefcase"> </i>
                                        <h3 class="text-danger number">Rs <?php echo ($total/$percentgeIncome);?></h3>
                                        <p class="stat-text">Income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //statistics data -->

                <!-- charts -->
                <div class="chart">
                    <div class="row">
                        <div class="col-lg-6 pr-lg-2 chart-grid">
                            <div class="card text-center card_border">
                                <div class="card-header chart-grid__header">
                                    Bar Chart
                                </div>
                                <div class="card-body">
                                    <!-- bar chart -->
                                    <div id="container">
                                        <canvas id="barchart"></canvas>
                                    </div>
                                    <!-- //bar chart -->
                                </div>
                                <div class="card-footer text-muted chart-grid__footer">
                                    Updated 2 hours ago
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-lg-2 chart-grid">
                            <div class="card text-center card_border">
                                <div class="card-header chart-grid__header">
                                    Line Chart
                                </div>
                                <div class="card-body">
                                    <!-- line chart -->
                                    <div id="container">
                                        <canvas id="linechart"></canvas>
                                    </div>
                                    <!-- //line chart -->
                                </div>
                                <div class="card-footer text-muted chart-grid__footer">
                                    Updated just now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //charts -->

                <!-- Petshop join request -->
                <div class="accordions">
                    <div class="row">
                        <!-- accordion style 1 -->
                        <div class="col-lg-12 mb-4 accordion" id="accordionExample">
                            <div class="card card_border">
                                <div class="card-header chart-grid__header card__title">
                                    <a href="#" class="" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">Petshop Join Requests</a>
                                </div>
                                <div class="card-body">
                                    <div class="collapse show" id="collapseOne" data-parent="#accordionExample"
                                        aria-labelledby="headingOne">

                                        <!--Table-->
                                        <div class="table-responsive">
                                            <table id="" class="display dataTable no-footer" style="width:100%"
                                                role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column ascending"
                                                            style="width: 239px;" aria-sort="descending">Ref</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column ascending"
                                                            style="width: 239px;">User Name</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Designation: activate to sort column ascending"
                                                            style="width: 362px;">Joining Date</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Joining date: activate to sort column ascending"
                                                            style="width: 188px;">Last Login</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Status: activate to sort column ascending"
                                                            style="width: 195px;">Status</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
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
                                                    $limit = 0;
                                                    $oddOrEven = "even";
                                
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while (($row = $result->fetch_assoc()) && ($limit < 5)) {
                                                            $limit++;
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

                                                            if($oddOrEven == "odd")
                                                            {
                                                                $oddOrEven = "even";
                                                            }else{
                                                                $oddOrEven = "odd";
                                                            }
                                                        
                                                            echo '
                                                        <tr role="row" class="'.$oddOrEven.'">
                                                            <td>'.$userRole.'</span></td>
                                                            <td class=""><img src="assets/images/avatar5.jpg" class="rounded-circle mr-2" width="40px" alt="">'.$fname . " ". $lname.'</td>
                                                            <td class="">'.$joinDate.'</td>
                                                            <td class="">'.$lastLogin.'</td>
                                                            '.$status.'
                                                            <td>BTN</span></td>
                                                        </tr>
                                                            ';
                                                        
                                                        }
                                                    }
                                                    $result->close();
                                                    $conn->next_result();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--Table-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //accordion style 1 -->
                    </div>
                </div>
                <!-- //Petshop join request -->

                <!-- Recently joined users -->
                <div class="accordions">
                    <div class="row">
                        <!-- accordion style 1 -->
                        <div class="col-lg-12 mb-4 accordion" id="accordionExample">
                            <div class="card card_border">
                                <div class="card-header chart-grid__header card__title">
                                    <a href="#" class="" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="true" aria-controls="collapseTwo">Recently Joined Users</a>
                                </div>
                                <div class="card-body">
                                    <div class="collapse" id="collapseTwo" data-parent="#accordionExample"
                                        aria-labelledby="headingTwo">
                                        <!--datatable-->
                                        <div class="table-responsive">
                                            <table id="" class="display dataTable no-footer" style="width:100%"
                                                role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column ascending"
                                                            style="width: 239px;" aria-sort="descending">Ref</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Name: activate to sort column ascending"
                                                            style="width: 239px;">User Name</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Designation: activate to sort column ascending"
                                                            style="width: 362px;">Joining Date</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Joining date: activate to sort column ascending"
                                                            style="width: 188px;">Last Login</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                                            aria-label="Emp. Status: activate to sort column ascending"
                                                            style="width: 195px;">Status</th>
                                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"
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
                                                    $limit = 0;
                                                    $oddOrEven = "even";
                                
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while (($row = $result->fetch_assoc()) && ($limit < 5)) {
                                                            $limit++;
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
                                                        
                                                            if($oddOrEven == "odd")
                                                            {
                                                                $oddOrEven = "even";
                                                            }else{
                                                                $oddOrEven = "odd";
                                                            }

                                                            echo '
                                                        <tr role="row" class="'.$oddOrEven.'">
                                                            <td>'.$userRole.'</span></td>
                                                            <td class="">'.$fname . " ". $lname.'</td>
                                                            <td class="">'.$joinDate.'</td>
                                                            <td class="">'.$lastLogin.'</td>
                                                            '.$status.'
                                                            <td>BTN</span></td>
                                                        </tr>
                                                            ';
                                                        
                                                        }
                                                    }
                                                    $result->close();
                                                    $conn->next_result();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--datatable-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //accordion style 1 -->
                    </div>
                </div>
                <!-- //Recently joined users -->

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