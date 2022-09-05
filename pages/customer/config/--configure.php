<?php
	$conn = new mysqli("localhost","root","","rjavancena");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>