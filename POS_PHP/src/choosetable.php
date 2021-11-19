<?php
    if(isset($_POST['changetable'])){
    $gettable=$_POST["table-Number"];
    $conn = new mysqli("localhost", "root", "", "pos");
        if($conn->connect_error){
	        die("Connection Failed!".$conn->connect_error);
        }
    $sql = "UPDATE `order` SET `table`= '$gettable' WHERE ID = '$orderID';";
    $order = mysqli_query($conn, $sql);
                              
    }
?>