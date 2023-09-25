<?php
    include '../config/define.php' ;
	include ROOT.'boardController/invite.php' ;
	$mylevel = $_COOKIE['level'] ;
	$btype = $_POST['btype'] ;
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="./css/write.css">
</head>
<body>
<table align="center">
    
    <tbody>
        <form action="" method="post" encType="multiplart/form-data">
            <tr>
                <td><input type="text" placeholder="제목을 입력하세요. " name="title"/></td>
            </tr>
            <?php
            if ($btype == 0){ //중고장터?>
              <tr>
                <td><input type="text" placeholder="가격을 입력하세요." name="price"</td>
              </tr>
           <?php }?>

           <?php
           if ($btype == 1){ //맛집정보 ?>
            <tr>
              <td><input type="text" placeholder="장소를 입력하세요." name="location"></td>
            </tr>
           <?php }?>

           <?php
           if ($btype == 2){ //번개모임 ?>
            <tr>
              <td><input type="datetime-local" id="starttime" name="starttime" value="2020-09-28" min="2020-09-28" max="2020-10-31"> 
              </td> 
            </tr> 
            <tr> 
              <td><input type="text" placeholder="장소를 입력하세요." name="location"/></td> 
            </tr>
           <?php }?>
            <tr>
              <td>
                    <div class="filebox preview-image"> 
                    
                    <label for="input-file">
                      업로드
                    </label> 
                    <input type="file" id="input-file" class="upload-hidden"> 
                  </div>
              </td>
            </tr>
            <tr>
                <td>
                  <label for="hier_high">열람제한상한</label>
                  <select name="hier_high" id="hier_high" onchange="hier_all()">
                    <optgroup label="선택">
                      <option value=0>전체</option>
                      <option value=6>임원</option>
                      <option value=5>부장</option>
                      <option value=4>차장</option>
                      <option value=3>과장</option>
                      <option value=2>대리</option>
                      <option value=1>사원</option>
                    </optgroup>
                  </select>
                  <label for="hier_low" id = "hier_low_label">하한</label>
                  <select name="hier_low" id="hier_low">
                    <optgroup label="선택">
                      <option value=6>임원</option>
                      <option value=5>부장</option>
                      <option value=4>차장</option>
                      <option value=3>과장</option>
                      <option value=2>대리</option>
                      <option value=1>사원</option>
                    </optgroup>
                  </select>
                </td>
            </tr>
            <tr>
                <td><textarea placeholder="내용을 입력하세요.&#13;&#10;" name="content"></textarea></td>
            </tr>
            
           <tr>
             <td>
                  <?php
                    // 나중에 id받으면 author 사용
                    //$author = $_POST['author'];
                    // type : 0-중고, 1-맛집, 2-번개          
                      function submit(){
                        $query = "INSERT INTO board(
                          
                          type,
                          title, 
                          author,  
                          hier_high, 
                          hier_low,
                          imgsrc,
                          viewcount,
                          content,
                          sell,
                          likes,
                          level,
                          finish,
                          starttime,
                          location
                          ) 
                          VALUES(
                            
                            2,
                            '{$title}',
                             '{$author}',
                                {$hier_high},
                                 {$hier_low},
                                  '',
                                  0,
                                  '{$content}',
                                  0,
                                  0,
                                  0,
                                  0,
                                  '{$date}',
                                  '{$location}'
                                )";
                        if(mysql_query($conn, $query)){
                          echo "New record created Successfully";
                        }
                        else{
                          echo "Error: ".$query."<br>".mysqli_error($conn);
                        }
                     
                      echo("<meta http-equiv='Refresh' URL=index.html'>"); //페이지 돌아가기
                    }

                    if(isset($title, $content, $hier_high, $hier_low)){
                      submit();
                    }
                    else{
                      echo "<p>Please fill in everything.</p>";
                    }
                    ?>
                    <input type="submit" class="button" name="submit" value="등록하기"/>
                    <input type="submit" value="목록 보기" onclick="javascript:location.href='board.php'"/>
                </td>
            </tr>
        </form>
    </tbody>
</table>
</body>
</html>
<script>


var mylevel = <?php echo $mylevel ;?> ;

//preview image 
var imgTarget = $('.preview-image .upload-hidden');
imgTarget.on('change', function () {
	var parent = $(this).parent();
	parent.children('.upload-display').remove();
	if (window.FileReader) { //image 파일만 
		if (!$(this)[0].files[0].type.match(/image\//))
			return;
		var reader = new FileReader();
		reader.onload = function (e) {
			var src = e.target.result;
			parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img src="' + src + '" class="upload-thumb"></div></div>');
		} ;
		reader.readAsDataURL($(this)[0].files[0]);
	} else {
		$(this)[0].select();
		$(this)[0].blur();
		var imgSrc = document.selection.createRange().text;
		parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img class="upload-thumb"></div></div>');
		var img = $(this).siblings('.upload-display').find('img');
		img[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\"" + imgSrc + "\")";
	}
});
function hier_all(){
    if (document.getElementById('hier_high').value == 0) {
        document.getElementById('hier_low').value = 0 ;
        document.getElementById('hier_low').style.display = 'none' ;
        document.getElementById('hier_low_label').style.display = 'none' ;
    } else {
        document.getElementById('hier_low').style.display = '' ;
        document.getElementById('hier_low_label').style.display = '' ;
    }
}
console.log(document.getElementById('hier_high').value);
</script>