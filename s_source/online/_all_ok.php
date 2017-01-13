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

	$sql = "Insert Into $table Set ";
	$sql .= "name='".$name."',";
	$sql .= "email='".$email."',";
	$sql .= "tel='".$tel."',";
	$sql .= "mobile='".$mobile."',";
	$sql .= "gubun='".$gubun."',";
	$sql .= "subject='".$subject."',";
	$sql .= "comment='".$comment."',";
	$sql .= "ip='".$REMOTE_ADDR."',";
	$sql .= "wdate='".$wdate."'";
	$q_result = mysql_query($sql);

	if($q_result){
		if($adminmail){
			$uid = mysql_insert_id();

			$subject = "";
			$content = "";
			if($email)		$send_email = $email;
			else				$send_email = $adminmail;

			//basic_sendmail($adminmail, $send_email, $subject, $content);
		}
		?>
		<script type="text/javascript">
		parent.$('.f_pop_wrap').show();
		</script>
		<?
		//redir_proc3("/","성공적으로 접수되었습니다.\\r\\r담당자가 확인후 처리해드리겠습니다.");
	}else{
		redir_proc2("입력실패");
	}
}elseif($mode=="del_ok"){

}
?>