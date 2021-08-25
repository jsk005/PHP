--
-- 데이터베이스: `poll`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `idx` int(5) NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(45) NOT NULL,
  `candidate_position` varchar(45) NOT NULL,
  `candidate_cvotes` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 테이블의 덤프 데이터 `candidates`
--

INSERT INTO `candidates` (`idx`, `candidate_name`, `candidate_position`, `candidate_cvotes`) VALUES
(1, '김세민', '총학생회', 1),
(2, '김연홍', '총학생회', 0),
(3, '서유찬', '총학생회', 0),
(6, '남수빈', '총학생회', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobileNO` varchar(14) DEFAULT NULL,
  `voter_id` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`member_id`, `admin`, `name`, `email`, `mobileNO`, `voter_id`, `password`) VALUES
(1, 1, '관리자', 'admin@gmail.com', '', '50034571', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 0, '홍길동', 'jsk005@gmail.com', '', '19964714075000192', '5ca8b65ecca189bcbb9f68f05fd561e0');

-- --------------------------------------------------------

--
-- 테이블 구조 `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` char(8) NOT NULL,
  `enddate` char(8) NOT NULL,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `poll`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `idx` int(5) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(45) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `positions`
--

INSERT INTO `positions` (`idx`, `position_name`) VALUES
(2, '총학생회');
