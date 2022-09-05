<?php require_once "./config/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './--header.php'?>
    <title>R.J. Avancena</title>
    <link rel="stylesheet" href="/assets/css/signup.css">
</head>
<body>
    <div class="main-container">
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
                  <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
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
                  <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="./signin.php">Sign in</a></li>
                    <li><a class="dropdown-item" href="./signup.php">Sign up</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="./signin.php"><i class="fa-solid fa-bag-shopping"></i></i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    </head>

    <div class="form-container">
        <div class="left-content">
            <div class="tabimg-container" data-aos="fade-right" data-aos-duration="1000">
                <h1>Hello friend!</h1>
                <p>Fill up personal information and start to order online.</p>
                <img class="tabimg" src="/assets/img/signup.svg" alt="">
            </div>
            </div>

    <div class="right-content">
    <form action="./signup.php" method="POST" autocomplete="">
    <h1 class="text-center">Sign up</h1>
          <p>Fill up personal information and start to order online.</p>

            <!--SHOW SUCCESS/ERROR VALIDATION-->
        <?php
        if(count($errors) == 1){
            ?>
            <div class="alert alert-danger text-center">
                <?php
                foreach($errors as $showerror){
                    echo $showerror;
                }
                ?>
            </div>
            <?php
        }elseif(count($errors) > 1){
            ?>
            <div class="alert alert-danger">
                <?php
                foreach($errors as $showerror){
                    ?>
                    <li><?php echo $showerror; ?></li>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>

            <!--LETS CREATE SIGN UP FORM-->
        <div class="form-group mb-4">
            <label class="userLabel" for="email" class="form-label">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Enter Username" required value="<?php echo $username ?>">
        </div>
        <div class="form-group mb-4">
        <label for="email" class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter Email Address" required value="<?php echo $email ?>">
        </div>
        <div class="form-group mb-4">
            <label for="email" class="form-label">Fullname</label>
            <input class="form-control" type="text" name="fullname" placeholder=" Enter Full Name" required value="<?php echo $fullname ?>">
        </div>
        <div class="form-group mb-4">
        <label for="email" class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
        </div>
        <div class="form-group mb-4">
        <label for="email" class="form-label">Confirm Password</label>
            <input class="form-control" type="password" name="cpassword" placeholder="Enter Confirm password" required>
        </div>
        <div class="form-group mt-5">
            <input class="form-control btn btn-primary btn-lg mt-2" type="submit" name="signup" value="Signup">
        </div>
        <div class="link login-link text-center mt-5">Already a member? <a href="./signin.php">Login here</a>
    </div>
      </form>
    </div>
</div>
</div>
<?php include './--footer.php'?>
</body>
</html>