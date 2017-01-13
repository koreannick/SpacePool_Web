<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect)		$connect = dbcon();

if(!$sms_connect)		$sms_connect = sms_dbcon();

foreach($_POST as $key => $val){
	$$key = trim($val);
}

if($mode == "input_ok"){

	$c_id = $sms_cid;
	$c_pass = $sms_cpass;


	$tran_msg = mysql_real_escape_string($body);
	$callback = str_replace("-", "", $callback);
	if($reserve){
		$reserve_date = "$yy-$mm-$dd $hh:$ss:00";
		$reserve_ = "Y";
	}else{
		$reserve_ = "N";
		$reserve_date = date("Y-m-d H:i:s");
	}

	if($m_kind==""){
		$destination = str_replace("-", "", $destination);
		$destination = str_replace(" ", "", $destination);

		if(strpos($destination,",")>0){
			$recv_phone = $destination;
			$destination_arr = explode(",",$recv_phone);
			for($i=0;$i<count($destination_arr);$i++){
				$destination = $destination_arr[$i];

				include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
			}
		}else{
			include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
		}
	}elseif($m_kind=="all"){
		$result = mysql_query("select id,name,mobile from $t_member where mobile != '' order by name asc",$connect);
		if(mysql_num_rows($result)>0){
			while($r=mysql_fetch_array($result)){
				$destination = $r[mobile];
				$destination = str_replace("-", "", $destination);
				$destination = str_replace(" ", "", $destination);

				include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
			}
		}
		@mysql_free_result($result);
	}else{
		$result = mysql_query("select id,name,mobile from $t_member where mobile != '' and m_kind = '$m_kind' order by name asc",$connect);
		if(mysql_num_rows($result)>0){
			while($r=mysql_fetch_array($result)){
				$destination = $r[mobile];
				$destination = str_replace("-", "", $destination);
				$destination = str_replace(" ", "", $destination);

				include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
			}
		}
		@mysql_free_result($result);
	}


	redir_proc2("발송완료");
}
?>