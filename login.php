<?php   
include 'dbconn.php'; 
?>


<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>회원가입 및 로그인 사이트</title>
<style>
   {
  margin: 0 auto;
  padding:0;
}

a
{
  text-decoration: none; 
}

ul li 
{
  list-style: none;
}

#login_box
{
  width:500px;
  height:200px;
  border:solid 2px gray;
}

table 
{
  margin-top:10px;
}

.mem a:hover 
{
  color:red;
}

#btn 
{
  width:95px;
  height:55px;
  background: skyblue;
  border:solid 1px skyblue;
}

.inph 
{
  height:25px;
}
   </style>
</head>
<body>
	<div id="login_box">
		<h1>로그인</h1>							
			<form method="post" action="login_ok.php">
				<table align="center" border="0" cellspacing="0" width="300">
        			<tr>
            			<td width="130" colspan="1"> 
                		<input type="text" name="userid" class="inph">
            		</td>
            		<td rowspan="2" align="center" width="100" > 
                		<button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
        		<tr>
            		<td width="130" colspan="1"> 
               		<input type="password" name="userpw" class="inph">
            	</td>
        	</tr>
        	<tr>
           		<td colspan="3" align="center" class="mem"> 
              	<a href="member.php">회원가입 하시겠습니까?</a>
                <a href="member_find.php">계정찾기</a>
           </td>
        </tr>
    </table>
  </form>
</div>
</body>
</html>