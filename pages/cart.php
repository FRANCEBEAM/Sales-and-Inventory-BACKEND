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
                          <!--LOGO-->
                          <a class="navbar-brand" href="#">  
                            <div class="logo">
                           <h1><span class="iconify" data-icon="ion:storefront"></span>
                            R.J.<span style="color:#0094FF">AVANCEÑA</span></h1>
                            <span class="ent">ENTERPRISES</span>
                              </div>
                           </a>
                
                           <!--NAVBAR TOGGLE-->
                           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                
                          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                              <ul class="navbar-nav navbar-nav-scroll" style="--bs-scroll-height: 200px;">
                                <li class="nav-item">
                                  <a class="home" aria-current="page" href="/pages/home.php">Home</a>
                                </li>
                                <li class="nav-item">
                                  <a class="shop" aria-current="page" href="#">Shop</a>
                                </li>
                                <li class="nav-item">
                                  <a class="about" aria-current="page" href="#about-section">About</a>
                                </li>
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

        <tbody class=" mt-2">
          <tr class="item mt-2">
            <td>
                <img src="/img/item1.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </td>

            <td>
              <div class="qty-container">
              <button>-</button>
              <input type="text" style="width: 30px;">
              <button>+</button>
            </div>
            </td>
            <td class="productPrice">₱749</td>
            <td class="productTotal">₱1250</td>
            <td><i class="bi bi-trash3"></i></td>
          </tr>

          <tr class="item mt-2">
            <td class="item"><img src="/img/item1.png" alt="">
              <p>Lorem ipsum dolor sit amet</p>
          </td>

            <td>
              <div class="qty-container">
              <button>-</button>
              <input type="text" style="width: 30px;">
              <button>+</button>
            </div>
            </td>
            <td class="productPrice">₱749</td>
            <td class="productTotal">₱1250</td>
            <td><i class="bi bi-trash3"></i></td>
          </tr>

          <tr class="item mt-2">
            <td class="item">
              <img src="/img/item1.png" alt="">
                <p>Lorem ipsum dolor sit amet</p>
            </td>
            <td>
              <div class="qty-container">
              <button>-</button>
              <input type="text" style="width: 30px;">
              <button>+</button>
            </div>
            </td>
            <td class="productPrice">₱749</td>
            <td class="productTotal">₱1250</td>
            <td><i class="bi bi-trash3"></i></td>
          </tr>
        </tbody>
      </table>

     <div class="foot-container mt-5">
        <div class="total-container">
            <h1>Total items:</h1>
            <p>3</p>
        </div>

            <div class="subtotal-container ">
                <h1>Subtotal:</h1>
                <p>₱4999</p>
            </div>

            <div class="checkout-container"> 
              <a class="btn btn-dark" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</a>
              <i class="bi bi-bag-check"></i>
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