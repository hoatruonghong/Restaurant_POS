<?php
    $PID = $_REQUEST["ProIDToDel"];

    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    $sql = "DELETE FROM `cart` WHERE `productID` = '$PID';";
    $res = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>