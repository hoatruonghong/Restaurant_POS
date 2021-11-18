<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "pos";
  $connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if($connect->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>
