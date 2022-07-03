<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: home.php");
        die();
    }

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    include 'configure.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (username, email, fullname, password, code) VALUES ('{$username}', '{$email}','{$fullname}', '{$password}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'donpapichulo2.8@gmail.com';                     //SMTP username
                        $mail->Password   = 'jzblakfsldyxokip';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('donpapichulo2.8@gmail.com', 'Papi always happy');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'no reply';
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost:3000/pages/signin?verification='.$code.'">http://localhost:3000/pages/signin?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="/styles/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-container">
    <!--SIGN UP FORM-->
        <div class="register-form">
            <!--LEFT CONTENT-->
            <div class="left-content">
                <div class="tabimg-container" data-aos="fade-right" data-aos-duration="1000">
                <h1>Hello Friend!</h1>
                <p>Fill up personal information and start to order online.</p>
                 <img class="tabimg" src="/img/signupimg.svg" alt="">
               </div>

            </div>
                <!--RIGHT CONTENT-->
                <div class="right-content">
                 <div class="header-signup" data-aos="fade-up" data-aos-duration="1000">
                    <h1 style="font-weight:bold;">Sign up</h1>
                    <p>If you have already an account register <br>You can <a href="/pages/signin.php" style="color: #FF432A; font-weight: bold; text-decoration: none;">Login here !</a></p>
                  </div>

                  
                     <form action=""  method="post" data-aos="fade-up" data-aos-duration="1000"
                     data-aos-delay="200" id="my-form">

                     <!--SHOW VALIDATION ERROR-->
                     <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <!--SHOW VALIDATION SUCCESS-->
                <?php if (isset($_GET['success'])) { ?>
                      <p class="success"><?php echo $_GET['success']; ?></p>
                 <?php } ?>

                 <!--FOR USERNAME FORM-->
                    <div class="form-group mb-4">
                        <?php if (isset($_GET['username'])) { ?>
                    <input class="form-control" type="text" name = "username" id="username-reg" placeholder = "Enter your username" value="<?php if (isset($_POST['submit'])) { echo $username; } ?>">
                    <?php }else{ ?>
                        <label for="formGroupExampleInput" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username-reg" 
                        name="username"
                        placeholder="Enter your Username">
                        <?php }?>
                    </div>


                    <!--FOR EMAIL FORM-->
                    <div class="form-group mb-4">
                        <?php if (isset($_GET['email'])) { ?>
                    <input class="form-control" type="email" name = "email" id="email-reg" placeholder = "Enter your email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>">
                    <?php }else{ ?>
                        <label for="formGroupExampleInput" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-reg" 
                        name="email"
                        placeholder="Enter your Email">
                        <?php }?>
                    </div>

                        <!--FOR FULL NAME FORM-->
                        <div class="form-group mb-4">
                        <?php if (isset($_GET['fullname'])) { ?>
                        <input class="form-control" type="text" name ="fullname"  id="full-name" placeholder = "Enter full name" value="<?php echo $_GET['fullname']; ?>">
                        <?php }else{ ?>
                        <label for="formGroupExampleInput" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full-name" 
                        name="fullname"
                        placeholder="First and Last"
                        type="text">
                        <?php }?>
                    </div>

                    <!--FOR PASSWORD FORM-->
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput" class="form-label"><i class="bi bi-lock"></i>Password</label>
                            <input type="password" class="form-control" id="password" 
                            name="password"
                            placeholder="Enter your Password">
                        </div>
                        

                    <!--FOR CONFIRM PASSWORD FORM-->
                    <div class="form-group mb-4">
                        <label for="formGroupExampleInput" class="form-label"><i class="bi bi-lock"></i>Confirm Password</label>
                        <input type="password" class="form-control" id="con-password" 
                        name="confirm-password"
                        placeholder="Confirm your password">
                    </div>

                    <!--TERMS AND AGREEMNT-->
                    <!-- <div class="form-check pt-5">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="terms" for="flexCheckDefault">
                            By signing up you accept the <b>Terms of service</b> and <b>Privacy Policy</b>
                        </label>
                      </div> -->

                        <div class="form-group d-grid gap-2">
                            <button class="btn btn-primary" type="submit" name="submit" value="SIGN UP">Signup</button>
                        </div>
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