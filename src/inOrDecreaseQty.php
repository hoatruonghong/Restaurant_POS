<?php
    $newQty = $_REQUEST["newQty"];
    $PID = $_REQUEST["PIDToChange"];

    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    $sql = "SELECT MAX(`ID`) AS `ID` FROM `order`;";
    $OID = mysqli_query($conn, $sql);
    $OID = mysqli_fetch_assoc($OID);
    $OID = $OID['ID'];

    $sql = "SELECT `price` FROM `product` WHERE ID = '$PID';";
    $price = mysqli_query($conn, $sql);
    $price = mysqli_fetch_assoc($price);
    $price = $price['price'];

    $total = $price * $newQty;

    $sql = "UPDATE `cart` SET `quantity` = '$newQty', `total_price` = '$total' WHERE `productID` = '$PID' AND `orderID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    $sql = "SELECT SUM(`total_price`) AS `Final_price` FROM cart WHERE `orderID` = '$OID';";
    $Final_price = mysqli_query($conn, $sql);
    $Final_price = mysqli_fetch_assoc($Final_price);
    $Final_price = $Final_price['Final_price'] * 110 / 100;
    $sql = "UPDATE `order` SET `total_price` = '$Final_price' WHERE `ID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>