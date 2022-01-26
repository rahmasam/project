<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$cid = validate_id($_GET['cid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    if (empty($_POST['category'])) {
        $errors[] = 'Please enter the category name';
    } else {
        $cat_name = mysqli_real_escape_string($dbc, strip_tags($_POST['category']));
    }
    if (isset($_POST['position']) && filter_var($_POST['position'], FILTER_VALIDATE_INT)) {
        $position = $_POST['position'];
    } else {
        $errors[] = 'Please choose a location for the list';
    }
    
    $description = mysqli_real_escape_string($dbc,$_POST['desc']);

    if (empty($errors)){
        $q = "UPDATE categories SET cat_name = '{$cat_name}' ,description = '{$description}',position = '{$position}' WHERE cat_id = '{$cid}' ";
        
        $r = mysqli_query($dbc,$q);

        confirm_query($r,$q);

        if (mysqli_affected_rows($dbc) == 1){
            $msg = "Editing the directory successfully";
            $suc = 1;
        }else{
            $msg = "Error!Category hasn't changed";
            $suc = 0;
        }
    } else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
        }
    }
    header('Location: ../view_categories.php?cid='.$cid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
}
?>