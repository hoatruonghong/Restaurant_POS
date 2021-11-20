<?php 
	if(isset($_GET['payment_method']))
	{
		$payment_method = $_GET['payment_method'];
		$card_id = "";
		$password_card = "";
		$payment_date = date("Y-m-d");
		if($payment_method == "visa")
		{
			$card_id = $_GET['input1'];
			$password_card = $_GET['input3'];
		}
		elseif($payment_method == "card")
		{
			$card_id = $_GET['input4'];
			$password_card = $_GET['input5'];
		}
		elseif($payment_method == "momo")
		{
			$card_id = $_GET['input6'];
			$password_card = $_GET['input7'];
		}
		elseif($payment_method == "zalopay")
		{
			$card_id = $_GET['input8'];
			$password_card = $_GET['input9'];
		}


		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "POS";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) 
		{
		  	die("Connection failed: " . $conn->connect_error);
		}
		// select current order id
		$sql = "SELECT MAX(`ID`) AS `ID` FROM `order`;";
		$OID = mysqli_query($conn, $sql);
		$OID_row = mysqli_fetch_assoc($OID);
		$OID_row = $OID_row['ID'];
		// insert paid order into payment table
		$sql = "INSERT INTO `payment`(`orderID`, `payment_method`, `payment_date`, `card_id`, `password`) 
			VALUES('$OID_row','$payment_method','$payment_date','$card_id','$password_card');";
        $res = mysqli_query($conn, $sql);

        //set state of order
        $sql = "UPDATE `order` SET `status` = 1 WHERE `ID` = '$OID_row';";
        $res = mysqli_query($conn, $sql);
	}
	
 ?>