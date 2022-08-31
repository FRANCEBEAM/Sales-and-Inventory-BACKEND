<?php require_once "../config/controllerUserData.php"; ?>
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


// //CART SECTION
// require_once ("../config/cartComponent.php");
// require_once ("../config/controllerCartData.php");


// $db = new productlist("rjavancena", "productlist");


// if (isset($_POST['remove'])){
//   if ($_GET['action'] == 'remove'){
//       foreach ($_SESSION['cart'] as $key => $value){
//           if($value["productid"] == $_GET['id']){
//               unset($_SESSION['cart'][$key]);
//               echo "<script>alert('Product has been Removed...!')</script>";
//           }
//       }
//   }
// }
?>

<?php
  // session_start();
//CART SECTION
// require_once ("../config/cartComponent.php");
// require_once ("../config/controllerCartData.php");


// $db = new productlist("rjavancena", "productlist");


// if (isset($_POST['remove'])){
//   if ($_GET['action'] == 'remove'){
//       foreach ($_SESSION['cart'] as $key => $value){
//           if($value["productid"] == $_GET['id']){
//               unset($_SESSION['cart'][$key]);
//               echo "<script>alert('Product has been Removed...!')</script>";
//           }
//       }
//   }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My cart</title> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel="stylesheet" href="../styles/cart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
</head>
<body>
  <div class="main-container">
    <!--NAVIGATION-->
  <head>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/img/avancena logo.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/pages/home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">About</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="fullname">
                <b><?php echo $fetch_info['fullname'] ?></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="/pages/profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="/pages/account.php">Account</a></li>
                  <li><a class="dropdown-item" href="/index.php">Logout</a></li>
                </ul>
              </li>

            <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a href='../pages/cart.php'>
            <i class="fa-solid fa-bag-shopping"></i>
                  </i>
                  </a>
                    <?php
                          if (isset($_SESSION['cart'])){
                              $count = count($_SESSION['cart']);
                              echo "<span id='cart_count'>$count</span>";
                          }else{
                              echo "<span id='cart_count' class='text-warning bg-light'>0</span>";
                          }
                      ?>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</head>

<!-- CART LIST CONTENT -->
  <div class="cartList-container mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div style="display:<?php if (isset($_SESSION['showAlert'])) {
    echo $_SESSION['showAlert'];
  } else {
    echo 'none';
  } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
  } unset($_SESSION['showAlert']); ?></strong>
          </div>
          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped text-center">
              <thead>
                <tr>
                  <td colspan="7">
                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                  </td>
                </tr>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>
                    <a href="../config/--action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                  require '../config/--configure.php';
                  $stmt = $conn->prepare('SELECT * FROM cart');
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $grand_total = 0;
                  while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                <td><?= $row['id'] ?></td>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <td><img src="<?= $row['image_file'] ?>" width="50"></td>
                  <td><?= $row['product'] ?></td>
                  <td>
                    <i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2); ?>
                  </td>
                  <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                  <td>
                    <input type="number" class="form-control itemQty" id="itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                  </td>
                  <td><i class="fa-solid fa-peso-sign"></i></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                  <td>
                    <a href="../config/--action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                <?php $grand_total += $row['total_price']; ?>
                <?php endwhile; ?>
                <tr>
                  <td colspan="3">
                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                      Shopping</a>
                  </td>
                  <td colspan="2"><b>Sub Total</b></td>
                  <td><b><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                  <td>
                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
   </div>

    <!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">PRODUCT NAME</th>
              <th scope="col">QTY</th>
              <th scope="col">PRICE</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Boysen Glow White</td>
              <td>102</td>
              <td>₱749</td>
            </tr>
            <tr>         
              <td>Boysen Glow White</td>
              <td>102</td>
              <td>₱749</td>
            </tr>
            <tr>         
              <td>Boysen Glow White</td>
              <td>102</td>
              <td>₱749</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Confirm order</button>
      </div>
    </div>
  </div>
</div>
        <script src="/js/app.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
      <script>
        AOS.init();
      </script>
      <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $("#itemQty").on('change', function() {
      var $el = $(this).closest('tr');
      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find("#itemQty").val();
      location.reload(true);
      $.ajax({
        url: '/config/--action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
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
        url: '/config/--action.php',
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
</body>
</html>