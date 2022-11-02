create table TABLE_BOARD (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	create_time DATETIME NOT NULL,
	title VARCHAR(40) NOT NULL,
	type TINYINT(1) NOT NULL,
	content VARCHAR(500) NOT NULL,
	author VARCHAR(20) NOT NULL,
	level TINYINT(1) NOT NULL
);

create table TABLE_COMMENT (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	create_time DATETIME NOT NULL,
	board_seqno INT(11) NOT NULL,
	content VARCHAR(100) NOT NULL,
	author VARCHAR(20) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);


create table TABLE_USER (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	create_time DATETIME NOT NULL,
	id VARCHAR(20) NOT NULL,
	pswd VARCHAR(20) NOT NULL,
	name VARCHAR(20) NOT NULL,
	level TINYINT(1) NOT NULL,
	year TINYINT(1) NOT NULL,
	phone INT(11) NOT NULL,
	board_seqno INT(11) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);

create table TABLE_THUNDER (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	board_seqno INT(11) NOT NULL,
	invite VARCHAR(20) NOT NULL, 
	distance INT(6) NOT NULL,
	location VARCHAR(40) NOT NULL,
	menu VARCHAR(20) NOT NULL,
	start_time DATETIME NOT NULL,
	loc_name VARCHAR(20) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);

create table TABLE_FOOD (
	seqno INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	board_seqno INT(11) NOT NULL,
	likes INT(6) NOT NULL,
	distance INT(6) NOT NULL,
	location VARCHAR(40) NOT NULL,
	loc_name VARCHAR(20) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);

create table TABLE_MARKET (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	board_seqno INT(11) NOT NULL,
	price INT(11) NOT NULL,
	num_ok TINYINT(1) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);

create table TABLE_IMAGE (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	create_time DATETIME NOT NULL,
	board_seqno INT(11) NOT NULL,
	imgsrc VARCHAR(30) NOT NULL,
	CONSTRAINT FOREIGN KEY(board_seqno) REFERENCES TABLE_BOARD(seqno)
);

create table TABLE_AUTH (
	seqno INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id VARCHAR(20) NOT NULL,
	authkey VARCHAR(10),
	indate DATETIME NOT NULL
);
