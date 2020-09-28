<?php

include "dbconn.php";
include "password.php";

//$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$userpw= $_POST['userpw'];
$level = $_POST['level'];
$phone = $_POST['phone'];


$sql = mq("update member set pswd='".$userpw."', level='".$level."',phone='".$phone."' where id='".$_SESSION['userid']."'");
echo "<script>alert('정보변경이 완료되었습니다 	'); history.back();</script>";

?>