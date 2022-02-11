<?php
if(!isset($_SESSION)){
    session_start();
}
include 'include/common.php';
//include 'include/dbConnection.php';
include 'include/functions.php';
//Check if session roleid exists
if (isset($_SESSION["roleid"])) {
    $session_roleID = $_SESSION["roleid"];
    $userid = $_SESSION["userid"];
}else{
    $session_roleID = 0;
    $userid=0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $title = "Receipt";
    include 'include/header.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <?php
if(isset($_GET['order'])){
    $order_ = $_GET['order'];
}

//customerdetails
//fetch product from database, using session userid
$sql = "CALL sp_getUserDetails($userid);";
$result = $conn->query($sql);
$output = "";
if ($result -> num_rows > 0) {
    //output data for each row
    while ($row = $result->fetch_assoc()) {
        $fname = $row['firstName'];
        $lname = $row['lastName'];
        $nic = $row['nic'];
        $mobile = $row['mobile'];
        $email = $row['email'];
    }
}
 $result->close();
 $conn->next_result();

//order details
//fetch product from database, using session userid
$sql = "CALL sp_getPaidOrderByUserID($userid);";
$result = $conn->query($sql);
$output = "";
if ($result -> num_rows > 0) {
    //output data for each row
    while ($row = $result->fetch_assoc()) {
        $orderNo = $row['orderID'];
        $date = date('d M Y', strtotime($row['createdDateTime']));
        $remark = $row['status'];
        $qty = getPaidOrderDetailsNoOFProducts($order_);
        $total_ = getPaidOrderDetailsTotals($order_);

        $delivery = getDeliveryScheduleStatus($order_);
    }
}
 $result->close();
 $conn->next_result();

 //delivery address
 //get delivery schedule for address and maps location
$postcode = "";
$fulladdress = "";
$arrayResult = getDeliverySchedule($order_);
if ($arrayResult != null) {
if ($arrayResult -> num_rows > 0) {
 //output data for each row
 while ($row1 = $arrayResult->fetch_assoc()) {
     $street = $row1['street'];
     $town = $row1['town'];
     $district = $row1['name'];
     $postcode = $row1['postcode'];
     $longitude = $row1['longitude'];
     $latitude = $row1['latitude'];
     $fulladdress = $street. " ".$town.", ". $district;
 }
}
$arrayResult->close();
$conn->next_result();
}
?>

    <input type="text" id="orderid" value="<?php echo $orderNo;?>" disabled hidden>
    <div class="col-12 text-right"
        style="padding: 15px;solid #000;width: 80%;margin: 0 auto;position: relative;overflow: hidden;"><button
            class="btn btn-info" id="downloadPDF"><b>Download Receipt</b></button></div>
    <div id="content2"></br></br>
        <div style="background: #fff;border-bottom: 1px solid #ffffff;">
            <div class="tokenDet"
                style="padding: 15px;border: 1px solid #000;width: 80%;margin: 0 auto;position: relative;overflow: hidden;">
                <div class="title"
                    style="text-align: center; color: black; border-bottom: 1px solid #000;margin-bottom: 15px;">
                    <h2><b><span style="color:#ff7315;">E</span> Petshop</b></h2>
                    <h4>Receipt Order No: <?php echo $order_;?> </h4>
                </div>
                <div class="parentdiv" style="display: inline-block;width: 100%;position: relative;">
                    <div class="innerdiv" style="width: 80%;float: left;">
                        <div class="restDet">
                            <div class="div">
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Customer</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $fname . " " . $lname; ?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>NIC</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $nic; ?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Address</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $fulladdress;?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Postcode</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $postcode;?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Email</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $email;?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Mobile</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $mobile;?></span>
                                </div>
                                </br></br>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>No of products</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $qty;?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Total</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span>Rs<?php echo $total_;?></span>
                                </div>
                                <div class="label" style="width: 30%;float: left;">
                                    <strong>Status</strong>
                                </div>
                                <div class="data" style="width: 70%;display: inline-block;">
                                    <span><?php echo $delivery;?></span>
                                </div>
                                </br>
                                <hr>
                                <table border=1 class="col-12">
                                    <thead class="bg-light">
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Brand</th>
                                        <th>Cateogry</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </thead>
                                    <tbody>

                                        <?php
                                    //user orderID to populate this

                                $sql = "CALL sp_getProductLineDetailsByOrderID($order_, 'Order paid');";
                                $result = $conn->query($sql);
                                $bg=0;
                                $oldpetshop = 0;
                                $count = 0;

                            if ($result -> num_rows > 0) {
                                //output data for each row
                                while ($row = $result->fetch_assoc()) {
                                    $qty = $row['quantity'];
                                    $price = $row['price'];
                                    $pid = $row['productID'];
                                    $unit = $row['unit'];
                                    $number = $row['number'];
                                    $status = $row['status'];
                                    if($status == "Order Paid"){
                                        $status = "Pending";
                                    }
                                    $count++;
                                    //$qty = getPaidOrderDetailsNoOFProducts($orderNo);
                                    //$total = getPaidOrderDetailsTotals($orderNo);

                                    //Get product detail
                                    $resultArr = getProductDetailsByProductID($pid);
                                    
                                    
                                    if ($resultArr -> num_rows > 0) {
                                        //output data for each row
                                        while ($row = $resultArr->fetch_assoc()) {
                                            $pname = $row['pname'];
                                            $bname = $row['bname'];
                                            $desc = $row['description'];
                                            $img = $row['imgPath'];
                                            $pcname = $row['pcname'];
                                            $pdname = $row['prodname'];
                                            //petshop details
                                            $psname = $row['psname'];
                                            $psid = $row['petshopID'];

                                        
                                        }
                                    }
                                    $resultArr->close();
                                    $conn->next_result();
                                    
                                    //background
                                    if($bg == 0){
                                        $bg = 1;
                                    }else{
                                        $bg = 0;
                                    }

                                    if ($oldpetshop != $psid){
                                        $oldpetshop = $psid;
                                        echo '
                                    <!--<tr class="text-center bg-dark"><td colspan="6"><a class="text-white" href="viewPetshops.php#petshop'.$psid.'">'.strtoupper($psname).'</a></td></tr>-->';
                                    }

                                    echo '
                                    <tr class="'.(($bg == 1)?"cardbg":"").'">
                                <!--<td width="16%"><img src="product/'.$img.'" alt="Img" width="100%" height="100%"></td>-->
                                <td>'.$count.'</td>
                                <td>'.$number." ".$unit." ".$pname.'</td>
                                <td>'.$bname.'</td>
                                <td>'.$pcname." " .$pdname.'</td>
                                <td>'.$qty.'</td>
                                <td>'.$price.'</td>
                                </tr>';
                                }
                            }
                             $result->close();
                             $conn->next_result();

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="sideDiv" style="width: 20%;float: left;">
                        <div class="atts" style="float: left;width: 100%;">
                            <!--<div class="photo" style="width: 115px;height: 150px;float: right;">
                            <img src="brand/boyu.png" style="width: 100%;" />
                        </div>
                        <div class="sign"
                            style="position: absolute;bottom: 0;right: 0;border-top: 1px dashed #000;left: 80%;text-align: right;">
                            <small>Self Attested</small>
                        </div>-->
                            <div>
                                <div class="label">
                                    <strong>Payment Date</strong>
                                </div>
                                <div class="data">
                                    <span><?php echo $date;?></span>
                                </div>
                        </br>
                                <div class="label">
                                    <strong>Payment Method</strong>
                                </div>
                                <div class="data">
                                    <img src="paypal/paypalLogo.jpg" style="width:100px; height:72px;">
                                </div>
                            </div>

                            <!--<table class="col-1" style="position: absolute;bottom: 0;right: 0;">
                            <thead class="bg-light">
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <td>Rs <?php echo $total_;?></td>
                            </tbody>
                        </table>-->
                        </div>
                    </div>
                </div>
            </div>
        </div></br></br>
    </div>
</body>

</html>
<script>
/*
$('#cmd2').click(function() {
  	var options = {
		//'width': 800,
  	};
  	var pdf = new jsPDF('p', 'pt', 'a4');
  	pdf.addHTML($("#content2"), -1, 220, options, function() {
    	pdf.save('admit_card.pdf');
  	});
});
*/
$('#downloadPDF').click(function() {
    orderNo = document.getElementById('orderid').value;
    domtoimage.toPng(document.getElementById('content2'))
        .then(function(blob) {
            var pdf = new jsPDF('l', 'pt', [$('#content2').width(), $('#content2').height()]);

            pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
            pdf.save("Receipt_Order_" + orderNo + ".pdf");

            that.options.api.optionsChanged();
        });
});
</script>
<?php include "bottomScripts.php"; ?>