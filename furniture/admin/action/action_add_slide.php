<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();


    //upload a image

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $str = explode('.',$_FILES['image']['name']); $str = end($str); $file_ext=strtolower($str);


        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Please select a silde image and the image only supports uploading JPG, JPEG or PNG files.";
        }

        if($file_size > 2097152) {
            $errors[]='Image size should not be larger than 2MB';
        }

        if(empty($errors)==true) {
             move_uploaded_file($file_tmp,"../uploads/slides/".$file_name);
        }
    }

    //
    if(empty($_POST['description'])) {
        $errors[] = "You must enter a description of this slide photo";
    } else {
        $description = mysqli_real_escape_string($dbc,$_POST['description']);
    }

    if (empty($errors)){
        $q = "INSERT INTO slides (slide_image,description,post_on) VALUE ('{$_FILES['image']['name']}','{$description}',NOW())";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);
        if (mysqli_affected_rows($dbc) == 1){
            $msg = "Add photo slide successfully";
            $suc = 1;
        }else{
            $msg = "Slide photo add failed";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .= $error ."<br/>";
        }
    }
    header('Location: ../add_slide.php?msg=' . $msg.'&&'.'suc='.$suc);
}
?>
