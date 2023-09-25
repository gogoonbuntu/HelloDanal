<?php
    $host = "127.0.0.1";
    $port = "33060";
    $id = "tmddud333";
    $pw = "abd123"; //보안보안
    $dbname = "tmddud333";
	$conn = mysqli_connect($host, $id, $pw, $dbname, $port);

// MySQL 서버에 연결
$connection = new mysqli($host, $id, $pw, $dbname, $port);

// 연결 상태 확인
if ($connection->connect_error) {
    die("MySQL 연결 실패: " . $connection->connect_error);
}

echo "MySQL 연결 성공!";
?>