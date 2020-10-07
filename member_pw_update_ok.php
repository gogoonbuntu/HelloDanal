<?php

include "dbconn.php";
include "password.php";

//$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$userpw = $_POST['pw'];


$sql = mq("update user set pswd='".$userpw."' where id = '".$_COOKIE['tempid']."'");
setcookie('tempid', '', time() - 3600, '/'); // 비밀번호 찾을때 사용하는 tempid 쿠키 제거
unset($_COOKIE['tempid']);
echo "<script>alert('비밀번호를 변경했습니다.'); location.href='login.php';</script>";

?>