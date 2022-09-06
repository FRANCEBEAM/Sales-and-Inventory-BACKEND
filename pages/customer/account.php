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
  <title>My account</title> 
  <link rel="stylesheet" href="/assets/css/account.css">
</head>
<body>

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

<div class="main-container">
        <!--ACCOUNT SECTION-->
  <h1 class="profileInfo">Account Setting</h1>

    <div class="profile-container">
 <form method="POST" action="../pages/account.php" >

 <!--SHOW VALIDATION SUCCESS-->
 <?php 
            if($passChange){
                ?>
                 <div class="row justify-content-center">            
                   <?php echo $passChange; ?>              
                </div>
                <?php
            }
            ?>


<div class="detail-container">
  
        <div class="oldpass mb-4">
            <h1>Old Password</h1>
                <input type="password" class="form-control mt-3" id="formGroupExampleInput" name="oldpass" placeholder="Enter your old password" required>
        </div>

        <div class="newpass mb-4">
            <h1>New Password</h1>
                <input type="password" class="form-control mt-3" id="formGroupExampleInput" name="newpass" placeholder="Enter your new password" required>
        </div>

        <div class="conpass mb-4">
            <h1>Confirm Password</h1>
                <input type="password" class="form-control mt-3" id="formGroupExampleInput" name="conpass" placeholder="Re-enter your old password" required>
        </div>

          </div>
            <button type="submit" class="btn btn-primary mt-4" name="btnChange">Save changes</button>
        </form>
    </div>
</div>

<?php include './--footer.php'?>


</body>
</html>