<?php   
    include '../config/define.php' ;
    include ROOT.'config/dbconn.php';
    include ROOT.'lib/log.php';
    if( isset($_COOKIE['user_id']) ) {
        push_log($_SERVER, $_COOKIE['user_id']." LOGIN.",__LINE__)
?>
    <script>
        document.location.href = "/index.php" ;
    </script>
<?php
    }
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>회원가입 및 로그인 사이트</title>
	<link rel="stylesheet" href="./css/input.css">
	<meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Pragma" content="no-cache"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <img src="./img/danal full logo.png" width="60px">
        </div>
        <div id="login_title">
            <span class="login_header">로그인</span>
        </div>    

    	<div id="login_box">
    									
    			<form method="post" action="login_ok.php">
    				<table align="center">
            			<tr>
                			<td> 
                    		<input type="text" class="shadow inph" placeholder="아이디" name="userid" size=40>
                		</td>

            		</tr>
            		<tr>
                		<td> 
                   		<input type="password" class="shadow inph" placeholder="비밀번호" name="userpw" size=40>
                	    </td>
            	    </tr>
            	<tr>
               		<td align="center">
               		<button type="submit" class="btn shadow" >로그인</button> 
                  	<button type="button" class="btn blue shadow" onclick="location.replace('signup.php');">회원가입</button>
                    <div class="find_pw">비밀번호를 잊으셨나요? <a href="member_find.php">비번찾기</a></div>
                    </td>
                </tr>
            </table>
         </form>
        </div>
    </div>
    
    <footer>
        <img class="login_no" src="./img/character danaly.png">
    </footer>
</body>
</html>
<script>
    var wh = window.innerHeight;
    document.getElementsByTagName("body")[0].style.height = wh+"px";
    
    //clear cookie ;
    document.cookie="user_id=;Max-Age=-999999;" ;
    document.cookie="level=;Max-Age=-999999;" ;
    document.cookie="myidx=;Max-Age=-999999;" ;
    
    //clear history
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    
    
    //호스팅어 로고 지우기
    function no_logo() {
        var div_list = document.getElementsByTagName("div") ;
        for (var a of div_list) {
            if(a.style['z-index']>999999) {
                a.parentNode.removeChild(a) ;
            }
        }
    }
    window.onload = function(){
        no_logo();
        setTimeout(no_logo(), 100) ;
        setTimeout(no_logo(), 500) ;
    } ;
</script>
