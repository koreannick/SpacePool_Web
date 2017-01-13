<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

foreach($_POST as $key => $val){
	$$key = bad_tag_convert2($val);
}

if($mode=="input_ok"){
	$wdate = time();
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;
	$creg = $creg1."-".$creg2."-".$creg3;
	$pwd = trim($_POST["pwd"]);

	if(!$id || !$name || !$pwd)		redir_proc("back", "입력데이터가 부족합니다.");

	if(preg_match("/[\,]?{$id}/i", $CONF_noid))		redir_proc("back", "사용불가한 아이디입니다.");

	if(preg_match("/[\,]?{$nickname}/i", $CONF_noid))		redir_proc("back", "사용불가한 닉네임입니다.");

	$sql = "Insert Into $t_member Set ";
	$sql .= "id='$id',";
	$sql .= "name='$name',";
	$sql .= "pwd='".sql_password($pwd)."',";
	$sql .= "nickname='$nickname',";
	$sql .= "email='$email',";
	$sql .= "post='$post',";
	$sql .= "addr1='$addr1',";
	$sql .= "addr2='$addr2',";
	$sql .= "tel='$tel',";
	$sql .= "mobile='$mobile',";
	$sql .= "status='$status',";
	$sql .= "m_kind='$m_kind',";
	$sql .= "wdate=$wdate,";
	$sql .= "company='$company',";
	$sql .= "n_talk='$n_talk',";
	$sql .= "creg='$creg',";
	$sql .= "cetc='$cetc',";
	$sql .= "cperson='$cperson',";
	$sql .= "cdate1='$cdate1',";
	$sql .= "cdate2='$cdate2',";
	$sql .= "comment='$comment',";
	$sql .= "ip='$REMOTE_ADDR'";
	mysql_query($sql);

	redir_proc("$_SERVER[PHP_SELF]", "");

}elseif($mode == "edit_ok"){
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;
	$creg = $creg1."-".$creg2."-".$creg3;
	$pwd = trim($_POST["pwd"]);

	$sql = "Update $t_member Set ";
	if($name)		$sql .= "name='$name',";
	if($pwd)			$sql .= "pwd='".sql_password($pwd)."',";
	if($email)		$sql .= "email='$email',";
	if($nickname)		$sql .= "nickname='$nickname',";
	$sql .= "post='$post',";
	$sql .= "addr1='$addr1',";
	$sql .= "addr2='$addr2',";
	$sql .= "tel='$tel',";
	$sql .= "m_kind='$m_kind',";
	$sql .= "status='$status', ";
	$sql .= "n_talk='$n_talk',";
	$sql .= "company='$company',";
	$sql .= "creg='$creg',";
	$sql .= "cetc='$cetc',";
	$sql .= "cperson='$cperson',";
	$sql .= "cdate1='$cdate1',";
	$sql .= "cdate2='$cdate2',";
	$sql .= "comment='$comment',";
	$sql .= "mobile='$mobile' ";
	$sql .= "Where uid='$uid'";
	mysql_query($sql);

	if(auth_lev()==9)			redir_proc("$_SERVER[PHP_SELF]?mode=view&uid=$uid&page=$page&statuss=$statuss", $msg);
	else							redir_proc("$_SERVER[PHP_SELF]?mode=edit", $msg);

}elseif($mode == "del_ok"){
	$sql = "Delete From $t_member Where uid='$uid'";
	mysql_query($sql);
	redir_proc($_SERVER["PHP_SELF"] . "?mode=list&page=$page&statuss=$statuss", "삭제 하였습니다.");
}elseif($mode=="status_chg_ok"){
	$uid = $_POST["uid"];
	if($status){
		for($i=0;$i<count($uid);$i++){
			if($uid[$i]){
				if($status=="exit"){
					@mysql_query("delete from $t_member where uid = ".$uid[$i]);
				}elseif($status=="ok"||$status=="wait"){
					@mysql_query("update $t_member set status = '$status' where uid = ".$uid[$i]);
				}else{
					@mysql_query("update $t_member set m_kind = '$status' where uid = ".$uid[$i]);
				}
			}
		}

		redir_proc3("reload", "");
	}
}
?>