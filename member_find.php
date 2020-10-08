<?php 
  include "dbconn.php";
  if(isset($_COOKIE['userid'])){
    echo "<script>alert('".$_COOKIE['userid']."님은 이미 로그인되어 있습니다.'); history.back();</script>";
  }else{ ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<title>비밀번호 변경</title>
<style>
* {margin: 0 auto;}

a {color:#333; text-decoration: none;}

.findbox {text-align:center; width:500px; margin-top:30px; }
</style>
</head>
<body>
  <div class="findbox">
    <form method="post" action="member_find_id.php">
      <h1>회원계정 찾기</h1>
      <p><a href="login.php">로그인으로</a></p>
        <fieldset>
          <legend>아이디 찾기</legend>
            <table>
              <tr>
                <td>전화번호</td>
                <td><input type="text" name="phone"></td>
              </tr>
            </table>
          <input type="submit" value="아이디 찾기" />
      </fieldset>
     </form>
  </div>
  <div class="findbox">
      <form method="post" action="member_find_pw.php">
        <fieldset>
          <legend>비밀번호 찾기</legend>
            <table>
              <tr>
                <td>아이디</td>
                <td><input type="text" size="35" name="userid" placeholder="아이디"></td>
              </tr>
            </table>
          <input type="submit" value="비밀번호 찾기" />
      </fieldset>
    </form>
  </div>
</body>
</html>
<?php } ?>