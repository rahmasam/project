<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    //check list
    if (isset($_POST['cat_id']) && filter_var($_POST['cat_id'],FILTER_VALIDATE_INT,array('min_array' => 1))){
        $cat_id = mysqli_real_escape_string($dbc,strip_tags($_POST['cat_id']));
    }else {
        $errors[] = 'You must choose a category for the product';
    }


    // check the name of the password
    if (empty($_POST['product'])){
        $errors[] = 'You must enter a name for the product';
    }else{
        $product = mysqli_real_escape_string($dbc,strip_tags($_POST['product']));
    }

    //upload a image

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.',$_FILES['image']['name']); $str = end($str); $file_ext=strtolower($str);


        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Please select 1 product image and the photo only supports uploading JPG, JPEG or PNG files.";
        }

        if($file_size > 2097152) {
            $errors[]='File size should not be larger than 2MB';
        }

        if(empty($errors)==true) {
            move_uploaded_file($file_tmp,"../uploads/products/".$file_name);
        }
    }


    //check the price
    if (isset($_POST['product_price']) && $_POST['product_price'] !== '' && (float)$_POST['product_price'] >= 0 ){
        $product_price = $_POST['product_price'];
    }elseif (isset($_POST['product_price'])&& $_POST['product_price'] !== ''&& (float)$_POST['product_price'] < 0){
        $errors[] = 'Product price cannot be less than 0';
    }elseif(isset($_POST['product_price']) && $_POST['product_price'] == ''){
        $errors[] = 'You must enter the product price';
    }

    // check the text of the journal
    if (isset($_POST['selling_price']) && $_POST['selling_price'] !== '' && (float)$_POST['selling_price'] >= 0   ){
        $selling_price = $_POST['selling_price'];
    }elseif (isset($_POST['selling_price']) && $_POST['selling_price'] !== '' && (float)$_POST['selling_price'] < 0){
        $errors[] = 'The selling price cannot be less than 0';
    }elseif(isset($_POST['selling_price']) && $_POST['selling_price'] == ''){
        $errors[] = 'You must enter the selling price of the product';
    }
    //kiem tra selling _price va product_price
    if (isset($_POST['product_price']) && isset($_POST['selling_price']) && ($_POST['product_price']<$_POST['selling_price'])){
        $errors[] = 'The selling price of the product cannot be less than the product price!!! Please re-enter.';
    }

    //check the production location
    if (empty($_POST['made_in'])){
        $errors[] = 'You must enter the place of manufacture for the product';
    }else{
        $made_in = mysqli_real_escape_string($dbc,strip_tags($_POST['made_in']));
    }

    //
    if(empty($_POST['introduce'])) {
        $errors[] = "You must enter the product's information";
    } else {
        $introduce = mysqli_real_escape_string($dbc,$_POST['introduce']);
    }

    if (empty($errors)){
        $q = "INSERT INTO products (cat_id,product_name,product_price,selling_price,image,introduce,made_in,post_on) VALUE ($cat_id,'{$product}',$product_price,$selling_price,'{$_FILES['image']['name']}','{$introduce}','{$made_in}',NOW())";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);
        if (mysqli_affected_rows($dbc) == 1){
            $msg = "add successful products";
            $suc = 1;
        }else{
            $msg = "Add product failed";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .= $error ."<br/>";
        }
    }
    header('Location: ../add_product.php?msg=' . $msg.'&&'.'suc='.$suc);
}
