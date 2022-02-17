<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../include/functions.php';

$output = "";
if ((isset($_POST['registerAction'])) && (isset($_POST['v']))) {

    //nic
    if ($_POST['registerAction'] == 'nic') {
        //call function verify nic
        if (verifyNIC($_POST['v'])) {
            $output= "NIC Already exists";
        }
    }
    //email
    if ($_POST['registerAction'] == 'email') {
        //call function verify nic
        if (verifyEmail($_POST['v'])) {
            $output= "Email Already exists";
        }
    }
    //mobile
    if ($_POST['registerAction'] == 'phone') {
        //call function verify nic
        if (verifyMobile($_POST['v'])) {
            $output= "Mobile Number Already exists";
        }
    }
    //pname
    if ($_POST['registerAction'] == 'pname') {
        //call function verify nic
        if (verifyBusinessName($_POST['v'])) {
            $output= "Business Name Already exists";
        }
    }
    //brn
    if ($_POST['registerAction'] == 'brn') {
        //call function verify nic
        if (verifyBRN($_POST['v'])) {
            $output= "Business Registration Number Already exists";
        }
    }
}
echo $output;
