<?php
class MySQLDbClass {

	/*
	function isConnectDb($db) {
		$conn = @mysql_connect($db['host'].':'.$db['port'],$db['user'],$db['pass']);
		//Set encoding
		mysql_query("SET CHARSET utf8");
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		if(!$conn){
			die('Not connected :' . mysql_error());
			exit;
		}
		$selc = mysql_select_db($db['name'],$conn); // 접근한 계정으로 사용할 수 있는 DB 선택
		// 연결 식별자($conn) 는 생략 가능하며, 생략시 가장 최근에 설정한 연결 식별자가 사용된다.
		return $selc ? $conn : false;
	} // */

	//DB-UID데이터
	function getUidData($table,$uid){
		return $this->getDbData($table,'uid='.(int)$uid,'*');
	}

	// DB Query Cutom 함수
	function getDbData($table,$where,$column){
		global $dbconn;
		$result = mysql_query('select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		$row = mysql_fetch_array($result);
		return $row;
	}

	// DB Query result 함수
	function getDbresult($table,$where,$column){
		global $dbconn;
		$result = mysql_query('select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		return $result;
	}

	//DB데이터 필드 개수
	function getDbColums($table,$where,$column){
		global $dbconn;
		$result = mysql_query('select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		return mysql_num_fields($result);
	}

	//DB데이터 레코드 총 개수
	function getDbRows($table,$where){
		global $dbconn;
		$sql = 'select count(*) from '.$table.($where?' where '.$this->getSqlFilter($where):'');
		//echo $sql;
		$rows = mysql_fetch_array(mysql_query($sql));
		return $rows[0] ? $rows[0] : 0;
	}

	//DB데이터 ARRAY -> 테이블에 출력할 데이터 배열
	// order by : 정렬 순서, rowsPage : 화면에 출력할 개수, curPage : 현재 페이지
	function getDbArray($table,$where,$flddata,$orderby,$rowsPage,$curPage){
		global $dbconn;
		$curPage = $curPage ? $curPage : 1; // 현재 페이지가 없으면 1로 설정
		$sql = 'select '.$flddata.' from '.$table.($where?' where '.$this->getSqlFilter($where):'').($orderby?' order by '.$orderby:'').($rowsPage?' limit '.(($curPage-1)*$rowsPage).', '.$rowsPage:'');
		//echo $sql;
		$result = mysql_query($sql);
		return $result;
	}

	//DB select
	function getDbSelect($table,$where,$column){
		global $dbconn;
		$row = mysql_query('select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''),$dbconn);
		return $row;
	}

	//DB삽입
	function getDbInsert($table,$key,$val){
		global $dbconn;
		mysql_query("insert into ".$table." (".$key.")values(".$val.")");
	}

	//DB업데이트
	function getDbUpdate($table,$set,$where){
		global $dbconn;
		mysql_query('set names utf8');
		mysql_query('set sql_mode=\'\'');
		mysql_query("update ".$table." set ".$set.($where?' where '.$this->getSqlFilter($where):''));
	}

	//DB삭제
	function getDbDelete($table,$where){
		global $dbconn;
		mysql_query("delete from ".$table.($where?' where '.$this->getSqlFilter($where):''),$dbconn);
	}

	//SQL필터링
	function getSqlFilter($sql){
		return $sql;
	}

}//end dbClass

class MySQLiDbClass {
	/*
	function isConnectDb($db)
	{
		$conn = mysqli_connect($db['host'],$db['user'],$db['pass'],$db['name'],$db['port']);
		mysqli_set_charset($conn, "utf8");  // DB설정이 잘못되어 euc-kr 로 되어 있으면 문제가 됨
		if (mysqli_connect_errno()) {
		   printf("Connect failed: %s\n", mysqli_connect_error());
		   exit();
		} else {
		  return $conn;
		}
	}
	*/

	//DB-UID데이터
	function getUidData($table,$uid)
	{
		return $this->getDbData($table,'uid='.(int)$uid,'*');
	}

	// DB Query Cutom 함수
	function getDbData($table,$where,$column) {
		global $dbconn;
		$result = mysqli_query($dbconn,'select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		$row = mysqli_fetch_array($result);
		return $row;
	}

	// DB Query result 함수
	function getDbresult($table,$where,$column) {
		global $dbconn;
		$result = mysqli_query($dbconn,'select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		return $result;
	}

	//DB데이터 ARRAY -> 테이블에 출력할 데이터 배열
	function getDbArray($table,$where,$flddata,$orderby,$rowsPage,$curPage){
		global $dbconn;
		$sql = 'select '.$flddata.' from '.$table.($where?' where '.$this->getSqlFilter($where):'').($orderby?' order by '.$orderby:'').($rowsPage?' limit '.(($curPage-1)*$rowsPage).', '.$rowsPage:'');
		if($result = mysqli_query($dbconn,$sql)){
			return $result;
		}
	}

	//DB데이터 레코드 총 개수
	function getDbRows($table,$where){
		global $dbconn;
		$sql = 'select count(*) from '.$table.($where?' where '.$this->getSqlFilter($where):'');
		if($result = mysqli_query($dbconn,$sql)){
			$rows = mysqli_fetch_row($result);
			return $rows[0] ? $rows[0] : 0;
		}
	}

	//DB삽입
	function getDbInsert($table,$key,$val){
		global $dbconn;
		mysqli_query($dbconn,"insert into ".$table." (".$key.")values(".$val.")");
	}

	//DB업데이트
	function getDbUpdate($table,$set,$where){
		global $dbconn;
		mysqli_query('set names utf8');
		mysqli_query('set sql_mode=\'\'');
		mysqli_query($dbconn,"update ".$table." set ".$set.($where?' where '.$this->getSqlFilter($where):''));
	}

	//DB삭제
	function getDbDelete($table,$where)	{
		global $dbconn;
		mysqli_query($dbconn,"delete from ".$table.($where?' where '.$this->getSqlFilter($where):''));
	}

	//SQL필터링
	function getSqlFilter($sql)
	{
		return $sql;
	}

}//end dbClass

?>