
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <?php include './--header.php' ?>
  <link rel="stylesheet" href="/assets/css/index.css">
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
              <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
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

        <!-- SEARCH BAR -->
        <div class="search-container">
            <div class="search-bar">
              <form action="./search.php" method="post">
                <label class="mb-2">Enter a product that you want to search</label>
                <div class="d-flex">
                <input class="form-control me-1" type="text" name = "search" placeholder="Search" aria-label="Search">
                
                <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i>Search</button> 
              </div>
              <label class="mt-2 fw-bold">Popular: </label>
              </form>
            </div>
          </div>

  <!-- FETCH SEARCH -->
  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-9 py-5">

    <div class="card section-intro px-4 ">
      <div class="card-body ">
        <div class="card-header items-header"><h4><b>Featured Items</b></h4></div>
      <div class="row py-3 items">
              <?php

//connect ot the database
        require './config/--configure.php';
        //get the search keyword
        $search = $_POST['search'];
        //SQL query to get the products based on the search keyword
        $sql = "SELECT * FROM inventory WHERE product LIKE 
        '%$search%' OR descriptions LIKE '%$search%'
        ";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the product is available
        if ($count > 0) {
            while ($row  = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $product = $row['product'];
                $descriptions = $row ['descriptions'];
                $price = $row ['price'];
                $image_file = $row ['image_file'];
                ?>

            <div class="mb-5 card">
                    <img src="/assets/img/image 1.jpg" class="card-img-top" alt="...">
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



                <?php

            }
        }else {
            echo "<div class='alert alert-danger'>
            there is no product matching your search....
            </div>";
        }

            ?>
<!------ start of card 1 ---------------->

        
       
<!------ End of card 1 ---------------->

      </div>
    </div>
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

<?php include './--footer.php'?>


</body>
</html>