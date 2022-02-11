<?php
//solves header issue
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <!-- CSS -->
    <link href="//fonts.googleapis.com/css?family=Oswald:300,400,500,600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/image/icon/icon.jpg">
    <!-- CSS -->
</head>

<body>
    <section class="w3l-specification-6">
        <!-- /specification-6-->
        <div class="specification-6-mian py-5">
            <div class="container py-lg-5">
                <div class="row story-6-grids text-left">
                    <div class="col-lg-5 story-gd">
                        <div class="wrap bg-dark border rounded">
                            </br>
                            <h4 class="text-center text-white mb-4">REGISTRATION</h4>
                            <div class="login-bghny p-md-5 p-4 mx-auto mw-100">

                                <form id="register" action="" method="post">
                                    <div id="tabPersonal">
                                        <div class="form-group text-center">
                                            <div class="btn-group btn-group-toggle" data-toggle="">
                                                <label class="btn active login-texthny mb-2" role="button">
                                                    <input type="radio" onclick="checkOption(3);" name="options"
                                                        value="3" required>Customer
                                                </label>
                                                <label class="btn login-texthny mb-2" role="button">
                                                    <input type="radio" onclick="checkOption(2);" name="options"
                                                        value="2">Petshop Owner
                                                </label>
                                            </div>
                                        </div>
                                        <small class="form-text text-warning">Required Field are marked *</small></br>
                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">First Name <span
                                                    class="text-warning">*</span></p>
                                            <input type="text" class="form-control" id="fname" placeholder=""
                                                name="fname" data-parsley-maxlength="10" data-parsley-ui-enabled="true"
                                                data-parsley-required="true" onkeyup="validate(this.id)" required>
                                            <p class="login-texthny mb-2 text-danger" id="fnameErrorMsg"></p>
                                        </div>

                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">Last Name <span
                                                    class="text-warning">*</span></p>
                                            <input type="text" class="form-control" id="lname" placeholder=""
                                                name="lname" onkeyup="validate(this.id)" required>
                                            <p class="login-texthny mb-2 text-danger" id="lnameErrorMsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">NIC <span
                                                    class="text-warning">*</span></p>
                                            <input type="text" class="form-control" id="nic" placeholder="" name="nic"
                                                onkeyup="validate(this.id); verifyUniqueness(this.id, this.value)"
                                                required>
                                            <p class="login-texthny mb-2 text-danger" id="nicErrorMsg"></p>
                                            <p class="login-texthny mb-2 text-danger" id="nicAjaxErrorMsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">Email address <span
                                                    class="text-warning">*</span></p>
                                            <input type="email" class="form-control" id="email" placeholder=""
                                                name="email"
                                                onkeyup="validate(this.id); verifyUniqueness(this.id, this.value)"
                                                required>
                                            <p class="login-texthny mb-2 text-danger" id="emailErrorMsg"></p>
                                            <p class="login-texthny mb-2 text-danger" id="emailAjaxErrorMsg"></p>
                                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your
                                                email
                                                with anyone else.</small> -->
                                        </div>

                                        <div class="form-group">
                                            <p class="login-texthny mb-2 text-white">Mobile <span
                                                    class="text-warning">*</span></p>
                                            <input type="text" class="form-control" id="phone" placeholder=""
                                                name="phone"
                                                onkeyup="validate(this.id); verifyUniqueness(this.id, this.value)"
                                                required>
                                            <p class="login-texthny mb-2 text-danger" id="phoneErrorMsg"></p>
                                            <p class="login-texthny mb-2 text-danger" id="phoneAjaxErrorMsg"></p>
                                        </div>
                                        <div class="form-group" id="passwordDIV">
                                            <p class="login-texthny mb-2 text-white">Password <span
                                                    class="text-warning">*</span></p>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" placeholder=""
                                                    name="password" onkeyup="validate(this.id)" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text text-black"><i class="fa fa-eye"
                                                            id="togglePassword" style="cursor: pointer;"
                                                            onclick="viewpassword()"></i></div>
                                                </div>
                                            </div>
                                            <p class="login-texthny mb-2 text-danger" id="passwordErrorMsg"></p>
                                        </div>
                                        <div class="form-group" id="cpasswordDIV">
                                            <p class="login-texthny mb-2 text-white">Confirm Password <span
                                                    class="text-warning">*</span></p>
                                            <input type="password" class="form-control" id="cpassword" placeholder=""
                                                name="cpassword" onkeyup="validate(this.id)" required>
                                            <p class="login-texthny mb-2 text-danger" id="cpasswordErrorMsg"></p>
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-success submit-login btn mb-4" id="regis"
                                        name="register" value="Register" title="">
                                        <small class="form-text text-white">Already have an account? <a href="login.php" class="text-warning">Login</a></small></br>
                                </form>

                            </div>
                        </div>
                        <?php
        if (isset($_POST['register'])) {
            include 'include/functions.php';
            //Fetch data from the fields
              
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $nic = $_POST['nic'];
            //$gender = $_POST['gender'];
            //$dob = $_POST['dob'];
            $street = "";
            $town = "";
            $district = 1;
            $email = $_POST['email'];
            $mobile = $_POST['phone'];
            $reg = date("Y/m/d G:i:s");
            $psd = password_hash($_POST['password'], PASSWORD_DEFAULT); //hash password using md5
            $status = -1;
            $role = $_POST['options'];

            //empty
            $long = "";
            $lat = "";
            $lastLogin = "";

            // ********** If user not already exits (check email, phone, NIC)
            //give errror message

            //addUser($fname, $lname, $gender, $dob, $street, $town, $district, $email, $mobile, $reg, $psd, $status, $role);
            $result = addUser($fname, $lname, $nic, "", "", $street, $town, $district, $email, $mobile, $reg, $psd, $status, $long, $lat, $lastLogin, $role);

            if ($result) {
                //**********get registration success message
                if ($role == 3) {
                    //activate account first
                    //send email
                    //hash user id
                    $userID = getUserID($email);
                    $hashid = password_hash($userID, PASSWORD_DEFAULT);
                    //$_SESSION['activateUserID'] = $userID;
                    $subject="Activate Your E-Petshop Account";
                    $body='Click <a href="http://localhost/epetshop/activated.php?key='.$hashid.'" target="_blank">here</a> to activate your key <br><br>
                    If you did not make this request, please disregard this email.';
                    sendEmail($email, $fname, $lname, $subject, $body);

                    //get admin id
                    $adminID = getAdminID();
                    //send admin notif
                    //addNotif($userID, $title, $message, $date, $status)
                    $ntitle = "New Customer Registered";
                    $nmessage = $userID;
                    $ndate = date("Y/m/d G:i:s");
                    $nstatus = 1;
                    addNotif($adminID, $ntitle, $nmessage, $ndate, $nstatus);

                    header('Location: activateAccount.php');
                //send notif to admin, a customer has join
                    //sendEmail("epetshopbse@gmail.com", "e", "petshop", "New Customer Registration", "A new customer has join e-petshop,
                    //Click to view customer details <br> Customer Name : $fname $lname");

                    //echo "<script>window.location.href='login.php';</script>";
                } elseif ($role == 2) {
                    //get userID and send as query parameter xxx
                    //create a session tmpUserID
                    $userID = getUserID($email);
                    $_SESSION['tmpUserID'] = $userID;

                    //activate account first
                    //send email
                    //hash user id
                    $userID = getUserID($email);
                    $hashid = password_hash($userID, PASSWORD_DEFAULT);
                    //$_SESSION['activateUserID'] = $userID;
                    $subject="Activate Your E-Petshop Account";
                    $body='Click <a href="http://localhost/epetshop/activated.php?key='.$hashid.'&ref=2" target="_blank">here</a> to activate your key <br><br>
                    If you did not make this request, please disregard this email.';
                    sendEmail($email, $fname, $lname, $subject, $body);

                    //send notif to admin
                    //get admin id
                    $adminID = getAdminID();
                    //send admin notif
                    //addNotif($userID, $title, $message, $date, $status)
                    $ntitle = "New Petshop-Owner Registered";
                    $nmessage = $userID;
                    $ndate = date("Y/m/d G:i:s");
                    $nstatus = 1;
                    addNotif($adminID, $ntitle, $nmessage, $ndate, $nstatus);

                    //activate account => then registerpetshop
                    header('Location: activateAccount.php');

                    //header('Location: registerPetshop.php');
                    //    echo "<script>window.location.href='registerPetshop.php';</script>";
                }
            } else {
                //**********get registration failed message
                //header('Location: ecommerce.php');
                echo "<script>window.location.href='register.php';</script>";
            }
        }
