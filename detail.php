<?php
	include 'dbconn.php';

 
  //$bno=$_GET['idx'];
 
  $bno = 1; /* bno함수에 idx값을 받아와 넣음*/ 
//'.$bno.'

	$sql = 'select * from board where idx ='.$bno.''; 
	$result= mysqli_query($conn, $sql);
  $result2 = mysqli_fetch_array($result);
  $viewcount = $result2['viewcount'] + 1;
  $sql2 = 'update board set viewcount = '.$viewcount.' where idx = '.$bno.'';
  $result= mysqli_query($conn, $sql2);
  $result= mysqli_query($conn, $sql);
  $board = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    


		<div id="bodyWrapper">


     	<div class="container">

		  <div class="row">

				<table class="table table-striped"

					style="text-align: center; border: 1px solid #dddddd">

					<thead>

						<tr>

							<th colspan="3"	style="background-color: #eeeeee; text-align: center;"> 
              <?php echo "<img src=".$board['imgsrc']."class=\"img-responsive\" alt=\"Responsive image\">" ?>  </th>

						</tr>

					</thead>

					<tbody>
            
            <tr>

							<td>제목</td>	
              
							<td colspan="2"><?php echo $board['title']; ?></td>

						</tr>

						<tr>

							<td>작성자</td>	

							<td colspan="2"><?php echo $board['author']; ?></td>

						</tr>

						<tr>

							<td>작성일</td>	

							<td colspan="2"><?php echo $board['starttime']; ?></td>

						</tr>

            <tr>

							<td>조회수</td>	

							<td colspan="2"><?php echo $board['viewcount']; ?></td>

						</tr>

						<tr>

							<td>내용</td>	

							<td colspan="2" style="min-height: 200px; text-align: left;">
                <?php echo $board['content']; ?>
              </td>

						</tr>

						

					</tbody>

				</table>	
		</div>

    <div class="row mt-1">
      <div class="col"></div>
      <div class="col"></div>
			<div class="col-1"><a href = "board.html" class="btn btn-primary">목록</a></div>
      <div class="col-1"><a href="modify.php?idx=<?php echo $board['idx']; ?>" class="btn btn-primary">수정</a></div>
      <div class="col-1"><a href="delete.php?idx=<?php echo $board['idx']; ?>" class="btn btn-primary">삭제</a></div>
    </div>
	

    <div class="col">
		댓글
		</div>
		
		<div class="row ml-2 mt-2 bg-light"><!-- 댓글 리스트 박스 -->

			<div id="reply_box" class="col" > <!-- 리스트 컨텐트 박스 -->
			</div>
		</div>
	
		<div class="row mt-2 ml-1 mb-3 bg-light" > <!--댓글 입력 창-->
			<div class="col mt-2">
				<textarea id="reply_content" class="form-control"></textarea>
			</div>
			<div class="col-1 mt-2 mr-2 border border-secondary bg-white text-center" style="vertical-align: middle;">	
				<a style="color:black; font-weight:bold; line-height:60px;" href="#">등록</a>
		</div>

    <div id="templete" class="row" style="display:none">
		<!-- ..... -->
		<div class="col">
			<div class="row mt-3 border-bottom border-secondary text-left">
				
				<div class="col-2 bg-secondary text-white">작성자</div>
				<img src="..." class="img-responsive" alt="Responsive image">
				<div class="col-2 r_writer">다날이</div>
				<div class="col-2 r_write_date" >2020-09-24</div>
				<div class="col-1"><button class="btn btn-sm btn-link update text-dark" style="display:none">수정</button></div>
				<div class="col-1"><button class="btn btn-sm btn-link delete text-dark" style="display:none">삭제</button></div>
				<div class="col"></div>
			</div>
			
			<div class="row bg-light ">
				<div class="col r_content">내용 어쩌고....먀며ㅗㄷ랴며ㅗㄹ며ㅑ돌</div>
				<div class="col-1 r_submit"></div>
				
				
		</div>
  </div>

    
				
	</div>

	</div>

    
	<footer class="footer text-center mt-5 mb-0">
		<p class="text-secondary">20년 9월 특채 신입 프로젝트</h3>
	  <p>	tmddud333@danal.co.kr </p>
	</footer>


  <script src="script.js"></script>
  </body>
</html>