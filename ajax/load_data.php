<?php 

include("../include/dbConnection.php");


if (isset($_POST['page'])) {
	$page = $_POST['page'];
}else{
	$page = 1;
}

if (isset($_POST['petshopID'])) {
	$_petshopID = $_POST['petshopID'];
}else{
    $_petshopID = 0;
}

$pagination = '<div >
<ul class="pagination">';


$limit = 8;
$start = ($page - 1)* $page;

//$pages = mysqli_query($connect,"SELECT count(productLineID) AS id FROM productline;");

if($_petshopID > 0){
    $sql = "CALL sp_countMyProducts($_petshopID);";
}else{
    $sql = "CALL sp_countProductLine();";
}
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $total = $row['id'];
	$count = ceil($total / $limit);
	for ($i=1; $i <=$count ; $i++) { 
        if ($page == $i) {
            $pagination .= '<a id="'.$i.'" href="" class="active">'.$i.'</a>';
        }else{
			$pagination .= '<a id="'.$i.'" href="" class="">'.$i.'</a>';
		}

	}
}

$pagination .= '</ul>
</div>';

$result->close();
$conn->next_result();
//$pagination="";


$sql = "CALL sp_getAllProductLineDetailsWithLimits($start, $limit);";
$result = $conn->query($sql);

$outputRow = "";

$output = "";
if ($result -> num_rows < 1) {
    $output .="<h3>No products available</h3>";
}else{
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
        $productID = $row['productID'];
		 
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
                                            <input type="hidden" name="price" value="'.$price.'" id="price'.$pid.'">
                                            <button type="submit" class="transmitv-cart ptransmitv-cart add-to-cart add_cart" name="add" id="'.$pid.'">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="viewProductDetails.php?prodid='.$pid.'">'.$pname . " ".$number. " " .$unit.'</a> | <a href="#brand">'.$brand.'</a></h3>
                                    <!-- <span class="price"><del>$975.00</del>Rs2200</span> -->
                                    <span class="price">Rs '.$price.'</span></br>
                                    <small><a href="viewPetshops.php#petshop'.$petshopID.'"><u>'.$petshopName.'</u></a></small>
                                </div>
                            </div>
                        </div>

		 ';
        if($_petshopID > 0){
            if($_petshopID == $petshopID){
                $output .= $outputRow;
            }
        }else{
            $output .= $outputRow;
        }
	}
}
$result->close();
$conn->next_result();



$data['output'] = $output;
$data['pagination'] = $pagination;


echo json_encode($data);
 ?>