<?php

    $host = "localhost";
    $id = "id14957377_danal";
    $pw = "!Q2w3e1q2w3e";
    $dbname = "id14957377_tmddud333";
	$conn = mysqli_connect($host, $id, $pw, $dbname);

  $db = new mysqli($host, $id, $pw, $dbname);
	//$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>