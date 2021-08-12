<?php
date_default_timezone_set('ASIA/SEOUL');

$ip_addr="220.85.225.145"; // public IP address
$key = 'TBbi95971076jantkey991ggis1ukims';//암호화 통신을 위한 키
$mykey='jgsysyksr897213579'.date('Ymd');

// SESSION 설정
ini_set("session.cache_expire", 60); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 3600); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 1); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
?>
