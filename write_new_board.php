<?php

    require_once('dbconn.php') ;
    $type = $_POST['btype'] ;
    $sql = "select seqno, id, name, level, year from TABLE_USER";
    $result = mq($sql) ;
    $rows = [] ;
    $bno = 0;
    $if_modify = false;
    
    if(isset($_POST['seqno'])){
        $if_modify = true ;
        $bno = $_POST['seqno'] ;
        $board_name = array('MARKET', 'FOOD', 'THUNDER') ;
        $sql_modify = "select TABLE_BOARD.*, TABLE_".$board_name[$type].".* from TABLE_BOARD join TABLE_".$board_name[$type]." on TABLE_BOARD.seqno = $bno and TABLE_".$board_name[$type].".board_seqno = $bno" ;
        $result_modify = mysqli_fetch_array(mq($sql_modify)) ;
    }
    
    while($row = mysqli_fetch_array($result)) {
        array_push($rows, $row) ;
    }
    
    $level = $_COOKIE['level'] ;
    $author = $_COOKIE['user_id'] ;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/write.css">
    <style>
        /* PC , 테블릿 가로 (해상도 768px ~ 1023px)*/
        @media all and (min-width:768px) and (max-width:1023px) { /*스타일입력*/}
        
        /* 테블릿 세로 (해상도 768px ~ 1023px)*/
        @media all and (min-width:768px) and (max-width:1023px) { /*스타일입력*/}
        
        /* 모바일 가로, 테블릿 세로 (해상도 480px ~ 767px)*/
        @media all and (min-width:480px) and (max-width:767px) { /*스타일입력*/}
        
        /* 모바일 가로, 테블릿 세로 (해상도 ~ 479px)*/
        @media all and (max-width:479px) { /*스타일입력*/}
        
        /* PC (해상도 1024px)*/
        @media all and (min-width:1024px) { /*스타일입력*/}
        
        /* 테블릿 가로, 테블릿 세로 (해상도 768px ~ 1023px)*/
        @media all and (min-width:768px) and (max-width:1023px) { /*스타일입력*/}
        
        /* 모바일 가로, 모바일 세로 (해상도 480px ~ 767px)*/
        @media all and (max-width:767px) { /*스타일입력*/}
        
        #wrapper{
            margin:0 auto;
            margin-top:10px;
        }
       
        .firstCol{
            width:20%;
        }
        
        .secondCol{
            width:80%;
        }
        body {
            margin:0px;
        }
       
     </style>
