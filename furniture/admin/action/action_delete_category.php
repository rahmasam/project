<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$cid = validate_id($_GET['cid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Erase')) {
        $q = "DELETE FROM categories WHERE cat_id = $cid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Delete category successfully";
            $suc = 1;
        } else {
            $msg = "This category does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have un-deleted the category.";
        $suc = 0;
    }
    header('Location: ../view_categories.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>