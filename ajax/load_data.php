<?php
include("../include/functions.php");
include("../include/dbConnection.php");


if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = 1;
}

if (isset($_POST['perpage'])) {
    if ($_POST['perpage'] == "All") {
        $perpage = 1000;
    } else {
        $perpage = $_POST['perpage'];
    }
} else {
    $perpage = 10;
}

if (isset($_POST['searchv']) && ($_POST['searchv']!= "")) {
    $searchValue = $_POST['searchv'];
} else {
    $searchValue = null;
}

if (isset($_POST['petshopID'])) {
    $_petshopID = $_POST['petshopID'];
    if ($searchValue == null) {
        $searchValue = "m";
    }
    //add 2 because of error
    //$perpage+= 2;
} else {
    $_petshopID = 0;
}

$pagination = '<div >
<ul class="pagination">';

//number of item in one page, drop down
$limit = $perpage;
$start = ($page - 1)* $perpage;

//$pages = mysqli_query($connect,"SELECT count(productLineID) AS id FROM productline;");
$total = 0;
if ($_petshopID > 0) {
    $sql = "CALL sp_countMyProducts($_petshopID);";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        $total++;
    }
$result->close();
$conn->next_result();
} else {
    $sql = "CALL sp_countProductLine();";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $total = $row['id'];
    }
$result->close();
$conn->next_result();
}

$count = ceil($total / $limit);
for ($i=1; $i <=$count ; $i++) {
    if ($page == $i) {
        $pagination .= '<a id="'.$i.'" href="" class="active">'.$i.'</a>';
    } else {
        $pagination .= '<a id="'.$i.'" href="" class="">'.$i.'</a>';
    }
}

$pagination .= '</ul>
</div>';
//$pagination="";

//sp_getAllProductLineDetailsWithLimitsSearch("search". $start, $limit);
if ($searchValue != null) {
    $sql = "CALL sp_getAllProductLineDetailsWithLimitsSearch('%$searchValue%', $start, $limit);";
} else {
    $sql = "CALL sp_getAllProductLineDetailsWithLimits($start, $limit);";
}
$result = $conn->query($sql);

$outputRow = "";
$showresult = 0;

$output = "";
if ($result -> num_rows < 1) {
    $output .="<h3>No products available</h3>";
} else {
    //output data for each row
    while ($row = $result->fetch_assoc()) {
        $pid = $row['plID'];
        $pname = $row['pname'];
        $brand = $row['bname'];
        $desc= $row['description'];
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
        $priceDisplay = 'Rs'  . $price ;
        $productID = $row['productID'];
        $showresult++;
         
        //get discount
        $percentage = "";
        $start = "";
        $end = "";
        $date = "";
        $percentageDisplay="";
        $newprice = $price;
        $arrayResult = getDiscount($pid, "active");
        if ($arrayResult != null) {
            if ($arrayResult -> num_rows > 0) {
                //output data for each row
                while ($row1 = $arrayResult->fetch_assoc()) {
                    $percentage = $row1['percentage'];
                    $percentageDisplay = $percentage . '%';
                    $start = date('d-m-Y', strtotime($row1['startDate']));
                    $end = date('d-m-Y', strtotime($row1['endDate']));
                    $date = $start . " to " . $end;
                    $newprice = (($price * (100 - $percentage))*0.01);
                    $priceDisplay = '<del>'.$priceDisplay.'</del>' ." " .'<b class="text-danger">Rs'  . $newprice .'<br>'.daysleft($end).'day'.((daysleft($end)>1)?"s":"").' left</b>';
                }
            }
            $arrayResult->close();
            $conn->next_result();
        }

        $outputRow = '
		 <!-- Post Starts-->
		 <div class="col-lg-3 col-6 product-incfhny mb-4 cardbg border border-white border-rounded">
         </br>
                                <div class="product-grid2 transmitv">
                                    <div class="product-image2">
                                        <a href="viewProductDetails.php?prodid='.$pid.'">
                                            <img class="pic-1 img-fluid" src="product/'.$img.'">
                                            <img class="pic-2 img-fluid" src="product/'.$img.'">
                                        </a>
                                        <ul class="social">
                                            <li><a href="viewProductDetails.php?prodid='.$pid.'" data-tip="Quick View"><span class="fa fa-eye"></span></a>
                                            </li>

                                            <!--<li><a href="ecommerce.html" data-tip="Add to Cart"><span
                                                        class="fa fa-shopping-bag"></span></a>
                                            </li>-->
                                        </ul>
                                        <div class="transmitv single-item">
                                        <form action="#" method="post">
                                            <input type="hidden" name="id" value="'.$pid.'" id="'.$pid.'">
                                            <input type="hidden" name="quantity" value="1" id="quantity'.$pid.'">
                                            <input type="hidden" name="name" value="'.$pname. " ".$number. " " .$unit.'" id="name'.$pid.'">
                                            <input type="hidden" name="price" value="'.$newprice.'" id="price'.$pid.'">
                                            <button type="submit" class="transmitv-cart ptransmitv-cart add-to-cart add_cart" name="add" id="'.$pid.'">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="viewProductDetails.php?prodid='.$pid.'">'.$pname . " ".$number. " " .$unit.'</a> | <a href="#brand">'.$brand.'</a></h3>
                                    <!-- <span class="price"><del>$975.00</del>Rs2200</span> -->
                                    <span class="price">'.$priceDisplay.'</span></br>
                                    <small><a href="viewPetshops.php#petshop'.$petshopID.'"><u>'.$petshopName.'</u></a></small>
                                </div>
                            </div>
                        </div>

		 ';

         //get productline discount
         /*$arrayResult = DiscountedProductLine();
         if ($arrayResult != null) {
             if ($arrayResult -> num_rows > 0) {
                 //output data for each row
                 while ($row1 = $arrayResult->fetch_assoc()) {
                     if($row1['productLineID'] == $pid){
                         
                     }
                     
                 }
             }
             $arrayResult->close();
             $conn->next_result();
         }*/

        if ($_petshopID > 0) {
            if ($_petshopID == $petshopID) {
                $output .= $outputRow;
            }
        } else {
            $output .= $outputRow;
        }
    }
}
$result->close();
$conn->next_result();

$data['showresult'] = $showresult;
$data['output'] = $output;
$data['pagination'] = $pagination;


echo json_encode($data);
