<?php
    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    $sql = "SELECT MAX(`ID`) AS `ID` FROM `order` WHERE `status` = 0;";
    $OID = mysqli_query($conn, $sql);
    $OID = mysqli_fetch_assoc($OID);
    $OID = $OID['ID'];
    $sql = "DELETE FROM `order` WHERE `ID` = '$OID';";
    $res = mysqli_query($conn, $sql);
?>