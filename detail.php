<?php  
	include 'dbconn.php';
	include 'log.php';
	
    $bno = $_POST["input_idx"]; /* bno함수에 idx값을 받아와 넣음*/ 
    
	$viewcount = mysqli_fetch_array(mq("select * from TABLE_BOARD where seqno ='".$bno."'"));
	$viewcount = $viewcount['viewcount'] + 1;
	$c_author = $_COOKIE['user_id'];
	$fet = mq("update TABLE_BOARD set viewcount = '".$viewcount."' where seqno = '".$bno."'");
	
	$sql = mq("select * from TABLE_BOARD where seqno='".$bno."'"); /* 받아온 idx값을 선택 */

	$board = $sql->fetch_array();
	$btype = $board['type'];
	
	push_log($_SERVER, $_COOKIE['user_id']." ENTER ".$board['title']."(".$bno.")", __LINE__);
	
	$sql = mq("select * from TABLE_IMAGE where board_seqno='".$bno."'"); /* 받아온 idx값을 선택 */
	
	$image = $sql ->fetch_array();
	$imgsrc = $image['imgsrc'];
	$author = $board['author'];
	$sql = mq("select name from TABLE_USER where id='".$author."'"); /* 받아온 id값을 선택 */
	
	$user = $sql ->fetch_array();
	$name = $user['name'];
	
	$level = $board['level'];
	if($level == 1){$level = '사원';}
    else if($level == 2){$level = '대리';}
    else if($level == 3){$level = '과장';}
    else if($level == 4){$level = '차장';}
    else if($level == 5){$level = '부장';}
    else if($level == 6){$level = '임원';}
	
	$array_board_name = array('중고장터', '맛집리뷰', '번개모임');
	$board_name = $array_board_name[$btype] ;
	
	$price="";
	$distance="";
	$location="";
	
	if ($btype==0){
	    $sql = mq("select * from TABLE_MARKET where board_seqno='".$bno."'"); /* 받아온 idx값을 선택 */
	    $market = $sql ->fetch_array();
	    $price = $market['price'];
	}
	else if($btype==1){
	    $sql = mq("select * from TABLE_FOOD where board_seqno='".$bno."'"); /* 받아온 idx값을 선택 */
	    $food = $sql -> fetch_array();
	    $distance = $food['distance'];
	    $loc_name = $food['loc_name'];
	    $location = $food['location'];
	    $likes = $food['likes'];
	}
	else if($btype==2){
	    $sql = mq("select * from TABLE_THUNDER where board_seqno='".$bno."'"); /* 받아온 idx값을 선택 */
	    $thunder = $sql -> fetch_array();
	    $distance = $thunder['distance'];
	    $loc_name = $thunder['loc_name'];
	    $location = $thunder['location'];
	    $mymenu = $thunder['menu'];
	}
	$rows=[];
	$comment = mq("select TABLE_COMMENT.*,TABLE_USER.name from TABLE_COMMENT join TABLE_USER where TABLE_COMMENT.board_seqno='".$bno."' and TABLE_USER.id=TABLE_COMMENT.author order by TABLE_COMMENT.seqno desc"); /* 코멘트 부르기 */
	while($row = mysqli_fetch_array($comment)){
        array_push($rows, $row) ;
        
    }

    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="euc-kr">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/detail.css">
    
    <title>상세페이지</title>
