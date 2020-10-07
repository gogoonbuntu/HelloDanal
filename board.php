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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	 crossorigin="anonymous">
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	 crossorigin="anonymous">
	</script>
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
	<header>
		중고장터
	</header>

	<table id="bodyWrapper">
		<tbody>
		<?php
			while($row = mysqli_fetch_array($result)) {
  				echo '<tr><td rowspan="2"><img src="'
				  .$row['imgsrc']
				  .'"> </td><td class="title">'
				  .$row['title']
				  .'<span class="like">♡<span class="count">'
				  .$row['likes']
				  .'</span></span></td></tr>'
				  .'<tr class="bottomline"><td class="description">'
				  .$row['content']
				  .'</td></tr>' ;
			}
		?>
		</tbody>
	</table>

	<footer>
		20년 9월 특채 신입 프로젝트</br>
		tmddud333@danal.co.kr
	</footer>
	<script src="script.js">
	</script>
</body>

</html>