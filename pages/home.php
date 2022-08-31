<?php require_once "../config/controllerUserData.php"; ?>

<?php 
session_start();
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


//FOR CART SECTION
// require_once "../config/cartComponent.php";
// require_once "../config/controllerCartData.php";


// $database = new productlist("rjavancena", "productlist");

// if(isset($_POST['add'])){
    // print_r($_POST['productid']);
//   if(isset($_SESSION['cart'])){

//         $item_array_id = array_column($_SESSION['cart'], "productid");

//         if(in_array($_POST['productid'], $item_array_id)){
//             echo "<script>alert('Product is already added in the cart..!')</script>";
//             echo "<script>window.location = '../pages/home.php'</script>";
//         }else{

//             $count = count($_SESSION['cart']);
//             $item_array = array(
//                 'productid' => $_POST['productid']
//             );

//             $_SESSION['cart'][$count] = $item_array;
//         }

//     }else{
//       $item_array = array(
//         'productid' => $_POST['productid']
//         );

//         // Create new session variable
//         $_SESSION['cart'][0] = $item_array;
//         print_r($_SESSION['cart']);
//         }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R.J. Avancena</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
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

    <!--HERO SECTION-->
    <div class="hero-container" id="home">
      <div class="left-content">
        <div class="text-content">
            <h5 data-aos="fade-right" data-aos-duration="1000">Good Tools for Good Works</h5>
             <h1 data-aos="fade" 
             data-aos-duration="400"
             data-aos-delay="300">MAKING YOUR LIFE SIMPLE</h1>
             <p class="mt-2" data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. A, habitasse egestas ipsum aenean ultricies sed sed. Egestas pulvinar enim in purus dictum.</p>
        </div>

        <div class="col text-center">
        <a data-aos="fade-left"
        id="btn-shopnow"
        data-aos-duration="400" class="btn btn-primary mt-5" href="#item-list">Shop Now <i class="fa-solid fa-cart-shopping"></i></a>
        </div>
      </div>

      <div class="right-content" data-aos="fade-up">
    </div>
  </div>
 
    <!--STORE INFO-->
    <div class="info-container" data-aos="fade-up" data-aos-duration="1000">
        <div class="truck-container">    
            <i class="bi bi-truck"></i>
            <h5><b>Offer Truck Deliver</b></h5>
          <p>Minimum of 100 Quantity</p>
        </div>

        <div class="open-container">
          <i class="bi bi-clock"></i>
          <h5><b>Open Hours</b></h5>
          <p>7:00 AM to 5:00 PM</p>
        </div>

        <div class="loc-container">
          <i class="bi bi-geo-alt"></i>
          <h5><b>Location</b></h5>
          <p>Area B SJDM Bulacan</p>
      </div>
    </div>

        <!-- SEARCH BAR -->
        <div class="search-container">
            <div class="search-bar">
              <form class="">
                <label class="mb-2">Enter a product that you want to search</label>
                <div class="d-flex">
                <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                
                <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i>Search</button> 
                <!-- <a href="/pages/signin.php">
                    <i class="bi bi-bag-check"></i>
                </a> -->
              </div>
              <label class="mt-2 fw-bold">Popular: </label>
              </form>
            </div>
            
          </div>

  
   <!--CATEGORIES SECTION-->
   <div class="categories-container">
     <h5 class="shopCateg" id="shop-categories">Shop by categories:</h5>
   </div>

   
    <div class="swiper">
      <div class="swiper-wrapper">   
        <div class="swiper-slide">
          <img src="/img/toolshammer.svg" width="50%">
          <p>Hand Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/welding.svg">
          <p>welding Equipment</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/paint.svg">
          <p>Paints</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/brickwall.svg">
          <p>Cements</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/wood.svg">
          <p>Woods</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/cutting.svg">
          <p>Cutting Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/drill.svg">
          <p>Power Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/steel.svg">
          <p>Structural Steel</p>
        </div>
        <div class="swiper-slide">
          <img src="/img/measure.svg">
          <p>Measure Tools</p>
        </div>
      </div>

      <div class="swiper-pagination"></div>
    </div>
          

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include '../config/--configure.php';
  			$stmt = $conn->prepare('SELECT * FROM inventory');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['image_file'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
              <h4 class="card-title text-center text-info"><?= $row['product'] ?></h4>
              <h5 class="card-text text-center text-danger"><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?>/-</h5>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control quantity" value="<?= $row['quantity'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="product" value="<?= $row['product'] ?>">
                <input type="hidden" class="price" value="<?= $row['price'] ?>">
                <input type="hidden" class="image_file" value="<?= $row['image_file'] ?>">
                <input type="hidden" class="serialnumber" value="<?= $row['serialnumber'] ?>">
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->


    <!--PAGINATION-->
    <div class="pagination-container">
      <ul class="pagination">
        <li class="page-item disabled">
          <span class="page-link">Previous</span>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item" aria-current="page">
          <span class="page-link">2</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
  </div>

    <!--ABOUT SECTION-->
    <div class="about-container" id="about-section">
      <h1>ABOUT</h1>

      <div class="about-text">
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultrices amet tellus ac, curabitur. Risus, sit arcu in purus vulputate odio. Scelerisque sit sollicitudin enim purus lacus vestibulum, leo laoreet semper. Fermentum metus purus risus commodo turpis.</p> 
      </div>

      <div class="about-socials">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-instagram"></i>
        <i class="bi bi-twitter"></i>
      </div>
    </div>
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
 <!-- Initialize Swiper -->
 <script src="/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
<script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var id = $form.find(".id").val();
      var product = $form.find(".product").val();
      var price = $form.find(".price").val();
      var image_file = $form.find(".image_file").val();
      var serialnumber = $form.find(".serialnumber").val();

      var quantity = $form.find(".quantity").val();

      $.ajax({
        url: '/config/--action.php',
        method: 'post',
        data: {
          id: id,
          product: product,
          price: price,
          quantity: quantity,
          image_file: image_file,
          serialnumber: serialnumber
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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