<?php

    $host = "db";
    $port = "3306";
    $id = "tmddud333";
    $pw = "abd123"; //보안보안
    $dbname = "tmddud333";
	$conn = mysqli_connect($host, $id, $pw, $dbname, $port);

  $db = new mysqli($host, $id, $pw, $dbname, $port);
	//$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
