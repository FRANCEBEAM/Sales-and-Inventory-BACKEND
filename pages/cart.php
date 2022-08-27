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
//CART SECTION
require_once ("../config/cartComponent.php");
require_once ("../config/controllerCartData.php");


$db = new productlist("rjavancena", "productlist");


if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["productid"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
          }
      }
  }
}

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
  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
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
                <a class="dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
                <div class="cartList-container mt-5">
                    <table class="table">
                      <thead>
                        <tr>
                          <td scope="col">PRODUCT DETAILS</td>
                      
                          <td scope="col">QUANTITY</td>
                          <td scope="col">PRICE</td>
                          <td scope="col">TOTAL</td>
                          <td scope="col"></td>
                        </tr>
                      </thead>

        <?php
                  $total = 0;
                      if (isset($_SESSION['cart'])){
                          $productid = array_column($_SESSION['cart'], 'productid');

                          $result = $db->getData();
                          while ($row = mysqli_fetch_assoc($result)){
                              foreach ($productid as $id){
                                  if ($row['id'] == $id){
                                      cartElement($row['productimage'], $row['productname'],$row['productprice'], $row['id']);
                                      $total = $total + (int)$row['productprice'];
                                  }
                              }
                          }
                      }else{
                          echo "<h5>Cart is Empty</h5>";
                      }

        ?>
                    </table>

                  <div class="foot-container mt-5">
                      <div class="total-container">
                          <h1>Total items:</h1>
                          <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<p>$count items</p>";
                            }else{
                                echo "<h6>0 items</h6>";
                            }
                        ?>
                      </div>

                          <div class="subtotal-container ">
                              <h1>Subtotal:</h1>
                              <p>$<?php echo $total; ?></p>
                          </div>

                          <div class="checkout-container"> 
                            <a class="btn btn-dark" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</a>
                            <i class="bi bi-bag-check"></i>
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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
      <script>
        AOS.init();
      </script>
</body>
</html>