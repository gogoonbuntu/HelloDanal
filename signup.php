<?php
	include 'dbconn.php';
	$sql = 'select id from danal_id';
	$result = mq($sql);
?>
<form method="post" action="signupProcess.php" id="signupForm">
<table>
	<tbody>
		<tr>
			<td>
				다날 아이디
			</td>
			<td>
				<input type="text" name="id" placeholder="ex) danal1234" onchange="idCheck(this)">
			</td>
			<td id="idCheck">
				미인증
			</td>
		</tr>
		<tr>
			<td>
				비밀번호
			</td>
			<td>
				<input type="password" name="pswd" id="pswd" placeholder="password" onchange="pswdCheck(this)">
			</td>
			
		</tr>
		<tr>
			<td>
				비밀번호 확인
			</td>
			<td>
				<input type="password" id="repswd" placeholder="re-password" onchange="pswdCheck(this)">
			</td>
			<td id="pswdCheck">
				X
			</td>
		</tr>
		<tr>
			<td>
				직급
			</td>
			<td>
				<select name="level" name="level" form="signupForm">
					<option value="none">=== 선택 ===</option>
					<option value="1">사원</option>
					<option value="2">대리</option>
					<option value="3">과장</option>
					<option value="4">차장</option>
					<option value="5">부장</option>
					<option value="6">실장</option>
					<option value="7">이사</option>
					<option value="8">상무</option>
					<option value="9">전무</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				전화번호
			</td>
						<td>
				<input type="text" name="phonenumber" placeholder="010xxxxxxxx" onchange="numCheck(this)">
			</td>
			<td id="numCheck">
				특수기호 없이 입력해주세요
			</td>
		</tr>
	</tbody>
</table>
<button onclick="goSubmit();">제출</button>
<button onclick="goback();">취소</button>
</form>


<script>
	let idOK=0;
	let pswdOK=0;
	let numOK=0;
	let idList = new Array();
	<?php
	while($row = mysqli_fetch_array($result)){
	?>
	idList.push("<?php echo $row['id']?>");
	<?php
	}?>
	function pswdCheck(a){
		let checkMsg = document.getElementById("pswdCheck");
		if(a.getAttribute('id')=="pswd"){
			if( a.value!="" 
				&& a.value==document.getElementById("repswd").value){
				console.log(a.value);
				console.log(document.getElementById("repswd").value);
				checkMsg.innerHTML="√";
				pswdOK=1;
			}
			else {
				checkMsg.innerHTML="X";
				pswdOK=0;
			}
		}
		else {
			if( a.value!="" 
				&& a.value==document.getElementById("pswd").value){
				console.log(a.value);
				console.log(document.getElementById("pswd").value);
				checkMsg.innerHTML="√";
				pswdOK=1;
			}
			else {
				checkMsg.innerHTML="X";
				pswdOK=0;
			}
		}

	}

	function idCheck(a){
		let checkMsg = document.getElementById("idCheck");
		for(let id of idList){
			if(id==a.value){
				checkMsg.innerHTML="인증!"
				idOK=1;

			}
			else {
				checkMsg.innerHTML="미인증"
				idOK=0;
			}
		}
	}

	function numCheck(a){
		let pureValue = a.value.replace(/-/g , "");
		pureValue = pureValue.replace(/,/g , "");
		pureValue = pureValue.replace(/ /g , "");
		pureValue = pureValue.replace(/_/g , "");
		let n = Number(pureValue);
		let checkMsg = document.getElementById("numCheck");
		console.log(n);
		if(pureValue.charAt(0)!='0'
			|| n<1000000001
			|| n>1799999999){
			checkMsg.innerHTML="잘못된 전화번호입니다.";
			numOK=0;
		}
		else {
			checkMsg.innerHTML="정상 번호입니다.";
			numOK=1;
		}
	}
	
	function goSubmit(){
	    if(numOK && pswdOK && idOK){
	        document.getElementById("signupForm").submit();
	    }
	    else {
	        alert("아이디, 비번, 폰번을 확인해주세요.");
	    }
	}
    
    function goback(){
        window.location.replace('login.php');
    }
</script>
