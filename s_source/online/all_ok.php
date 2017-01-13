<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

foreach($_POST as $key => $val){
	$$key = bad_tag_convert2($val);
}

if($mode == "edit_ok"){

	$sql = "Update $table Set ";
	$sql .= "name='".$name."',";
	$sql .= "email='".$email."',";
	$sql .= "tel='".$tel."',";
	$sql .= "mobile='".$mobile."',";
	$sql .= "gubun='".$gubun."',";
	$sql .= "subject='".$subject."',";
	$sql .= "comment='".$comment."',";
	$sql .= "admin_comment='".$admin_comment."' ";
	$sql .= "Where uid=$uid ";

	$q_result = mysql_query($sql, $connect);
	if($q_result){
		redir_proc3($_SERVER[PHP_SELF] . "?mode=view&page=$page&uid=$uid", "");
	}else{
		redir_proc2("입력실패");
	}

}elseif($mode == "del_ok"){
	if(!$connect){	$connect = dbcon();	}

	$sql = "Delete From $table Where uid=$uid";
	mysql_query($sql, $connect);

	redir_proc3($_SERVER[PHP_SELF] . "?mode=list&page=$page", "");

}
?>