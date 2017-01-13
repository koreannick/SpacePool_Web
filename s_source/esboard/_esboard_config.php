<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

if(!$connect)		$connect = dbcon();

$tableview = 1;
$w_secret = 0;
$view_list = 0;
$kind_chk = 0;
$oneone_chk = 0;
$thum_width = 100;
$thum_height = 100;
$writable = 0;
$commentable = 0;
$comment_write = 0;
$replable = 0;
$viewable = 1;
$downble = 1;
$file_num = 3;
$searchform = 1;
$row_cnt = 3;			//갤러리용
$listonly = 0;
$num_per_page = 15;

if(!$mode)			$mode = "list";

$t_files = "es_files";
$t_comment = "es_comment_board";
$link_path = "/DATAS/$table/";
$save_path = $_SERVER["DOCUMENT_ROOT"] . $link_path;

// bbs 구분 ///////////////////////////
if($table == "es_free1"){
	$page_title = "공지사항";
	$lang = "";
	$board_type = "notice";
}elseif($table == "es_free2"){
	$page_title = "질문하기";
	$lang = "";
	$board_type = "bbs";
	if(auth_lev()>0){
		$writable = 1;
		$w_secret = 1;
		$commentable = 1;
		$comment_write = 1;
	}
}elseif($table == "es_free3"){
	$page_title = "POOL 스토리";
	$lang = "";
	$board_type = "notice";
}else{
	redir_proc("/","");
	exit;
}

$_GET = xss_clean($_GET);

$mode_arr = ":view::list::write::write_ok::del::del_ok::reply::reply_ok::edit::edit_ok::secret_view::pwd_ok::comment_ok::comment_del_ok::comment_list_ok::list_ok:";

if($uid){
	if(!number_check($uid)){
		redir_proc("/","잘못된 접근입니다.");
		exit;
	}
}
if($skind){
	if(!number_check($skind)){
		redir_proc("/","잘못된 접근입니다.");
		exit;
	}
}
if($page){
	if(!number_check($page)){
		redir_proc("/","잘못된 접근입니다.");
		exit;
	}
}

if(!preg_match("/:".$mode.":/",$mode_arr)){
	redir_proc("/","잘못된 접근입니다.");
	exit;
}

if(isset($HTTP_REFERER)){
	if(strpos($HTTP_REFERER,$CONF_SITE_DOMAIN)==0){
		redir_proc("/","잘못된 접근입니다.");
		exit;
	}
}

if(isset($search)){
	$search = mysql_real_escape_string($search);
	$search = preg_replace("/[\<\>\'\"\%\=\(\)\s]/", "", $search);
}

if($skey){
	if($skey!="subject"&&$skey!="comment"&&$skey!="name"){
		redir_proc("/","잘못된 접근입니다.");
		exit;
	}
}

flush2();


if($admin_type == "admin"){
	if(substr($mode,strrpos($mode,"_")) == "_ok"){	// ok 일경우 ////////////////////
		$page_source = "./esboard/all_ok.php";
		include_once($page_source);
		exit();
	}elseif($mode == "edit" || $mode == "reply"){
		$page_source = "./esboard/write.php";
	}else{
		if($mode=="secret_view"){
			$page_source = "./esboard/_pwd.php";
		}else{
			$page_source = "./esboard/" . $mode. ".php";
		}
	}
}else{
	if(isset($_GET)){
		foreach($_GET as $key=>$val){
			if($key=="skey"||$key=="search"||$key=="skind"||$key=="page"||$key=="mode"||$key=="uid"||$key=="table"||$key=="puid"||$key=="x"||$key=="y"){
			}else{
				redir_proc("/","잘못된 접근입니다.");
				exit;
			}
		}
	}

	if(substr($mode,strrpos($mode,"_")) == "_ok"){	// ok 일경우 ////////////////////
		include_once($_SERVER["DOCUMENT_ROOT"]."/s_source/esboard/_all_ok.php");
		exit;
	}else{
		$page_source = "/s_source/esboard/_" . $mode.$lang.".php";

		if($mode == "edit" || $mode == "reply"){
			if(!$uid){
				redir_proc("back","잘못된 접근입니다.");
				exit;
			}
			if(!$writable){
				redir_proc("/","글쓰기 권한이 없습니다.");
				exit;
			}
			$page_source = "/s_source/esboard/_write" . $lang . ".php";
		}elseif($mode=="secret_view"){
			if(!$uid){
				redir_proc("back","잘못된 접근입니다.");
				exit;
			}
			$page_source = "/s_source/esboard/_pwd".$lang.".php";
		}elseif($mode=="view"){
			if(!$uid){
				redir_proc("back","잘못된 접근입니다.");
				exit;
			}
			if(!$viewable){
				redir_proc("/","접근권한이 없습니다.");
				exit;
			}
		}elseif($mode=="write"){
			if(!$writable){
				redir_proc("/","글쓰기 권한이 없습니다.");
				exit;
			}
		}

		if(!file_exists($_SERVER["DOCUMENT_ROOT"].$page_source)){
			redir_proc("/","잘못된 접근입니다.");
			exit;
		}
	}
}
?>