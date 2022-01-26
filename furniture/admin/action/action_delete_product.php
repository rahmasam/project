<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$pid = validate_id($_GET['pid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Erase')) {
        $q = "DELETE FROM products WHERE product_id = $pid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Delete product successfully";
            $suc = 1;
        } else {
            $msg = "This product does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have canceled deletion of this product.";
        $suc = 0;
    }
    header('Location: ../view_products.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>