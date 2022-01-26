<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name      = Clean($_POST['name']);
    $email     = Clean($_POST['email']);
    $password  = Clean($_POST['password']); 
    $role_id   = $_POST['role_id'];
    $phone     = Clean($_POST['phone']);


    # Validate name ....
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['name'] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors['name'] = 'Invalid String';
    }


    # Validate Email
    if (!Validate($email,1)) {
        $errors['email'] = 'Field Required';
    } elseif (!Validate($email,2)) {
        $errors['email'] = 'Invalid Email';
    }


    # Validate Password
    if (!Validate($password,1)) {
        $errors['password'] = 'Field Required';
    } elseif (!Validate($password,3)) {
        $errors['password'] = 'Length must be >= 6 chars';
    }

    
     # Validate role_id .... 
     if (!Validate($role_id,1)) {
        $errors['role_id'] = 'Field Required';
    }elseif(!Validate($role_id,4)){
        $errors['role_id'] = "Invalid Id";
    }

     # Validate phone .... 
     if (!Validate($phone,1)) {
        $errors['Phone'] = 'Field Required';
    } elseif (!Validate($phone,5)) {
        $errors['phone'] = 'InValid Number';
    }

   
    # Validate Image
    if (!Validate($_FILES['image']['name'],1)) {
        $errors['Image'] = 'Field Required';
    }else{

         $ImgTempPath = $_FILES['image']['tmp_name'];
         $ImgName     = $_FILES['image']['name'];

         $extArray = explode('.',$ImgName);
         $ImageExtension = strtolower(end($extArray));

         if (!Validate($ImageExtension,7)) {
            $errors['Image'] = 'Invalid Extension';
         }else{
             $FinalName = time().rand().'.'.$ImageExtension;
         }

    }


    if (count($errors) > 0) {
        $msg = $errors;
    } else {
        // DB CODE .....

       $disPath = '../uploads/'.$FinalName;


       if(move_uploaded_file($ImgTempPath,$disPath)){

        $password = md5($password);
        $sql = "insert into users (user_name,user_account,user_password,image,phone,role_id) values ('$name','$email','$password','$FinalName','$phone',$role_id)";
        $op = mysqli_query($dbc, $sql);

        if ($op) {
            $msg = 'Raw Inserted';
            $suc=1;
        } else {
            $msg = 'Error Try Again ' . mysqli_error($dbc);
            $suc=0;
        }
    
       }else{
        $msg = 'Error  in uploading Image  Try Again ' ;
        $suc=0;
       }
    
    }
    # Set Session ......
    //$_SESSION['Message'] = $msg;
}
header('Location: ../add_user.php?msg=' . $msg.'&&'.'suc='.$suc);






































































































if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    
    //check list
    if (isset($_POST['']) && filter_var($_POST['cat_id'],FILTER_VALIDATE_INT,array('min_array' => 1))){
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
            $msg = "More successful Users";
            $suc = 1;
        }else{
            $msg = "Add user failed";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .= $error ."<br/>";
        }
    }
    header('Location: ../add_product.php?msg=' . $msg.'&&'.'suc='.$suc);
}
?>