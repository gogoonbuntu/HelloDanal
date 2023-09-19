<?php
    include "config/dbconn.php" ;
    include "config/define.php" ;
    
    $sql_market = "SELECT TABLE_BOARD.*,TABLE_MARKET.price,TABLE_MARKET.status,TABLE_IMAGE.imgsrc FROM TABLE_BOARD join TABLE_MARKET join TABLE_IMAGE on TABLE_MARKET.board_seqno  = TABLE_BOARD.seqno and TABLE_BOARD.seqno=TABLE_IMAGE.board_seqno;" ;
    $sql_food = "SELECT a.*, (SELECT COUNT(*) AS cnt FROM TABLE_COMMENT WHERE TABLE_COMMENT.board_seqno = a.seqno) as Totalcomment FROM (SELECT TABLE_BOARD.*,TABLE_FOOD.likes,TABLE_FOOD.location,TABLE_FOOD.distance,TABLE_IMAGE.imgsrc FROM TABLE_BOARD inner join TABLE_FOOD inner join TABLE_IMAGE on TABLE_FOOD.board_seqno = TABLE_BOARD.seqno and TABLE_BOARD.seqno=TABLE_IMAGE.board_seqno) a;" ;
    $sql_thunder = "SELECT TABLE_BOARD.*,TABLE_THUNDER.start_time,TABLE_THUNDER.distance,TABLE_THUNDER.distance,TABLE_THUNDER.location,TABLE_THUNDER.menu,TABLE_THUNDER.invite FROM TABLE_BOARD join TABLE_THUNDER on TABLE_THUNDER.board_seqno = TABLE_BOARD.seqno and TABLE_THUNDER.start_time > '".date('Y-m-d H:i:s')."' ;" ;
    
    $result_market = mq($sql_market) ;
    $result_food = mq($sql_food) ;
    $result_thunder = mq($sql_thunder) ;
    $rows = [] ;
    
    while($row = mysqli_fetch_array($result_market)){
        array_push($rows, $row) ;
    }
    while($row = mysqli_fetch_array($result_food)){
        array_push($rows, $row) ;
    }
    while($row = mysqli_fetch_array($result_thunder)){
        array_push($rows, $row) ;
    }
    
    if ( !isset($_COOKIE['user_id']) ) {
	    echo "<script>"
	        ."alert('잘못된 접근입니다');"
	        ."location.href = 'memberController/login.php' ;"
	        ."</script>" ;
        die('잘못된 접근입니다');
	    exit;
	}
	
	$user_id = $_COOKIE['user_id'] ;
	
	if ( !isset($_COOKIE['user_valid']) ) {
	    $sql_update_user = "select seqno, level from TABLE_USER where id='$user_id'" ;
	    $result_info = mysqli_fetch_array(mq($sql_update_user)) ;
	    $user_seqno = $result_info[0] ;
	    $user_level = $result_info[1] ;
	    ?>
	    <script>
	        function setCookieM( c_name,value,expireminute ) {
            var exdate = new Date();
            exdate.setMinutes(exdate.getMinutes()+expireminute);
            document.cookie = c_name +  "=" + escape(value)
                                               + ((expireminute==null) ? "" : ";expires="+exdate.toUTCString());
            }
            setCookieM('user_valid', 'true', 1);
            setCookieM('level', <?php echo $user_level ; ?>, 60 * 24 * 30) ;
            setCookieM('myidx', <?php echo $user_seqno ; ?>, 60 * 24 * 30) ;
	    </script>
	    <?php
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	    ?> 
	    <script> btype = <?php echo $_POST['btype'] ; ?> ; </script>
	    <?php
	} else {
	    ?>
	    <script> btype = 0 ; </script>
	    <?php
	}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta charset="euc-kr">
    <meta name="viewport" content="width=device-width">
    <title>Hello Danal !</title>
    <link rel="stylesheet" href="./css/common_style.css">
	<link rel="stylesheet" href="./css/board.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  </head>
  <body>

	<header class="title_b">번개모임</header>
	
	<form action="detail.php" name="toDetail" method="post">
	    <input type="hidden" name="input_idx">
    </form>
	    
	<div id="bodyWrapper">
		<table>
			<tbody>
			</tbody>
		</table>
	</div>
	
	<form action="write_new_board.php" name="new" method="post">
	    <input type=hidden name="btype" value="">
    	<button type="button" class="new_b" onclick="new_submit();">
    		+
    	</button>
	</form>
	
	<footer>
		<div class="naviMenu" onclick="typeChange(0);">
			<img src="img/shopping.png"><br>중고장터
		</div>
		<div class="naviMenu" onclick="typeChange(1);">
			<img src="img/food.png"><br>맛집리뷰
		</div>
		<div class="naviMenu" onclick="typeChange(2);">
			<img src="img/thunder.png"><br>번개모임
		</div>
		<div class="naviMenu" onclick="typeChange(3);">
			<img src="img/profile.png"><br>내 페이지
		</div>
	</footer>

