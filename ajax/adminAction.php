<?php 
if(!isset($_SESSION)){
    session_start();
}
include '../include/functions.php';
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
echo $output;
?>