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

		echo '				
		<script>
		Swal.fire({
			position: "top-start",
			icon: "success",
			title: "Item added to your cart",
			showConfirmButton: false,
			timer: 1500
		})
		</script>';
	} else {
		echo '
				<script>
				Swal.fire({
					position: "top-start",
					icon: "info",
					title: "Item already added to your cart",
					showConfirmButton: false,
					timer: 1500
				})
				</script>
		';
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
