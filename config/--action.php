<?php
session_start();
require '--configure.php';

// Add products into the cart table
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$email = $_SESSION['email']; //getting this email using session
	$product = $_POST['product']; // product name from db
	$price = $_POST['price']; // product price
	$image_file = $_POST['image_file']; // product image
	$serialnumber = $_POST['serialnumber']; // product serial number
	$quantity = $_POST['quantity']; // product quantity

	$total_price = $price * $quantity;

	$stmt = $conn->prepare("SELECT serialnumber FROM cart WHERE serialnumber=? and email = '$email'");
	$stmt->bind_param('s', $serialnumber);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$code = $r['serialnumber'] ?? '';

	if (!$code) {
		$query = $conn->prepare('INSERT INTO cart (email, product, price, image_file, qty ,total_price, serialnumber) VALUES (?,?,?,?,?,?,?)');
		$query->bind_param('sssssss', $email, $product, $price, $image_file, $quantity, $total_price, $serialnumber);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible m-0" id="messageAlert">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
	</svg>
						  <strong>Item added to your cart!</strong>
						</div>';
	} else {
		echo '<div class="alert alert-danger alert-dismissible m-0" id="messageAlert">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
		<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
	</svg>
						  <strong>Item already added to your cart!</strong>
						</div>';
	}
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$email = $_SESSION['email']; //getting this email using session
	$stmt = $conn->prepare("SELECT * FROM cart WHERE email = '$email'");
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];
		$email = $_SESSION['email']; //getting this email using session
	  $stmt = $conn->prepare("DELETE FROM cart WHERE id=? and email = '$email'");
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:../pages/cart.php');
	}

		// Remove all items at once from cart
		if (isset($_GET['clear'])) {
			$email = $_SESSION['email']; //getting this email using session
			$stmt = $conn->prepare("DELETE FROM cart WHERE email = '$email'");
			$stmt->execute();
			$_SESSION['showAlert'] = 'block';
			$_SESSION['message'] = 'All Item removed from the cart!';
			header('location:../pages/cart.php');
		}


	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $id = $_POST['id'];
	  $price = $_POST['price'];

	  $tprice = $qty * $price;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}


?>
