<?
if(!defined("__GAUTECH__"))	 exit;

if(!$USESSION[0]){
	redir_proc3("/","로그인하신 후 이용해주시기바랍니다.");
}else{
	if($USESSION[2]!="m2"&&$USESSION[2]!="admin"){
		redir_proc3("/member/host_signup.php","호스트 전용 기능입니다.");
	}
}
?>