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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <option value="1">Hand tools</option>
                        <option value="2">Cutting tools</option>
                        <option value="3">Paint tools</option>
                        <option value="4">Woods</option>
                        <option value="5">Walls</option>
                        <option value="6">Welding/Equipment</option>
                        <option value="7">Drill tools</option>
                        <option value="8">Measure tools</option>
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
                              <input  type= "hidden" class="card-title mt-5" name="hidden_name"><?php echo $row["product"]; ?></input>
                                <input type= "hidden" class="card-text" name="hidden_price">₱ <?php echo $row["price"]; ?></input>

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
                                    <p><span id="day"></span> , <span id="year"></span></p>
                                    <p id="time"></p>
                                </div>
                    </div>  
                    <br>
           
                        <div class="body-invoice">                   
                        <?php
                                  if(!empty($_SESSION["shopping_cart"]))
                                  {
                                    $total = 0;
                                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                                    {
                                  ?>
                            <div class="bill-pay">
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
                                                <!-- <button type="button" class="btn bg-light border rounded-circle"><i class="fa-solid fa-minus"></i></button> -->

                                                <p><?php echo $values["item_quantity"]; ?></p>

                                                <!-- <button type="button" class="btn bg-light border rounded-circle"><i class="fa-solid fa-plus"></i></button> -->
                                                  <a class="btn-remove" type="button"  href="/pages/administrator/merchandise.php?action=delete&id=<?php echo $values["item_id"]; ?>" style="background: none; border:none;"><i class="bi bi-trash3"></i></a>                     
                                            </div>
                                            <?php
                                                  $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                                    }
                                                  ?>
                                      </div>
                                    </div>
                                  </div>

                            </div>       
                            <div class="total-container mt-4">
                                <div class="total-items">
                                    <p>Total Items</p>
                                        <p class="fw-bold"></p>
                                </div>
                                    <div class="subtotal">
                                        <p>subtotal</p>
                                            <p class="fw-bold" style="color: #198754;">$ <?php echo number_format($total, 2); ?></p>
                                    </div>   
                             
                            </div>
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
                        <?php
                          }
                          ?>
                </div>
            </div>
    </div>

    </section>

    <script src="/assets/js/script.js"></script>
    <script>
  $(document).ready(function(){
           // Code for year 
             
           var currentdate = new Date(); 
             var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear();
                $('#year').text(datetime);
 
           // Code for extract Weekday     
                function myFunction()
                 {
                    var d = new Date();
                    var weekday = new Array(7);
                    weekday[0] = "Sunday";
                    weekday[1] = "Monday";
                    weekday[2] = "Tuesday";
                    weekday[3] = "Wednesday";
                    weekday[4] = "Thursday";
                    weekday[5] = "Friday";
                    weekday[6] = "Saturday";
 
                    var day = weekday[d.getDay()];
                    return day;
                    }
                var day = myFunction();
                $('#day').text(day);
     });
    </script>

    <!--Code for TIME -->
<script>
    window.onload = displayClock();
 
     function displayClock(){
       var time = new Date().toLocaleTimeString();
       document.getElementById("time").innerHTML = time;
        setTimeout(displayClock, 1000); 
     }
</script>

</body>
</html>