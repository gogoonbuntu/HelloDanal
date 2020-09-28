<?php
	include "dbconn.php";
	$userid = $_POST['userid'];
$sql = mq("select * from user where id='{$userid}'");
$result = $sql->fetch_array();

if($result["id"] == $userid){
	$_SESSION['uid'] = $userid;
	echo "<script>alert('회원님의 비밀번호를 변경합니다.'); location.href='member_pw_update.php';</script>";

}else{
	echo "<script>alert('없는 계정입니다.'); history.back();</script>";
}
?>