</html>

<script>
    /* 
     * 0: 중고장터
     * 1: 맛집리뷰
     * 2: 번개모임
     * 3: 내 페이지
     */
    boardrow = <?php echo json_encode($rows) ; ?> ;
    myidx = <?php
        if(!isset($_COOKIE['myidx'])){
            echo $result_info[0] ;
        } else {
            echo $_COOKIE['myidx'] ;
        } ;?> ;
    user_id = '<?php echo $user_id ; ?>' ;
    
    function typeChange(a){
        btype = a;
        if(a==3){
            $.ajax({
        		url: "mypage.php",
        		type: "post",
        		data: {},
        		success: function(data) {
        			$("tbody").html(data);
        		},
        		error: function(err) {
        			alert("err");
        		}
        	});    
        } else {
            loadPage(a)
        }
    	switch(a){
    		case 0: $("header").attr('class', 'title_j').html('중고장터');
    		        $("button").attr('class', 'title_j');
    				$(".naviMenu").attr('class','naviMenu');
    		        $(".naviMenu")[0].classList.add('selected');
    		        //$(".special").style.color;
    				break;
    		case 1: $("header").attr('class', 'title_m').html('맛집리뷰');
    		        $("button").attr('class', 'title_m');
    				$(".naviMenu").attr('class','naviMenu');
    		        $(".naviMenu")[1].classList.add('selected');
    				break;
    		case 2: $("header").attr('class', 'title_b').html('번개모임');
    		        $("button").attr('class', 'title_b');
    				$(".naviMenu").attr('class','naviMenu');
    		        $(".naviMenu")[2].classList.add('selected');
    				break;
    		case 3: $("header").attr('class', 'title_p').html('내 페이지');
    		        $("button").attr('class', 'none');
    				$(".naviMenu").attr('class','naviMenu');
    		        $(".naviMenu")[3].classList.add('selected');
    				break;
    	}
    	
    }
    
    typeChange(btype);
	
	function searchGo(){
	    keyWord = document.getElementsByClassName("searchInput")[0].value ;
	    if(keyWord=='') {
	        alert('검색어를 입력하세요') ;
	    } else {
	        loadPage(btype, keyWord) ;
	    }
	    
	}
	
	function loadPage(btype, keyWord) {
	    
	    var no_contents = true ;
	    
	    searchHTML = `<tr>
                        <td>
                            <form class="searchDiv" align="center">
                                <input type="text" class="searchInput" name="search" placeholder="키워드 검색"></input>
                                <img class="searchButton" src="./img/search.png" onclick="searchGo()">
                            </form>
                        </td>
                    </tr>`;
	    tbody = document.getElementsByTagName("tbody")[0] ;
	    tbodyContents = searchHTML ;
	    
	    /* 타입에 맞는 게시글만 필터링 */
	    temp2_boardrow = [] ;
	    for (q in boardrow) {
	        if (boardrow[q]['type']==btype) {
	            temp2_boardrow.push(boardrow[q]);
	        }
	    }
	    
	    /* 검색어 관련글만 필터링*/
	    temp_boardrow = [] ;
	    if (keyWord==undefined) {
	        temp_boardrow = temp2_boardrow ;
	    } else {
	        for ( j in temp2_boardrow) {
	            if(temp2_boardrow[j]['title'].indexOf(keyWord)!=-1){
	                temp_boardrow.push(temp2_boardrow[j]) ;
	            }
	        }
	    }
	
        for ( i in temp_boardrow ){
            if(btype==0){
                no_contents= false ;
                tbodyContents += `
                        <tr>
                            <td onclick="go_to_detail(this)" id="td` + temp_boardrow[i]['seqno'] + `">
                                <div class = "thumbnail"><img src="`+ temp_boardrow[i]['imgsrc'] +`"></div>
                                <div class = "title">`+ temp_boardrow[i]['title'] + `</div>
                                <div class = "content">`+ temp_boardrow[i]['content'] + `</div>
                                <div class = "special">`+ set_price(temp_boardrow[i]['price']) + `<span class="plain">원</span></div>
                            </td>
                        </tr><hr>
                ` ;
            } else if(btype==1) {
                no_contents= false ;
                tbodyContents += `
                        <tr>
                            <td onclick="go_to_detail(this)" id="td` + temp_boardrow[i]['seqno'] + `">
                                <div class = "thumbnail"><img src="`+ temp_boardrow[i]['imgsrc'] +`"></div>
                                <div class = "title">`+ set_title(temp_boardrow[i]['title']) + " ★x"
                                + parseFloat(temp_boardrow[i]['likes']).toFixed(1) + `</div>
                                <div class = "content">`+ temp_boardrow[i]['content'] + `</div>
                                <div class = "special">`+ '<img src="img/board_view.svg" width=20px; height=20px; style="vertical-align:middle;" >' +set_address(temp_boardrow[i]['viewcount'])
                                + `<span class="plain"><img src="img/board_comment.svg" width=20px; height=20px; style="margin-left:10px; vertical-align:middle; " >` + temp_boardrow[i]['Totalcomment'] + `</span></div>
                            </td>
                        </tr><hr>
                ` ; 
            } else {
                for (var k = 0, strtok = temp_boardrow[i]['invite'].split(","), length = strtok.length ; 
                        k < length ; k++){
                    if (strtok[k]==myidx.toString() || temp_boardrow[i]['author']==user_id) {
                        no_contents = false ;
                        tbodyContents += `
                        <tr>
                            <td onclick="go_to_detail(this)" id="td` + temp_boardrow[i]['seqno'] + `">
                                <div class = "title">`+ temp_boardrow[i]['title'] + `</div>
                                <div class = "content">`+ temp_boardrow[i]['content'] + `</div>
                                <div class = "special">`+ temp_boardrow[i]['menu'] + `</div>
                            </td>
                        </tr><hr>
                        ` ;
                        break;
                    }      
                }
            }
        }
        if(no_contents) {
            tbodyContents += `
                <tr>
                    <td style="text-align:center; height:300px;">
                    <img src="./img/danaly back.png" style="height: 150px; opacity:0.7;">
                    <br><br>
                    <span style="font-size:20px; color: #555;">게시글이 없습니다.</span>
                    </td>
                </tr>
            ` ; 
        }
        
        tbody.innerHTML = tbodyContents ;
        
        var class_special = document.getElementsByClassName("special") ;
        for( var i = 0 ; i < class_special.length ; i++ ) {
            class_special[i].classList.add("btype"+btype);            
        }
	}
	
    function set_price(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    function set_address(str){
        var space = window.innerWidth - 120 - 60;
        space = Math.round(space / 22);
        return str.substr(-space);
    }
	
	function set_title(str){
	    var space = window.innerWidth - 120 - 65;
	    space = Math.round(space / 22);
	    
	    return space > str.length ? str : str.substr(0, space-1) + ".." ;
	}
	
	function go_to_detail(objthis) {
	    document.toDetail.input_idx.value = objthis.id.substr(2,);
	    document.toDetail.submit();
	}
	
	function new_submit(){
	    document.forms['new'].btype.value = btype;
	    document.forms['new'].submit();
	}
	
 
</script>
