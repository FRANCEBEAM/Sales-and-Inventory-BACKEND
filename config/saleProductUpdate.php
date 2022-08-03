<?php
    $connect = mysqli_connect("localhost", "root", "", "rjavancena");
    $output = '';
    if(isset($_POST["category"]))
    {
        $category = mysqli_real_escape_string($connect, $_POST["category"]);
        $query = "
        SELECT name FROM inventory
        WHERE category = '$category';";
    }

    $result = mysqli_query($connect, $query);
    $final = array();
    while($row = mysqli_fetch_array($result)) {
        array_push($final, $row[0]);
    }

    echo json_encode($final);
?>