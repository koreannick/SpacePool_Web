<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

#################################################################################
// 인증 처리 --------------------------------------------
if(auth_lev()<9){
	redir_proc("/", "");
}
//------------------------------------------------------
// 기본설정 ////////////////////////////////////////
$t_member = "es_member";
$t_point = "es_point";
$save_path = $DOCUMENT_ROOT."/DATAS/es_member/";

if(!$connect)		$connect = dbcon();

if(auth_lev()==9)			$page_title = "회원관리";
else							$page_title = "정보수정";

// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "list";	}
if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "./member/all_ok.php";
	$CONF_SKIN = 0;
}elseif($mode=="input"){
	$page_source = "./member/edit.php";
}else{
	$page_source = "./member/" . $mode . ".php";
}

if($mode=="point"){
	$page_title = $mem_id." 회원 적립내역";
	$CONF_SKIN = 2;
}elseif($mode=="minfo"){
	$page_title = $id." 회원 정보";
	$CONF_SKIN = 2;
}elseif($mode=="logon"){
	$page_title = $id." 로그인 통계";
	$CONF_SKIN = 2;
}

if($mode=="excel"){
	$CONF_SKIN = 2;
	$page_title = "";

	$file_name = iconv("utf-8","euc-kr","회원명단_".date("Ymd").".xls");

	header ("Cache-Control:no-cache, must-revalidate");
	header( "Content-type: application/vnd.ms-excel" );
	header( "Content-Disposition: attachment; filename=$file_name" );
	header( "Content-Description: Excel Data" );
	header( "Content-charset=utf-8" );
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