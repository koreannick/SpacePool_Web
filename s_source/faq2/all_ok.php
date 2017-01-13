<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($mode == "write_ok"){		//게시판 쓰기 완료/////////////////////////////////////////////////////////////////////////////////////
	$subject = bad_tag_convert($_POST[subject]);
	$comment = bad_tag_convert($_POST[comment]);
	$wdate = time();

	$sql = "Insert Into $table Set ";
	$sql .= "kind='$kind', ";
	$sql .= "subject='$subject', ";
	$sql .= "comment='$comment', ";
	$sql .= "wdate='$wdate', ";
	$sql .= "ip='$REMOTE_ADDR' ";
	mysql_query($sql, $connect);
	redir_proc($_SERVER["PHP_SELF"] . "?mode=list&page=$page", "");
}elseif($mode == "edit_ok"){		//게시판 수정 완료/////////////////////////////////////////////////////////////////////////////////////

	$subject = bad_tag_convert($_POST[subject]);
	$comment = bad_tag_convert($_POST[comment]);

	$sql = "Update $table Set ";
	$sql .= "subject='$subject', ";
	$sql .= "kind='$kind', ";
	$sql .= "comment='$comment' ";
	$sql .= "Where uid=$uid";
	mysql_query($sql, $connect);
	redir_proc($_SERVER["PHP_SELF"] . "?mode=view&uid=$uid", "");

}elseif($mode == "del_ok"){
	if(!$connect){	$connect = dbcon();	}

	$sql = "Delete From $table Where uid=$uid";
	mysql_query($sql, $connect);
	redir_proc($_SERVER["PHP_SELF"] . "?mode=list&page=$page", "");
}


?>