<?php
if (!isset($_SESSION)) {
    session_start();
}

// 파일을 직접 실행하면 동작되지 않도록 하기 위해서
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	@extract($_POST); // $_POST['loginID'] 라고 쓰지 않고, $loginID 라고 써도 인식되게 함
	//echo '<pre>';print_r($_POST);echo '</pre>'; // 전송받은 배열을 확인하고 싶을 때 사용
	if(isset($userID) && !empty($userID) && isset($password) && !empty($password)) {
		include_once 'dbController.php';
		require_once 'loginClass.php';
		$c = new LoginClass();
		if ($c->isUserExisted($userID)==1) {
			echo '{"result":"0"}'; // echo json_encode(array('result' => '0')); 과 동일
		} else {
			$mobileNO = preg_replace("/[^0-9]/", "", $mobileNO); //전화번호 숫자만 남기고 제거
			// 회원 등록
			$user = $c->storeUser($userID, $userNM, $password, $mobileNO);
			if ($user) {// 회원 등록 성공 ==> 세션 만들기
				$_SESSION['userID'] = $user['userID'];
				$_SESSION['userNM'] = $user['userNM'];
				$_SESSION['admin'] = $user['admin'];
				echo json_encode(array('result' => '1'));
			} else {
				// 회원 등록 실패
				echo json_encode(array('result' => '-1'));
			}
		}
	}else {// 입력받은 데이터에 문제가 있을 경우
		echo json_encode(array('result' => '-2'));
	}
}
?>