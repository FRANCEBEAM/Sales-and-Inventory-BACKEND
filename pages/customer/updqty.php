<?php 
session_start();
include('./config/--configure.php');

$cartid=$_POST['cart_id'];
$qty=$_POST['qty'];

$upd="UPDATE cart SET qty='$qty' WHERE id='$cartid'";
$conn->query($upd);

?>
