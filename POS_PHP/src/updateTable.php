
<?php
$ID = $_GET['tableID'];
$conn = new mysqli("localhost", "root", "", "pos");
if($conn->connect_error){
    die("Connection Failed!".$conn->connect_error);
}
$sql = "SELECT MAX(`ID`) AS `ID` FROM `order` where `status` = 0;";
$OID = mysqli_query($conn, $sql);
$OID = mysqli_fetch_assoc($OID);
$OID = $OID['ID'];
$sql = "UPDATE `order` SET `table`= '$ID' WHERE `ID` = '$OID';";
$order = mysqli_query($conn, $sql);
?>

