<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../include/functions.php';
$output = "Invalid Account";
if ((isset($_POST['action']) && ($_POST['action'] == "login"))) {
    //Fetch data from Login form
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $isChecked = $_POST['check'];
    $accountActivated = "";

                            
    $sql = "CALL sp_getAllTypeUsers();";
    $result = $conn->query($sql);
    if ($result -> num_rows > 0) {
        
        //output data for each row
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $userEmail) {
                if (password_verify($userPassword, $row['password'])) {
                    
                    //update status
                    if ($row['status'] == -1) {
                        $accountActivated = "notActivated";
                        $output = "Account has not been Activated, please check your email account";
                    }
                    if ($row['status'] == 1) {
                        $accountActivated = "activated";
                        $output = "";
                    }
                    if ($row['status'] == 0) {
                        $accountActivated = "accountBlocked";
                        $output = "Account block";
                    }
                }
            }
        }
    }
    $result->close();
    $conn->next_result();

    if ($accountActivated == "activated") {
        //verify user credentials
        if ((verifyUserCredentials($userEmail, $userPassword)) == true) {
            //create session for this user
            $_SESSION['userid'] = getUserID($userEmail);
            $_SESSION['roleid'] = getUserRole($userEmail);

            $userID = $_SESSION['userid'];

            //update user last login datetime
            $lastLogin = date("Y/m/d G:i:s");
            updateUserLogin($lastLogin, $userID);

                
            saveCartInDb($userID);
            //clear cookies
            //clear session if exists
            unset($_SESSION['mycart']);
            $_SESSION['total_price'] = 0;
            setcookie("cart", null, -1, '/');
            //load cart
            //check if user have active order
            if (getActiveUserOrder($userID) > 0) {
                $orderID = getActiveUserOrder($userID);
                loadcart($orderID);
            }

            //if remember me is check, create cookie
            if ($isChecked) {
                //save email in cookie
                //$_COOKIE['email'] = $userEmail;
                setcookie("email", $userEmail, time() + (86400 * 30), "/");
            } else {
                //delete cookie if exists
                //$_COOKIE['email'] = "";
                setcookie("email", null, -1, '/');
            }
            //check role id to redirect to appropriate page
            $roleid = getUserRole($userEmail);
            if ($roleid == 1) {
                $output = 1;
            //header('location: adminDashboard.php');
            } elseif ($roleid == 2) {
                //header('Location: petshopHome.php');
                $output = 2;
            } elseif ($roleid == 3) {
                $output = 3;
                //header('Location: index.php');
            }
        }
        //credentials does not match ********** DISPLAY ERROR MESSAGE HERE
        else {
            $_SESSION['roleid'] = 0;
        }
    }
}
echo $output;
