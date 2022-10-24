<?php

    $host = "127.0.0.1";
    $id = "tmddud333";
    $pw = "abc123"; //보안보안
    $dbname = "tmddud333";
	$conn = mysqli_connect($host, $id, $pw, $dbname);

  $db = new mysqli($host, $id, $pw, $dbname);
	//$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
