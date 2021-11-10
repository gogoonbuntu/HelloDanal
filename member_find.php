<?php 
  include "dbconn.php";
  if(isset($_COOKIE['userid'])){
    echo "<script>alert('".$_COOKIE['userid']."님은 이미 로그인되어 있습니다.'); history.back();</script>";
  }else{ 
  	$sql = 'select id from TABLE_USER';
	$result = mq($sql);
	$input_id =  $_POST['input_id'];
	$input_pn = $_POST['input_pn'];
    if(isset($_POST['input_id']) && isset($_POST['input_pn'])){
        ?>
        <script>
        window.onload = function(){
            document.getElementById('userid').value = '<?php echo $input_id; ?>' ; 
            document.getElementById('phonenum').value = '<?php echo $input_pn; ?>' ;
        }
        </script>
        <?php
    }
  ?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width">
	<title>회원가입 폼</title>
	<link rel="stylesheet" href="./css/input.css">
	<link rel="stylesheet" href="./css/header.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

	</script>
	<style>
		* {
			margin: 0 auto;
		}

		a {
			color: #333;
			text-decoration: none;
		}

		.findbox {
			text-align: center;
			margin-top: 160px;
			width: 250px;
		}
		.character {
		    position:absolute;
		    text-align: center;
		    top: 0px;
		    z-index:-3;
		    margin-top:50px;
		    width:100%;
		}
		.character>img{
		    width:100px;
		}
		body {
		    background:linear-gradient(180deg, #FFF 0%, #F6EFEF 100%);
		}
	</style>
</head>

<body style="height: 100vh">
    <header>
        <div class="goback" onclick="goback()">
            <img src="img/goback.png">
        </div>
        <div class="headerText">비밀번호 찾기</div>
    </header>
    
    <div class="character">
  	    <img src="/img/character danaly stand.png">
  	</div>
  	
	<div class="findbox">
		<table>
			<tr>
				<td>
					<input class="inph" type="text" size="35" id="userid" placeholder="아이디">
				</td>
			</tr>
			<tr>
		        <td id="idCheck">X</td>
		    </tr>
			<tr>
				<td>
					<input class="inph" type="text" size="35" id="phonenum" placeholder="전화번호">
				</td>
            </tr>
			<tr>
			    <td id="numCheck">X</td>
			</tr>
		</table>
		<input class="inph" type="button" value="비밀번호 찾기" onclick="findid()">
		<form method="post" action="member_find_pw_update.php">
			<table id="pwupdate" style="display:none;">
				<tr>
					<td><input class="inph" type="password" size="35" name="pw" placeholder="변경비밀번호"></td>
				</tr>
				<tr>
					<td><input class="inph" type="password" size="35" name="repw" placeholder="비밀번호확인"></td>
				</tr>
				<tr>
				    <td>
				        <input type="hidden" id="hiddenid" name="id">
			            <input type="submit" value="변경하기" />    
				    </td>
				</tr>
			</table>
			
		</form>
  	</div>
  	
</body>
</html>
<script>
	let idList = new Array();
 	<?php
	while ($row = mysqli_fetch_array($result)) {
	?>
		idList.push("<?php echo $row['id']?>");
	<?php
	}?>
	var elem = document.getElementById('pwupdate');
	function findid() {
	    var elemok = 0;
		var userid = document.getElementById('userid');
		//alert(userid.value);
		for (let id of idList) {
			if (id == userid.value) {
				check_phonenum(id);
				elemok = 1;
			}
		}
		if (elemok == 1) {
			document.getElementById('idCheck').innerHTML = '√';
		}
		else if (elemok == 0) {
			document.getElementById('idCheck').innerHTML = 'X';
		}
	}

	function check_phonenum(id) {
		console.log(id);
		$.ajax({
			url: "/member_check_phonenum.php",
			data: {
			    uid: id,
				phonenumber: document.getElementById('phonenum').value
			},
			type: "POST",
			success: function (result) {
			    console.log(result);
				if (result == "1") {
					elem.style.display = '';
					document.getElementById('hiddenid').value = id;
					document.getElementById('numCheck').innerHTML = '√';
				} else {
					alert('정보가 잘못되었습니다.');
					document.getElementById('numCheck').innerHTML = 'X';
				}
			}
		})
	}
	function goback(){
	    history.back() ;
	    location.replace("login.php") ;
	}
</script>
<?php } ?>