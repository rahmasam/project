<?php
session_start();

include "includes/mysqli_connect.php";


$msg= '';

$arrKey = array_keys($_SESSION['cart']);
$strKey = implode(",",$arrKey);
$q = "SELECT * from products where product_id in($strKey)";
$r = mysqli_query($dbc, $q);


//Gui Mail
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $errors[] = "Please enter your full name!";
    }
    if (!empty($_POST['phone'])){
        $phone = $_POST['phone'];
    }else{
        $errors[] = "Please enter your phone number!";
    }if (!empty($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $errors[] = "Please enter your email address!";
    }
    if (!empty($_POST['address'])){
        $address = $_POST['address'];
    }else{
        $errors[] = "Please enter your shipping address!";
    }
    $add_notice = $_POST['add_notice'];
    //gui mail
    if (empty($errors)) {
         
            $code = rand(100000,1000000);
            while ($sendmail = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                $Thanhtien = $_SESSION['cart'][$sendmail['product_id']]['quantity'] * $sendmail['selling_price'];

                $mailHTML .= '
                        <tr>
                            <td width="70%">' . $sendmail['product_name'] . '</td>
                            <td width="10%">' . $_SESSION['cart'][$sendmail['product_id']]['quantity'] . '</td>
                            <td width="20%">' . number_format($Thanhtien, 0, ',', '.') . "<span'> L.E</span>" . '</td>
                        </tr>';
                $Tongcong += $Thanhtien;
                $q1 = "INSERT INTO transactions (transaction_code,customer_name,customer_email,customer_phone,customer_address,product,quantity,subtotal,time_order) ";
                 $q1 .=" VALUE ($code,'{$name}','{$email}',$phone,'{$address}','{$sendmail['product_name']}','{$_SESSION['cart'][$sendmail['product_id']]['quantity']}',$Thanhtien,NOW())";
                 $r1 = mysqli_query($dbc,$q1);

            }
          
           

            //After sending the email, delete the session cart
            unset($_SESSION['cart']);
            header('Location:success.php', true, 302);
       
    }else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
            header('Location: checkout.php?msg='.$msg.'');
        }
    }
}
?>
