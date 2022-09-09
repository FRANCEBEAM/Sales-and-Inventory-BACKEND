<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
              <a class="nav-link" aria-current="page" href="/pages/customer/signin.php"><i class="fas fa-shopping-cart"></i></a>
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
        <!-- <div class="search-container">
            <div class="search-bar">
            <form action="./pages/customer/search.php" method="post">
                <label class="mb-2">Enter a product that you want to search</label>
                <div class="d-flex">
                <input type="text" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i>Search</button> 
              </div>
              <label class="mt-2 fw-bold">Popular: </label>
              </form>
            </div>
          </div> -->

          <div class="search-container">
            <div class="search-bar">
              <form action="./pages/customer/search.php" method="post">
                <label class="mb-2">Enter a product that you want to search</label>
                <div class="d-flex">
                <input class="form-control me-1" type="text" name = "search" placeholder="Search" aria-label="Search">
                
                <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i>Search</button> 
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
          

        <!-- Displaying Products Start -->
      <div class="item-container" id="item-list">
      <?php
      #SPECIFY FIRST THE DATABASE
  			include './pages/customer/config/--configure.php';

        #START OF OUR PAGINATION FUNCTION
        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
          $page_no = $_GET['page_no'];
          } else {
            $page_no = 1;
                }
        $total_records_per_page = 16;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2"; 

        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `inventory`");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

  			$stmt = $conn->prepare("SELECT * FROM inventory");
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
        <div class="mb-5 card">
        <img src="assets/img/image 1.jpg" class="card-img-top" alt="...">
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
          <a href="/pages/customer/signin.php" class="btn btn-primary mt-4 d-md-block addItemBtn">Add to cart</a>
          </form>
        </div>
        </div>
        <?php endwhile; ?>
      </div>
  <!-- Displaying Products End -->

  <!--PAGINATION-->
    <?php include './pages/customer/config/--pagination.php'?>

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

<script type="text/javascript">

$(document).ready(function(){
  $("#search").keyup(function(){
        var input = $(this).val();
        if(input !=""){
            $.ajax({
              url: "/pages/customer/config/livesearch.php",
              method: "POST",
              data:{input:input},

              success:function(data){
                $("#result").html(data);
              }
            });
        }else{
          $("#result").css("display","none");
        }
    });
  });




</script>
</body>
</html>