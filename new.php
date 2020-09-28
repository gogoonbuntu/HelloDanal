<?php
	include 'dbconn.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>
<table>
    <thead>
        <caption> 새 글쓰기 </caption>
    </thead>
    <tbody>
        <form action="" method="post" encType="multiplart/form-data">
            <tr>
                <th> 제목: </th>
                <td><input type="text" placeholder="제목을 입력하세요. " name="title"/></td>
            </tr>
            <tr>
              <th>날짜: </th>
              <td>
                <input type="datetime-local" id="starttime" name="starttime" value="2020-09-28" min="2020-09-28" max="2020-10-31">
              </td>
            </tr>
            <tr>
              <th>장소: </th>
              <td><input type="text" placeholder="장소를 입력하세요." name="location"/></td>
            </tr>
            <tr>
                <th>내용: </th>
                <td><textarea cols="100" rows="50" placeholder="내용을 입력하세요.&#13;&#10;" name="content"></textarea></td>
            </tr>
            <tr>
                <th> </th>
                <td>
                  <label for="hier_high">열람제한상한</label>
                  <select name="hier_high" id="hier_high">
                    <optgroup label="선택">
                      <option value=0>전체</option>
                      <option value=6>이사</option>
                      <option value=5>부장</option>
                      <option value=4>차장</option>
                      <option value=3>과장</option>
                      <option value=2>대리</option>
                      <option value=1>사원</option>
                    </optgroup>
                  </select>
                  <label for="hier_low">열람제한하한</label>
                  <select name="hier_low" id="hier_low">
                    <optgroup label="선택">
                      <option value=0>전체</option>
                      <option value=6>이사</option>
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
             <td>
                <td rowspan="2">
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
                    <input type="submit" class="button" name="submit" value="submit"/>
                    <input type="submit" value="목록 보기" onclick="javascript:location.href='board.php'"/>
                </td>
            </tr>

        </form>
    </tbody>
</table>
</body>
</html>

