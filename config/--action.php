<?php
session_start();
require '--configure.php';

// Add products into the cart table
if (isset($_POST['product'])) {
	$email = $_SESSION['email']; //getting this email using session
	// $username = $_POST['username'];
	// $email = $_POST['email'];
	$product = $_POST['product']; // product name from db
	$price = $_POST['price']; // product price
	$image_file = $_POST['image_file']; // product image
	$serialnumber = $_POST['serialnumber']; // product serial number
	$quantity = $_POST['quantity']; // product quantity

	$total_price = $price * $quantity;

	$stmt = $conn->prepare('SELECT serialnumber FROM cart WHERE email=?');
	$stmt->bind_param('s', $serialnumber);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$code = $r['serialnumber'] ?? '';

	if (!$code) {
		$query = $conn->prepare('INSERT INTO cart (product, price, image_file, qty ,total_price, email) VALUES (?,?,?,?,?,?)');
		$query->bind_param('ssssss', $product, $price, $image_file, $quantity, $total_price, $email);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	} else {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	}
}


// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $conn->prepare('SELECT * FROM cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$quantity = $_POST['qty'];
	$id = $_POST['id'];
	$price = $_POST['price'];

	$tprice = $quantity * $price;

	$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	$stmt->bind_param('isi', $qty, $tprice, $id);
	$stmt->execute();
}


	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:../pages/cart.php');
	}


?>
