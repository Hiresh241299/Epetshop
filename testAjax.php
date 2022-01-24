<?php 

if (isset($_POST['function'])) {
    if ($_POST['function'] == 1) {
        echo "test ajax 1";
    } elseif ($_POST['function'] == 2) {
        echo "test ajax 2";
    }
}
else{
    echo "test ajax 0";
}
?>