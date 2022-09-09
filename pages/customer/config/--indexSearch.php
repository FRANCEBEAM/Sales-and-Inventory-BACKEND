<div class="item-container">
              <h5 class="mt-5">Search result: <i class="fa-solid fa-store"></i></h5>
          </div>
  <!-- FETCH SEARCH -->
  <div class="item-container mt-5 mb-5" id="item-list"> 
    <?php
    error_reporting(0);
        //connect ot the database
        require './config/--configure.php';
        //get the search keyword
        $search = $_POST['search'];
        //SQL query to get the products based on the search keyword
        $sql = "SELECT * FROM inventory WHERE product LIKE 
        '%$search%' OR descriptions LIKE '%$search%'
        ";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the product is available
        if ($count > 0) {
            while ($row  = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $product = $row['product'];
                $descriptions = $row ['descriptions'];
                $price = $row ['price'];
                $image_file = $row ['image_file'];
                ?>

            <div class="mb-5 card">
                    <img src="/assets/img/image 1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title mt-2"><b><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?></b></h5>
                      <h4 class="card-text mt-2"><?= $row['product'] ?></h4>
                      <p class="card-text mt-2"><?= $row['descriptions'] ?></p>

                      <form action="" class="form-submit">
                      <input type="hidden" class="form-control quantity" value="50">
                      <input type="hidden" class="id" value="<?= $row['id'] ?>">
                      <input type="hidden" class="product" value="<?= $row['product'] ?>">
                      <input type="hidden" class="price" value="<?= $row['price'] ?>">
                      <input type="hidden" class="image_file" value="<?= $row['image_file'] ?>">
                      <input type="hidden" class="serialnumber" value="<?= $row['serialnumber'] ?>">
                      <a href="/pages/customer/signin.php" class="btn btn-primary mt-4 d-md-block addItemBtn">Add to cart</a>
                      </form>
                    </div>
                    </div>



                <?php

            }
        }else {
            echo "<h3 class='mb-5'>
            No product found
            </h3>";
        }

            ?>
            </div>
