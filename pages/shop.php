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
    <title>R.J. Avancena</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
              <a class="nav-link" aria-current="page" href="/pages/home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/pages/shop.php">Shop</a>
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
            <li class="nav-item dropdown"><a href='../pages/cart.php'><i class="fas fa-shopping-cart"></i><span id="cart-item" class="badge bg-danger"></span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</head>
    <!--HERO SECTION-->
    <div id="message"></div>

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
  <div class="item-container" id="item-list">
  <?php
  			include '../config/--configure.php';
  			$stmt = $conn->prepare('SELECT * FROM inventory');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
  <div class="mb-5 card">
    <img src="/img/image 1.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title mt-2"><b><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?></b></h5>
      <p class="card-text mt-2"><?= $row['product'] ?></p>

      <form action="" class="form-submit">
      <input type="hidden" class="form-control quantity" value="50">
      <input type="hidden" class="id" value="<?= $row['id'] ?>">
      <input type="hidden" class="product" value="<?= $row['product'] ?>">
      <input type="hidden" class="price" value="<?= $row['price'] ?>">
      <input type="hidden" class="image_file" value="<?= $row['image_file'] ?>">
      <input type="hidden" class="serialnumber" value="<?= $row['serialnumber'] ?>">
      <a href="#" class="btn btn-primary mt-4 d-md-block addItemBtn">Add to cart</a>
      </form>
    </div>
  </div>
  <?php endwhile; ?>
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
 <!-- Initialize Swiper -->
 <script src="/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="/js/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href='/styles/sweetalert2.min.css' media="screen" />


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
          // window.scrollTo(0, 0);
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