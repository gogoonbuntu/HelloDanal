<?php 
  include "dbconn.php";
  if(isset($_SESSION['userid'])){
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
  }else{ ?>
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
<?php } ?>