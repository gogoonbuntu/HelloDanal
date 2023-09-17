<?php  
	include ROOT."config/dbconn.php";
	header("Pragma: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    
    $level_name = array('에러','사원', '대리', '과장', '차장', '부장', '임원') ;
    
    $userid = $_COOKIE['user_id'];

    $sql_user_info = "select id, level, phone from TABLE_USER where id='$userid'" ;
    $sql_my_contents = "select seqno, type, title from TABLE_BOARD where author='$userid'" ;
    
    
    $result = mq($sql_user_info) ;
    $account_data = [] ;
    while($i = mysqli_fetch_array($result)){
        array_push($account_data, $i) ;
    }

    $level = $account_data[0][1];
    $phone_num = $account_data[0][2];
    
    $result0 = mq($sql_my_contents) ;
    $rows = [] ;
    while($row = mysqli_fetch_array($result0)){
        array_push($rows, $row) ;
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="euc-kr">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>내 정보</title>

</head>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<body id="hidden">
    <div id="side-nav">
    <div class="contents">
        <br>
        <table>
            <tbody align="left">
                <tr class="t_align">
                    <th>아이디 : </th>
                    <td> 
                    <?php   
                        echo $userid ;
                    ?> 
                        <div class="logout" onclick="logout()">로그아웃</div>
                    </td>
                </tr>
                <tr>
                    <th>직급 : </th>
                    <td>
                    <?php
                        echo $level_name[$level] ; 
                    ?>
                    </td>
                </tr>
                <tr>
                    <th>전화번호 : </th>
                    <td>
                    <?php
                        if(is_null($phone_num)){
                            $phone_num = '010-';
                        }
                        echo $phone_num; 
                    ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align:center ; background-color:#F3F3F3 ;" onclick="changePassword()">
                        비밀번호 수정
                    </th>
                </tr>
                <tr>
                    <th colspan=2 >내가 쓴 게시글</th>
                </tr>
            </tbody>
        </table>
    <div id="pagination">
        <ul id="my_pages" style="">
            
        </ul>
    </div>
    <div id="paging" style="display:flex; justify-content:center;">
    </div>      
    <script src="ref/paging.js" type="text/javascript"></script>
    </div>
    </div>
    <form action="member_find.php" method="post" name="form_change_pw">
        <input type="hidden" name="input_id" value="<?php echo $userid ; ?>">
        <input type="hidden" name="input_pn" value="<?php echo $phone_num ; ?>">
    </form>
</body>
</html>

<script>
    var rows = <?php echo json_encode($rows) ; ?> ;
    // Initial Page Buttons
    var contentsPerPage = 5;
    pages = rows.length / contentsPerPage ;
    pages > parseInt(rows.length / contentsPerPage) ? pages = parseInt(pages) + 1 : pages ;
    
    var pageCurrent = 1;
    
    if (pages > 0) {
    	for (var i = 1; i <= pages; i++) {
    		document.getElementById('paging').innerHTML+="<div class='pageButton' onclick='loadMyPage(this)'>"+i+"</button > ";
    }
    	document.getElementsByClassName('pageButton')[0].click();
    } else {
    	document.getElementById('paging').innerHTML+="Empty";
    }
    
    
    // Functions
    function loadMyPage(elem) {
        header_name = ['중', '맛', '번']
    	pageCurrent = parseInt(elem.innerHTML);
    	console.log("pageCurrent: " + pageCurrent);
    	addhtml = document.getElementById('my_pages');
    	temphtml = "";
    	for (var i = (pageCurrent-1) * contentsPerPage ; i < Math.min(pageCurrent * contentsPerPage, rows.length) ; i++) {
    		temphtml += '<li class="result btype' +rows[i][1]+ '" onclick="godetail(' +rows[i][0]+ ')" >' ;
    		temphtml += '['+header_name[parseInt(rows[i][1])]+'] ' ;
    		temphtml += rows[i][2] ; //title
    		temphtml += '</li>' ;
    	}
    	addhtml.innerHTML = temphtml;
    }
    
    function godetail(i){
        var form = document.createElement("form");
        form.setAttribute('method', 'post');
	    form.setAttribute('action', "detail.php");
	    document.charset = "utf-8";
	

		var hiddenField = document.createElement('input');
		hiddenField.setAttribute('type', 'hidden');
        hiddenField.setAttribute('name', "input_idx");
		hiddenField.setAttribute('value', i);

		form.appendChild(hiddenField);

	    document.body.appendChild(form);
        
	    form.submit();
        
        
    }
    function changePassword(){
        document.form_change_pw.submit();
    }
    function logout(){
        document.cookie="user_id=;Max-Age=-999999;" ;
        document.cookie="level=;Max-Age=-999999;" ;
        document.cookie="myidx=;Max-Age=-999999;" ;
        location.replace('/login.php') ;
    }
    
    //호스팅어 로고 지우기
    var div_list = document.getElementsByTagName("div") ;
    for (var a of div_list) {
        console.log(a.style['z-index']);
        if(a.style['z-index']>999999) {
            a.parentNode.removeChild(a) ;
        }
    }
</script>