<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');

$errors = array();

$pid = validate_id($_GET['pid']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    


    $cat_id = Clean($_POST['cat_id']);
    $p_name = Clean($_POST['product']);
    $product_price = Clean($_POST['product_price']);
    $selling_price = $_POST['selling_price'];
    $introduce = Clean($_POST['introduce']);
    $made_in = Clean($_POST['made_in']);



    if (isset($_POST['cat_id']) && filter_var($_POST['cat_id'], FILTER_VALIDATE_INT, array('min_array' => 1))) {
        $cat_id = mysqli_real_escape_string($dbc, strip_tags($_POST['cat_id']));

    } else {

        $errors[] = 'You must choose a category for the product';
    }



    if (!empty($_POST['product_price']) && (float)$_POST['product_price'] >= 0) {

        $product_price = $_POST['product_price'];
        
    } elseif (!empty($_POST['product_price']) && (float)$_POST['product_price'] < 0) {

        $errors[] = 'Product price cannot be less than 0';

    } elseif (empty($_POST['product_price'])) {


        $errors[] = 'You must enter the product price';
    }


// check the name of the password
    if (empty($_POST['product'])) {
        $errors[] = 'You must enter a name for the product';
    } else {
        $p_name = mysqli_real_escape_string($dbc, strip_tags($_POST['product']));
    }

//upload a image
/*
    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.', $_FILES['image']['name']);
        $str = end($str);
        $file_ext = strtolower($str);


        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "Please select 1 product image and the photo only supports uploading JPG, JPEG or PNG files.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size should not be larger than 2MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/products/" . $file_name);
        }
    }
*/
if (!Validate($_FILES['image']['name'],1)) {
    $errors[] = 'Field Required';
}else{

     $ImgTempPath = $_FILES['image']['tmp_name'];
     $ImgName     = $_FILES['image']['name'];

     $extArray = explode('.',$ImgName);
     $ImageExtension = strtolower(end($extArray));

     if (!Validate($ImageExtension,7)) {

        $errors[] = 'Invalid Extension';

     }else{

         $FinalName = time().rand().'.'.$ImageExtension;
         $disPath = '../uploads/products/'.$FinalName;
         move_uploaded_file($ImgTempPath,$disPath);

     } 

}


 
// check the text of the prison
    if (!empty($_POST['selling_price']) && (float)$_POST['selling_price'] >= 0) {
        $selling_price = $_POST['selling_price'];

    } elseif (!empty($_POST['selling_price']) && (float)$_POST['selling_price'] < 0) {

        $errors[] = 'Discount cannot be less than 0';

    } elseif (empty($_POST['selling_price'])) {

        $errors[] = 'You must enter the product discount';
    }

// selling _price va product_price
    if (isset($_POST['product_price']) && isset($_POST['selling_price']) && ($_POST['product_price'] < $_POST['selling_price'])) {
        $errors[] = 'The selling price of the product cannot be less than the product price!!! Please re-enter.';
    }


    if (empty($_POST['made_in'])) {
        $errors[] = 'You must enter the place of manufacture for the product';
    } else {
        $made_in = mysqli_real_escape_string($dbc, strip_tags($_POST['made_in']));
    }

//
    if (empty($_POST['introduce'])) {
        $errors[] = "You must enter the product's information";
    } else {
        $introduce = mysqli_real_escape_string($dbc, $_POST['introduce']);
    }

    if (empty($errors)) {
        $q = "UPDATE products SET ";
        $q .= " cat_id = '{$cat_id}', ";
        $q .= " product_name = '{$p_name}', ";
        $q .= " product_price = '{$product_price}', ";
        $q .= " selling_price = '{$selling_price}', ";
        $q .= " image = '{$FinalName}', ";
        $q .= " introduce = '{$introduce}', ";
        $q .= " made_in = '{$made_in}', ";
        $q .= " post_on = NOW() ";
        $q .= " WHERE product_id = {$pid} LIMIT 1 ";

        $r = mysqli_query($dbc, $q);
            // confirm_query($r, $q);
             
        if (mysqli_affected_rows($dbc) == 1) {

            

            if (!move_uploaded_file($ImgTempPath, $disPath)) {
                $errors[] = 'Error  in uploading Image  Try Again ';
            } else {
                unlink('../uploads/products/' . $_POST['image']);
            }

            $msg = " Edit the product successfully.";
            $suc = 1;
            header('Location: ../view_products.php?pid='.$pid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        } else {
            $msg = "Error!Product has not changed";
            $suc = 0;
        }
    } else {
        foreach ($errors as $error) {
            $msg .= $error . "<br/>";
            header('Location: ../edit_product.php?pid='.$pid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        }
    }

}

?>