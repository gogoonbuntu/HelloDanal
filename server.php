<?php

	$conn = mysqli_connect("localhost", "buntu2", "!Q2w3edaidai", "mainDB");

	$result = mysqli_query($conn, "select * from board");

	$sql = "SELECT * FROM topic";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result)) {
  		echo '<h2>'.$row['title'].'</h2>';
  		echo $row['description'];
	}
?>
