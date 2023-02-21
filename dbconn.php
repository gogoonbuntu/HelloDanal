<?php

    $db_docker = array(
	    'host'=>'db',
	    'port'=>"3306",
	    'id'=>'tmddud333',
	    'pw'=>'abd123',
	    'dbname'=>'tmddud333'
    );

    $db_db4free = array(
	    'host'=>'db4free.net',
	    'port'=>"3306",
	    'id'=>'tmddud333',
	    'pw'=>'', //in email
	    'dbname'=>'tmddud333'
    );

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
