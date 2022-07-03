<?php 
session_start(); 
include "connect.php";

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['fullname'])&& isset($_POST['password']) && isset($_POST['conpassword'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$email = validate($_POST['email']);
	$fullname = validate($_POST['fullname']);
	$password = validate($_POST['password']);

	$conpassword = validate($_POST['conpassword']);


	$user_data = 'email='. $email. '&username=';


	if (empty($username)) {
		header("Location: signup.php?error=Username is required&$user_data");
	    exit();
	}else if(empty($email)){
		header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}else if(empty($fullname)){
		header("Location: signup.php?error=Full Name is required&$user_data");
	    exit();
	}
	else if(empty($password)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($conpassword)){
        header("Location: signup.php?error=Please provide confirm Password&$user_data");
	    exit();
	}

	else if($password !== $conpassword){
        header("Location: signup.php?error=Confirm password not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $password = md5($password);

	    $sql = "SELECT * FROM registered_users WHERE email='$email'";
		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The email is already taken&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO registered_users(username, email, fullname,password) VALUES('$username', '$email', '$fullname', '$password')";
           $result2 = mysqli_query($con, $sql2);
           if ($result2) {
           	 header("Location: signin.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}