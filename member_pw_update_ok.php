<?php

include "dbconn.php";
include "password.php";

//$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$userpw = $_POST['pw'];


$sql = mq("update user set pswd='".$userpw."' where id = '".$_SESSION['uid']."'");
session_destroy();
echo "<script>alert('비밀번호를 변경했습니다.'); location.href='/index.html';</script>";

?>