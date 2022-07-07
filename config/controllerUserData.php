<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require '../vendor/autoload.php';

session_start();
require "../config/connect.php";
$username ="";
$email = "";
$fullname = "";
$errors = array();

// IF THE USER WANTS TO SIGNUP BUTTON
if(isset($_POST['signup'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }

    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);

    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (username, email, fullname, password, code, status)
                        values('$username', '$email', '$fullname', '$encpass', '$code', '$status')";

        $data_check = mysqli_query($con, $insert_data);

        if($data_check){
          //Load Composer's autoloader
            require '../vendor/autoload.php';
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            $mail->Username = 'donpapichulo2.8@gmail.com'; 
            $mail->Password = 'jzblakfsldyxokip'; 

            $mail->setFrom('donpapichulo2.8@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);
            $mail->Subject="Your code verification";
            $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $code <br></h3>";

            if($mail->send($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}
        //     $subject = "Email Verification Code";
        //     $message = "Your verification code is $code";
        //     $sender = "From: donpapichulo2.8@gmail.com";

        //     if(mail($email, $subject, $message, $sender)){
        //         $info = "We've sent a verification code to your email - $email";
        //         $_SESSION['info'] = $info;
        //         $_SESSION['email'] = $email;
        //         $_SESSION['password'] = $password;
        //         header('location: otp.php');
        //         exit();
        //     }else{
        //         $errors['otp-error'] = "Failed while sending code!";
        //     }
        //    }else{
        //     $errors['db-error'] = "Failed while inserting data into database!";
        
    

    // IF USER WANTS TO CLICK VERIFICATION AND SUBMIT BUTTON
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                header('location: signin.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    

    //IF USER WANTS TO LOGIN
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";

        $res = mysqli_query($con, $check_email);
     
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    // IF USER FORGET THE PASSWORD THEN CONTINUE BUTTON
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);

            if($run_query){
                //Load Composer's autoloader
                require '../vendor/autoload.php';
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';
    
                $mail->Username = 'donpapichulo2.8@gmail.com'; 
                $mail->Password = 'jzblakfsldyxokip'; 
    
                $mail->setFrom('donpapichulo2.8@gmail.com', 'OTP Verification');
                $mail->addAddress($_POST["email"]);
    
                $mail->isHTML(true);
                $mail->Subject="Your reset code verification";
                $mail->Body="<p>Dear user, </p> <h3>Your Reset OTP code is $code <br></h3>";
                
                 if($mail->send($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: resetCode.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }


    //RESET OTP BUTTON
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: newPassword.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //IF USER CLICK THE CHANGE PASSWORD BUTTON
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: passwordChanged.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //THE LOGIN NOW BUTTON
    if(isset($_POST['login-now'])){
        header('Location: signin.php');
    }
?>