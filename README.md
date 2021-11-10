# HelloDanal

files.000webhost.com

db4free.net

https://danal2009.000webhostapp.com/index.html

==============================================
해야 할 일들 쉣더뻑

TABLE_BOARD 공통
seqno
title
content
type
author
level
viewcount
create_time

TABLE_MARKET 중고장터
seqno
price
status

TABLE_FOOD 맛집리뷰 <- board
seqno
likes
distance
location

TABLE_THUNDER 번개모임
seqno
start_time
distance
location
menu
invite varchar(200)

TABLE_IMAGE
board_seqno
seqno
imgsrc


TABLE_USER
seqno
id
level
phone
pw
+name

cookie
user_id
level



php 파일 속 변수 다 바꾸기

** 맨윗단에 sql 문 다 빼놓고 **
** post 값 받기 다 뺴놓고    **
정승영 : index.php detail.php login.php member_check_phonenum.php signup.php signupProcess.php
ㄴinvite 작업,  board -> TABLE_FOOD - 정승영
진영인 : {write_process.php write_new_board.php new.php board_write.php} mypage.php
ㄴ 전화번호 노출 (새글쓰기), php 경로 방어
최병민 : login_ok.php member_find_pw_update.php member_find.php
ㄴ 테이블 생성, 가데이터 넣기 - 최병민 중고장터, 번개 4개씩, 이메일 인증



/*
TABLE_COMMENT
seqno
board_seqno
content
author
create_time
*/
//코멘트