?>
                    </div>

                    <!-- Customer description-->
                    <div class="col-lg-7 story-gd pl-lg-4" id="CustDesc">
                        <a class="navbar-brand" href="index.php">
                            <h3 class="hny-title"><span>E </span>Petshop</h3>
                        </a>
                        <p></p>

                        <div class="row story-info-content mt-md-5 mt-4">

                            <div class="col-md-6 story-info">
                                <h5> <a href="#">01. Visit E-Petshop</a></h5>
                                <p>A wide range of products for all pets availabe.</p>


                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">02. Add To Cart</a></h5>
                                <p>Select the products you need for your pets and add them to your shopping cart.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">03. Checkout</a></h5>
                                <p>Checkout when you finish your shopping.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">04. Fast Delivery</a></h5>
                                <p>You products are deliered at your door step within 2 business days.</p>
                            </div>
                        </div>

                    </div>
                    <!-- //Customer description-->

                    <!-- Owner description-->
                    <div class="col-lg-7 story-gd pl-lg-4" id="OwnerDesc">
                        <a class="navbar-brand" href="index.php">
                            <h3 class="hny-title"><span>E </span>Petshop</h3>
                        </a>
                        <p></p>

                        <div class="row story-info-content mt-md-5 mt-4">

                            <div class="col-md-6 story-info">
                                <h5> <a href="#">01. Setup E-Petshop</a></h5>
                                <p>Insert the required details about your petshop.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">02. Add Products</a></h5>
                                <p>Add your products and categories them accordingly.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">03. Make Sales</a></h5>
                                <p>Attract more customers to increase sales.</p>
                            </div>
                            <div class="col-md-6 story-info">
                                <h5> <a href="#">04. Connect With Customers</a></h5>
                                <p>Keep in touch with existing and prospect customers.</p>
                            </div>
                        </div>
                    </div>
                    <!-- //Owner description-->
                </div>
            </div>
        </div>
    </section>
    <!-- //specification-6-->
