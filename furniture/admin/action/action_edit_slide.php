<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$errors = array();
$sid = validate_id($_GET['sid']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//upload a image

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
            $errors[] = "Please select 1 slide image and the image only supports uploading JPG, JPEG or PNG files.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Slide size should not be larger than 2MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp,"../uploads/slides/".$file_name);
        }
    }

    if (empty($_POST['description'])) {
        $errors[] = "You must enter a description for the slide";
    } else {
        $decription = mysqli_real_escape_string($dbc, $_POST['description']);
    }

    if (empty($errors)) {
        $q = "UPDATE slides SET ";
        if (!empty($_FILES['image']['name']))
        {
            $q .= " slide_image = '{$_FILES['image']['name']}', ";
        }
        $q .= " description = '{$decription}', ";
        $q .= " post_on = NOW() ";
        $q .= " WHERE slide_id = {$sid} LIMIT 1 ";
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);
        if (mysqli_affected_rows($dbc) == 1) {
            $msg = " Edit slide successfully.";
            $suc = 1;
        }
        header('Location: ../view_slides.php?sid='.$sid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
    } else {
        foreach ($errors as $error) {
            $msg .= $error . "<br/>";
         header('Location: ../edit_slide.php?sid='.$sid.'&&'.'msg=' . $msg.'&&'.'suc='.$suc);
        }
    }
}

?>