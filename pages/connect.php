<?php 

    $con=new mysqli('localhost','root','','rjavancena');
    
    if(!$con){
        die(mysqli_error($con));
    }
?>