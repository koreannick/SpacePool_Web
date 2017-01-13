<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

if(auth_lev()<9)			redir_proc("/", "");

$connect = dbcon();

$table = "es_faq2";
$page_title = "공간별 설명";
if(!$mode){	$mode="list";	}

if($mode=="view"||$mode=="list"||$mode=="write"||$mode=="write_ok"||$mode=="del"||$mode=="del_ok"||$mode=="edit"||$mode=="edit_ok"){
}else{
	redir_proc("back","잘못된 접근입니다.");
}

if(substr($mode,strrpos($mode,"_")) == "_ok"){	// ok 일경우 ////////////////////
	$page_source = "./faq2/all_ok.php";
	include_once($page_source);
	exit();
}elseif($mode == "edit"){
	$page_source = "./faq2/write.php";
}else{
	$page_source = "./faq2/" . $mode. ".php";
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