</head>
<body>
    <header>
        <div class="goback" onclick="goback()">
            <img src="img/goback.png">
        </div>
        <div class="headerText"> </div>
        <form name="form_goback" action="index.php" method="post">
		    <input type="hidden" name="btype" value="">
		</form>
    </header>
    <form action="write_new_board_process.php" method="post" name="boardForm" enctype="multipart/form-data" required>
    <input type="hidden" name="">
    <input type="hidden" name="btype" value=<?php echo $type?>>
    <div id="wrapper">
        <table>
        <thead>
        <tr>
            <td colspan=2>
                <input type="text" placeholder="제목을 입력하세요." name="title"
                 value="<?php echo $if_modify ? $result_modify['title'] : null;?>">
            </td>
        </tr>
            <?php
            if ($type == 0){ //중고장터?>
              <tr>
                <td class="firstCol">가격 : </td>
                <td class="secondCol">
                    <input type="text" placeholder="가격을 입력하세요." name="price" 
                           value="<?php echo $if_modify ? $result_modify['price'] : null ;?>">
                </td>
              </tr>
              <tr>
                  <td class="firstCol">번호 표기</td><td><input type="checkbox" name="check" id="check" value="check"/></td>
              </tr>
              <tr>
                  <td class="firstCol"></td>
                  <td class="secondCol">
                        <?php if(!$if_modify) {
                                echo "<input type='file' id='uploadfile' name='uploadfile[]' multiple />" ;
                                } else {
                                echo "이미지는 수정할 수 없습니다." ; } 
                        ?>
                  </td>
              </tr>
            
           <?php } ?>

           <?php
           if ($type == 1){ 
           //맛집정보 ?>
            <tr>
                <td>
                    <input type="text" value="서현" id="search_head" style="color:#777;">
                </td>
                <td>
                    <input type="text" id="search" style="width:70%;" placeholder="장소를 입력하세요"
                           value="<?php echo $if_modify ? $result_modify['location'] : null ;?>">
                    <button type='button' id="loc_search" style='width:60px; height:32px;'onclick='addressSearch(document.getElementById("search").value)'>
                        검색
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="hidden" name="loc_name" id="loc_name">
                    <label style="border: 1px;" name="road_addr" id="road_addr"></label>
                    <input type="hidden" name="location">(
                    <label style="border: 1px;" name="distance" id="distance"></label>
                    <input type="hidden" name="distance">)
                </td>
            </tr>
            <tr>
                <td class="firstCol">맛집 사진</td>
                <td class="secondCol">
                    <?php if(!$if_modify) {
                                echo "<input type='file' id='uploadfile' name='uploadfile[]' multiple />" ;
                                } else {
                                echo "이미지는 수정할 수 없습니다." ; } 
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="text" name="likes" placeholder="평점 :5점 만점" maxlength=3
                           value="<?php echo $if_modify ? $result_modify['likes'] : null;?>">>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <div id="map" style="width:100%;height:350px;margin: 0 auto;"></div>
                </td>
            </tr>
           <?php }?>

           <?php
           if ($type == 2){ 
            //번개모임 ?>
            <tr>
                <td colspan=2>
                    <input type="text" placeholder="식사메뉴" name="menu" id="menu"
                           value="<?php echo $if_modify ? $result_modify['menu'] : null ;?>">
                </td>
            </tr>
            <tr>
              <td class="firstCol">시작시간:</td>
              <td><input type="datetime-local" id="start_time" name="start_time" value="2020-09-28" min="2020-09-28" max="2020-10-31"/>
              </td> 
            </tr>
            <script>
                var today = new Date();
                document.getElementById("start_time").setAttribute("min", today);
            </script>
            <tr>
                <td colspan=2 align="center">
                    <button type="button" onclick="document.querySelector('#popup_back').classList.remove('hide');load_member();" style="width:80%; height:30px; margin:5px 0 ;">초대인원 설정</button>
                    <div id="invite_show" style="width:100%">초대인원 없음</div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" value="서현" id="search_head" style="color:#777;">
                </td>
                <td>
                    <input type="text" id="search" style="width:70%;" placeholder="장소를 입력하세요"
                           value="<?php
                                    if($if_modify){
                                        $strtok = explode(" ", $result_modify['location']) ;
                                        for ($i = 3 ; $i < count($strtok) ; $i++){
                                            echo $strtok[$i]." " ;
                                        }
                                    }
                                    
                                ?>">
                    <button type='button' id="loc_search" style='width:60px; height:32px;'onclick='addressSearch(document.getElementById("search").value)'> 검색                    </button>
                </td> 
            </tr>
            <tr>
                <td colspan=2>
                    <input type="hidden" name="loc_name" id="loc_name">
                    <label style="border: 1px;" name="road_addr" id="road_addr"></label>
                    <input type="hidden" name="location">(
                    <label style="border: 1px;" name="distance" id="distance"></label>
                    <input type="hidden" name="distance">)
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <div id="map" style="width:80%;height:350px;margin: 0 auto;"></div>
                </td>
                <input type="hidden" name="invite" id="input_invite">
            </tr>
            <?php } ?>
            <tr>
                <td colspan=2>
                    <textarea style="resize:none; width:99%;" placeholder="내용을 입력하세요." name="content"
                             ><?php echo $if_modify ? $result_modify['content'] : null ;?></textarea>
                </td>
            </tr>
                
            </thead>
            </table>
            <?php 
				$type==2 ? include 'invite.php' : 0 ;
				include 'loading.php' ;
			?>
    </div>
    
    <input type="hidden" name="level">
    <input type="hidden" name="author">
    
    <button type="button" onclick="final_submit()" style="width:100%; height:50px;">글쓰기</button>
    </form>
    
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=42d23ea334fd5aa74b554bee027e2bf8&libraries=services"></script>
<script>
    var boardForm = document.forms['boardForm'] ;
    boardForm['level'].value = "<?php echo $level ;?>" ;
    boardForm['author'].value = "<?php echo $author ;?>" ;
    btype = <?php echo $type ; ?> ;
    
    var header = document.getElementsByClassName("headerText")[0] ;
    switch(btype){
		case 0: header.setAttribute('class', 'headerText title_j') ;
		        header.innerHTML="중고장터 새글쓰기" ;
				break;
		case 1: header.setAttribute('class', 'headerText title_m') ;
		        header.innerHTML="맛집리뷰 새글쓰기" ;
				break;
		case 2: header.setAttribute('class', 'headerText title_b') ;
	            header.innerHTML="번개모임 새글쓰기" ;
				break;
	}
    
	function final_submit(){
		if(validateForm()) {
            goLoading() ;
			boardForm.submit() ;
		}
	}

    function goback(){
        document.forms['form_goback'].btype.value=btype ;
	    document.forms['form_goback'].submit();
	}
    
    //모든 입력란 입력되었는지 여부 확인
    function validateForm(type = btype){
        var check_li = new Array();
        check_li[0] = boardForm["title"].value;
        if(type == 0){
            check_li[1] = boardForm["price"].value;
            //checkbox, file은 따로 확인
            check_li[2] = boardForm["content"].value;
            
            if(document.getElementById("check").checked){
                check_li[3] = "c_true";
            }    
            else{
                check_li[3] = "c_false";
            }
            console.log($('#uploadfile')[0].files);
            if($('#uploadfile')[0].files.length == 0){
                check_li[4] = "f_false";
            }
            else{
                check_li[4] = "f_true";
            }
            
        }
        
        else if(type == 1){
            check_li[1] = boardForm["location"].value;
            check_li[2] = boardForm["distance"].value;
            check_li[3] = boardForm["content"].value;
        }
        
        else if(type == 2){
            check_li[1] = boardForm["start_time"].value;
            check_li[2] = boardForm["invite"].value;
            check_li[3] = boardForm["menu"].value;
            check_li[4] = boardForm["location"].value;
            check_li[5] = boardForm["distance"].value;
            check_li[6] = boardForm["content"].value;
        }
        console.log(check_li);
        
        for(var i = 0; i < check_li.length; i++){
            if(check_li[i] == ""){
                alert("모든 입력란을 입력해주세요!");
                return false;
            }
            else if(check_li[i] == "f_false"){
                alert("사진을 첨부하여 주세요!");
                return false;
            }
            
        }
        return true;
    }
    
    //장소 검색할때 엔터시에 작동
    $(document).ready(function(){
       $('#search').keypress(function(e){
          if(e.keyCode==13)
            $('#loc_search').click();
       });
    });
    
    // 마커를 클릭하면 장소명을 표출할 인포윈도우 입니다
    var infowindow = new kakao.maps.InfoWindow({
        zIndex:1
    });
    
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };  
    
    // 지도를 생성합니다    
    var map = new kakao.maps.Map(mapContainer, mapOption); 
    
    // 장소 검색 객체를 생성합니다
    var ps = new kakao.maps.services.Places(); 
    
    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new kakao.maps.services.Geocoder();
    
    // 키워드로 장소를 검색합니다
    function addressSearch(keyword){
        keyword = document.getElementById('search_head').value+keyword ;
        ps.keywordSearch(keyword, placesSearchCB); 
    } 
    
                                 
    
    
    // 키워드 검색 완료 시 호출되는 콜백함수 입니다
    function placesSearchCB (data, status, pagination) {
        if (status === kakao.maps.services.Status.OK) {
    
            // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
            // LatLngBounds 객체에 좌표를 추가합니다
            var bounds = new kakao.maps.LatLngBounds();
    
            for (var i=0; i<data.length; i++) {
                displayMarker(data[i]);    
                bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
            }       
    
            // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
            map.setBounds(bounds);
        } 
    }
    
    //다날 퍼스트 타워 위치
    var homeaddress = '경기 성남시 분당구 분당로 55';
    var home_X; //다날 x 좌표
    var home_Y; //다날 y 좌표
    var dest_X; //목적지 x 좌표
    var dest_Y; //목적지 y 좌표
    
    geocoder.addressSearch(homeaddress, function(result, status) {
        // 정상적으로 검색이 완료됐으면 
        if (status === kakao.maps.services.Status.OK) {
           home_X = result[0].x;
           home_Y = result[0].y;
        } 
    });
    
    
    
    // 지도에 마커를 표시하는 함수입니다
    function displayMarker(place) {
        
        var coords = new kakao.maps.LatLng(place.y, place.x)
        
        dest_X = place.x;
        dest_Y = place.y;
        
        // 마커를 생성하고 지도에 표시합니다
        var marker = new kakao.maps.Marker({
            map: map,
            position: coords 
        });
        
        var road_addr = ''
        var loc_name = ''
        
        // 마커에 클릭이벤트를 등록합니다
        kakao.maps.event.addListener(marker, 'click', function() {
            searchDetailAddrFromCoords(coords, function(result, status) {
            if (status === kakao.maps.services.Status.OK) {
                var detailAddr = '<div class="title">' + place.place_name + '</div>';
                    detailAddr += !!result[0].road_address ? '<div class="body">도로명주소 : ' + result[0].road_address.address_name + '</div>' : '';
                // detailAddr += '<div>지번 주소 : ' + result[0].address.address_name + '</div>';
                
                var content = '<div class="bAddr">' +
                                detailAddr + 
                            '</div>';
                            
                            
                var finalPath = [
                    new kakao.maps.LatLng(home_Y, home_X),
                    new kakao.maps.LatLng(dest_Y, dest_X)
                
                ];
                
                var clickLine = new kakao.maps.Polyline({
                   path: finalPath
                });
                
                //목적지까지의 거리 계산
                var distance = Math.round(clickLine.getLength());
                var pure_distance = distance ;
                if(distance < 1000){ distance = distance.toString() + " m"; }
                else{distance = (distance * 0.001).toFixed(3).toString() + " km";}
                
                //장소명 저장
                loc_name = place.place_name;
                
                //도로명 주소 저장
                road_addr = result[0].road_address.address_name;
                
                //도로명, 거리 표시
                document.getElementById('road_addr').innerHTML = road_addr ;
                document.getElementById('distance').innerHTML = distance ;
                boardForm['loc_name'].value = loc_name;
                boardForm['location'].value = road_addr ;
                boardForm['distance'].value = pure_distance ;
                
                // 마커를 클릭한 위치에 표시합니다 
                marker.setPosition(coords);
                marker.setMap(map);
    
                // 인포윈도우에 클릭한 위치에 대한 법정동 상세 주소정보를 표시합니다
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }   
        });
        
        });
        
        
        
        
    }
    
    function searchDetailAddrFromCoords(coords, callback) {
        // 좌표로 법정동 상세 주소 정보를 요청합니다
        geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
    }
    
    function no_logo() {
        //호스팅어 로고 지우기
        var div_list = document.getElementsByTagName("div") ;
        for (var a of div_list) {
            if(a.style['z-index']>999999) {
                a.parentNode.removeChild(a) ;
            }
        }
    }
    window.onload = function(){
        no_logo();
        setTimeout(no_logo(), 100) ;
        setTimeout(no_logo(), 500) ;
    } ;
    
</script>
</body>
</html>