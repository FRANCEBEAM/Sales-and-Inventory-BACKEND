<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include './pages/customer/--header.php' ?>
  <link rel="stylesheet" href="assets/css/index.css">
  <title>R.J. Avancena</title>
</head>
<body>
  <div class="main-container">
      <!--NAVIGATION-->
  <head>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="assets/img/avancena logo.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/pages/customer/shop.php">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">About</a>
            </li>
          </ul>
          
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="/pages/customer/signin.php">Sign in</a></li>
                <li><a class="dropdown-item" href="/pages/customer/signup.php">Sign up</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/pages/customer/signin.php"><i class="fa-solid fa-bag-shopping"></i></i></a>
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
          <img src="assets/img/toolshammer.svg" width="50%">
          <p>Hand Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/welding.svg">
          <p>welding Equipment</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/paint.svg">
          <p>Paints</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/brickwall.svg">
          <p>Cements</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/wood.svg">
          <p>Woods</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/cutting.svg">
          <p>Cutting Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/drill.svg">
          <p>Power Tools</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/steel.svg">
          <p>Structural Steel</p>
        </div>
        <div class="swiper-slide">
          <img src="assets/img/measure.svg">
          <p>Measure Tools</p>
        </div>
      </div>

      <div class="swiper-pagination"></div>
    </div>
          
    <!--ITEM LIST SECTION-->
      <div class="item-container" id="item-list">
        <div class="card">
          <img src="assets/img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets//img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets//img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets//img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets//img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets//img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets/img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>

        <div class="card">
          <img src="assets/img/image 1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title mt-2"><b>₱749</b></h5>
            <p class="card-text mt-2">Dual TIG/MMA with Welding Mask</p>
            <a href="#" class="btn btn-primary mt-3">Add to cart</a>
          </div>
        </div>
      </div>

    <!--PAGINATION-->
    <div class="pagination-container mt-5">
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
    <div class="about-container mt-5" id="about-section">
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

<?php include './pages/customer/--footer.php'?>
</body>
</html>