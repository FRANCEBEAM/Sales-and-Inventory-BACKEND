<?php 
include 'connect.php';

if(isset($_POST['deletesend'])){
    $unique=$_POST['deletesend'];

    $sql="delete from `inventory` where id=$unique";
    $reqult=mysqli_query($con,$sql);
}

?>