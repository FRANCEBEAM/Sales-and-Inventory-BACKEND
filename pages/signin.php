<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: home.php");
        die();
    }

    include 'configure.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: signin.php");
        }
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: home.php");
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="/styles/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main-container">
        <div class="login-form">
            <div class="left-content">
                <div class="img-sign">
                    <h1 data-aos="fade-right" data-aos-duration="1000"
                    data-aos-delay="200">Hello Again!</h1>
                <p data-aos="fade-right" data-aos-duration="1000"
                >Welcome back, explore your creativity and discover new skills.</p>
                    <img src="/img/store.svg" alt="" data-aos="fade-up">
                </div>
            </div>
            <div class="right-content">
                <div class="login-header">
                    <h1 data-aos="fade-up" data-aos-duration="1000">Sign In</h1>
                </div>

                <form method="post" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="200">

                    <div class="form-group mb-4">
                        <label for="formGroupExampleInput" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Email or Username" name="email" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="formGroupExampleInput" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your Password" name="password" required>
                    </div>

                    <!-- <div class="form-check pt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="remember" for="flexCheckDefault">Remember me
                        </label>
                      </div> -->

                    <div class="form-group d-grid gap-2">
                        <button class="btn btn-primary" name="submit">Sign in</button>
                    </div>

                </form>
                <div class="already-acc">
                    <p>Don't have an account? <a href="/pages/signup.php">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>