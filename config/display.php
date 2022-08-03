<?php 
include 'connect.php';
if(isset($_POST['displaySend'])){
    $table='<table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Item name</th>
        <th scope="col">Unit price</th>
        <th scope="col">Stock</th>
        <th scope="col">Status</th>
        <th scope="col">Sales</th>
        <th scope="col">Return</th>
        <th scope="col">Action</th>
      </tr>
    </thead>';
    $sql="Select * from `inventory`";
    $result=mysqli_query($con,$sql);
    $number=1;
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $itemname=$row['itemname'];
        $unitprice=$row['unitprice'];
        $stock=$row['stock'];
        $status=$row['status'];
        $sales=$row['sales'];
        $return=$row['return'];
        $table.='<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$itemname.'</td>
        <td>'.$unitprice.'</td>
        <td>'.$stock.'</td>
        <td>'.$status.'</td>
        <td>'.$sales.'</td>
        <td>'.$return.'</td>
        <td>
        <button class = "btn btn-primary" onclick="updateProduct('.$no.')">Update</button>
        <button class = "btn btn-danger" onclick="deleteProduct('.$no.')">Delete</button>
        </td>
      </tr>';
      $number++;
    }
    $table.='</table>';
    echo $table;
}


?>

