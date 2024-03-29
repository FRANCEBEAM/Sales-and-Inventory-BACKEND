<?php require_once "./config/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: resetCode.php');
            }
        }else{
            header('Location: otp.php');
        }
    }
}else{
    header('Location: signin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include './--header.php'?>
  <title>My cart</title> 
  <link rel="stylesheet" href="/assets/css/cart.css">
</head>
</head>
<body>
  <div class="main-container">
    <!--NAVIGATION-->
    <head>
      <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="/assets/img/avancena logo.svg" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">About</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                  <a class="dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="fullname">
                  <b>Joe Sassy</b>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="./account.php">Account</a></li>
                    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                  </ul>
                </li>
  
              <ul class="navbar-nav">
              <li class="nav-item dropdown"><a href='./cart.php'><i class="fas fa-shopping-cart"></i><span id="cart-item" class="badge bg-danger"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  </head>

<!-- CART LIST CONTENT -->
<div class="cartList-container mt-5" id="cartcart">
  <h4 class="fw-bold mt-5 mb-5">My cart</h4>

    <?php
        require '../customer/config/--configure.php';
        $grand_total = 0;
        $stmt = $conn->prepare("SELECT * FROM `cart` WHERE email = '$email'");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()):
        $grand_total = $grand_total+($row['qty']*$row['price']);

    ?>
  <div class="card mb-2">
    <div class="img-container">
          <img src="assets/img/image 1.jpg" alt="">
    </div>
    <div class="card-body">
      <h5 class="card-title"><?= $row['product'] ?></h5>
      <p class="card-text"><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2); ?></p>

    
  <div class="qty-container">
    <form id="frm<?php echo $row['id'] ?>">
      <input type="hidden" name="cart_id" value="<?php  echo $row['id'];?>">
        <input type="number" class="form-control itemQty" name="qty" id="itemQty" value="<?php echo $row['qty']; ?>" onchange="updcart(<?php echo $row['id'];  ?>)" onkeyup="updcart(<?php echo $row['id'];  ?>)">
  </form>
  </div>

      <div class="card-foot">
        <h5 class="card-title total"><b>Total:&nbsp;&nbsp;</b><?= number_format($row['price']*$row['qty']); ?></h5>
        <a href="./config/--action.php?remove=<?= $row['id'] ?>" class="text-danger btnRemove" onclick="deletedata(<?php echo $row['id'];?>)"><i class="bi bi-trash3-fill text-danger removeBtn"></i></a>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
  <div class="total-container">
    <h5 class="sub-total"><b>Subtotal:&nbsp;&nbsp;</b><i class="fa-solid fa-peso-sign"></i><?= number_format($grand_total,2); ?></h5>
    <a href="./checkout.php" class="btn btn-success mt-4 mb-5 <?= ($grand_total > 1) ? '' : 'disabled'; ?>" data-bs-toggle="modal" data-bs-target="#modalOrder"><b>CHECKOUT</b>&nbsp;&nbsp;<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12.8377 8.01561H1.63281C1.38689 8.01561 1.1875 8.215 1.1875 8.46092V10.539C1.1875 10.785 1.38689 10.9844 1.63281 10.9844H12.8377V12.6936C12.8377 13.4871 13.797 13.8844 14.3581 13.3234L17.5517 10.1298C17.8995 9.78194 17.8995 9.21803 17.5517 8.87024L14.3581 5.67664C13.797 5.11558 12.8377 5.51295 12.8377 6.30642V8.01561V8.01561Z" fill="white"/>
      </svg>
    </a>

<!-- Modal -->
<div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<?php
	require './config/--configure.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product, '(',qty,')') AS ItemQty, total_price,qty,price FROM cart where email = '$email'";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  // $grand_total += $row['total_price'];
    $grand_total = $grand_total+($row['qty']*$row['price']);
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="" id="order">
         <h4 class="text-center text-success p-2 mb-5">Confirm your orders and details</h4>
         <div class="p-3 mb-2 text-center displayOrder">
          <h5><b>Products: </b><?= $allItems; ?></h5>
          <h5 class="mt-3"><b>Total Amount: </b><?=number_format($grand_total,2) ?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
          <label class="form-label">Full Name:</label>
            <input type="text" name="fullname" class="form-control" placeholder="Enter Name" value='<?php echo $fetch_info['fullname'] ?>'>
          </div>
          <div class="form-group">
          <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" value='<?php echo $fetch_info['email'] ?>'>
          </div>
          <div class="form-group">
          <label class="form-label">Phone Number:</label>
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" value='<?php echo $fetch_info['phone'] ?>' required>
          </div>
          <div class="form-group">
          <label class="form-label">Address:</label>
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."><?php echo $fetch_info['address'] ?></textarea>
          </div>
          <h6 class="text-center lead mt-5 fw-bold">Select Payment Mode</h6>
          <div class="form-group">
            <select name="paymentmode" class="form-control mt-3">
              <option value="Cash On Delivery"></i>Cash On Delivery</option>
              <option value="Walk-in">Walk-In</option>
              <option value="Debit/Credit Card">Debit/Credit Card</option>
            </select>
          </div>
          <div class="modal-footer">
          <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary btn-lg mb-3 btn-block">
        <button type="button" class="btn btn-secondary btn-lg  btn-block" data-bs-dismiss="modal">Close</button>
      </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


<?php include './--footer.php'?>

</body>
</html>