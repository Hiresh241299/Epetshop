<?php 
if(!isset($_SESSION)){
    session_start();
}
include '../admininclude/functions.php';
$output = "";
if((isset($_POST['adminAction'])) && (isset($_POST['v']))){

    //brand
    if($_POST['adminAction'] == 'br'){
        //call function get brand
        if(verifyNIC($_POST['v'])){
            $output= "NIC Already exists";
        }
    }

    //p,pro,loc

}

if((isset($_POST['UpdateNotif'])) && (isset($_POST['adminID']))){
    //brand
    if($_POST['UpdateNotif'] == 2){
        //update notif, set status 2
        updateNotif($_POST['adminID'], 2);
        $output = 0;
    }
}
echo $output;
?>