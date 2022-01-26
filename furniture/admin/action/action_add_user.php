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
  /*
     if (!Validate($phone,1)) {
        $errors['Phone'] = 'Field Required';
    } elseif (!Validate($phone,5)) {
        $errors['phone'] = 'InValid Number';
    }

  
  */
   
    # Validate Image
 /*  
    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.',$_FILES['image']['name']); 
        
        $str = end($str);
        $file_ext=strtolower($str);

        

        $expensions= array("jpeg","jpg","png");

        $FinalName = time().rand().'.'.$file_ext;

        $disPath="../uploads/products/".$FinalName;


        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Please select 1 product image and the photo only supports uploading JPG, JPEG or PNG files.";
        }

        if($file_size > 2097152) {
            $errors[]='File size should not be larger than 2MB';
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
         }

         $disPath = '../uploads/'.$FinalName;


         move_uploaded_file($ImgTempPath,$disPath);

    }

 

    if (empty($errors)) {
        
        $password = md5($password);
        $sql = "insert into users (user_name,user_account,user_password,image,phone,role_id) values 
        ('$name','$email','$password','$FinalName','$phone',$role_id)";
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
    
    
    # Set Session ......
    //$_SESSION['Message'] = $msg;
    }
header('Location: ../add_user.php?msg='.$msg.'&&'.'suc='.$suc);
