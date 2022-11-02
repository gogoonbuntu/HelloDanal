<?php
	include 'dbconn.php';
	echo "처리중입니다...\n";
		$sql = "insert into TABLE_USER(id, level, phonenumber, pswd) values ('$_POST[id]', '$_POST[level]', '$_POST[phonenumber]', '$_POST[pswd]');";

		//$result = mq($sql);
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	echo "1 record added";
	echo "<script>"
		."window.location.replace('login.php');"
	        ."<script>";
?>
