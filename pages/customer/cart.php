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
<div class="cartList-container mt-5">

    <?php
        require '../customer/config/--configure.php';
        $stmt = $conn->prepare("SELECT * FROM `cart` WHERE email = '$email'");
        $stmt->execute();
        $result = $stmt->get_result();
        $grand_total = 0;
        while ($row = $result->fetch_assoc()):
    ?>

  <div class="card mb-2">
    <div class="img-container">
          <img src="assets/img/image 1.jpg" alt="">
    </div>
    <div class="card-body">
      <h5 class="card-title"><?= $row['product'] ?></h5>
      <p class="card-text"><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2); ?></p>

      <div class="qty-container">
        <div class="btn btn-outline-dark value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><i class="fa-sharp fa-solid fa-minus"></i></div>
        <input type="number" class="form-control itemQty" id="itemQty" value="<?= $row['qty'] ?>">
        <div class="btn btn-dark value-button" id="increase" onclick="increaseValue()" value="Increase Value"><i class="fa-sharp fa-solid fa-plus"></i></div>
      </div>

      <div class="card-foot">
        <h5 class="card-title total"><b>Total:&nbsp;&nbsp;</b><?= number_format($row['total_price'],2); ?></h5>
        <a href="./config/--action.php?remove=<?= $row['id'] ?>" class="text-danger btnRemove" onclick="deletedata(<?php echo $row['id'];?>)"><i class="bi bi-trash3-fill text-danger removeBtn"></i></a>
        
      </div>
    </div>
  </div>
  <?php $grand_total += $row['total_price']; ?>
  <?php endwhile; ?>
  <div class="total-container">
    <h5 class="sub-total"><b>Subtotal:&nbsp;&nbsp;</b><i class="fa-solid fa-peso-sign"></i><?= number_format($grand_total,2); ?></h5>
    <a href="checkout.php" class="btn btn-success mt-4 mb-5 <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><b>CHECKOUT</b>&nbsp;&nbsp;<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12.8377 8.01561H1.63281C1.38689 8.01561 1.1875 8.215 1.1875 8.46092V10.539C1.1875 10.785 1.38689 10.9844 1.63281 10.9844H12.8377V12.6936C12.8377 13.4871 13.797 13.8844 14.3581 13.3234L17.5517 10.1298C17.8995 9.78194 17.8995 9.21803 17.5517 8.87024L14.3581 5.67664C13.797 5.11558 12.8377 5.51295 12.8377 6.30642V8.01561V8.01561Z" fill="white"/>
      </svg>
      
      </a>
  </div>
</div>


<?php include './--footer.php'?>
  <script type="text/javascript">

  $(document).ready(function() {


    $(".btnRemove").on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href')

        Swal.fire({
        title: 'Remove from the cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Remove'
      }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
      })
    });

    // Change the item quantity
    $("#itemQty").on('change', function() {
      var $el = $(this).closest('tr');
      var id = $el.find(".pid").val();
      var price = $el.find(".pprice").val();
      var qty = $el.find("#itemQty").val();
      location.reload(true);
      $.ajax({
        url: '/pages/customer/config/--action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          id: pid,
          price: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: '/pages/customer/config/--action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>

  <script src="/js/quantity.js"></script>
</body>
</html>