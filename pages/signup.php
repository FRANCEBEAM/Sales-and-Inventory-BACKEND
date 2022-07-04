<?php require_once "../config/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/styles/signup.css">
</head>
<body>
    <div class="main-container">
                <div class="left-content">
                        <div class="tabimg-container" data-aos="fade-right" data-aos-duration="1000">
                        <h1>Hello Friend!</h1>
                        <p>Fill up personal information and start to order online.</p>
                        <img class="tabimg" src="/img/signupimg.svg" alt="">
                    </div>
                </div>

                <div class="right-content">
                <form action="/pages/signup.php" method="POST" autocomplete="">
                    <h2 class="text-center mb-5">Sign up</h2>

                      <!--SHOW SUCCESS/ERROR VALIDATION-->
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-cente">
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
                        <input class="form-control" type="text" name="username" placeholder="Enter Username" required value="<?php echo $username ?>">
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control" type="email" name="email" placeholder="Enter Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control" type="text" name="fullname" placeholder=" Enter Full Name" required value="<?php echo $fullname ?>">
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control" type="password" name="cpassword" placeholder="Enter Confirm password" required>
                    </div>
                    <div class="form-group mt-5">
                        <input class="form-control btn btn-primary" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center mt-5">Already a member? <a href="/pages/signin.php">Login here</a></div>
                </form>
            </div>
    </div>
    
</body>
</html>