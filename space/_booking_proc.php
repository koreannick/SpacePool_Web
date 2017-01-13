<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

if($mode!="booking_chk_ok"&&$mode!="edate_cal_ok"){
	include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";
}

$connect = dbcon();
$sms_connect = sms_dbcon();
$adminmail = "spacepool@naver.com";

foreach($_POST as $key => $val){
	$$key = bad_tag_convert2($val);
}

if($mode=="insert_ok"){
	require "_booking_chk_qry.php";

	$pay_status = "N";
	$pay_date = "";
	$wdate = time();
	$status = "ok";

	$result = mysql_query("select count(uid) from es_booking",$connect);
	$cnt = mysql_result($result,0,0);
	@mysql_free_result($result);

	$order_code = date("YmdHis_").sprintf("%05d",($cnt+10001));

	if(!$sc_1)		$sc_1 = "N";
	if(!$sc_2)		$sc_2 = "N";
	if(!$sc_3)		$sc_3 = "N";

	$result = mysql_query("insert into es_booking (pid,puid,order_code,id,name,mobile,email,comment,gubun,btype,sDate,eDate,person,sTime,eTime,payment,pay_status,pay_date,ip,wdate,status,total_price,sc_1,sc_2,sc_3) values ('$pid','$uid','$order_code','$USESSION[0]','$name','$mobile','$email','$comment','$gubun','$btype','$sDate','$eDate','$person','$sTime','$eTime','$payment','$pay_status','$pay_date','$REMOTE_ADDR','$wdate','$status','$total_price','$sc_1','$sc_2','$sc_3')",$connect);
	if($result){
		$order_code_arr = explode("_",$order_code);
		$order_num = $order_code_arr[1];

		if($payment=="card"){
			$tran_msg = "예약번호 $order_num ".$s_m_1;
		}elseif($payment=="bank"){		//무통장입금은 sms로 계좌정보 발송
			$tran_msg = "예약번호 $order_num ".$s_m_2." ".$pay_bank_1." ".$pay_bank_2." ".$pay_bank_3." ".number_format($total_price)."원";
		}elseif($payment=="offline"){
			$tran_msg = "예약번호 $order_num ".$s_m_3;
		}

		//문자발송
		$c_id = $sms_cid;
		$c_pass = $sms_cpass;
		$destination = str_replace("-","",$mobile);

		if($destination&&$tran_msg){
			include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
		}

		//host에게 메일발송
		$host_email = $pid;
		if($host_email){
			$guest_name = $USESSION[1];
			require "../mail/mail05.php";

			basic_sendmail($host_email,$adminmail,$mail_subject,$mail_content);
		}
		?>
		<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('.f_pop_wrap',parent.document).show();
		});
		</script>
		<?
		//redir_proc3("/member/book_list.php","신청완료되었습니다.");
		//exit;
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}
}elseif($mode=="cancel_ok"){
	if(!$buid){
		redir_proc2("잘못된 접근입니다.");
		exit;
	}
	if($host=="Y")		$list_page = "host_book_list.php";
	else					$list_page = "book_list.php";

	$result = mysql_query("select id,status,sDate,eDate,sTime,eTime,pid,mobile,pid,order_code,email from es_booking where uid=$buid",$connect);
	if($result&&mysql_num_rows($result)>0){
		$org_id = mysql_result($result,0,0);
		$status = mysql_result($result,0,1);
		$sDate = mysql_result($result,0,2);
		$eDate = mysql_result($result,0,3);
		$sTime = mysql_result($result,0,4);
		$eTime = mysql_result($result,0,5);
		$org_pid = mysql_result($result,0,6);
		$mobile = mysql_result($result,0,7);
		$pid = mysql_result($result,0,8);
		$order_code = mysql_result($result,0,9);
		$email = mysql_result($result,0,10);
		@mysql_free_result($result);

		if($host=="Y"){
			if($org_pid!=$USESSION[0]&&auth_lev()!=9){
				redir_proc3("/member/".$list_page."?kind=$kind&page=$page","본인의 예약건이 아니므로 취소하실 수 없습니다.");
				exit;
			}
		}else{
			if($org_id!=$USESSION[0]&&auth_lev()!=9){
				redir_proc3("/member/".$list_page."?kind=$kind&page=$page","본인의 예약건이 아니므로 취소하실 수 없습니다.");
				exit;
			}
		}
	}else{
		redir_proc3("/member/".$list_page."?kind=$kind&page=$page","잘못된 접근입니다.");
		exit;
	}

	//이용중이거나 이용완료된건은 취소안되게
	if($status=="cancel"){
		redir_proc3("/member/".$list_page."?kind=2","이미 취소된 내역입니다.");
		exit;
	}

	if($pay_status=="Y"){
		if(date("Y-m-d")>=$sDate){
			if($sTime>0&&$eTime>0){
				if(date("H")>=$sTime&&date("H")<=$eTime){
					redir_proc3("/member/".$list_page."?kind=1","이용중이거나 이용완료된 건은 취소하실 수 없습니다.");
					exit;
				}
			}Else{
				redir_proc3("/member/".$list_page."?kind=1","이용중이거나 이용완료된 건은 취소하실 수 없습니다.");
				exit;
			}
		}
	}

	$result = mysql_query("update es_booking set status='cancel', cancel_date='".time()."' where uid=$buid ",$connect);
	if($result){

		$c_id = $sms_cid;
		$c_pass = $sms_cpass;

		//guest에게 문자발송
		$tran_msg = $s_m_4;
		$destination = str_replace("-","",$mobile);

		if($destination&&$tran_msg){
			include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
		}

		//host에게 문자발송
		if($pid){
			$tran_msg = $s_m_4;

			$result2 = mysql_query("select mobile from es_member where email='$pid'",$connect);
			if($result2&&mysql_num_rows($result2)>0){
				$host_mobile = mysql_result($result2,0,0);
				$destination = str_replace("-","",$host_mobile);

				if($destination&&$tran_msg){
					include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
				}
			}
			@mysql_free_result($result2);
		}

		//guest에게 메일발송
		if($email){
			require "../mail/mail02.php";

			basic_sendmail($email,$adminmail,$mail_subject,$mail_content);
		}

		//host에게 메일발송
		$host_email = $pid;
		if($host_email){
			require "../mail/mail06.php";

			basic_sendmail($host_email,$adminmail,$mail_subject,$mail_content);
		}
	?>
		<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('.f_pop_wrap',parent.document).show();
		});
		</script>
	<?
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}
}elseif($mode=="review_ok"){
	if(!$puid){
		redir_proc2("잘못된 접근입니다.");
		exit;
	}
	if(!$buid){
		redir_proc2("잘못된 접근입니다.");
		exit;
	}
	if(!$comment){
		redir_proc2("잘못된 접근입니다.");
		exit;
	}

	$score = str_replace("star_0","",$score);

	$result = mysql_query("insert into es_product_review (puid,buid,id,nickname,score,comment,ip,wdate) values ('$puid','$buid','$USESSION[0]','$USESSION[3]','$score','$comment','$REMOTE_ADDR',".time().")",$connect);
	if($result){
		redir_proc3("reload","등록되었습니다.");
		exit;
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}
}elseif($mode=="pay_update_ok"){
	$result = mysql_query("select pid,pay_status,mobile,email,order_code from es_booking where uid=$uid",$connect);
	if($result&&mysql_num_rows($result)>0){
		$pid = mysql_result($result,0,0);
		$pay_status = mysql_result($result,0,1);
		$mobile = mysql_result($result,0,2);
		$email = mysql_result($result,0,3);
		$order_code = mysql_result($result,0,4);
	}
	@mysql_free_result($result);

	if($pid!=$USESSION[0]&&auth_lev()!=9){
		redir_proc3("reload","본인의 예약내역이 아닙니다.");
		exit;
	}

	if($pay_status=="Y"){
		$pay_status_n = "N";
		$pay_date = "";
		$kind = 1;
	}else{
		$pay_status_n = "Y";
		$pay_date = date("Y-m-d");
		$kind = 2;
	}

	$result = mysql_query("update es_booking set pay_status='$pay_status_n',pay_date='$pay_date' where uid=$uid",$connect);

	if($result){
		$order_code_arr = explode("_",$order_code);
		$order_num = $order_code_arr[1];

		//문자발송
		if($pay_status_n=="N"){
			$tran_msg = "예약번호 $order_num ".$s_m_6;
		}elseif($pay_status_n=="Y"){
			$tran_msg = "예약번호 $order_num ".$s_m_5;
		}
		if($tran_msg){
			$c_id = $sms_cid;
			$c_pass = $sms_cpass;
			$destination = str_replace("-","",$mobile);

			if($destination&&$tran_msg){
				include $_SERVER["DOCUMENT_ROOT"]."/s_source/sms/sms_query.php";
			}
		}

		//guest에게 메일발송
		if($email){
			if($pay_status_n=="N"){		//결제취소시
				require "../mail/mail02.php";
			}elseif($pay_status_n=="Y"){		//결제승인시
				require "../mail/mail01.php";
			}

			// basic_sendmail($email,$adminmail,$mail_subject,$mail_content);
			basic_sendmail($email,$adminmail,$mail_subject,$mail_content);
			nmail($email,$adminmail,$mail_subject,$mail_content);
		}

		redir_proc3("/member/host_book_list.php?kind=$kind&page=$page","");
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}
}elseif($mode=="booking_chk_ok"){
	require "_booking_chk_qry.php";
}elseif($mode=="edate_cal_ok"){

	if($sDate){
		$sDate_arr = explode("-",$sDate);

		$result = mysql_query("select gubun,g2_p from es_product where uid=$uid",$connect);
		if($result&&mysql_num_rows($result)>0){
			$gubun = mysql_result($result,0,0);
			$g2_p = mysql_result($result,0,1);
		}
		@mysql_free_result($result);

		if($gubun==1){
			$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));
		}elseif($gubun==2){
			if($g2_p=="M"){
				$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));
			}else{
				$eDate = $sDate;
			}
		}elseif($gubun==3){
		}elseif($gubun==4){
			$eDate = $sDate;
		}

		echo $eDate;
	}else{
		echo "&nbsp;";
	}
}
?>
