<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

// 인증 처리 --------------------------------------------
if(auth_lev()!=9){
	redir_proc("/", "");
}
//------------------------------------------------------
// 기본설정 ////////////////////////////////////////
$table = "es_popup";
$CONF_DATABLES = 1;
$link_path = "/DATAS/$table/";


// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "list";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./popup/all_ok.php";
	$CONF_SKIN = 0;
}else{
	$page_source = "./popup/" . $mode . ".php";
}

$page_title = "팝업창관리";

// 페이지 재설정
if($mode == "edit"){
	$page_source = "./popup/input.php";
}elseif($mode=="view"){
	$CONF_SKIN = 2;
}

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