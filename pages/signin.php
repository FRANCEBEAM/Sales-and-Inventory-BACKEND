<?php require_once "../config/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R.J. Avancena</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="stylesheet" href="/styles/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-container">
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
                  <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="/index.php">Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="/index.php">About</a>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="/pages/signin.php">Sign in</a></li>
                    <li><a class="dropdown-item" href="/pages/signup.php">Sign up</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="/pages/signin.php"><i class="fa-solid fa-bag-shopping"></i></i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    </head>

    <div class="form-container">
    <div class="left-content">    
              <div class="hello-welcome">
                <h1 data-aos="fade-right" data-aos-duration="1000"
                data-aos-delay="200" class="hello">Hi friend!</h1>
                 <p data-aos="fade-right" class="welcome" data-aos-duration="1000"
            >Welcome back, explore your creativity and discover new skills.</p>
              </div>    

              <div class="sign-mob">
                <h1 data-aos="fade-right" data-aos-duration="1000"
                        data-aos-delay="200" class="hello">Sign in!</h1>
               <p data-aos="fade-right" class="welcome" data-aos-duration="1000"
                    >Login with your email or username and password.</p>
              </div> 
              <img class="tabimg" src="/img/signinimg.svg" alt="" data-aos="fade-up">           
            </div>

                <div class="right-content">
                <form action="/pages/signin.php" method="POST" autocomplete="" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="200">
                <h1 class="text-center">Sign in</h1>
                    <p class="text-center">Login with your email or username and password.</p>

                      <!--SHOW SUCCESS/ERROR VALIDATION-->
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                      <!--LETS CREATE LOGIN FORM-->
                      <!--LETS CREATE LOGIN FORM-->
                      <div class="form-group">
                      <label for="email" class="form-label mt-5">Email address</label>
                      <input class="form-control mb-4" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                      <label for="email" class="form-label">Password</label>
                      <input class="form-control mb-4" type="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="link forget-pass text-left mt-1"><a href="/pages/forgotPassword.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary btn-lg mt-5" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center mt-5">Not yet a member? <a href="/pages/signup.php">Signup now</a></div>
              </form>
        </div>
    </div>
</div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
  AOS.init();
</script>
</body>
</html>