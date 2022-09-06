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
  <title>My profile</title> 
  <link rel="stylesheet" href="/assets/css/profile.css">
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
<?php include './--footer.php'?>
</body>
</html>