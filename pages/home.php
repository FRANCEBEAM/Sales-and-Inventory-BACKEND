<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: signin.php");
        die();
    }else if(!isset($_SESSION['SESSION_EMAIL'])) {
      header("Location: signin.php");
      die();
    }

    include 'configure.php';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");


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
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="stylesheet" href="/styles/index.css">
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
                <a class="home" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="shop" aria-current="page" href="#">Shop</a>
              </li>
              <li class="nav-item">
                <a class="about" aria-current="page" href="#about-section">About</a>
              </li>
              <li class="nav-item">
              <a><b><?php if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
                echo "Welcome " . $row['username'];
                }
              ?></b></a>
              </li>
              <li class="nav-item">
                <a class="logout"  aria-current="page" href="/pages/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</head>

    <!--HERO SECTION-->
    <div class="hero-container">
      <div class="left-content">
        <div class="text-content">
            <h5 data-aos="fade-right" data-aos-duration="1000">Good Tools for Good Works</h5>
             <h1 data-aos="fade" 
             data-aos-duration="400"
             data-aos-delay="300">MAKING YOUR LIFE SIMPLE</h1>
        </div>
        <a data-aos="fade-left" 
        data-aos-duration="400" class="btn-dark" href="#shop-categories"><i class="bi bi-bag-check"></i> Shop Now!</a>
      </div>

      <div class="right-content" data-aos="fade-up">
        <div class="bg-hero">
          <img src="/img/bgHero.svg" alt="">
        </div>
    </div>
  </div>
 
    <!--STORE INFO-->
    <div class="store-info" data-aos="fade-up" data-aos-duration="1000">
      <div class="info-container">
        <div class="truck-container">    
            <i class="bi bi-truck"></i>
            <p><b>Offer Truck Deliver</b></p>
          <p>Minimum of 100 Quantity</p>
        </div>

        <div class="open-container">
          <i class="bi bi-clock"></i>
          <p><b>Open Hours</b></p>
          <p>7:00 AM to 5:00 PM</p>
        </div>

        <div class="loc-container">
          <i class="bi bi-geo-alt"></i>
          <p><b>Location</b></p>
          <p>Area B SJDM Bulacan</p>
        </div>
      </div>
    </div>

        <!-- SEARCH BAR -->
        <div class="search-container pt-5">
          <form class="d-flex">
          <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          </div>

    <!--DROP DOWN SECTION-->
    <!--SIZE-->
   <div class="dropdown">
    <button class="btn dropdown-toggle" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
      Size
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <li><button class="dropdown-item" type="button">Size 12</button></li>
      <li><button class="dropdown-item" type="button">Size 24</button></li>
      <li><button class="dropdown-item" type="button">Size 36</button></li>
      <li><button class="dropdown-item" type="button">Size 48</button></li>
      <li><button class="dropdown-item" type="button">Size 50</button></li>
    </ul>

    <!--COLOR-->
    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Color
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <li><button class="dropdown-item" type="button">Green</button></li>
      <li><button class="dropdown-item" type="button">Red</button></li>
      <li><button class="dropdown-item" type="button">Blue</button></li>
      <li><button class="dropdown-item" type="button">Yellow</button></li>
      <li><button class="dropdown-item" type="button">White</button></li>
    </ul>

   <!--TYPE-->
    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Type
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <li><button class="dropdown-item" type="button">B1</button></li>
      <li><button class="dropdown-item" type="button">B2</button></li>
      <li><button class="dropdown-item" type="button">B3</button></li>
      <li><button class="dropdown-item" type="button">B4</button></li>
      <li><button class="dropdown-item" type="button">B5</button></li>
    </ul>
  </div>

   <!--CATEGORIES SECTION-->
   <p class="shopCateg" id="shop-categories" data-aos="fade-right" data-aos-duration="1000">Shop By Categories:</p>
   
    <div class="swiper" data-aos="fade-up" data-aos-duration="1000">
      <div class="swiper-wrapper">   
        <div class="swiper-slide">
          <img src="img/toolshammer.svg" width="50%">
          <p>Hand Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="img/welding.svg">
          <p>welding Equipment</p>
        </div>
        <div class="swiper-slide">
          <img src="img/paint.svg">
          <p>Paints</p>
        </div>
        <div class="swiper-slide">
          <img src="img/brickwall.svg">
          <p>Cements</p>
        </div>
        <div class="swiper-slide">
          <img src="img/wood.svg">
          <p>Woods</p>
        </div>
        <div class="swiper-slide">
          <img src="img/cutting.svg">
          <p>Cutting Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="img/drill.svg">
          <p>Power Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="img/steel.svg">
          <p>Structural Steel</p>
        </div>
        <div class="swiper-slide">
          <img src="img/measure.svg">
          <p>Measure Tools</p>
        </div>
      </div>
            <!-- Add Arrows -->          
              <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div>
          </div>
          

    <!--ITEM LIST SECTION-->
      <div class="item-container" id="item-list">
        <!-- 1 item -->
        <div class="card" style="width: 20rem; height: 22rem;">
          <img src="/img/item1.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><b>₱749</b></h5>
            <p class="card-text">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>

          <!-- 2 item -->
          <div class="card" style="width: 20rem; height: 22rem;">
            <img src="/img/item1.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><b>₱749</b></h5>
              <p class="card-text">Dual TIG/MMA with Welding Mask</p>
              <a href="#" class="btn btn-primary">Add to cart</a>
            </div>
          </div>

        <!-- 3 item -->
        <div class="card" style="width: 20rem; height: 22rem;">
          <img src="/img/item1.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><b>₱749</b></h5>
            <p class="card-text">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>

          <!-- 4 item -->
          <div class="card" style="width: 20rem; height: 22rem;">
            <img src="/img/item1.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><b>₱749</b></h5>
              <p class="card-text">Dual TIG/MMA with Welding Mask</p>
              <a href="#" class="btn btn-primary">Add to cart</a>
            </div>
          </div>

          <!-- 5 item -->
          <div class="card" style="width: 20rem; height: 22rem;">
            <img src="/img/item1.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><b>₱749</b></h5>
              <p class="card-text">Dual TIG/MMA with Welding Mask</p>
              <a href="#" class="btn btn-primary">Add to cart</a>
            </div>
          </div>

              <!-- 6 item -->
              <div class="card" style="width: 20rem; height: 22rem;">
                <img src="/img/item1.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><b>₱749</b></h5>
                  <p class="card-text">Dual TIG/MMA with Welding Mask</p>
                  <a href="#" class="btn btn-primary">Add to cart</a>
                </div>
              </div>

        <!-- 7 item -->
        <div class="card" style="width: 20rem; height: 22rem;">
          <img src="/img/item1.png" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><b>₱749</b></h5>
            <p class="card-text">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>

        <!-- 8 item -->
        <div class="card" style="width: 20rem; height: 22rem;">
          <img src="/img/item1.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><b>₱749</b></h5>
            <p class="card-text">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>

      <!-- 9 item -->
      <div class="card" style="width: 20rem; height: 22rem;">
        <img src="/img/item1.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><b>₱749</b></h5>
          <p class="card-text">Dual TIG/MMA with Welding Mask</p>
          <a href="#" class="btn btn-primary">Add to cart</a>
        </div>
      </div>

            <!-- 10 item -->
            <div class="card" style="width: 20rem; height: 22rem;">
              <img src="/img/item1.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><b>₱749</b></h5>
                <p class="card-text">Dual TIG/MMA with Welding Mask</p>
                <a href="#" class="btn btn-primary">Add to cart</a>
              </div>
            </div>

        <!-- 11 item -->
        <div class="card" style="width: 20rem; height: 22rem;">
        <img src="/img/item1.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><b>₱749</b></h5>
          <p class="card-text">Dual TIG/MMA with Welding Mask</p>
          <a href="#" class="btn btn-primary">Add to cart</a>
        </div>
      </div>

      <!-- 12 item -->
      <div class="card" style="width: 20rem; height: 22rem;">
        <img src="/img/item1.png">
        <div class="card-body">
          <h5 class="card-title"><b>₱749</b></h5>
          <p class="card-text">Dual TIG/MMA with Welding Mask</p>
          <a href="#" class="btn btn-primary">Add to cart</a>
        </div>
      </div>
      
      </div>

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

 <!-- Initialize Swiper -->
 <script src="/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>