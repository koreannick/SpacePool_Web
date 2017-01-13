<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

foreach($_POST as $key => $val){
	$$key = bad_tag_convert($val);
}

if($mode == "input_ok"){
	$uid = uniqid("i_");
	$wdate = time();
	$size = $ww . "|" . $hh;
	$pos = $pos1 . "|" . $pos2;

	$status = ($status=="on")?$status:"off";
	$layer = ($layer=="Y")?$layer:"N";

	$sql = "Insert Into $table Set ";
	$sql .= "uid='$uid', ";
	$sql .= "title='$title', ";
	$sql .= "contents='$contents', ";
	$sql .= "size='$size', ";
	$sql .= "status='$status', ";
	$sql .= "pos='$pos', ";
	$sql .= "ctime='$ctime', ";
	$sql .= "layer='$layer', ";
	$sql .= "wdate=$wdate ";

	mysql_query($sql, $connect);

	redir_proc($_SERVER[PHP_SELF] . "?mode=list", "");

}elseif($mode == "edit_ok"){
	$size = $ww . "|" . $hh;
	$pos = $pos1 . "|" . $pos2;

	$status = ($status=="on")?$status:"off";
	$layer = ($layer=="Y")?$layer:"N";

	$sql = "Update $table Set ";
	$sql .= "uid='$uid', ";
	$sql .= "title='$title', ";
	$sql .= "contents='$contents', ";
	$sql .= "size='$size', ";
	$sql .= "pos='$pos', ";
	$sql .= "layer='$layer', ";
	$sql .= "ctime='$ctime', ";
	$sql .= "status='$status' ";
	$sql .= "Where uid='$uid'";

	if(!$connect){	$connect = dbcon();	}
	mysql_query($sql, $connect);

	redir_proc($_SERVER[PHP_SELF] . "?mode=list&page=$page", "");

}elseif($mode == "del_ok"){
	if(!$connect){	$connect = dbcon();	}

	$sql = "Delete From $table Where uid='$uid'";
	mysql_query($sql, $connect);

	redir_proc($_SERVER[PHP_SELF] . "?mode=list&page=$page", "");
}
?>