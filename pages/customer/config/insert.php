<?php 
include 'connect.php';

extract($_POST);

if(isset($_POST['itemnameSend']) && isset($_POST['categorySend']) && isset($_POST['unitcostSend']) && isset($_POST['stockSend']) && isset($_POST['statusSend']) && isset($_POST['supplierSend']) && isset($_POST['imageSend']) && isset($_POST['descriptionSend'])){

    $sql="insert into `inventory` (itemname,category,unitcost,stock,status,supplier,productimage,productdescription)
    values ('$itemnameSend','$categorySend', '$unitcostSend', '$stockSend', '$statusSend', '$supplierSend', '$imageSend', '$descriptionSend')";
    // $sql1="insert into `history` (category,name,price,stock,status)
    // values ('$categorySend','$nameSend', '$priceSend', '$stockSend', '$statusSend')";

    $result=mysqli_query($con,$sql);
    // $result=mysqli_query($con,$sql1);
}
?>