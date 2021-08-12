<?php
class DBController {
	private $host = 'localhost';
	private $database = 'test';
	private $userid = 'root';
	private $password = 'autoset';
    protected $db;

    public function __construct() {
        $this->db = $this->connectDB();
    }

	function __destruct(){
        mysqli_close($this->connectDB());
		//mysqli_close($this->db);
    }

    private function connectDB() {
		$dbconn = mysqli_connect($this->host, $this->userid, $this->password, $this->database);
		mysqli_set_charset($dbconn, "utf8"); // DB설정이 잘못되어 euc-kr 로 되어 있으면 문제가 됨
		if (mysqli_connect_errno()) {
		   printf("Connect failed: %s\n", mysqli_connect_error());
		   exit();
		} else {
		  return $dbconn;
		}
    }


	//DB-UID데이터
	function getUidData($table,$uid){
		return $this->getDbData($table,'uid='.(int)$uid,'*');
	}

	// DB Query Cutom 함수
	function getDbData($table,$where,$column) {
		$result = mysqli_query($this->db,'select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		$row = mysqli_fetch_array($result);
		return $row;
	}

	// DB Query result 함수
	function getDbresult($table,$where,$column) {
		$result = mysqli_query($this->db,'select '.$column.' from '.$table.($where?' where '.$this->getSqlFilter($where):''));
		return $result;
	}

	//DB데이터 ARRAY -> 테이블에 출력할 데이터 배열
	function getDbArray($table,$where,$flddata,$orderby,$rowsPage,$curPage){
		$sql = 'select '.$flddata.' from '.$table.($where?' where '.$this->getSqlFilter($where):'').($orderby?' order by '.$orderby:'').($rowsPage?' limit '.(($curPage-1)*$rowsPage).', '.$rowsPage:'');
		if($result = mysqli_query($this->db,$sql)){
			return $result;
		}
	}

	//DB데이터 레코드 총 개수
	function getDbRows($table,$where){
		$sql = 'select count(*) from '.$table.($where?' where '.$this->getSqlFilter($where):'');
		if($result = mysqli_query($this->db,$sql)){
			$rows = mysqli_fetch_row($result);
			return $rows[0] ? $rows[0] : 0;
		}
	}

	//DB삽입
	function getDbInsert($table,$key,$val){
		mysqli_query($this->db,"insert into ".$table." (".$key.")values(".$val.")");
	}

	//DB업데이트
	function getDbUpdate($table,$set,$where){
		mysqli_query('set names utf8');
		mysqli_query('set sql_mode=\'\'');
		mysqli_query($this->db,"update ".$table." set ".$set.($where?' where '.$this->getSqlFilter($where):''));
	}

	//DB삭제
	function getDbDelete($table,$where)	{
		mysqli_query($this->db,"delete from ".$table.($where?' where '.$this->getSqlFilter($where):''));
	}

	//SQL필터링
	function getSqlFilter($sql){
		return $sql;
	}
}//end dbClass

?>