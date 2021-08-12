--
-- 데이터베이스: `test`
--
--
-- 테이블 구조 `members`
-- 도움이 되셨다면 https://link2me.tistory.com 에 방문해서 광고 클릭 해주세요.

CREATE TABLE IF NOT EXISTS `members` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(50) NOT NULL DEFAULT '',
  `userNM` varchar(20) NOT NULL,
  `passwd` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `admin` tinyint(2) NOT NULL DEFAULT '0',
  `phoneSE` varchar(80) DEFAULT NULL,
  `OStype` tinyint(2) NOT NULL DEFAULT '0',
  `regdate` char(14) NOT NULL DEFAULT '',
  `curdate` char(14) DEFAULT NULL COMMENT '최근접속',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블 구조 `member_data`
--

CREATE TABLE IF NOT EXISTS `member_data` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `relateduid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `userNM` varchar(60) NOT NULL COMMENT '이름',
  `email` varchar(60) NOT NULL COMMENT '메일',
  `mobileNO` varchar(20) NOT NULL COMMENT '휴대폰번호',
  `officeNO` varchar(20) DEFAULT NULL COMMENT '사무실번호',
  `homeNO` varchar(20) DEFAULT NULL COMMENT '집전화',
  `home_addr1` varchar(100) DEFAULT NULL COMMENT '집주소',
  `home_addr2` varchar(50) DEFAULT NULL COMMENT '세부 집주소',
  `office_addr1` varchar(100) DEFAULT NULL COMMENT '사무실주소',
  `office_addr2` varchar(50) DEFAULT NULL COMMENT '세부사무실주소',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '성별',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '포인트',
  `smart` tinyint(2) NOT NULL DEFAULT '0',
  `modifydate` char(14) NOT NULL DEFAULT '' COMMENT '수정일자',
  PRIMARY KEY (`uid`),
  KEY `relateduid` (`relateduid`),
  KEY `mobileNO` (`mobileNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

