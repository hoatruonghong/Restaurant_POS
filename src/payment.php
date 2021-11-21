<?php
	include ('component/header.php');
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "POS";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT MAX(`ID`) AS `ID` FROM `order` WHERE `status` = 0;";
	$OID = mysqli_query($conn, $sql);
	$OID_row = mysqli_fetch_assoc($OID);
	$OID_row = $OID_row['ID'];
	$sql = "SELECT * FROM `order` where `ID` = '$OID_row';";
	$order = mysqli_query($conn, $sql);
	$order = mysqli_fetch_assoc($order);
	$total_price = $order['total_price'];
?>


	<div class="contain">
		<div class="main">
			<div class="row1">
				<p class="text1">Tổng thanh toán</p>
				<p class="text2"><?php echo $total_price . "đ"; ?></p>
			</div>
			<div class="row2">
				<h5>PHƯƠNG THỨC THANH TOÁN</h5>
			</div>
			<div class="row3">
				<form action="process_payment.php" method="GET" name="payment_form">
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="payment_method" class="payment_method" id="exampleRadios1" value="visa" >
					  	<label id="formid-check-label" for="exampleRadios1">
					    	Credit Card - tín dụng hoặc ghi nợ 
					  	</label>
					  	<img src="../images/visa.png">
					  	<div id="visa-detail">
					  		<div class="card_info" style="margin: 0 10px;">
					  			<label for="card_num" class="form-label">Số thẻ</label>
  								<input type="text" class="form-control" id="card_num" placeholder="Card number" name="input1">
  								<div style="display: flex;">
  									<div>
  										<label for="MMYY" class="form-label">Hạn sử dụng</label>
  										<input class="form-control" type="text" id="MMYY" placeholder="YYYY-MM-DD" name="input2">
  									</div>
  									<div>
  										<label for="CVV" class="form-label">CVV</label>
  										<input class="form-control" type="text" id="CVV" name="input3">
  									</div>
  								</div>
					  		</div>

					  	</div>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="payment_method" class="payment_method" id="exampleRadios2" value="card">
					  	<label id="form-check-label" for="exampleRadios2">
					    	Thẻ ngân hàng 
					  	</label>
					  	<img src="../images/card.png">
					  	<div id="card-detail">
					  		<div class="card_info" style="margin: 0 10px;">
					  			<label for="card_num" class="form-label">Số tài khoản</label>
  								<input type="text" class="form-control" id="card_num" placeholder="Card number" name="input4">
  
					  		</div>

					  	</div>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="payment_method" class="payment_method" id="exampleRadios3" value="momo">
					  	<label id="form-check-label" for="exampleRadios3">
					    	Ví MOMO
					  	</label>
					  	<img src="../images/momo.png">
					  	<div id="momo-detail">
					  		<div class="card_info" style="margin: 0 10px;">
					  			<label for="card_num" class="form-label">Số điện thoại</label>
  								<input type="text" class="form-control" id="card_num" placeholder="Phone" name="input6">

  
					  		</div>

					  	</div>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="payment_method" class="payment_method" id="exampleRadios4" value="zalopay">
					  	<label id="form-check-label" for="exampleRadios4">
					    	Ví ZaloPay
					  	</label>
					  	<img src="../images/zalopay.png">
					  	<div id="zalopay-detail">
					  		<div class="card_info" style="margin: 0 10px;">
					  			<label for="card_num" class="form-label">Số điện thoại</label>
  								<input type="text" class="form-control" id="card_num" placeholder="Phone" name="input8">
  
					  		</div>

					  	</div>
					</div>
					<div class="form-check">
					  	<input class="form-check-input" type="radio" name="payment_method" class="payment_method" id="exampleRadios5" value="cash">
					  	<label id="form-check-label" for="exampleRadios5">
					    	Tiền mặt
					  	</label>
					  	<img src="../images/cash.png">
					</div>

					<div class="button">
						<input type="submit" value="HOÀN TẤT" class="btn btn-danger w-100">
						<!-- <button type="submit" class="btn w-100 btn-secondary" style="margin-top: 10px;">HỦY</button> -->
					</div>
				
				</form>
				<button onclick="deleteOrder()" class="btn w-100 btn-secondary" style="margin-top: 10px;">HỦY</button>
			</div>
			<div class="row5">
				<p>Điều khoản</p>
				<img src="../images/VN.png">
			</div>
		</div>
	</div>

<?php
	include ('component/footer.php');
?>

<script type="text/javascript">
	radio1 = document.getElementById('exampleRadios1');
	var content1;

	radio2 = document.getElementById('exampleRadios2');
	var content2;

	radio3 = document.getElementById('exampleRadios3');
	var content3;

	radio4 = document.getElementById('exampleRadios4');
	var content4;

	radio5 = document.getElementById('exampleRadios5');

	radio1.addEventListener("click", function () {
		content1 = document.getElementById('visa-detail');
		content2 = document.getElementById('card-detail');
		content3 = document.getElementById('momo-detail');
		content4 = document.getElementById('zalopay-detail');
		content1.style.display = 'block';
		content2.style.display = 'none';
		content3.style.display = 'none';
		content4.style.display = 'none';
		// body...
	});

	radio2.addEventListener("click", function () {
		content1 = document.getElementById('visa-detail');
		content2 = document.getElementById('card-detail');
		content3 = document.getElementById('momo-detail');
		content4 = document.getElementById('zalopay-detail');
		content2.style.display = 'block';
		content1.style.display = 'none';
		content3.style.display = 'none';
		content4.style.display = 'none';
		// body...
	});

	radio3.addEventListener("click", function () {
		content1 = document.getElementById('visa-detail');
		content2 = document.getElementById('card-detail');
		content3 = document.getElementById('momo-detail');
		content4 = document.getElementById('zalopay-detail');
		content3.style.display = 'block';
		content1.style.display = 'none';
		content2.style.display = 'none';
		content4.style.display = 'none';

		// body...
	});

	radio4.addEventListener("click", function () {
		content1 = document.getElementById('visa-detail');
		content2 = document.getElementById('card-detail');
		content3 = document.getElementById('momo-detail');
		content4 = document.getElementById('zalopay-detail');
		content4.style.display = 'block';
		content1.style.display = 'none';
		content2.style.display = 'none';
		content3.style.display = 'none';
		// body...
	});

	radio5.addEventListener("click", function () {
		content1 = document.getElementById('visa-detail');
		content2 = document.getElementById('card-detail');
		content3 = document.getElementById('momo-detail');
		content4 = document.getElementById('zalopay-detail');
		content1.style.display = 'none';
		content2.style.display = 'none';
		content3.style.display = 'none';
		content4.style.display = 'none';
		// body...
	});

	function deleteOrder(){
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "deleteOrder.php", true);
        xmlhttp.send();
		window.location.href='home.php';
	}



</script>