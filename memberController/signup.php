<?php
	include ROOT.'config/dbconn.php';
	$sql = 'select id from danal_id';
	$result = mq($sql);
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/input.css">
<link rel="stylesheet" href="./css/write.css">
<link rel="stylesheet" href="./css/invite.css">
<form method="post" action="signupProcess.php" id="signupForm">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<table align="center">
	<tbody>
	    <tr>
	        <th>
	            <br>
	            회원가입 !
	            <br><br>
	        </th>
	    </tr>
		<tr>
			<td>
				<input type="text" name="id" placeholder="다날 아이디" maxlength="20">
			</td>
		</tr>
		<tr>
			<td>
				<input type="password" name="pswd" id="pswd" placeholder="비밀번호" onchange="pswdCheck(this)">
			</td>
		</tr>
		<tr>
			<td>
				<input type="password" id="repswd" placeholder="비밀번호 확인" onchange="pswdCheck(this)">
			</td>
		</tr>
        <tr>
            <td>
                <div id="pswdCheck" class="red">
            	    X
                </div>
            </td>
        </tr>
		<tr>
		    <td>
				<input type="text" name="name" id="input_name" placeholder="실명 이름" maxlength=3>
				<select name="level" id="level" form="signupForm" onclick="goCheck()">
					<option value="none">=== 직급 ===</option>
					<option value="1">사원</option>
					<option value="2">대리</option>
					<option value="3">과장</option>
					<option value="4">차장</option>
					<option value="5">부장</option>
					<option value="6">임원</option>
				</select>
			</td>
		</tr>
		<tr>
		    <td>
		        <div id="idCheck" style="color:gray;">
		            아닐 시 계정이 무통보 삭제될 수 있습니다.
		        </div>
		    </td>
		</tr>
		<tr>
			<td>
				<input type="text" name="phonenumber" placeholder="전화번호" onchange="numCheck(this)" maxlength="11">
			</td>
		</tr>
				<tr>
		    <td>
		        <div id="numCheck" class="red">
                	특수기호 없이 입력해주세요
                </div>
		    </td>
		</tr>
		<tr>
			<td>
				<input type="text" name="year" placeholder="입사년도(2자리)" maxlength="2">
			</td>
		</tr>
	</tbody>
</table>

<div id="popup_back" class="hide">
    <div id="popup_box">
        <span id="danal_id">다날아이디</span>@danal.co.kr로<br>
        새로운 인증메일이 발송되었습니다.<br><br>
        <div class="timer">5:00</div> 시간 내로 메일 속<br>
        인증번호를 입력해주세요.
        <input type="text" name="authkey">
        <button type="button" onclick="goSubmit()">확인</button>
    </div>
</div>

<div class="signup_btn_wrapper">
<button type="button" class="signup_btn nopass " onclick="sendMail();">제출</button>
<button type="button" class="signup_btn" onclick="goback();">취소</button>
</div>
</form>

