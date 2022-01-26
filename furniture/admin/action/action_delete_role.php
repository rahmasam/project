<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$rid = validate_id($_GET['rid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'Erase')) {
        $q = "DELETE FROM roles WHERE role_id = $rid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Delete position successfully";
            $suc = 1;
        } else {
            $msg = "This position does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have canceled the deletion of the position.";
        $suc = 0;
    }
    header('Location: ../view_roles.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>