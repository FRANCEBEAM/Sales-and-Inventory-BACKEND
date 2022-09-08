<?php
include('connect.php');

if(isset($_POST['input'])){
  $input = $_POST['input'];

  $query = "SELECT * FROM inventory WHERE product LIKE '{$input}%' OR category LIKE '{$input}%' ";

  $result = mysqli_query($con, $query);

  if(mysqli_num_rows($result) >0){?>

          <div>
              <?php 
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $product = $row['product'];
                  $price = $row['price'];

                  ?>
                    <p><?php echo $id;?></p>
                     <p><?php echo $product;?></p>
                    <p><?php echo $price;?></p>

                  <?php
                }
              ?>
          </div>



<?php
  }else{
      echo "<h1>No data</h1>";
  }
}
?>