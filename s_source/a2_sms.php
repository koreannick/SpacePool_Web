<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

if(auth_lev()<8)			redir_proc("/", "");

$t_member = "es_member";
$admin = true;

// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "input";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./sms/all_ok.php";
	$CONF_SKIN = 0;
}else{
	$page_source = "./sms/" . $mode . ".php";
}
$CONF_SKIN = 2;

if($mode=="result")		$CONF_SKIN = 1;

// 페이지 타이틀
$page_title = "SMS발송";

// TOP
if($CONF_SKIN == 1){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/top_admin.php");
}elseif($CONF_SKIN == 2){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/top_blank.php");
}

// 페이지 불러오기 //////////////////////////////////////////////////////////////////////////////////////////
if($page_source){
	include_once($page_source);
}else{
	echo("<br><br><div><h2>없는 페이지 입니다.</h2></div>");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

// BOTTOM
if($CONF_SKIN == 1){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/bottom_admin.php");
}elseif($CONF_SKIN == 2){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/bottom_blank.php");
}
?>