</body>

</html>


<script src="assets/js/validateRegister.js"></script>
<script>
//view password
function viewpassword() {

    var password = document.getElementById('password');
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}


//hide confirmbtn
//document.getElementById("cpasswordDIV").style.display = "none";

function showconfirmbtn() {
    //unhide confirmbtn
    //document.getElementById("cpasswordDIV").style.display = "block";
}

//enable register button if password == confirmpassword
document.getElementById("regis").disabled = true;
document.getElementById("regis").title = "Fill form";

function checkpassword(isvalid) {
    //showconfirmbtn();
    if (!isvalid) {
        document.getElementById("regis").disabled = true;
        document.getElementById("regis").title = "Fill form";
    } else {
        var pass = document.getElementById("password").value;
        var cpass = document.getElementById("cpassword").value;
        if ((pass == cpass) && (pass != "")) {
            document.getElementById("regis").disabled = false;
            document.getElementById("regis").title = "Register Now";
        } else {

            document.getElementById("regis").disabled = true;
            document.getElementById("regis").title = "Fill form";
        }
    }
}

//get radion button element by name

var c = document.getElementById("CustDesc");
var o = document.getElementById("OwnerDesc");
//var tabpersonal = document.getElementById("tabPersonal");
var btnnext = document.getElementById("next");
var btnregis = document.getElementById("regis");



//default: hide o show c
//hide 0 show c
o.style.display = "none";
c.style.display = "block";
//tabpersonal.style.display = "block";
btnnext.style.display = "none";
btnregis.style.display = "inline";

function checkOption(role) {
    //var role = documement.getElementsByName('options').value;


    if (role == 2) {
        document.getElementById("regis").value = "    Next    ";

        //hide c show o
        o.style.display = "block";
        c.style.display = "none";

    } else if (role == 3) {
        document.getElementById("regis").value = "Register";

        //show c hide o
        o.style.display = "none";
        c.style.display = "block";
    }
}

/*function nextTab() {
        tabpet.style.display = "block";
        tabpersonal.style.display = "none";
        btnback.style.display = "inline";
        btnnext.style.display = "none";
        btnregis.style.display = "inline";
    

}
function backTab() {
    //btnback.style.display = "none";
    //tabpet.style.display = "none";
    btnnext.style.display = "inline";
    btnregis.style.display = "none";
    //tabpersonal.style.display = "block";
}
*/
</script>
<?php include "bottomScripts.php"; ?>

<script>
//ajax call to verify NIC, email, phone
function verifyUniqueness(field, value) {

    if (value != "") {
        $.ajax({
            url: 'ajax/registerAction.php',
            data: {
                registerAction: field,
                v: value
            },
            type: 'post',
            success: function(data) {

                $('#' + field + 'AjaxErrorMsg').html(data);
                if (data != "") {
                    checkpassword(false);
                }
            }
        });
    }
}
</script>