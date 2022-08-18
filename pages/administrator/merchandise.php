<!-- Coding by RJ Avanceña Enterprises -->
<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "rjavancena");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="/pages/administrator/merchandise.php"</script>';
			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '--header.php'; ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Merchandise</title> 

</head>
<body>

<?php include '--sidebar.php'; ?>

   <!-- Start Here -->
   <section class="home">
        <div class="text">Merchandise</div>

        <!-- Search Container -->
        <div class="search-container">
            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text" id="inputGroup-sizing-lg"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder= "Search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
              </div> 
        </div>

            <!-- Content Container -->
    <div class="merchandize-container mt-5">
        <div class="left-content">
            <h5 class="mb-5 fw-bold">Hardware category</h5>

                <div class="category-container">
                      <!-- Category -->
                      <select class="form-select" aria-label="Default select example">
                        <option selected>Choose category</option>
                        <option value="1">Leather</option>
                        <option value="2">Stone</option>
                        <option value="3">Iron</option>
                        <option value="4">Gold</option>
                        <option value="5">Diamond</option>
                      </select>
                 </div>

                 <hr>

                 <div class="productlist-container">
                			<?php
                        $query = "SELECT * FROM inventory ORDER BY id ASC";
                        $result = mysqli_query($connect, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                          while($row = mysqli_fetch_array($result))
                          {
                        ?>
                        <form method="post" action="/pages/administrator/merchandise.php?action=add&id=<?php echo $row["id"]; ?>">
                          <div class="card text-center">
                            <img src="/assets/img/image 1.jpg" alt="">
                            <input type="text" name="quantity" value="1" class="form-control mt-4" />
                          <h5  class="card-title mt-5" name="hidden_name"><?php echo $row["product"]; ?></inp>
                             <p class="card-text" name="hidden_price">₱ <?php echo $row["price"]; ?></p>

                                 <button type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-outline-dark">Add to bill</button>
                            </div>
                        </form>
                      <?php
                          }
                        }
                      ?>
                 </div>
              </div>

            <!-- Right Content -->
            <div class="right-content">
                <div class="sales-invoice">
                    <div class="head-invoice">
                            <div class="head1">
                                <h5 class="fw-bold">Sales Invoice</h5>
                                <p>trn202206</p>
                            </div>
                                <div class="head2">
                                    <p>Monday, 8 Aug, 2022</p>
                                    <p>2:11 PM</p>
                                </div>
                    </div>  
                    <br>
           
                        <div class="body-invoice">
                            <div class="bill-pay">
                            <?php
                                  if(!empty($_SESSION["shopping_cart"]))
                                  {
                                    $total = 0;
                                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                                    {
                                  ?>
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                      <div class="col-md-4">
                                        <!-- <img src="/assets/img/image 2.jpg" class="img-fluid rounded-start" alt="..."> -->
                                      </div>
                                      <div class="col-md-8">
                                        <div class="card-body">
                                          <h5 class="card-title fw-bold"><?php echo $values["item_name"]; ?></h5>
                                          <p class="card-text">₱ <?php echo $values["item_price"]; ?></p>
                                            
                                          <div class="qty">
                                                <button type="button" class="btn bg-light border rounded-circle"><i class="fa-solid fa-minus"></i></button>

                                                    <input type="text" value="<?php echo $values["item_quantity"]; ?>" class="form-control d-inline">

                                                <button type="button" class="btn bg-light border rounded-circle"><i class="fa-solid fa-plus"></i></button>
  
                                                <a class="btn-remove" type="button"  href="/pages/administrator/merchandise.php?action=delete&id=<?php echo $values["item_id"]; ?>" style="background: none; border:none;"><i class="bi bi-trash3"></i></a>                     
                                            </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>       

                            <?php
                              $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                          ?>
                            <div class="total-container mt-4">
                                <div class="total-items">
                                    <p>Total Items</p>
                                        <p class="fw-bold">2</p>
                                </div>
                                    <div class="subtotal">
                                        <p>subtotal</p>
                                            <p class="fw-bold" style="color: #198754;">$ <?php echo number_format($total, 2); ?></p>
                                    </div>                  
                            </div>
                            <?php
                          }
                          ?>

                            <h5 class="fw-bold mt-4">Payment Method</h5>
                                <div class="payment-container w-auto mt-3">
                                    
                                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary" for="option1"><i class="bi bi-cash-coin"></i>Cash</label>

                                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary" for="option2"><i class="bi bi-credit-card"></i>Master Card</label>

                                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary" for="option3"><i class="bi bi-bank"></i>Bank</label>

                                    <button type="button" class="btn btn-primary btn-lg">PAY</button>
                                </div>   
                        </div>  
                </div>
            </div>
    </div>

    </section>

    <script src="/assets/js/script.js"></script>

</body>
</html>