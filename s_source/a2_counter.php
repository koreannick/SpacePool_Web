<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

// 인증 처리 --------------------------------------------
if(auth_lev()!=9){
	redir_proc("/", "");
}
//------------------------------------------------------
// 기본설정 ////////////////////////////////////////
$table = "con_info";
$connect = dbcon();

// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "day";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./counter/all_ok.php";
	$CONF_SKIN = 0;
}else{
	$page_source = "./counter/" . $mode . ".php";
}

// 페이지 재설정
if($mode == "view"){
	$CONF_SKIN = 2;
}

if($mode == "day"){
	$page_title = "일별접속 분석";
}elseif($mode == "month"){
	$page_title = "월별접속 분석";
}elseif($mode == "time"){
	$page_title = "시간별접속 분석";
}elseif($mode == "site"){
	$page_title = "경로별접속 분석";
}elseif($mode == "search"){
	$page_title = "검색어별접속 분석";
}elseif($mode == "ip"){
	$page_title = "IP별접속 분석";
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