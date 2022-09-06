<?php require_once "./config/controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: signin.php');  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">

              <!--SHOW SUCCESS/ERROR VALIDATION-->
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>

              <!--FORM FOR LOGIN-->
                <form action="./signin.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button btn btn-primary" type="submit" name="login-now" value="Login Now">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>