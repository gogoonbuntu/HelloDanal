<?php
	include "dbconn.php";
if($_POST["userid"] == ""){
		echo '<script> alert("항목을 입력하세요"); history.back(); </script>';
	}else{
$userid = $_POST["userid"];
$sql = mq("select * from user where id='{$userid}'");
$result = $sql->fetch_array();

if($result["id"] == $userid){
    
    setcookie('tempid',$userid,time()+(3600),'/');
	echo "<script>alert('회원님의 비밀번호를 변경합니다.');</script>";
  if(isset($_Cookie['userid'])){
    echo "<script>alert('".$_COOKIE['userid']."님은 이미 로그인되어 있습니다.'); history.back();</script>";
  }else{
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<title>회원가입 폼</title>
<style>
* {margin: 0 auto;}
.find {text-align:center; width:500px; margin-top:30px; }
</style>
</head>
<body>
  <div class="find">
  <form method="post" action="member_pw_update_ok.php">
    <h1>비밀번호 변경</h1>
      <fieldset>
        <legend></legend>
          <table>
            <tr>
              <td>비밀번호 변경 : </td>
              <td><input type="password" size="35" name="pw" placeholder="변경비밀번호"></td>
            </tr>
          </table>
        <input type="submit" value="변경하기" />
      </fieldset>
  </form>
</div>
</body>
</html>
<?php } }
else{
    echo "<script>alert('없는 계정입니다.'); history.back();</script>";
}
	
}
?>
