<?php
session_start();
$id = $_GET['id'];

unset($_SESSION['cart'][$id]);
if(count($_SESSION['cart'])==0){

    //delete cart when all products are removed
    
    unset($_SESSION['cart']);
}
if (isset($_GET['page']) && $_GET['page'] =='cart' ){
    header('Location:../cart.php');
}else{
    header('Location:../cart.php');
}
?>