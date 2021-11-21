<?php 
	if(isset($_GET['payment_method']))
	{
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
		$sql = "SELECT MAX(`ID`) AS `ID` FROM `order` WHERE `status` = 0;";
		$OID = mysqli_query($conn, $sql);
		$OID = mysqli_fetch_assoc($OID);
		$OID = $OID['ID'];

		$payment_method = $_GET['payment_method'];
		$payment_date = date("Y-m-d", time());
		if($payment_method == "visa")
		{
			$card_id = $_GET['input1'];
			$expiry_date = $_GET['input2'];
			$CVV = $_GET['input3'];
			$sql = "INSERT INTO `credit_card`(`orderID`, `cardNumber`, `expiryDate`, `CVV`) VALUES ('$OID','$card_id', '$expiry_date', '$CVV');";
			$res = mysqli_query($conn, $sql);
			$sql = "UPDATE `order` SET `status` = 1, `payment_date` = '$payment_date' WHERE `ID` = '$OID';";
			$res = mysqli_query($conn, $sql);
		}
		elseif($payment_method == "card")
		{
			$card_id = $_GET['input4'];
			$sql = "INSERT INTO `atm`(`orderID`, `cardNumber`) VALUES ('$OID','$card_id');";
			$res = mysqli_query($conn, $sql);
			$sql = "UPDATE `order` SET `status` = 1, `payment_date` = '$payment_date' WHERE `ID` = '$OID';";
			$res = mysqli_query($conn, $sql);
		}
		elseif($payment_method == "momo")
		{
			$phone = $_GET['input6'];
			$sql = "INSERT INTO `momo`(`orderID`, `phoneNumber`) VALUES ('$OID','$phone');";
			$res = mysqli_query($conn, $sql);
			$sql = "UPDATE `order` SET `status` = 1, `payment_date` = '$payment_date' WHERE `ID` = '$OID';";
			$res = mysqli_query($conn, $sql);
		}
		elseif($payment_method == "zalopay")
		{
			$phone = $_GET['input8'];
			$sql = "INSERT INTO `zalopay`(`orderID`, `phoneNumber`) VALUES ('$OID','$phone');";
			$res = mysqli_query($conn, $sql);
			$sql = "UPDATE `order` SET `status` = 1, `payment_date` = '$payment_date' WHERE `ID` = '$OID';";
			$res = mysqli_query($conn, $sql);			
		}
		echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset=\"utf-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
			<title>Payment</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"../styles/payment_style.css\">
		
			<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC\" crossorigin=\"anonymous\">
			<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM\" crossorigin=\"anonymous\"></script>
		</head>
		<body>
			<div class=\"container-fluid bg-light\" >
				<nav class=\"navbar header-color\">
					  <div class=\"container\">
						<a class=\"header-title\">THANH TOÁN</a>
						<a href=\"home.html\" class=\"navbar-brand\" style=\"color:#2C3A57\"> Quay về trang chủ </a>
					  </div>
				</nav>";
		echo "Chúc mừng bạn đã thanh toán thành công!";
		include ('component/footer.php');
		

	}
	
 ?>