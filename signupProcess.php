<?php
	include 'dbconn.php';

	$sql = "insert into user(id, level, phonenumber, pswd) values ('$_POST[id]', '$_POST[level]', '$_POST[phonenumber]', '$_POST[pswd]');";
	echo $sql;
	//$result = mq($sql);
	if (!mysqli_query($conn,$sql))
    {
        die('Error: ' . mysqli_error($conn));
    }
    echo "1 record added";

?>