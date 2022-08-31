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
  <link rel="stylesheet" href="../styles/profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>

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
              <a class="nav-link active" aria-current="page" href="/pages/home.php">Home</a>
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
                <a class="dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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

<div class="main-container">
        <!--PROFILE SECTION-->
  <h1 class="profileInfo">Profile Information</h1>

  <?php 
            if($success){
                ?>
                 <div class="row justify-content-center">
                      <div class="alert alert-success text-center col-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg> <?php echo $success; ?>
                      </div>
                </div>
                <?php
            }
            ?>

      <div class="profname-container">
        <div class="fullname">
                <h1><?php echo $fetch_info['fullname'] ?></h1>
        </div>
        <div class="email">
            <p><?php echo $fetch_info['email'] ?></p>
        </div>
        </div>
      
    <div class="profile-container">
        <!---NAME INFORMATION-->
    <form action= "/pages/profile.php" method="POST" >
<div class="detail-container">
  
        <div class="phone mb-4">
            <h2><i class="bi bi-phone"></i> Phone Number</h1>
                <input type="number" class="form-control mt-3" id="formGroupExampleInput" name="phone" placeholder="Enter your phone number" value="<?php echo $fetch_info['phone'] ?>">
        </div>

        <div class="address mb-4">
            <h2><i class="bi bi-geo-alt"></i> Address</h2>
            <input type="text" class="form-control mt-3" id="formGroupExampleInput" name="address" placeholder="Enter your address" value="<?php echo $fetch_info['address'] ?>">
        </div>

        <div class="birthdate mb-4">
            <h2><i class="bi bi-calendar"></i> Date of Birth</h2>
                <div class="">
                        <div class="form-group">
                            <div class='input-group date' id='startDate'>
                                <span class="input-group-addon input-group-text mt-3"><span class="fa fa-calendar"></span>
                                  </span>
                                 <input type='text' class="form-control mt-3" name="datebirth" placeholder= "mm/dd/yyyy" value='<?php echo $fetch_info['datebirth'] ?>'>
                            </div>
                        </div>
                    </div>
              </div>

          <div class="gender mb-4">
            <h2><i class="bi bi-person"></i> Gender</h2>
            <select class="form-select" id = "genderSelect" aria-label="Default select example" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
           </div>
          </div>
            <button type="submit" class="btn btn-primary mt-4" name="btnSave">Save changes</button>
        </form>
    </div>
</div>


<script>
  document.querySelector('#genderSelect').value = "<?php echo $fetch_info['gender']   
            ?>";
</script>
 <script src="/js/datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>