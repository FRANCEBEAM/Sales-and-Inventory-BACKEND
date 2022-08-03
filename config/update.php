<?php 
include 'connect.php';

    if(isset($_POST['updateid'])){
        $product_id=$_POST['updateid'];

        $sql="Select * from `inventory` where id=$product_id";
        $result=mysqli_query($con,$sql);
        $response=array();
        while($row=mysqli_fetch_assoc($result)){
            $response=$row;
        }
        echo json_encode($response);
    }else{
        $response['status']=200;
        $response['message']="Invalid or data not found";
    }


    // update query

    if(isset($_POST['hiddendata'])){
        $uniqueid=$_POST['hiddendata'];
        $itemname = $_POST['updateitemname'];
        $category = $_POST['updatecategory'];
        $unitcost = $_POST['updateunitcost'];
        $stock=$_POST['updatestock'];
        $status=$_POST['updatestatus'];
        $supplier=$_POST['updatesupplier'];
        $productimage=$_POST['updateproductimage'];
        $description=$_POST['updatedescription'];

        $sql="update `inventory` set itemname='$itemname',unitcost='$unitcost',stock='$stock',status='$status',supplier='$supplier', productimage='$productimage', description='$description' where id=$uniqueid";

        $result=mysqli_query($con,$sql);
    }
?>