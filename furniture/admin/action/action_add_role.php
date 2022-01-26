<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    if (empty($_POST['role'])){
        $errors[] = 'Please enter the title of the position';
    }else {
        $role = mysqli_real_escape_string($dbc,strip_tags($_POST['role']));
    }

    //check permission(permission co the co hoac ko)
    $permission = mysqli_real_escape_string($dbc,$_POST['permission']);


    if (empty($errors)){
        $q = "SELECT role FROM roles WHERE role = '{$role}'";
        $r = mysqli_query($dbc,$q);

        if (mysqli_num_rows($r) >= 1){
            $msg = "Chức vụ này đã tồn tại!";
            $suc = 0;
        }else{
            //If there is no output, then insert data first
            
            $q = "INSERT INTO roles (role,permission) VALUE ('{$role}','{$permission}')";
            $r = mysqli_query($dbc,$q);
            confirm_query($r,$q);
            if (mysqli_affected_rows($dbc) == 1){
                $msg = "More successful positions";
                $suc = 1;
            }else{
                $msg = "System error";
                $suc = 1;
            }
        }

    } else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
        }
    }

    header('Location: ../add_role.php?msg=' . $msg.'&&'.'suc='.$suc);
}
?>