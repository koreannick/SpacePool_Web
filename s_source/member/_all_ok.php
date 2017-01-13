<?
if(!defined("__GAUTECH__"))		exit;

if(!$connect)			$connect = dbcon();
if(!$sms_connect)		$sms_connect = sms_dbcon();

if($mode == "login_ok"){	// 로그인 ////////////////////////////////////////////////////////////
	$sql = "Select * From $t_member Where id='$id'";
	$result = mysql_query($sql,$connect);
	if($row=mysql_fetch_array($result)){

		if(sql_password($pwd) == $row["pwd"]){
			if($row["status"]!="ok"){
				redir_proc2("승인되어야 로그인이 가능합니다.");
			}
			$m_kind = $row["m_kind"];
			$name = $row["name"];
			$pwd_mod_date = $row["pwd_mod_date"];

			$SN_USESSION = $id . "|" . $name . "|" . $m_kind;
			$_SESSION["SN_USESSION"] = $SN_USESSION;
			session_register("SN_USESSION");

			$msg = "$id 님 환영합니다.";
			$return_url = ($return_url)?$return_url:$CONF_START;

			//마지막 로그인날짜 업데이트
			@mysql_query("update $t_member set last_log_date = ".time()." where id='$id'",$connect);
			///////////////////////////////////////////////////////////////

			redir_proc3($return_url,"");
		}else{
			redir_proc2("비밀번호가 일치하지 않습니다.");
		}
	}else{
		redir_proc2("아이디와 비밀번호를 확인해 주세요");
	}
}elseif($mode=="logout_ok"){	// 로그아웃 /////////////////////////////////////////////////////////
	session_destroy();

	redir_proc("/?nhnMode=logout", "");
}elseif($mode=="insert_ok"){		// 회원정보 입력 /////////////////////////////////////////////


}elseif($mode == "edit_ok"){
	foreach($_POST as $key => $val){
		$$key = bad_tag_convert2($val);
	}
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;
	$creg = $creg1."-".$creg2."-".$creg3;
	$last_mod_date = time();

	//인증번호 확인
	$result = mysql_query("select authnum from $t_member where email='$USESSION[0]'",$connect);
	if($result&&mysql_num_rows($result)>0){
		$org_authnum = mysql_result($result,0,0);
	}
	@mysql_free_result($result);

	if($org_authnum!=$authnum){
		redir_proc2("휴대폰 인증번호가 틀렸습니다.");
		exit;
	}

	// 회원기본정보 입력
	$sql = "Update $t_member Set ";
	$sql .= "post='$post',";
	$sql .= "addr1='$addr1',";
	$sql .= "addr2='$addr2',";
	$sql .= "tel='$tel',";
	$sql .= "mobile='$mobile',";
	$sql .= "authnum='',";
	$sql .= "company='$company',";
	$sql .= "creg='$creg',";
	$sql .= "cetc='$cetc',";
	$sql .= "cperson='$cperson',";
	$sql .= "cdate1='$cdate1',";
	$sql .= "cdate2='$cdate2',";
	$sql .= "comment='$comment',";
	if($host=="ok"){
		//사업자 바로 승인
		$m_kind = "m2";

		$sql .= "m_kind='$m_kind',";
		$sql .= "n_talk='$n_talk',";
		$sql .= "host='Y',";
		$sql .= "h_ip='$REMOTE_ADDR',";
		$sql .= "h_wdate='".time()."',";
	}
	$sql .=" last_mod_date='$last_mod_date' ";
	$sql .= "Where email='$USESSION[0]'";
	mysql_query($sql,$connect);

	//회원정보에서 주소가져오기
	if($addr1||$addr2){
		$address = $addr1." ".$addr2;
		$lat = "";
		$lng = "";

		//$xml = simplexml_load_file("http://maps.google.com/maps/api/geocode/xml?address=".urlencode($address)."&sensor=false");
		//$lat = $xml->result->geometry->location->lat;
		//$lng = $xml->result->geometry->location->lng;

		//@mysql_query("update es_product set lng='$lng', lat='$lat' where id='$USESSION[0]'");
	}
	@mysql_free_result($result);

	if($host=="ok"){
		$email = $USESSION[0];
		$name = $USESSION[1];
		$m_kind = "m2";
		$nickname = $USESSION[3];
		$profile_image = $USESSION[4];

		$SN_USESSION = $email."|".$name."|".$m_kind."|".$nickname."|".$profile_image;

		$_SESSION["SN_USESSION"] = $SN_USESSION;


		//redir_proc3("/","호스트로 신청하였습니다.\\r\\r관리자가 확인후 승인처리해드리겠습니다.\\r\\r감사합니다.");
		redir_proc3("/","HOST로 전환되었습니다.\\r\\r감사합니다.");
	}else{
		redir_proc3("/","성공적으로 수정되었습니다.");
	}

}elseif($mode == "leave_ok"){
	if(auth_lev()==9){
		redir_proc("back","관리자 계정은 탈퇴가 불가능합니다.");
	}else{
		$result = mysql_query("delete from $t_member where email = '$USESSION[0]'",$connect);
		if($result){
			echo "<script>alert('성공적으로 탈퇴되었습니다.\\r\\r이용해주셔서 감사합니다.');location.href='${CONF_MEMBER_FILE}?mode=logout_ok';</script>";
			exit;
		}else{
			echo "<script>alert('오류가 발생하였습니다..\\r\\r관리자에게 문의바랍니다..');history.back();</script>";
			exit;
		}
	}
}elseif($mode == "pwd_chg_ok"){

}elseif($mode=="sms_send_ok"){
	$mobile = $mobile1.$mobile2.$mobile3;

	$authnum = rand(100000,999999);

	$destination = $mobile;
	$tran_msg = "SpacePool - 인증번호 ".$authnum;

	$c_id = $sms_cid;
	$c_pass = $sms_cpass;

	if(strlen($destination)>6){
		$result = mysql_query("update $t_member set authnum='$authnum' where email='$USESSION[0]'",$connect);
		if($result){
			## SMS발송 - 시작 ##############################################################################################

			if($destination){
				//$tran_msg = iconv("utf-8","euc-kr",$tran_msg);

				include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
			}
			redir_proc2("인증번호가 발송되었습니다.");
		}else{
			redir_proc2("오류가 발생하였습니다.");
		}
	}
}elseif($mode=="host_reg_ok"){


}elseif($mode=="guest_chg_ok"){
	$result = mysql_query("update $t_member set m_kind='m1',n_talk='',host='N',h_ip='',h_wdate='' Where email='$USESSION[0]'",$connect);

	if($result){
		$email = $USESSION[0];
		$name = $USESSION[1];
		$m_kind = "m1";
		$nickname = $USESSION[3];
		$profile_image = $USESSION[4];

		$SN_USESSION = $email."|".$name."|".$m_kind."|".$nickname."|".$profile_image;

		$_SESSION["SN_USESSION"] = $SN_USESSION;


		redir_proc3("reload","GUEST로 전환되었습니다.");
	}else{
		redir_proc2("오류가 발생하였습니다.");
	}
}

?>