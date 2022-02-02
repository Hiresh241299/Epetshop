<div class="header sticky-header">

    <!-- notification menu start -->
    <div class="menu-right">
        <div class="navbar user-panel-top">
            <!--<div class="search-box">
                        <form action="#search-results.html" method="get">
                            <input class="search-input" placeholder="Search Here..." type="search" id="search">
                            <button class="search-submit" value=""><span class="fa fa-search"></span></button>
                        </form>
                    </div>-->

            <?php
                                        $notifOutput = "";
                                        //Load notif from database\
                                        $adminid= $_SESSION['userid'];
                                        $limit = 0;
                                        $count = 0;
                                        $sql = "CALL sp_getNotif($adminid);";
                                        $result = $conn->query($sql);
                                        if ($result -> num_rows > 0) {
                                            //output data for each row
                                            while (($row = $result->fetch_assoc()) && ($limit < 5)){
                                                $limit++;
                                                $NID = $row['NID'];
                                                $title = $row['title'];
                                                //contains userid
                                                $message = $row['message'];
                                                $NID = $row['NID'];
                                                $date = $row['createdDateTime'];
                                                $status = $row['status'];
                                                $timeLapsed = time_elapsed_string($date, false);
                                                if($status == 1){
                                                    $count++;
                                                }
                                                $notifOutput .='
                                                <li class="odd"><a href="#" class="grid">
                                                    <div class="user_img text-center"><h5 class="bg-light border rounded">'.strtoupper((getUserDetails($message,"lastname"))[0]).'</h5></div>
                                                    <div class="notification_desc">
                                                    <p>'.$title.'</p>
                                                    <p>'.getUserDetails($message,"fullName").'</p>
                                                    <span>'.$timeLapsed.'</span>
                                                </div>
                                                </a></li>
                                                ';
                                            }
                                        }
                                        $result->close();
                                        $conn->next_result();
                                        ?>
            <div class="user-dropdown-details d-flex">
                <div class="profile_details_left">
                    <ul class="nofitications-dropdown">
                        <li class="dropdown">
                            <a href="#" onclick="UpdateNotif(<?php echo $adminid;?>)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                    class="fa fa-bell"></i><span id="notifbadge" class="badge blue"><?php echo $count;?></span></a>
                            <ul class="dropdown-menu">
                                <?php echo $notifOutput;?>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#all" class="bg-primary">See all notifications</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                    class="fa fa-comment"></i><span class="badge blue">4</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 4 new messages</h3>
                                    </div>
                                </li>
                                <li><a href="#" class="grid">
                                        <div class="user_img"><img src="adminassets/images/avatar1.jpg" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Johnson purchased template</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a></li>
                                <li class="odd"><a href="#" class="grid">
                                        <div class="user_img"><img src="adminassets/images/avatar2.jpg" alt=""></div>
                                        <div class="notification_desc">
                                            <p>New customer registered </p>
                                            <span>1 hour ago</span>
                                        </div>
                                    </a></li>
                                <li><a href="#" class="grid">
                                        <div class="user_img"><img src="adminassets/images/avatar3.jpg" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Lorem ipsum dolor sit amet </p>
                                            <span>2 hours ago</span>
                                        </div>
                                    </a></li>
                                <li><a href="#" class="grid">
                                        <div class="user_img"><img src="adminassets/images/avatar1.jpg" alt=""></div>
                                        <div class="notification_desc">
                                            <p>Johnson purchased template</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#all" class="bg-primary">See all messages</a>
                                    </div>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="profile_img">
                                    <img src="adminassets/images/profileimg.jpg" class="rounded-circle" alt="" />
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                                <li class="user-info">
                                    <h5 class="user-name">Hiresh Mohun</h5>
                                </li>
                                <li> <a href="#"><i class="lnr lnr-user"></i>My Profile</a> </li>
                                <li> <a href="#"><i class="lnr lnr-cog"></i>Setting</a> </li>
                                <li class="logout"> <a href="login.php"><i class="fa fa-power-off"></i>
                                        Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--notification menu end -->
</div>