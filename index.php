<?php
	include 'dbconn.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="euc-kr">
    <meta name="viewport" content="width=device-width">
    <title>repl.it</title>
    <link rel="stylesheet" href="./css/common_style.css">
  </head>
  <body>

	  	<header>
			Hello Danal ! </br>
      <?php
        if(isset($_SESSION['userid'])){
		echo "<h2>{$_SESSION['userid']} 님 환영합니다.</h2>";
        }
      ?>
	  	</header>

		<div id="bodyWrapper">
			<button id="quizButton" onclick="location.href='./board.html'">
        		게시판
			</button>
			<button id="vacationButton" onclick="location.href='./new.php'">
				새글 생성
			</button>
			<button id="reservationButton" onclick="location.href='./detail.html'">
				상세보기
			</button>
      <button id="myPageButon" onclick="location.href='./mypage.php'">
				마이페이지
			</button>
	  	</div>

		<footer>
			20년 9월 특채 신입 프로젝트</br>
			tmddud333@danal.co.kr
		</footer>
  </body>
</html>