</head>
<body id="hidden">
    <body onload="refreshreplylist()">
    <header>
        <div class="goback" onclick="goback()">
            <img src="img/goback.png">
        </div>
        <div class="headerText"><?php echo $board_name ?></div>
        <form name="form_goback" action="index.php" method="post">
		    <input type="hidden" name="btype" value="">
		</form>
    </header>
    <div id="container">
        <table align="center">
        <?php if ($btype != '2') { ?>
            <tr>
                <td align="center">
                    <img src="<?php echo $image['imgsrc'] ;?>" width="100%" class="img-responsive" alt="Responsive image">
                </td>    
            </tr>
        <?php } ?>
            <tr>
                <th>
                    <div id="title" class="contents_important" align="left">
                        <?php echo $board['title'];
                        if($c_author == $author) { ?>
                        <div id="delete" class="author_button" onclick="confirm('정말 삭제할까요?') ? document.forms['form_delete'].submit() : false ;">삭제</div>
                        <div id="modify" class="author_button" onclick="document.forms['form_modify'].submit() ;">수정</div>
                        <form method="post" name="form_modify" action="write_new_board.php">
                            <input type="hidden" value="<?php echo $bno ;?>" name="seqno">
                            <input type="hidden" value="<?php echo $btype ;?>" name="btype">
                        </form>
                        <form method="post" name="form_delete" action="delete_board.php">
                            <input type="hidden" value="<?php echo $bno ;?>" name="seqno"> 
                            <input type="hidden" value="<?php echo $btype ;?>" name="btype">
                        </form>
                        <?php } ?>
                    </div>
                </th>
            </tr>
            <tr>
                <td>
                    <span id="author">by <?php echo $board['author'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="special" class="contents_important" align="left">
                        <?php if ($btype == '1') { ?>
                            <div id="likes"><!-- set_stars() --></div>
                        <?php } ?>
                        <?php if ($btype == '2') { ?>
                            <div id="menu">
                                <?php echo $mymenu; ?>
                            </div>
                        <?php } ?>
                        <?php if ($btype == '0') {
                            echo number_format($price) ;
                        } ?>
                    </div>
                </td>
            </tr>
            <?php if ($btype != '0') { ?>
            <tr>
                <td>
                    <div id="location" class="contents_important"><!-- set_location() --></div>
                </td>
            </tr>                
            <?php } ?>
            
        </table>
        
        <table align="center" style="background-color:#f3f3f3;">
            <tr>
                <td>
                    <div id="contents">
                        <?php echo $board['content']; ?>
                    </div>
                </td>
            </tr>
            <?php if ($btype != '0') { ?>
            <tr>
                <td align="center">
                    <div id="map" style="width:90%; padding-top:90%; position:relative;"></div>
                    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3e966a5b660119401470417835ee05ee&libraries=services,clusterer,drawing"></script>
                	<script>
                    	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
                    		    mapOption = {
                                center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
                                level: 4 // 지도의 확대 레벨
                            };  
                        
                        // 지도를 생성합니다    
                        var map = new kakao.maps.Map(mapContainer, mapOption); 
                        var markers = [];
                        // 주소-좌표 변환 객체를 생성합니다
                        var geocoder = new kakao.maps.services.Geocoder();
                        
                        var homeaddress = '경기 성남시 분당구 분당로 55';
                        var coords,coords2;
                        var linePath = new Array();
                        geocoder.addressSearch(homeaddress, function(result, status) {
                        
                            // 정상적으로 검색이 완료됐으면 
                             if (status === kakao.maps.services.Status.OK) {
                                coords2 = new kakao.maps.LatLng(result[0].y, result[0].x);
                                linePath[0]= result[0].y;
                                linePath[1]= result[0].x;
                                addMarker(coords2, 0);
                            } 
                        });
                        
                        var address='<?php echo $location; ?>';
                        // 주소로 좌표를 검색합니다
                        geocoder.addressSearch(address, function(result, status) {
                            // 정상적으로 검색이 완료됐으면 
                             if (status === kakao.maps.services.Status.OK) {
                                coords = new kakao.maps.LatLng(result[0].y, result[0].x);
                                addMarker(coords, 1);
                                linePath[2]= result[0].y;
                                linePath[3]= result[0].x;
                                
                                 
                                setMarkers(map);
                                var finalPath= [
                                    new kakao.maps.LatLng(linePath[0], linePath[1]),
                                    new kakao.maps.LatLng(linePath[2], linePath[3])
                                    ];
               
                                var clickLine = new kakao.maps.Polyline({
                                    path: finalPath, // 선을 구성하는 좌표 배열입니다 클릭한 위치를 넣어줍니다
                                });
                
                                var distance = Math.round(clickLine.getLength());
                                if(distance < 1000){ distance = distance.toString() + " m"; }
        			            else{distance = (distance * 0.001).toFixed(3).toString() + " km";}
                                map.setCenter(coords);  
                                
                            } 
                        });
                       
                        // 마커를 생성하고 지도위에 표시하는 함수입니다
                        function addMarker(position, check) {
                            
                            // 마커를 생성합니다
                            var marker = new kakao.maps.Marker({
                                position: position
                            });
                            if(check==0){
                             // 인포윈도우로 장소에 대한 설명을 표시합니다
                            var infowindow = new kakao.maps.InfoWindow({
                                content: '<div style="width:150px;text-align:center;padding:6px 0;">다날 퍼스트타워</div>'
                            });
                            }
                            else{
                                <?php if($btype == '1'){?>
                                    var loc_name = '<?php echo $food['loc_name']; ?>';
                                <?php } ?>
                                
                                <?php if($btype == '2'){?>
                                    var loc_name = '<?php echo $thunder['loc_name']; ?>';
                                <?php } ?>
                                
                                var infowindow = new kakao.maps.InfoWindow({
                                    content: '<div style="width:150px;text-align:center;padding:6px 0;">'+loc_name+'</div>'
                                });    
                            }
                                infowindow.open(map, marker);
                            // 마커가 지도 위에 표시되도록 설정합니다
                            marker.setMap(map);
                            
                            // 생성된 마커를 배열에 추가합니다
                            markers.push(marker);
                        }
                        
                        // 배열에 추가된 마커들을 지도에 표시하거나 삭제하는 함수입니다
                        function setMarkers(map) {
                            for (var i = 0; i < markers.length; i++) {
                                markers[i].setMap(map);
                            }            
                        }
                        
                        
                	</script>
            <?php } ?>
                </td>    
            </tr>
        </table>
        <div id="bottom_row">
            <div class="box1" onclick="goTop()">
                <img src="img/up.svg" style= "vertical-align:middle;"> 맨 위로</a>
            </div>
            <div class="box2" onclick="goComment()">
                <img id="functional" src="img/comment.png" style= "vertical-align:middle;"> 댓글</a>
            </div>
            
        </div>
      
		<div id="commentbox"> <!--댓글 입력 창-->
			<div>
			    댓글<br>
				<textarea id="reply_content" class="form-control"></textarea>
				<div onclick="javascript:comment()">등록</a>
			</div>

        <table id="replytable"><!-- 댓글 리스트 박스 -->
            <tbody id="replybox">
            </tbody>
        </table>
		
		</div>
		
</body>
</html>
<script type="text/javascript">

     var doubleSubmitFlag = false;
    function doubleSubmitCheck(){
        if(doubleSubmitFlag){
            return doubleSubmitFlag;
        }else{
            doubleSubmitFlag = true;
            return false;
        }
    }


    //호스팅어 로고 지우기
    var div_list = document.getElementsByTagName("div") ;
    for (var a of div_list) {
        if(a.style['z-index']>999999) {
            a.parentNode.removeChild(a) ;
        }
    }
        
    var commentrow = <?php echo json_encode($rows) ; ?> ;
    var c_author = '<?php echo $c_author ?>';
    var btype = <?php echo $btype ?>;
    function showreply()
        {
            var elem = document.getElementById('commentbox');
            if(elem.style.display=="none")
                elem.style.display="block";
            else
                elem.style.display="none";
        }
    function refreshreplylist()
    {   
        var table =document.getElementById('replytable');
        var type= '<?php echo $btype ?>';
        
        var elem = document.getElementById('replybox');
        rephtml="";
        for(i in commentrow)
        {
            if(c_author == commentrow[i]['author']){
                var func = "deletereply("+commentrow[i]['seqno']+")";
                rephtml+='<tr class="exline"><td>'+commentrow[i]['name']+'</td><td>'+commentrow[i]['create_time']+'</td><td><button onclick="'+func+'" class="btn btn-sm btn-link delete text-dark">삭제</button></td></tr><tr><td colspan=3>'+commentrow[i]['content']+'<hr></td></tr>';
            }
            else{
                rephtml+='<tr class="exline"><td>'+commentrow[i]['name']+" "+commentrow[i]['create_time']+'</td></tr><tr><td colspan=3>'+commentrow[i]['content']+'<hr></td></tr>';    
            }
        }
        elem.innerHTML=rephtml;
    }
    function deletereply(i){
        var form = document.createElement("form");
        var bno = '<?php echo $bno ?>';
        form.setAttribute('method', 'post');
	    form.setAttribute('action', "delete_comment.php");
	    document.charset = "utf-8";
	    var hiddenField = document.createElement('input');
	    hiddenField.setAttribute('type', 'hidden');
	    hiddenField.setAttribute('name', "comment_seqno");
	    hiddenField.setAttribute('value', i);
	    
	    form.appendChild(hiddenField);
	    
	    hiddenField = document.createElement('input');
	    hiddenField.setAttribute('type', 'hidden');
	    hiddenField.setAttribute('name', "seqno");
	    hiddenField.setAttribute('value', bno);
	    
	    form.appendChild(hiddenField);
	    
	    document.body.appendChild(form);
	    form.submit();
	    
    }
    function comment(){
       
        var c_content = document.getElementById('reply_content');
        if(c_content.value=='')
        {
            alert('댓글 내용을 작성하세요.');
            return;
        }
        if(doubleSubmitCheck()) return;

        var boardno = '<?php echo $bno ?>';
        var params = new Array();
        params.push(boardno,c_author,c_content.value);
        var form = document.createElement("form");
        
        form.setAttribute('method', 'post');
	    form.setAttribute('action', "write_comment.php");
	    document.charset = "utf-8";
	    for ( var key in params) {

		var hiddenField = document.createElement('input');

		hiddenField.setAttribute('type', 'hidden');
        if(key==0){
		    hiddenField.setAttribute('name', "board_seqno");
        }
        else if(key==1){
            hiddenField.setAttribute('name', "author"); 
        }
        else if(key==2){
            hiddenField.setAttribute('name', "content");
        }
		hiddenField.setAttribute('value', params[key]);

		form.appendChild(hiddenField);

	}
	    document.body.appendChild(form);
        
	    form.submit();
    }
    
    function goback(){
        document.forms['form_goback'].btype.value=btype ;
	    document.forms['form_goback'].submit();
	}
    
    var header = document.getElementsByClassName("headerText")[0] ;
    switch(btype){
		case 0: header.setAttribute('class', 'headerText title_j') ;
				break;
		case 1: header.setAttribute('class', 'headerText title_m') ;
				break;
		case 2: header.setAttribute('class', 'headerText title_b') ;
				break;
	}
	<?php if($btype==1){ ?>
	    var likes = <?php echo $likes ?> ;
	    var stars = "" ;
	    for(var i=0 ; i<parseInt(likes) ; i++ ) {
	        stars += "★" ;
	    }
	    if(parseInt(likes) < likes){
	        stars += "☆" ;
	    }
	    document.getElementById("likes").innerHTML = stars ;
	<?php } ?>
	
	<?php if($btype!=0){ ?>
	    var address = "<?php echo $location ; ?>" ;
	    //길이 길면 자르기
	    address += "(<?php echo $distance ; ?>m)" ;
	    document.getElementById("location").innerHTML = address;
    <?php } ?>
    
    var offsetTop = document.querySelector("header").offsetTop;
    var offsetComment = document.querySelector("#commentbox").offsetTop;
    function goTop(){
        window.scrollTo({top:offsetTop, behavior:'smooth'}) ;
    }
    
    function goComment(){
        window.scrollTo({top:offsetComment, behavior:'smooth'}) ;
    }
</script>
