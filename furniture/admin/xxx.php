<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');

$uid = validate_id($_GET['uid']);

# Code .....
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $role_id = $_POST['role_id'];
    $phone = ($_POST['phone']);
/*
    # Validate name ....
    if (!Validate($name, 1)) {
        $errors[] = 'Required Field';
    } elseif (!Validate($name, 6)) {
        $errors[] = 'Invalid String';
    }

    # Validate Email
    if (!Validate($email, 1)) {
        $errors[] = 'Field Required';
    } elseif (!Validate($email, 2)) {
        $errors[] = 'Invalid Email';
    }

    # Validate role_id ....
    if (!Validate($role_id, 1)) {
        $errors[] = 'Field Required';
    } elseif (!Validate($role_id, 4)) {
        $errors[] = 'Invalid Id';
    }

    # Validate phone ....
    if (!Validate($phone, 1)) {
        $errors[] = 'Field Required';
    } elseif (!Validate($phone, 5)) {
        $errors[] = 'InValid Number';
    }
*/
    # Validate Image

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
             $disPath = '../uploads/'.$FinalName;
             move_uploaded_file($ImgTempPath,$disPath);
    
         } 
    
    }
} 


    if (empty($errors)) {

        if (!move_uploaded_file($ImgTempPath, $disPath)) {
            $errors[] = 'Error  in uploading Image  Try Again ';
        } else {
            unlink('../uploads/' . $_POST['image']);
        }
 
        $sql = "update users set user_name='$name' , user_account='$email' , phone= '$phone' , role_id = $role_id , image ='$FinalName' where id = $uid";

        $op = mysqli_query($dbc, $sql);

        if ($op) {
                $msg = "Edit account successfully";
                $suc = 1;
                
        } else {
                $msg = "Error!Account has not changed";
                $suc = 0;
            }


        }else {
            foreach ($errors as $error){
                $msg .= $error . "<br/>";
            }
        }
        # Set Session ......
        $_SESSION['msg'] = $msg;
       
    
    header('Location: ../view_users.php?uid='.$uid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);

?>