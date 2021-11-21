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
	}
	
?>

 <?php 	
include ('component/header.php');
 ?>

<div class="contain">
	<div class="main" >
		<div class="card text-center">
		  	<img class="checked-img" style="align-self: center;" src="../images/checked.png" class="card-img-top" alt="checked">
			<div class="card-body ">
			    <h3 class="card-title">HOÀN TẤT</h3>
			    <p class="card-text">Xin cảm ơn quý khách!</p>
				<p class="card-text">Đơn hàng của quý khách đang được xử lí. Vui lòng chờ trong giây lát hoặc tiếp tục gọi thêm món.</p>
			</div>
			<div class="card-body ">
			    <a href="home.php" class="w-50">Về trang chủ</a>
			</div>
			<div class="time_container" style="color: lightslategrey;">Tự động quay về menu trong <span id="time">10</span>s</div>
			
			
		</div>
	</div>
</div>

<?php 

	include ('component/footer.php');

?>

<script type="text/javascript">
	
	function startTimer(duration, display) {
	    var timer = duration, seconds;
	    setInterval(function () {
	        seconds = parseInt(timer % 60, 10);

	        seconds = seconds < 10 ? "0" + seconds : seconds;

	        display.textContent = seconds;
	        --timer
	        if(timer === -1)
	        	window.location.href = "home.php";
	    }, 1000);

	}

	window.onload = function () {
	    var tenSeconds = 10,
	        display = document.querySelector('#time');
	    startTimer(tenSeconds, display);
	};
</script>