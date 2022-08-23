<!-- Coding by RJ Avanceña Enterprises -->
<?php
session_start();

// LETS REQUIRE ONCE THE MERCHANDIZE, IT'S A CONTROLLER OF OUR DATA
require_once("--merchandize-controller.php");
// CALL THE DBCONTROLLER CLASS 
$db_handle = new DBController();
//WE DECIDE TO USE SWITCH CASE IF THE CONDITION ARE MET, IT WILL INITIALIZE
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  //WE CALL THIS AS "ADD" CASE WHEN IT TRIGGER THE BUTTON
	case "add":
		if(!empty($_POST["quantity"])) {
    // VARIABLE productSerialNumber AS THE UNIQUE REFERENCE/KEY ACCESS IN OUR DATABASE
			$productSerialNumber = $db_handle->runQuery("SELECT * FROM inventory WHERE serialnumber='" . $_GET["serialnumber"] . "'");
			$itemArray = array($productSerialNumber[0]["serialnumber"]=>array('product'=>$productSerialNumber[0]["product"], 'serialnumber'=>$productSerialNumber[0]["serialnumber"], 'quantity'=>$_POST["quantity"], 'price'=>$productSerialNumber[0]["price"], 'image'=>$productSerialNumber[0]["image"]));
			
      //LETS TEST THE CONDITION INSIDE OF OUR ARRAY THAT HAVE PRODUCT
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productSerialNumber[0]["serialnumber"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productSerialNumber[0]["serialnumber"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;

  // INCASE WE WANT TO REMOVE THE PRODUCT IN THE LIST
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["serialnumber"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}

    // THEN SHOW ME A NO ITEM RECIEPT FOUND
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
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
                      <select class="form-select w-25" aria-label="Default select example">
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

                 <!-- OUR PRODUCT LIST THAT WILL ADD IN THE INVENTORY/DATABASE-->
                 <div class="productlist-container">
                 <?php
                  $product_array = $db_handle->runQuery("SELECT * FROM inventory ORDER BY id ASC");
                  if (!empty($product_array)) { 
                    foreach($product_array as $key=>$value){
                  ?>
                        <form method="post" class="product-form" action="/pages/administrator/merchandise.php?action=add&serialnumber=<?php echo $product_array[$key]["serialnumber"]; ?>">
                          <div class="card text-center">
                            <img src="/assets/img/image 1.jpg" alt="">
                            <div class="product-title mt-3"><?php echo $product_array[$key]["product"]; ?></div>
                             <div class="product-price mt-1"><?php echo "₱".$product_array[$key]["price"]; ?></div>
                             <input type="text" class="product-quantity mt-3 w-50" name="quantity" value="1" size="2"  style="align-items: center; margin:auto;"/>
                               <input type="submit" value="Add to bill" style="align-items: center; margin:auto; text-align:center;" class="btn btn-primary mt-3 w-50 text-center"/>
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
                  <!-- HEAD INVOICE CONTENT SHOWS DATE/TIME AND TRANSACTION -->
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
                        <!-- BODY INVOICE WILL REPRESENT AS THE ADD PRODUCT LIST -->
                        <div class="body-invoice">
                        <a id="btnEmpty" class ="text-danger" href="/pages/administrator/merchandise.php?action=empty" style="text-decoration: none">Clear all</a>     
                            <div class="bill-pay">
                            <?php
                                if(isset($_SESSION["cart_item"])){
                                    $total_quantity = 0;
                                    $total_price = 0;
                                ?>	  
                                <div class="card" style="max-width: 540px;">
                                    <?php		
                                    foreach ($_SESSION["cart_item"] as $item){
                                        $item_price = $item["quantity"]*$item["price"];
                                    ?>  
                                    <div class="row g-0">
                                      <div class="col-md-4">
                                        <!-- <img src="/assets/img/image 2.jpg" class="img-fluid rounded-start" alt="..."> -->
                                      </div>
                                      <div class="col-md-8">
                                        <div class="card-body mb-3">
                                        <h5 class="card-title fw-bold"><?php echo $item["product"]; ?></h5>
                                          <p class="card-text"><?php echo "₱ ".$item["price"]; ?></p>                    
                                          <div class="qty">
                                                <p><?php echo "Qty: ". $item["quantity"]; ?></p>
                                                <a href="/pages/administrator/merchandise.php?action=remove&serialnumber=<?php echo $item["serialnumber"]; ?>" class="btnRemoveAction"><i class="bi bi-trash3"></i></a>                                   
                                            </div>                   
                                          </div>
                                        </div>
                                    </div>
                                    <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["price"]*$item["quantity"]);
                                    }
                                ?>
                              </div>
                            </div>       
  
                            <!-- TOTAL CONTENT -->
                            <div class="total-container mt-4">
                                <div class="total-items">
                                   <p>Total Items</p>
                                      <p class="fw-bold"><?php echo $total_quantity; ?></p>
                                </div>
                                <div class="subtotal">
                                    <p>subtotal</p>
                                      <p class="fw-bold" style="color: #198754;"><?php echo "₱ ".number_format($total_price, 2); ?></p>
                                </div>   
                            </div>
                            <?php
                                  } else {
                                  ?>
                                  <div class="no-records" style="text-align: center; padding-top: 4em; padding-bottom: 4em;">No item reciept <i class="bi bi-bag-check"></i></div>
                                  <?php 
                                  }
                              ?>

                              <!-- PAYMENT METHOD -->
                            <h5 class="fw-bold mt-4">Payment Method</h5>
                                <div class="payment-container w-auto mt-3">    
                                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                                      <label class="btn btn-outline-secondary" for="option1"><i class="bi bi-cash-coin"></i>Cash</label>

                                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" checked>
                                      <label class="btn btn-outline-secondary" for="option2"><i class="bi bi-credit-card"></i>Master Card</label>

                                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" checked>
                                      <label class="btn btn-outline-secondary" for="option3"><i class="bi bi-bank"></i>Bank</label>

                                    <button type="button" class="btn btn-success btn-lg">PAY</button>
                                </div>   
                        </div>  
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