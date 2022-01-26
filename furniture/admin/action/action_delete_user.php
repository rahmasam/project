<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$uid = validate_id($_GET['uid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Erase')) {
        $q = "DELETE FROM users WHERE user_id = $uid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Account deleted successfully";
            $suc = 1;
        } else {
            $msg = "This account does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have canceled the account deletion.";
        $suc = 0;
    }
    header('Location: ../view_users.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>