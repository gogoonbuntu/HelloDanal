<?php  
	include "dbconn.php";
	//if(isset($_SESSION['userid'])){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>내 정보</title>
<style>
* {margin: 0 auto;}
a {color:#333; text-decoration: none;}
.find {text-align:center; width:500px; margin-top:30px; }
</style>
</head>
<body>
	<div class="find">
		<!--<form method="post" action="member_pw_update.php"> -->
 			<?php
			  //  $sql = mq("select * from user where id='{$_SESSION['userid']}'");-->
			    //while($member = $sql->fetch_array()){-->
			//?>
			<h1>내 정보</h1>
			<p><a href="./index.html">홈으로</a></p>
				<fieldset>
					<legend>마이페이지</legend>
						<table>
							<p>
								반갑습니다! 
                <?php   
                if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                  $userid = $_SESSION['userid'];
                }
                else{
                  $userid = 'NULL';
                }
                echo $userid;
                ?> 
                님!
                <br>
							</p>
							<br>
              <p>
								직급 : 
								<?php
                if(isset($_SESSION['level']) && !empty($_SESSION['level'])) {
                  $level = $_SESSION['level'];
                }
                else{
                  $level = '무직';
                }
                echo $level; 
                ?>
                <br>
							</p>
              <br>
							<p>
								<?php
                if(isset($_SESSION['phone_num']) && !empty($_SESSION['phone_num'])) {
                  $phone_num = $_SESSION['phone_num'];
                }
                else{
                  $phone_num = '010-';
                }
                echo $phone_num; 
                ?>
                <br>
							</p>
              <br>
              <tr>
              <button onclick=goChangePW()>비밀번호변경</button> 
              &nbsp 
              <button onclick="href.location=''">정보변경</button>
              &nbsp
              <button >내가쓴글보기</button>
              </tr>
						</table>
					
			</fieldset>
			<?php //} ?>
		</form>
	<!--</div>-->
</body>
</html>
<?php //}else{
	//echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
//}
?>

<script>
  function goChangePW(){
    //member_find : 비밀번호 변경 페이지
    window.location.replace('member_find.php');	
  }
</script>