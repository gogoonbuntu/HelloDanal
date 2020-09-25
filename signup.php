<table>
	<tbody>
		<tr>
			<td>
				다날 아이디
			</td>
			<td>
				<input type="text" placeholder="ex) danal1234" onchange="idCheck(this)">
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
				<input type="password" id="pswd" placeholder="password">
			</td>
			
		</tr>
		<tr>
			<td>
				비밀번호 확인
			</td>
			<td>
				<input type="password" placeholder="re-password" onchange="pswdCheck(this)">
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
				<select name="level" >
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
				<input type="text" placeholder="010xxxxxxxx" onchange="numCheck(this)">
			</td>
		</tr>
	</tbody>
</table>
<button>제출</button>
<button>취소</button>
<script>

	function pswdCheck(a){
		if( a.value!="" 
			&& a.value==document.getElementById("pswd").value){
				console.log("OK");
				document.getElementById("pswdCheck").innerHTML="√";
		}
		//a.value
	}

	function idCheck(a){
		for(let id of idList){
			if(id==a.value){
				document.getElementById("idCheck").innerHTML="인증!"
			}
		}
	}

	function numCheck(a){
		if(Number(a.value)){
			
		}
	}
</script>
