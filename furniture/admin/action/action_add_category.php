<?php
session_start();
$account = $_SESSION['user_account'];
$permission = 'add_category';
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = array();
        //check category_name
        if (empty($_POST['category'])){
            $errors[] = 'Please enter the category name';
        }else {
            $cat_name = mysqli_real_escape_string($dbc,strip_tags($_POST['category']));
        }
       
        if (isset($_POST['position']) && filter_var($_POST['position'],FILTER_VALIDATE_INT,array('min_array' => 1))){
            $position = $_POST['position'];
        }else {
            $errors[] = 'Please choose a location for the list';
            
            
        }
         //check category_position
        if (empty($_POST['desc'])){
            $errors[] = 'Please enter the category desc';
        }else {
            $cat_desc = mysqli_real_escape_string($dbc,strip_tags($_POST['desc']));
        }
        


        if (empty($errors)){
            //If there is no output, then insert data first
            $q = "INSERT INTO categories (cat_name,description ,position) VALUE ('{$cat_name}','{$cat_desc}',$position)";
            $r = mysqli_query($dbc,$q);
            confirm_query($r,$q);

            if (mysqli_affected_rows($dbc) == 1){
                $msg = "Add successful category";
                $suc = 1;
            }else{
                $msg = "Error!Adding category failed";
                $suc = 0;
            }
        } else {
            foreach ($errors as $error){
                $msg .= $error . "<br/>";
            }
        }

        header('Location: ../add_category.php?msg=' . $msg.'&&'.'suc='.$suc);
    }
?>  