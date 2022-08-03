<?php 
include 'connect.php';
if(isset($_POST['displaySend'])){
    $table='<table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Item name</th>
        <th scope="col">Category</th>
        <th scope="col">Unit price</th>
        <th scope="col">Stock</th>
        <th scope="col">Status</th>
        <th scope="col">Sales</th>
        <th scope="col">Return</th>
        <th scope="col">Supplier</th>
        <th scope="col">Action</th>
      </tr>
    </thead>';
    $sql="Select * from `inventory`";
    $result=mysqli_query($con,$sql);
    $number=1;
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $itemname=$row['itemname'];
        $category=$row['category'];
        $unitcost=$row['unitcost'];
        $stock=$row['stock'];
        $status=$row['status'];
        $supplier=$row['supplier'];
        // $productimage=$row['productimage'];
        // $description=$row['productdescription'];
        $table.='<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$itemname.'</td>
        <td>'.$category.'</td>
        <td>'.$unitcost.'</td>
        <td>'.$stock.'</td>
        <td>'.$status.'</td>
        <td>'.$supplier.'</td>
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

