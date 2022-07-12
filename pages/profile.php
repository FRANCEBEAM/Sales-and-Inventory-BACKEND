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

<?php require_once "../config/editProfile.php" ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R.J. Avancena</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="stylesheet" href="/styles/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>

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
                <a class="home" aria-current="page" href="/pages/home.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="shop" aria-current="page" href="#">Shop</a>
              </li>

              <li class="nav-item">
                <a class="about" aria-current="page" href="/pages/home.php/#about-section">About</a>
              </li>

              <li class="nav-item dropdown">
              <a class="dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <b><?php echo $fetch_info['fullname'] ?></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="/index.php">Logout</a></li>
                </ul>
              </li>
      </nav>
</head>

<div class="main-container">
        <!--PROFILE SECTION-->
  <h1 class="profileInfo">Profile Information</h1>

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
    <form action="/pages/profile.php" method="post">
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
            <select class="form-select" aria-label="Default select example" name="gender" value='<?php echo $fetch_info['fullname'] ?>'>
             
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
           </div>
          </div>

            <button class="btn btn-primary mt-4" name="btnSave">Save changes</button>
        </form>
    </div>
</div>

<?php

// echo "        <div class='phone mb-4'>
// <h2><i class='bi bi-phone'></i> Phone Number</h1>
//     <input type='text' class='form-control mt-3' id='formGroupExampleInput' name='phone' placeholder='Enter your phone number'>
// </div>

// <div class='address mb-4'>
// <h2><i class='bi bi-geo-alt'></i> Address</h2>
// <input type='text' class='form-control mt-3' id='formGroupExampleInput' name='address' placeholder='Enter your address'>
// </div>

// <div class='birthdate mb-4'>
// <h2><i class='bi bi-calendar'></i> Date of Birth</h2>
//     <div class=''>
//             <div class='form-group'>
//                 <div class='input-group date' id='startDate'>
//                     <span class='input-group-addon input-group-text mt-3'><span class='fa fa-calendar'></span>
//                       </span>
//                      <input type='text' class='form-control mt-3' name='datebirth'/>
//                 </div>
//             </div>
//         </div>
//   </div>

// <div class='gender mb-4'>
// <h2><i class='bi bi-person'></i> Gender</h2>
// <select class='form-select' aria-label='Default select example' name='gender'>
 
//     <option value='Male'>Male</option>
//     <option value='Female'>Female</option>
//   </select>
// </div>";

?>



 <script src="/js/datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>