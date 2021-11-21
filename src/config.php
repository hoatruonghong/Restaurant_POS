<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "pos";
  $connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if($connect->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
  
  $sql = "SELECT * FROM `table`;";
  $table = mysqli_query($conn, $sql);

  mysqli_close($conn);
?>
