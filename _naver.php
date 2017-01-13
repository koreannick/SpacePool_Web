<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$naver = new Naver();

if($naver->getConnectState()){

	$login_info = $naver->getUserProfile('JSON');

	$data = json_decode($login_info,true);

	//$email = iconv("utf-8","euc-kr",$data['response']['email']);
	//$name = iconv("utf-8","euc-kr",$data['response']['name']);
	$id = $data['response']['id'];
	$email = $data['response']['email'];
	$name = $data['response']['name'];
	$nickname = $data['response']['nickname'];
	$profile_image = $data['response']['profile_image'];
	$gender = $data['response']['gender'];
	$birthday = $data['response']['birthday'];
	$age = $data['response']['age'];

	$connect = dbcon();

	$last_log_date = time();

	$status = "ok";
	$mailling = "ok";
	$m_kind = "m1";

	$result = mysql_query("select uid,status,m_kind from es_member where email='$email'");
	if($result&&mysql_num_rows($result)>0){
		$status = mysql_result($result,0,1);
		$m_kind = mysql_result($result,0,2);

		@mysql_query("update es_member set last_log_date='$last_log_date', profile_image='$profile_image', nickname='$nickname' where email='$email'");
	}else{
		$wdate = time();

		@mysql_query("insert into es_member (id,email,name,nickname,profile_image,wdate,last_log_date,ip,mailling,m_kind,status) values ('$id','$email','$name','$nickname','$profile_image','$wdate','$last_log_date','$REMOTE_ADDR','$mailling','$m_kind','$status')");
	}
	@mysql_free_Result($result);

	if($status=="ok"){
		$SN_USESSION = $email."|".$name."|".$m_kind."|".$nickname."|".$profile_image;

		$_SESSION["SN_USESSION"] = $SN_USESSION;


		/*
		$result = mysql_query("select * from es_login where email='$email'");
		if($result&&mysql_num_rows($result)>0){
			$ldate = time();

			@mysql_query("update es_login set ldate='$ldate', profile_image='$profile_image', nickname='$nickname' where email='$email'");
		}else{
			$wdate = time();
			$ldate = time();

			$gubun = "naver";

			@mysql_query("insert into es_login (id,email,name,nickname,profile_image,wdate,ldate,ip,gubun) values ('$id','$email','$name','$nickname','$profile_image','$wdate','$ldate','$REMOTE_ADDR','$gubun')");
		}
		@mysql_free_Result($result);
		*/
		$resultm = mysql_query("select replace(mobile,'-','') from $t_member where email='$email'");
		if($resultm&&mysql_num_rows($resultm)>0){
			$chk_m = trim(mysql_result($resultm,0,0));

			if(!$chk_m){
				redir_proc3("/member/member_info.php","기본정보를 등록해주셔야 이용가능합니다.");
			}

			redir_proc3("/","");
		}else{
			redir_proc3("/member/member_info.php","기본정보를 등록해주셔야 이용가능합니다.");
		}
		@mysql_free_result($resultm);
	}else{

		redir_proc3("/?nhnMode=logout","사용이 중지된 회원입니다.\\r관리자에게 문의바랍니다.");
	}
}
?>