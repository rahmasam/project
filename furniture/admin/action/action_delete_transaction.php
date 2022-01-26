<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$code = validate_id($_GET['code']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Erase')) {
        $q = "DELETE FROM transactions WHERE transaction_code = $code ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Delete transaction successfully";
            $suc = 1;
        } else {
            $msg = "This transaction does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have canceled the deletion of the transaction.";
        $suc = 0;
    }
    header('Location: ../view_transactions.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>