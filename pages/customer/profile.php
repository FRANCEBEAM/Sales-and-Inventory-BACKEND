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
              <a class="nav-link" aria-current="page" href="./home.php">Home</a>
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
    <div class="head-container">
      <h1 class="profileInfo mb-3">Profile Information</h1>
      <p>Fill all the information and personalize as your profile settings and security.</p>
    </div>

    <?php 
            if($success){
                ?>
                 <div class="row justify-content-center mt-5">
                      <div class="alert alert-success text-center col-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg> <?php echo $success; ?>
                      </div>
                </div>
                <?php
            }
            ?>

    <div class="information-container">
      <h1><?php echo $fetch_info['fullname'] ?></h1>
      <p><?php echo $fetch_info['email'] ?></p>
    </div>

      <div class="form-container">
        <form action= "./profile.php" method="POST" >
        <div class="card">
          <div class="card-body">
            <div class="card-head">
              <h1 class="mb-4">Phone Number: <i class="fa-solid fa-phone"></i></h1>
            </div>
            <p class="card-text">Set your phone number in your account to recognize as a customer.</p>
            <div class="input-group mb-3">
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="phone" value="<?php echo $fetch_info['phone'] ?>">
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="card-head">
              <h1 class="mb-4">Address: <i class="fa-solid fa-location-arrow"></i></h1>
            </div>
            <p class="card-text">Provide your address location. This might help for the store to deliver your product.</p>
            <div class="input-group mb-3">
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="address" value="<?php echo $fetch_info['address'] ?>">
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="card-head">
              <h1 class="mb-4">Date of Birth: <i class="fa-solid fa-calendar-days"></i></h1>
            </div>
            <p class="card-text">Fill your date of birth to recognize your age. This will consider as your information.</p>
            <div class="input-group mb-3">
            <input type='text' class="form-control" name="datebirth" placeholder= "mm/dd/yyyy" value='<?php echo $fetch_info['datebirth'] ?>'>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="card-head">
              <h1 class="mb-4">Gender: <i class="fa-sharp fa-solid fa-person"></i></i></h1>
            </div>
            <p class="card-text">Select what a type of person are you.</p>
            <div class="input-group mb-3">
              <select class="form-select" id = "genderSelect" aria-label="Default select example" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
        </div>
    
        <button type="submit" class="btn btn-primary btn-lg mt-5" name="btnSave" id="btnSave">Save changes</button>
    </form>
  </div>
</div>
<?php include './--footer.php'?>

<script>
  document.querySelector('#genderSelect').value = "<?php echo $fetch_info['gender']   
            ?>";
</script>

<script type="text/javascript">
  $(document).ready(function() {
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