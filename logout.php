<?php
if(!isset($_SESSION)){
    session_start();
}
session_destroy();
//clear cookies
//clear session if exists
//unset($_SESSION['mycart']);
//$_SESSION['total_price'] = 0;
setcookie("cart", null, -1, '/');
header("Location: index.php");
//echo "<script>window.location.href='index.php';</script>"; 
?>