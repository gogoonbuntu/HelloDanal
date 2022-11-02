<?php
	include 'dbconn.php';
	echo "처리중입니다...\n";
		$sql = "insert into TABLE_USER(id, level, phone, pswd, name, year) values ('$_POST[id]', '$_POST[level]', '$_POST[phonenumber]', '$_POST[pswd]', '$_POST[name]', '$_POST[year]');";

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
