<?php

    $host = "ec2-52-8-112-233.us-west-1.compute.amazonaws.com";
    $id = "sql6510505";
    $pw = "XXekRPbLBh"; //보안보안
    $dbname = "sql6510505";
	$conn = mysqli_connect($host, $id, $pw, $dbname);

  $db = new mysqli($host, $id, $pw, $dbname);
	//$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
