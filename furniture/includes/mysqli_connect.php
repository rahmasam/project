<?php
$dbc = mysqli_connect('localhost','root','','furniture');
if (!$dbc){
    echo("error in your connection".mysqli_connect_error());
}else{
    echo("");
}
?>