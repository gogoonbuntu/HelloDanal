<?php
	include 'dbconn.php';
	$sql = 'select * from board';
	$result = mq($sql);
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="euc-kr">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	 crossorigin="anonymous">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	 crossorigin="anonymous">
	</script>

	<link rel="stylesheet" href="./css/common_style.css">
	<link rel="stylesheet" href="./css/board.css">
	<title>Hello Danal !</title>
</head>

<body>
	<table id="bodyWrapper">
		<tbody>
		</tbody>
	</table>

	<form>
		<input type="hidden" name="type" value="0">
	</form>
</body>

</html>

<script>
/* 
 * 0: 중고장터
 * 1: 맛집리뷰
 * 2: 번개모임
 * 3: 내 페이지
 */
$.ajax({
		url: "boardType.php",
		type: "post",
		data: $("form").serialize(),
		success: function(data) {
			$("tbody").append(data);
		},
		error: function(err) {
			alert("err");
		}
});
function typeChange(){			
}
typeChange();
</script>