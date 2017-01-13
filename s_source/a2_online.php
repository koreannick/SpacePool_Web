<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

// 인증 처리 --------------------------------------------
if(auth_lev()<8)			redir_proc("/", "");

// 기본설정 ////////////////////////////////////////
$table = "es_online";
$link_path = "/DATAS/$table/";
$save_path = $_SERVER["DOCUMENT_ROOT"].$link_path;

// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "list";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./online/all_ok.php";
	$CONF_SKIN = 0;
}elseif($mode == "edit"){
	$page_source = "./online/input.php";
}else{
	$page_source = "./online/" . $mode . ".php";
}

// 페이지 타이틀
$page_title = "제휴문의";

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