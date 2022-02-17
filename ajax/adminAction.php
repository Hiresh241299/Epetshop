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

//update notif
if((isset($_POST['UpdateNotif'])) && (isset($_POST['adminID']))){
    //notif
    if($_POST['UpdateNotif'] == 2){
        //update notif, set status 2
        updateNotif($_POST['adminID'], 2);
        $output = 0;
    }
}

//update petshop status
if((isset($_POST['UpdatePetshop'])) && (isset($_POST['sts']))){

    if(updatePetshopStatus($_POST['UpdatePetshop'], $_POST['sts'])){
        $output = 1;
        //get user email via petshop
        $id= $_POST['UpdatePetshop'];
        $sql = "CALL sp_getUserEmailViaPetshopID($id);";
        $result = $conn->query($sql);
        $output = "";
        $email = "";
        $fname = "";
        $lname = "";
        if ($result -> num_rows > 0) {
        //output data for each row
            while ($row = $result->fetch_assoc()) {
                 $email = $row['email'];
                 $fname = $row['firstName'];
                 $lname = $row['lastName'];
            }
        }
        if($_POST['sts'] == 1){
            //send email that account has been verified
$subject = "E-Petshop Account Activate";
$body = "Your E-petshop account has been activated. Your are now able to access full features to promote your petshop and sell your products.
Click  <a href=\"http://localhost/epetshop/login.php\" target=\"_blank\">here</a> to login.
";
            sendEmail($email, $fname, $lname, $subject, $body);
        }
        if($_POST['sts'] == 0){
            //send email that account has been blocked
            $subject = "E-Petshop Account block";
$body = "Your E-petshop account has been blocked.";
            sendEmail($email, $fname, $lname, $subject, $body);
        }
        $output = 1;
    }else{
        $output = 0;
    }
}
echo $output;
?>