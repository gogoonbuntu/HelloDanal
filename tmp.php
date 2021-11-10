<?php
    $type = $_POST['btype'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/input.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <?php
        if($type == 0){
            echo "<a href='index.php'><img src='img/back.png' width='40' height='40' alt='My Image'></a><h1>중고장터 새글쓰기</h1>";
            echo "<title>중고장터 새글쓰기</title>";
        }
        else if($type == 1){
            echo "<a href='index.php'><img src='img/back.png' width='40' height='40' alt='My Image'></a><h1>맛집 새글쓰기</h1>";
            echo "<title>맛집 새글쓰기</title>";
        }
        else if($type == 2){
            echo "<a href='index.php'><img src='img/back.png' width='40' height='40' alt='My Image'></a><h1>번개모임 새글쓰기</h1>";
            echo "<title>번개모임 새글쓰기</title>";
        }
    ?>
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
        
        #wrapper{margin:0 auto;}
       
        .firstCol{
            width:20%;
        }
        
        .secondCol{
            width:80%;
        }
       
     </style>
</head>
<body>
    <form action="write_new_board_process.php" method="post" name="boardForm" onsubmit="return validateForm(<?php echo $type?>)" enctype="multipart/form-data" required>
    <input type="hidden" name="btype" value=<?php echo $type?>>
    <div id="wrapper">
        <table>
        <thead>
        <tr>
            <td class="firstCol">제목 : </td>
            <td class="secondCol"><input type="text" placeholder="제목을 입력하세요." name="title"></td>
        </tr>
            <?php
            if ($type == 0){ //중고장터?>
              <tr>
                <td class="firstCol">가격 : </td>
                <td class="secondCol"><input type="text" placeholder="가격을 입력하세요." name="price"></td>
              </tr>
              <tr>
                  <td class="firstCol">번호 표기</td><td><input type="checkbox" name="check" id="check" value="check"/></td>
              </tr>
              <td class="firstCol"></td>
              <td class="secondCol"><input type='file' id='uploadfile' name='uploadfile[]' multiple />
              </td>
            </thead>
            </table>
           <?php } ?>

           <?php
           if ($type == 1){ //맛집정보 ?>
            <tr>
                <td class="firstCol">장소 : </td>
                <td class="secondCol"><input type="text" name="location" id="location" placeholder="장소를 입력하세요"><button type='button' id="loc_search" style='width:60px; height:32px;'onclick='addressSearch(document.getElementById("location").value)'>검색</button></td>
            </tr>
            <tr>
                <td class="firstCol">도로명 : </td><td class="secondCol"><label style="border: 1px;" name="road_addr" id="road_addr"></label></td>
            </tr>
            <tr>
                <td class="firstCol">거리 : </td><td class="secondCol"><label style="border: 1px;" name="distance" id="distance"></label></td>
            </tr>
            </thead>
            </table>
            <div id="map" style="width:100%;height:350px;margin: 0 auto;"></div>
           <?php }?>

           <?php
           if ($type == 2){ //번개모임 ?>
            <tr>
              <td class="firstCol">시작시간:</td>
              <td><input type="datetime-local" id="start_time" name="start_time" value="2020-09-28" min="2020-09-28" max="2020-10-31"/> 
              </td> 
            </tr>
            <script>
                var today = new Date();
                document.getElementById("datetime-local").setAttribute("min", today);
            </script>
            <tr>
                <td class="firstCol"><label>열람제한</label></td>
                <td class="secondCol">
                    <label for="hier_high">상한</label>
                    <select name="hier_high" id="hier_high" > <!--onchange="hier_all()">-->
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
              <td class="firstCol">장소 : </td>
              <td class="secondCol"><input type="text" name="location" id="location" placeholder="장소를 입력하세요"><button type='button' id="loc_search" style='width:60px; height:32px;'onclick='addressSearch(document.getElementById("location").value)'>검색</button></td> 
            </tr>
            <tr>
                <td class="firstCol">도로명 : </td><td class="secondCol"><label style="border: 1px;" name="road_addr" id="road_addr"></label></td>
            </tr>
            <tr>
                <td class="firstCol">거리 : </td><td class="secondCol"><label style="border: 1px;" name="distance" id="distance"></label></td>
            </tr>
            </thead>
            </table>
            <div id="map" style="width:100%;height:350px;margin: 0 auto;"></div>
           <?php }?>
            
        
        <textarea style="resize:none; width:100%; " rows="10" placeholder="내용을 입력하세요." name="content"></textarea>    
    </div>
    <button type="submit" style="float:right;">글쓰기</button>
    </form>
    
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=42d23ea334fd5aa74b554bee027e2bf8&libraries=services"></script>
<script>

//모든 입력란 입력되었는지 여부 확인
function validateForm(type){
    var check_li = new Array();
    check_li[0] = document.forms["boardForm"]["title"].value;
    if(type == 0){
        check_li[1] = document.forms["boardForm"]["price"].value;
        //checkbox, file은 따로 확인
        check_li[2] = document.forms["boardForm"]["content"].value;
        
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
        check_li[1] = document.forms["boardForm"]["location"].value;
        check_li[2] = document.forms["boardForm"]["road_addr"].value;
        check_li[3] = document.forms["boardForm"]["distance"].value;
        check_li[4] = document.forms["boardForm"]["content"].value;
    }
    
    else if(type == 2){
        check_li[1] = document.forms["boardForm"]["start_time"].value;
        check_li[2] = document.forms["boardForm"]["hier_high"].value;
        check_li[3] = document.forms["boardForm"]["hier_low"].value;
        check_li[4] = document.forms["boardForm"]["location"].value;
        check_li[5] = document.forms["boardForm"]["road_addr"].value;
        check_li[6] = document.forms["boardForm"]["distance"].value;
        check_li[7] = document.forms["boardForm"]["content"].value;
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
   $('#location').keypress(function(e){
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
            if(distance < 1000){ distance = distance.toString() + " m"; }
            else{distance = (distance * 0.001).toFixed(3).toString() + " km";}
            
            
            //도로명 주소 저장
            road_addr = result[0].road_address.address_name;
            
            //도로명, 거리 표시
            document.getElementById('road_addr').innerHTML = road_addr;
            document.getElementById('distance').innerHTML = distance;
            
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


function hier_all(){
    // if (document.getElementById('hier_high').value == 0) {
    //     document.getElementById('hier_low').value = 0 ;
    //     document.getElementById('hier_low').style.display = 'none' ;
    //     document.getElementById('hier_low_label').style.display = 'none' ;
    // } else {
    //     document.getElementById('hier_low').style.display = '' ;
    //     document.getElementById('hier_low_label').style.display = '' ;
    // }
}
// console.log(document.getElementById('hier_high').value);
</script>
</body>
</html>