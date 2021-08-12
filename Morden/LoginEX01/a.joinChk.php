<?php
// 파일을 직접 실행하면 동작되지 않도록 하기 위해서
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	@extract($_POST); // $_POST['loginID'] 라고 쓰지 않고, $loginID 라고 써도 인식되게 함
	// db 접속파일 include 및 정상 로그인 여부 체크하는 함수 실행후 결과 반환처리 하면 된다.
	include_once 'dbController.php';
	require_once 'loginClass.php';
	$d = new DBController();
	$c = new LoginClass();
	$rs = $c->isUserExisted($userID);
	if($rs == '0'){
		echo '{"result":"1"}';
	} else {
		echo '{"result":"0"}'; // echo json_encode(array('result' => '0')); 과 동일
	}
}
?>