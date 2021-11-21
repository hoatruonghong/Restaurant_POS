<?php
    $PID = $_REQUEST["ProIDToDel"];

    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    $sql = "SELECT MAX(`ID`) AS `ID` FROM `order` WHERE `status` = 0;";
    $OID = mysqli_query($conn, $sql);
    $OID = mysqli_fetch_assoc($OID);
    $OID = $OID['ID'];
    $sql = "DELETE FROM `cart` WHERE `productID` = '$PID' AND `orderID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    $sql = "SELECT SUM(`total_price`) AS `Final_price` FROM cart WHERE `orderID` = '$OID';";
    $Final_price = mysqli_query($conn, $sql);
    $Final_price = mysqli_fetch_assoc($Final_price);
    $Final_price = $Final_price['Final_price'] * 110 / 100;
    $sql = "UPDATE `order` SET `total_price` = '$Final_price' WHERE `ID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
