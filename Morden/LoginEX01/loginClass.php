<?php
class LoginClass extends DBController {
	// AES 암호화
	function AES_encrypt($plain_text){
		global $key, $iv;
		$encryptedMessage = openssl_encrypt($plain_text, "aes-256-cbc", $key, true, $iv);
		return base64_encode($encryptedMessage);
	}

	// AES 복호화
	function AES_decrypt($base64_text){
		global $key, $iv;
		$decryptedMessage = openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $key, true, $iv);
		return $decryptedMessage;
	}

	// 로그아웃
	function getLogout(){
		session_start();
		session_destroy();
	}

	// 필터링 체크
	function SQLFiltering($inputValue){
		// 해킹 공격을 대비하기 위한 코드
		$inputValue = preg_replace("/[\s\t\'\;\"\=\--]+/","", $inputValue); // 공백이나 탭 제거, 특수문자 제거
		$inputValue = htmlentities($inputValue); // <script>documnet.cookie();</script> 공격 방지, 한글인식 불가
		if(preg_match('/[\/\\\\]/', $inputValue)) return 0;
		if(preg_match('/(and|null|where|limit)/i', $inputValue)) return 0;
		return $inputValue;
	}

    // 회원 정보 신규 입력
    public function storeUser($userID, $userNM, $passwd, $mobileNO) {
        $hash = $this->hashSSHA($passwd);
        $encrypted_password = $hash['encrypted']; // encrypted password
        $salt = $hash['salt']; // salt
        $regdate = date("YmdHis");

        $sql = "INSERT INTO members(userID,userNM,passwd,salt,regdate)
        VALUES('$userID','$userNM','$encrypted_password','$salt','$regdate')";
        if($result = mysqli_query($this->db,$sql)) { //성공
            $user = $this->getUser($userID, $passwd);
			//echo '<pre>';print_r($user);echo '</pre>';
            $rs = $this->storeUserDetail($user['uid'],$userNM,$userID,$mobileNO);
            if($rs == 1){
                return $user;
            } else {
                return -1;
            }
        } else {
            return -1; // 0
        }
    }

    // 회원 세부 정보 입력
    public function storeUserDetail($relateduid,$userNM,$email,$mobileNO){
        //$regdate = date("YmdHis");
        $sql ="INSERT INTO member_data(relateduid,userNM,email,mobileNO) ";
        $sql.="VALUES('$relateduid','$userNM','$email','$mobileNO')";
        if($result = mysqli_query($this->db,$sql)){
            return 1;
        } else {
			die('sql: '.$sql.' <br />error: ' . mysqli_error($this->db));
            return 0;
        }
    }

    // 회원 정보 반환
    public function getUser($userID, $password){
		$userID = mysqli_real_escape_string($this->db,$userID);
		$password = mysqli_real_escape_string($this->db,$password);
        $sql = "select * from members where userID='".$userID."'";
        $result = mysqli_query($this->db, $sql);
        if($user = mysqli_fetch_array($result)){
            $salt = $user['salt'];
            $encrypted_password = $user['passwd'];
            $hash = $this->checkhashSSHA($salt, $password);
            if ($encrypted_password == $hash) {
                return $user;
            }
        } else {
            return NULL;
        }
    }

    // 회원 가입 여부 체크
    public function isUserExisted($u) {
		if(!isset($u) || empty($u)) {
			return '-1';
		} else {
			$sql ="SELECT count(userID) from members WHERE userID='".$u."'";
			$result = mysqli_query($this->db, $sql);
			if($row = mysqli_fetch_array($result)){
				return $row[0]; // 미가입이면 0 반환, 가입이면 1 반환
			} else {
				return -1;
			}
		}
    }

    // 안드로이드/아이폰 로그인 체크
    public function LoginUserChk($userID,$password,$deviceID){
        if(empty($userID) || empty($password)){
            return 0;
        } else {
            $user = $this->getUser($userID, $password);
            if($user['idx']>0){
                // 장치 일련번호 체크
                if($user['phoneSE'] == NULL){ // 수정 필요
                    // 신규 장비번호 입력(최초 로그인)
                    $this->LoginUserEquipInput($userID,$deviceID);
                    return $user['idx'];
                } else {
                    if($user['phoneSE'] === $deviceID){
                        return 1; // 일련번호 일치
                    } else {
                        return -1; //일련번호 불일치
                    }
                }
            } else {
                return 0; //계정오류
            }
        }

    }

	//장치번호 업데이트
	function LoginUserEquipInput($userID,$deviceID){
        if(strlen($deviceID)>0 && is_numeric($deviceID)){ // 안드로이드폰
            $ostype = 2;
        } else if(strlen($deviceID)>30){ // 아이폰
            $ostype = 1;
        } else { // 기타
            $ostype = 0;
        }

		$userID = preg_replace("/[\s\t\'\;\"\=\--]+/","", $userID); // 공백이나 탭 제거(사용자 실수 방지)
		$sql="update members set ";
		$sql.="phoneSE='".$deviceID."' and  OStype='".$ostype."' ";
		$sql.="where userID= '".$userID."'";
		if($result=mysqli_query($this->db,$sql)){
			return 1;
		} else {
			return 0;
		}
	}//end function LoginUserEquipInput

    public function hashSSHA($password) {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    public function checkhashSSHA($salt, $password) {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }

	// 로그인 경고메시지
	function popup($msg) {
		echo "<script>alert('".$msg."');history.go(-1);</script>";
	}

	// 인증이 성공한 상태에서 직접 접속을 시도하는 외부 접속으로부터 보호
	function checkReferer($url) {
		$referer = $_SERVER['HTTP_REFERER'];
		$res = strpos($referer,$url);
		return $res == 0 ? false : true;
	}


	function getDiviceType()	{
		if(strpos($_SERVER['HTTP_USER_AGENT'],"iPhone") > 0) {
			$mtype=1;
		} else if(strpos($_SERVER['HTTP_USER_AGENT'],"Android") > 0) {
			$mtype=2;
		} else if(strpos($_SERVER['HTTP_USER_AGENT'],"iPad") > 0) {
			$mtype=1;
		} else {
			$mtype=3; // PC/Laptop 접속
		}
		return $mtype;
	}

	// 접속 Device
	function user_agent(){
		$iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		if($iPad||$iPhone||$iPod){
			return 'ios';
		} else if($android){
			return 'android';
		} else {
			return 'windows';
		}
	}

	function getOS() {
		$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);
		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}
		return $os_platform;
	}

	function getBrowser() {
		$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
		$browser        =   "Unknown Browser";
		$browser_array  =   array(
								'/msie/i'       =>  'Internet Explorer',
								'/firefox/i'    =>  'Firefox',
								'/safari/i'     =>  'Safari',
								'/chrome/i'     =>  'Chrome',
								'/edge/i'       =>  'Edge',
								'/opera/i'      =>  'Opera',
								'/netscape/i'   =>  'Netscape',
								'/maxthon/i'    =>  'Maxthon',
								'/konqueror/i'  =>  'Konqueror',
								'/mobile/i'     =>  'Mobile Browser'
							);
		foreach ($browser_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}
		}
		return $browser;
	}

}//end class LoginClass

?>