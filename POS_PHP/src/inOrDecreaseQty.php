<?php
    $newQty = $_REQUEST["newQty"];
    $PID = $_REQUEST["PIDToChange"];

    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    $sql = "SELECT `price` FROM `product` WHERE ID = '$PID';";
    $price = mysqli_query($conn, $sql);
    $price = mysqli_fetch_assoc($price);
    $price = $price['price'];

    $total = $price * $newQty;

    $sql = "UPDATE `cart` SET `quantity` = '$newQty', `total_price` = '$total' WHERE `productID` = '$PID';";
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>