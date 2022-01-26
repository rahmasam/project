<?php
session_start();
include ('../includes/functions.php');
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}else{
    $_SESSION = array();
    //If the user is logged in and has information, the user will be logged out

    session_destroy();//destroy session
}
header("Location: login.php");
?>
