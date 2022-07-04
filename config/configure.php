<?php

$server = "localhost";
$hardware = "root";
$pass = "";
$database ="rjavancena";

$conn = mysqli_connect($server, $hardware, $pass, $database);

if (!$conn){
    die("<script>alert('Connection Failed.')</script>");
}

?>