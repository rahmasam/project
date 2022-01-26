<?php
session_start();
?>
<?php
include ('../../includes/mysqli_connect.php');
include ('../../includes/functions.php');
$msg= '';
$suc= '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $errors = array();

    if (isset($_POST['account']) && filter_var($_POST['account'],FILTER_VALIDATE_EMAIL)){
        $account = mysqli_real_escape_string($dbc,$_POST['account']);
    }else{
        $errors[] = 'Please enter your account';
    }

    if (isset($_POST['password']) && preg_match('/^[\w\'.-]{6,20}$/',$_POST['password'])){
        $password = mysqli_real_escape_string($dbc,$_POST['password']);
    }else{
        $errors[] = 'Please enter a password';
    }

    if (empty($errors)){
        $q = " SELECT user_id,user_name,user_account,user_password,role_id FROM users WHERE (user_account = '$account' AND user_password = md5('$password'))";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);

        if (mysqli_num_rows($r) == 1){
            list($id,$name,$account,$password,$role_id) = mysqli_fetch_array($r,MYSQLI_NUM);
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_account'] = $account;
            $_SESSION['user_password'] = $password;
            $_SESSION['role_id'] = $role_id;
            $suc = 1;
        }else{
            $msg = "The account or password is incorrect.";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .=$error."<br/>";
        }
    }
    if ($suc == 1){
        $q = "SELECT * FROM users JOIN roles USING (role_id) WHERE user_account = '{$account}' AND permission LIKE '%login%'";
        $r = mysqli_query($dbc,$q);
        if (mysqli_num_rows($r) >= 1){
            header('Location: ../admin_index.php');
        }else{
            header('Location: ../waiting.php');
        }

    }else{

        header('Location: ../login.php?msg='.$msg);
    }
}
?>