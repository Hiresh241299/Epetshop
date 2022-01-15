<?php
if(!isset($_SESSION)){
    if(!isset($_SESSION)){
    session_start();
}
}
//load cookies in session if session[cart] is null and cookie[cart] not null
if(isset($_COOKIE["cart"])){
    $cart = $_COOKIE["cart"];
    $cart = json_decode($cart);
    //print_r($cart);

    //create session[mycart]
    if(!isset($_SESSION['mycart'])){
        
        foreach($cart as $key => $value){
            $item_array = array(
                'id'  => $value->id,
                'name' => $value->name,
                'price' => $value->price,
                'quantity' => $value->quantity
             );
 
             $_SESSION['mycart'][] = $item_array;
        }
    }

}


//$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
//$cart = json_decode($cart);
//$cartArr = array();

//add to cookies

/*add to cookies
$cart = array();
foreach ($_SESSION['mycart'] as $key => $value) {
    array_push($cart,array(
            'id' => $_SESSION['mycart'][$key]['id'],
            'name' => $_SESSION['mycart'][$key]['name'],
            'price' => $_SESSION['mycart'][$key]['price'],
            'quantity' => $_SESSION['mycart'][$key]['quantity']
        ));
}

setcookie("cart", json_encode($cart));
*/
?>