<script>

	let pswdOK=0;
	let numOK=0;

	function pswdCheck(a){
		let checkMsg = document.getElementById("pswdCheck");
		if(a.getAttribute('id')=="pswd"){
			if( a.value!="" 
				&& a.value==document.getElementById("repswd").value){
				checkMsg.innerHTML="√ 비밀번호가 일치합니다.";
				pswdOK=1;
				if(checkMsg.classList.contains('green')){
				} else {
				    checkMsg.classList.toggle('green') ;
				    checkMsg.classList.toggle('red') ;
				}
			}
			else {
				checkMsg.innerHTML="X 비밀번호가 불일치합니다.";
				pswdOK=0;
				if(!checkMsg.classList.contains('green')){
				} else {
				    checkMsg.classList.toggle('green') ;
				    checkMsg.classList.toggle('red') ;
				}
			}
		}
		else {
			if( a.value!="" 
				&& a.value==document.getElementById("pswd").value){
				checkMsg.innerHTML="√ 비밀번호가 일치합니다.";
				pswdOK=1;
				if(checkMsg.classList.contains('green')){
				} else {
				    checkMsg.classList.toggle('green') ;
				    checkMsg.classList.toggle('red') ;
				}
			}
			else {
				checkMsg.innerHTML="X 비밀번호가 불일치합니다.";
				pswdOK=0;
				if(!checkMsg.classList.contains('green')){
				} else {
				    checkMsg.classList.toggle('green') ;
				    checkMsg.classList.toggle('red') ;
				}
			}
		}
        goCheck();
	}

	function numCheck(a){
		let pureValue = a.value.replace(/-/g , "");
		pureValue = pureValue.replace(/,/g , "");
		pureValue = pureValue.replace(/ /g , "");
		pureValue = pureValue.replace(/_/g , "");
		let n = Number(pureValue);
		let checkMsg = document.getElementById("numCheck");
		if(pureValue.charAt(0)!='0'
			|| n<1000000001
			|| n>1799999999){
			checkMsg.innerHTML="잘못된 전화번호입니다.";
			numOK=0;
			if(!checkMsg.classList.contains('green')){
			} else {
			    checkMsg.classList.toggle('green') ;
			    checkMsg.classList.toggle('red') ;
			}
		}
		else {
			checkMsg.innerHTML="정상 번호입니다.";
			numOK=1;
			if(checkMsg.classList.contains('green')){
			} else {
			    checkMsg.classList.toggle('green') ;
			    checkMsg.classList.toggle('red') ;
			}
		}
		goCheck();
	}
    function goCheck(){
        btn = document.getElementsByClassName('signup_btn')[0] ;
        var user_id = document.forms['signupForm'].id.value;
        var year = document.forms['signupForm'].year.value;
        if(year != "" && user_id !="" && numOK && pswdOK && document.getElementById('level').value!='none'){
            if(btn.classList.contains('pass')){
            } else {
                btn.classList.toggle('pass');
                btn.classList.toggle('nopass');
            }
        } else {
            if(!btn.classList.contains('pass')){
            } else {
                btn.classList.toggle('pass');
                btn.classList.toggle('nopass');
            }
        }
    }
    
    function sendMail(){
        var user_id = document.forms['signupForm'].id.value;
        var year = document.forms['signupForm'].year.value;
	    if(year != "" && user_id && user_id != "" && numOK && pswdOK && document.getElementById('level').value!='none'){
	        document.getElementById('danal_id').innerHTML = user_id
	        document.getElementById('popup_back').classList.remove('hide')
	        //alert(user_id+"로 메일을 보냄")
	        $.ajax({
                url: '/signup_auth_mail.php',
                type: "get",
                dataType: "",
                data: {
                        uid: user_id,
                    },
                success: function(data){
                    mail_timer();
                },
                error: function (request, status, error){  
                }
            });
	    }
	    else {
	        alert("입력값을 확인해주세요 !");
	        return 0;
	    }
    }
	function goSubmit(){
        if (document.getElementById("signupForm").authkey.value=='') {
            alert("인증키를 입력하세요.");
        } 
        else if (counttime<1) {
            alert("유효기간이 끝났습니다.");
        } else {
            document.getElementById("signupForm").submit();
        }
	}
    
    function goback(){
        window.location.replace('login.php');		
    }
    
    /* 메일 인증 */    
    var counttime = 300 ;
    var timer_interval ;
    
    function mail_timer(){
        timer_interval = setInterval(function(){timer(counttime--)}, 1000) ;
    }
    
    function timer(counttime) {
        if(counttime>=0){
            counttime_min = Math.floor(counttime / 60) ;
            counttime_sec = counttime % 60 ;
            str = String(counttime_min)+":" ;
            str += counttime_sec > 9 ? String(counttime_sec) : "0"+String(counttime_sec) ;
            document.getElementsByClassName('timer')[0].innerHTML = str ;
        } else {
            alert("유효기간이 끝났습니다.");
            clearInterval(timer_interval) ;
            document.getElementById('popup_back').classList.add('hide') ;
        }
    }
</script>
