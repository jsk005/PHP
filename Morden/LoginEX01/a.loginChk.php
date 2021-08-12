<?php
if (!isset($_SESSION)) {
    session_start();
}
// 파일을 직접 실행하는 비정상적 동작을 방지 하기 위한 목적
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	@extract($_POST); // $_POST['loginID'] 라고 쓰지 않고, $loginID 라고 써도 인식되게 함
	if(isset($userID) && !empty($userID) && isset($password) && !empty($password)) {
		include_once 'dbController.php';
		require_once 'loginClass.php';
		$c = new LoginClass();
		$user = $c->getUser($userID, $password);
		if ($user != false) {
			$_SESSION['userID'] = $user['userID'];
			$_SESSION['userNM'] = $user['userNM'];
			$_SESSION['admin'] = $user['admin'];
			echo json_encode(array('result' => '1'));
		} else {
			echo json_encode(array('result' => '0'));
		}
	}else {// 입력받은 데이터에 문제가 있을 경우
		echo json_encode(array('result' => '-2'));
	}
} else { // 비정상적인 접속인 경우
	echo 0; // a.loginChk.php 파일을 직접 실행할 경우에는 화면에 0을 찍어준다.
	exit;
}
?>