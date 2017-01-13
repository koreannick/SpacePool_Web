<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

// 인증 처리 --------------------------------------------
if(auth_lev()<8)			redir_proc("/", "");

// 기본설정 ////////////////////////////////////////
$table = "es_product";
$CONF_DATABLES = 1;
$link_path = "/DATAS/$table/";
$save_path = $DOCUMENT_ROOT.$link_path;

// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "list";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./product/all_ok.php";
	$CONF_SKIN = 0;
}elseif($mode == "edit"){
	$page_source = "./product/input.php";
}else{
	$page_source = "./product/" . $mode . ".php";
}

// 페이지 타이틀
$page_title = "공간관리";

if($mode=="list2"){
	$page_title .= " - 예약현황";
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