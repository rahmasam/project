<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = mysqli_real_escape_string($dbc,$_POST['name']);
    }else{
        $errors[] = 'Please enter your full name';
    }
    if (isset($_POST['account']) && filter_var($_POST['account'],FILTER_VALIDATE_EMAIL)){
        $account = mysqli_real_escape_string($dbc,$_POST['account']);
    }else{
        $errors[] = 'Please enter your email account';
    }
    if (isset($_POST['password']) && preg_match('/^[\w\'.-]{6,20}$/',$_POST['password'])){
        $password = mysqli_real_escape_string($dbc,$_POST['password']);
    }else{
        $errors[] = 'Please enter password with 6-20 characters';
    }
    if (empty($errors)){
        $q = "SELECT user_account FROM users WHERE user_account = '{$account}'";
        $r = mysqli_query($dbc,$q);
        if (mysqli_num_rows($r) >= 1){
            $msg = "Email account already exists!! Please register another account!";
            $suc = 0;
            header('Location: ../register.php?msg='.$msg);
        }else{
            $q = "INSERT INTO users (user_name,user_account,user_password,role_id) VALUE ('$name','$account',SHA1('$password'),'8')";
            $r = mysqli_query($dbc,$q);
            confirm_query($r,$q);

            if (mysqli_affected_rows($dbc) == 1){
                header('Location: ../waiting.php');
            }else{
                $msg = "Lỗi hệ thống";
                $suc = 0;
            }
        }
    }else{
        foreach ($errors as $error){
            $msg .=$error."<br/>";
            header('Location: ../register.php?msg='.$msg);
        }
    }
}
?>