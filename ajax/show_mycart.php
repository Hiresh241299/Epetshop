<?php
include("../include/functions.php");
if (!isset($_SESSION)) {
    session_start();
}

$total = 0;
$to = 0;
$output = "";
$errorMSG ="";
$valid = 1;

/*$output .= '
<!--Display carts-->
<div class="mag-post-left-hny col-lg-8">
';*/
 
if (!empty($_SESSION['mycart'])) {
    foreach ($_SESSION['mycart'] as $key => $value) {

    //Get product line details
        $productLineID = $value['id'];
        //sp_getProductLineDetailsByProductLineID($productLineID);
        $sql = "CALL sp_getProductLineDetailsByProductLineID($productLineID);";
        $result = $conn->query($sql);

        if ($result -> num_rows > 0) {
            //output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['productID'];
                $pname = $row['pname'];
                $brand = $row['bname'];
                $desc= $row['description'];
                //shorten desc
                if (strlen($desc) > 100) {
                    $desc = substr($desc, 0, 100) . "...";
                }
                $img = $row['imgPath'];
                $prodcat = $row['pcname'];
                $petCat = $row['sname'];
                $postedDT = $row['postedDateTime'];
                $lastMDT = $row['lastModifiedDateTime'];
                $petshopID = $row['petshopID'];
                $petshopName = $row['petshop'];
                $unit = $row['unit'];
                $number = $row['number'];
                $qoh = $row['qoh'];
                $price = $row['price'];

                //check quantity availe
                if ($value['quantity'] > $qoh) {
                    $errorMSG = "Quantity not available!";
                    $valid = 0;
                } else {
                    $errorMSG = "";
                }
            }
        }
        $result->close();
        $conn->next_result();

        $output .='
    <!--Repeat-->
                        <div class="mag-hny-content">
                            <!--/set-1-->
                            <div class="blog-pt-grid-content">
                            <!--Remove single product from cart-->
                            <button class="btn btn-danger remove float-right" id="'.$value['id'].'" title="Delete Product">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                                <div class="maghny-gd-1 blog-pt-grid mb-5 blog-sidebar-bg">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <img class="" src="product/'.$img.'" alt="Product Image" style="width:75%;">
                                      </div>
                                      <div class="col-md-6">
                                        <h5>'.$number." ".$unit." ".$pname. " | " .$brand.'</h5>
                                        <small><a href="viewPetshops.php#petshop'.$petshopID.'"><u>'.$petshopName.'</u></a></small>
                                        <p><b>Pet: </b> '.$petCat."  ".'<b>Type: </b>'.$prodcat.'</p>
                                        <p>'.$desc.'</p>
                                        <h5>Rs '.$value['price'].' <p>('.$qoh.' Left)</p></h5>
                                        <p class="text-danger" id="quantityErrorMsg">'.$errorMSG.'</p>
                                      </div>
                                      <div class="col-md-2">
                                      </br>
                                        <p class="text-center" ><b>Quantity</b></p>
                                        <div class="quantity buttons_added">

                                        <input type="button" id="btnminus'.$value['id'].'" name="'.$value['id'].'" onclick=checkQuantity('.$value['id'].','.$qoh.') value="-" class="minus col-4 reduceQTY">
                                        
                                        <input
                                        type="text" step="1" min="1" max="100" name="quantity"
                                        id="quantity'.$value['id'].'" value="'.$value['quantity'].'" title="Qty"
                                        class="input-text qty text bg-white col-4" size="4" pattern=""
                                        inputmode="" disabled>

                                        <input type="button" id="btnplus'.$value['id'].'" name="'.$value['id'].'" onclick=checkQuantity('.$value['id'].','.$qoh.') value="+" class="plus col-4 addQTY">
                                                                                
                                        </div>
                                      </div>
                                    </div>
                                    <!--<div class="entry-meta d-flex mt-3"><span class="entry-author">By <a href="#">
                                                Admin</a></span><span class="meta-separator">|</span>
                                        <a href="#">Jan 22, 2020</a><span class="meta-separator">|</span>
                                        <a href="#"> 0 comment</a>
                                    </div>-->
                                </div>
                            </div>
                            <!--//set-1-->

                        </div>
                        <!--Repeat-->
    ';

        $total = $total + $value['quantity'] * $value['price'];
        $_SESSION['total_price'] = $total;

        /*$output .= "
           <tr>
             <td hidden>".$value['id']."</td>
             <td>".$value['name']."</td>
             <td>$ ".$value['price']."</td>
             <td>".$value['quantity']."</td>
             <td>$".number_format($value['quantity'] * $value['price'], 2)."</td>
             <td>
               <button class='btn btn-danger remove' id='".$value['id']."'>Remove</button>
             </td>
        ";
        $total = $total + $value['quantity'] * $value['price'];
    $_SESSION['total_price'] = $total;*/
    }

    $output .='
<div class="row">
  <div class="col-md-4">
    <button class="btn btn-danger btn-block clearall" title="Delete All Products">Clear All</button>
  </div>
</div>
';

  
    /*$output .= '
  <!--Display total-->
                    <div class="mag-post-right-hny col-lg-4">
                        <aside>
                            <div class="blog-sidebar-bg">
                                <div class="side-bar-hny-recent mb-5">
                                    <h4 class="side-title">Order <span>Summary</span></h4>
                                    <hr>
                                    <h5>Total <p class="float-right"><h4>Rs'.number_format($total, 2).'</h4></p></h5>
                                    <div class="mag-small-post">
                                    <a href="stripe/"> <button class="btn btn-success btn-block"><b>Checkout</b></button></a>
                                    </br>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <!--Display total-->
  ';*/

    /*
    $output .= "
           <tr>
           <td hidden><b>#subscribe</b></td>
           <td><b>Total Price</b></td>
           <td><b>Rs".number_format($total, 2)."</b></td>
           <td>
              <a href='stripe/'> <button class='btn btn-warning btn-block' >Checkout</button></a>
              </td>
              <td>
                <a href='invoice.php'><button class='btn btn-info btn-block'>Invoice</button></a>
              </td>
              <td>
                <button class='btn btn-warning btn-block clearall' id='".$value['id']."'>Clear All</button>
              </td>

           </tr>
      "; */

    $to = count($_SESSION['mycart']);
} else {
}

$totalValue = $total;
$total = "Rs" . number_format($total, 2);


$data['da'] = $to;
$data['out'] = $output;
$data['total'] = $total;
$data['totalValue'] = $totalValue;
$data['valid'] = $valid;

echo json_encode($data);
