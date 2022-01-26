<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

$sid = validate_id($_GET['sid']);

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['delete']) && ($_POST['delete'] == 'erase')) {
        $q = "DELETE FROM slides WHERE slide_id = $sid ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            $msg = "Delete slide successfully";
            $suc = 1;
        } else {
            $msg = "This slide does not exist!";
            $suc = 0;
        }
    } elseif (isset($_POST['delete']) && ($_POST['delete'] == 'Cancel')){
        $msg = "You have undeleted the slide.";
        $suc = 0;
    }
    header('Location: ../view_slides.php?msg=' . $msg.'&&'.'suc='.$suc);
}

?>