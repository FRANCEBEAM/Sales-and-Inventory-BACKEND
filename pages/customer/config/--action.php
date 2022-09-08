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
		header('location:\pages\customer\cart.php');
		
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
	  // $id = $_POST['id'];
	  // $price = $_POST['price'];

	  // $tprice = $qty * $price;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $fullname = $_POST['fullname'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $paymentmode = $_POST['paymentmode'];

	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO orders (fullname,email,phone,address,paymentmode,products,amountpaid)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$fullname,$email,$phone,$address,$paymentmode,$products,$grand_total);
	  $stmt->execute();
	  $stmt2 = $conn->prepare("DELETE FROM cart WHERE email = '$email'");
	  $stmt2->execute();
		
	  $data .= '<div class="text-center">
								<h2 class="text-success">Thank you for order</h2>
								<h4 class="text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<p>Name : ' . $fullname . '</p>
								<p>Email : ' . $email . '</p>
								<p>Phone : ' . $phone . '</p>
								<div class="mt-4 mb-3"><b>Total Amount Paid :<i class="fa-solid fa-peso-sign"></i></b>' . number_format($grand_total,2) . '</div>
								<div><b>Payment Mode : </b>' . $paymentmode . '</div>
								<script>
								Swal.fire({
									icon: "success",
									title: "Order Successfully",
									showConfirmButton: false,
									timer: 1500
								})
								</script>
						  </div>';

		// $data = '<script>
		// Swal.fire({
		// 	position: "top-start",
		// 	icon: "success",
		// 	title: "Item added to your cart",
		// 	showConfirmButton: false,
		// 	timer: 1500
		// }      ,$.ajax({
    //     success: function(response) {
    //       load_cart_item_number();
    //     }
    //   })
    // )
		// </script>';

	  echo $data;

	}
?>
