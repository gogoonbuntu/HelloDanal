

CREATE TABLE `board` (
  `idx` int NOT NULL,
  `type` int NOT NULL,
  `title` varchar(40) NOT NULL,
  `author` varchar(20) NOT NULL,
  `hier_high` int DEFAULT NULL,
  `hier_low` int DEFAULT NULL,
  `imgsrc` varchar(200) NOT NULL,
  `viewcount` int NOT NULL DEFAULT '0',
  `content` varchar(1000) NOT NULL,
  `sell` int NOT NULL DEFAULT '0',
  `likes` int NOT NULL DEFAULT '0',
  `level` int NOT NULL,
  `finish` int NOT NULL DEFAULT '0',
  `starttime` date NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `type`, `title`, `author`, `hier_high`, `hier_low`, `imgsrc`, `viewcount`, `content`, `sell`, `likes`, `level`, `finish`, `starttime`, `location`) VALUES
(1, 0, '오끼참치', 'asdf', NULL, NULL, 'https://t1.daumcdn.net/cfile/tistory/230C4545527658431A', 3, '오끼오끼! 오끼나와!', 0, 4, 1, 0, '2020-09-02', '123'),
(2, 0, '짬뽕24시', 'asdf', NULL, NULL, 'https://lh3.googleusercontent.com/proxy/Br64wItiUPoID6foL5JejeYFxBjJW-CLrOaonw2gVHnjJTXgFrJWw1_d1mDMwo94qKiFuOYO1h2RpfM7_EtbmkEjX_gvLSvXvYHj4nUz9OZ1siMwQnBbMJbW2mn63Sw3Ege7PTRo7urHlnw10wlZK6r91kOLJ6qP', 0, '진짜 24시간 먹여도 맛있는 짬뽕', 0, 0, 1, 0, '2020-09-25', '12312');

-- --------------------------------------------------------

--
-- 테이블 구조 `danal_id`
--

CREATE TABLE `danal_id` (
  `idx` int NOT NULL,
  `id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

--
-- 테이블의 덤프 데이터 `danal_id`
--

INSERT INTO `danal_id` (`idx`, `id`) VALUES
(1, 'tmddud333'),
(2, 'jinyi1187'),
(3, 'men1692'),
(4, 'bp');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `id` varchar(20) NOT NULL,
  `level` varchar(8) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `pswd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`id`, `level`, `phonenumber`, `pswd`) VALUES
('bp', '1', '01099998888', 'asdf'),
('11', '1', '11', '11'),
('bp', '2', '01099998888', 'adsf'),
('bp', '2', '01099998888', 'asdf'),
('bp', '2', '01099998888', '');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `danal_id`
--
ALTER TABLE `danal_id`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `danal_id`
--
ALTER TABLE `danal_id`
  MODIFY `idx` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

