<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$_SERVER[HTTP_REFERER]){
	redir_proc3("/","이전페이지 값이 없습니다.");
	exit;
}else{
	// 우선 이 URL 로 부터 온것인지 검사
	$parse = parse_url($_SERVER[HTTP_REFERER]);
	// 3.35
	// 포트번호가 존재할 경우의 처리
	$parse2 = explode(":", $_SERVER[HTTP_HOST]);
	if (str_replace("www.","",$parse[host]) != str_replace("www.","",$parse2[0])) {
		redir_proc3("/","올바른 접근이 아닌것 같습니다.");
		exit;
	}
}

if(preg_match("/chrome/",strtolower($_SERVER['HTTP_USER_AGENT']))){
}else{
	if(auth_lev()==0){
		if(!$mobile){
			$chk_key = $_SESSION["ss_norobot_key"];

			if(!$chk_key)		$chk_key = $_COOKIE["ck_norobot_key"];

			if ($chk_key) {
				if ($chk_key != $_POST["wr_key"]) {
					echo("<script>alert('정상적인 등록이 아닌것 같습니다.');history.back();</script>");
					exit;
				}
			} else {
				echo("<script>alert('정상적인 접근이 아닌것 같습니다.');history.back();</script>");
				exit;
			}
		}
	}
}
?>