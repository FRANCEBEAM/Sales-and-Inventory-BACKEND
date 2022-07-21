<?php

    require "--config.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM accounts WHERE id = '$id' ";
    // $sql = "UPDATE accounts SET status='Inactive' WHERE id = '$id' ";


    header("location: accounts.php?deleted");

    $query = mysqli_query($link, $sql);
?>
