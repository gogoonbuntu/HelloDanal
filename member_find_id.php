<?php
include "dbconn.php";
if($_POST["phone"] == ""){
		echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
	}else{

	$phone = $_POST['phone'];


$sql = mq("select * from user where phonenumber = '{$phone}'");
$result = $sql->fetch_array();

if($result["phonenumber"] == $phone){
	echo "<script>alert('회원님의 ID는 ".$result['id']."입니다.'); history.back();</script>";
}else{
echo "<script>alert('없는 계정입니다.'); history.back();</script>";
}
}
?>