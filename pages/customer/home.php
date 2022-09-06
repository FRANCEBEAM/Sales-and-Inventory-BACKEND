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
    <title>Home</title>
    <link rel="stylesheet" href="/assets/css/home.css">
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
              <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
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
                <b><?php echo $fetch_info['fullname'] ?></b>
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
    <!--HERO SECTION-->
    <div id="message"></div>
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
        data-aos-duration="400" class="btn btn-primary mt-5" href="./shop.php">Shop Now <i class="fa-solid fa-cart-shopping"></i></a>
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
              </div>
              <label class="mt-2 fw-bold">Popular: </label>
              </form>
            </div>
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

<?php include './--footer.php'?>

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
</body>
</html>
