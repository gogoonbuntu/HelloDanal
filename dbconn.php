<?php
	$conn = mysqli_connect("db4free.net", "tmddud333", "1q2w3edaidai", "tmddud333");

  $db = new mysqli("db4free.net", "tmddud333", "1q2w3edaidai", "tmddud333"); 
	//$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>