<?php
// 파일을 직접 실행하는 비정상적 동작을 방지 하기 위한 목적
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	if(!isset($_SESSION)) {
		session_start();
	}
    @extract($_POST);
    if(isset($curpw) && !empty($curpw) && isset($newpw) && !empty($newpw)) {
		require_once 'phpclass/config.php';
		require_once 'phpclass/dbconnect.php';
		require_once 'phpclass/loginClass.php';
		$c = new LoginClass();

		//키워드 확인
		if(!isset($_POST['keyword'])){
			$array = array(
				'status' => 'fail',
				'message' => 'no keyword',
			);
			echo json_encode($array);
			exit;
		}

		$keyword=$c->AES_decrypt($_POST['keyword']);
		//키워드 일치 확인
		if(strcmp($keyword,$mykey)<>0){
			$array = array(
				'status' => 'keyfail',
				'message' => '서버와 단말의 KEY가 일치하지 않습니다',
			);
			echo json_encode($array);
			exit;
		}

		$userID = $c->AES_decrypt($_POST['userID']);
		$curpw = $c->AES_decrypt($_POST['curpw']);
		$newpw = $c->AES_decrypt($_POST['newpw']);

		header("Cache-Control: no-cache, must-revalidate");
		header("Content-type: application/json; charset=UTF-8");

		// 현재 비밀번호 확인
		if($c->getPassword($userID,$curpw) == 0){
			$array = array(
				'status' => 'fail',
				'message' => '현재 비밀번호가 맞지 않습니다.',
			);
			echo json_encode($array);
			exit;
		}

		// 패스워드 변경 정보 반영
		$hash = $c->hashSSHA($newpw);
        $encrypted_pw = $hash['encrypted']; // encrypted password
        $salt = $hash['salt']; // salt
		$rs = $c->setPassword($encrypted_pw,$salt,$userID);

		if ($rs > 0) {
			$array = array(
				'status' => 'success',
				'message' => '',
			);
        } else {
			$array = array(
				'status' => 'fail',
				'message' => '업데이트에 실패했습니다.',
			);
        }
	} else {
			$array = array(
				'status' => 'fail',
				'message' => '정보가 정확하지 않습니다.',
			);
	}
	echo json_encode($array);
}

?>
