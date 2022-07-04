<?php require_once "../config/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/styles/signin.css">
</head>
<body>
    <div class="main-container">
            <div class="left-content">
                        <div class="tabimg-container">
                            <h1 data-aos="fade-right" data-aos-duration="1000"
                            data-aos-delay="200">Hello Again!</h1>
                        <p data-aos="fade-right" data-aos-duration="1000"
                        >Welcome back, explore your creativity and discover new skills.</p>
                            <img class="tabimg" src="/img/signinimg.svg" alt="" data-aos="fade-up">
                        </div>
                </div>

                <div class="right-content">
                <form action="/pages/signin.php" method="POST" autocomplete="" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="200">
                    <h2 class="text-center">Sign in</h2>
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
                    <div class="form-group">
                        <input class="form-control mb-5" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control mb-5" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left mb-4"><a href="/pages/forgotPassword.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary mt-4" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center mt-5">Not yet a member? <a href="/pages/signup.php">Signup now</a></div>
                </form>
                </div>
    </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
  AOS.init();
</script>
</body>
</html>