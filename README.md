# HelloDanal

files.000webhost.com

db4free.net

https://danal2009.000webhostapp.com/index.html

==============================================
�ؾ� �� �ϵ� �x����

TABLE_BOARD ����
seqno
title
content
type
author
level
viewcount
create_time

TABLE_MARKET �߰�����
seqno
price
status

TABLE_FOOD �������� <- board
seqno
likes
distance
location

TABLE_THUNDER ��������
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



php ���� �� ���� �� �ٲٱ�

** �����ܿ� sql �� �� ������ **
** post �� �ޱ� �� ������    **
���¿� : index.php detail.php login.php member_check_phonenum.php signup.php signupProcess.php
��invite �۾�,  board -> TABLE_FOOD - ���¿�
������ : {write_process.php write_new_board.php new.php board_write.php} mypage.php
�� ��ȭ��ȣ ���� (���۾���), php ��� ���
�ֺ��� : login_ok.php member_find_pw_update.php member_find.php
�� ���̺� ����, �������� �ֱ� - �ֺ��� �߰�����, ���� 4����, �̸��� ����



/*
TABLE_COMMENT
seqno
board_seqno
content
author
create_time
*/
//�ڸ�Ʈ
