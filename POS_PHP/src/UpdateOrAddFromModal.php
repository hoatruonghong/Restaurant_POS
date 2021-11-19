<?php
    $note = $_REQUEST["note"];
    $PID = $_REQUEST["ProID"];
    $total = $_REQUEST["total"];
    $qty = $_REQUEST["qty"];

    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }

    $sql = "SELECT MAX(`ID`) AS `ID` FROM `order`;";
    $OID = mysqli_query($conn, $sql);
    $OID = mysqli_fetch_assoc($OID);
    $OID = $OID['ID'];

    $sql = "SELECT * FROM `cart` WHERE `productID` = '$PID' AND `orderID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 0) {
        $sql = "INSERT INTO `cart`(`orderID`, `productID`, `quantity`, `note`, `total_price`) VALUES('$OID','$PID','$qty','$note','$total');";
        $res = mysqli_query($conn, $sql);
    }
    else{
        $sql = "UPDATE `cart` SET `quantity` = '$qty', `note` = '$note', `total_price` = '$total' WHERE `productID` = '$PID' AND `orderID` = '$OID';";
        $res = mysqli_query($conn, $sql);
    }

    $sql = "SELECT SUM(`total_price`) AS `Final_price` FROM cart WHERE `orderID` = '$OID';";
    $Final_price = mysqli_query($conn, $sql);
    $Final_price = mysqli_fetch_assoc($Final_price);
    $Final_price = $Final_price['Final_price'] * 110 / 100;
    $sql = "UPDATE `order` SET `total_price` = '$Final_price' WHERE `ID` = '$OID';";
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>