<?
if($destination&&$tran_msg){
	$results = mysql_query("select c_id,sms,lms from es_client where c_id = '$c_id' and c_pass = '$c_pass' and status = 'Y'",$sms_connect);
	if(mysql_num_rows($results)>0){
		$money_sms = mysql_result($results,0,1);
		$money_lms = mysql_result($results,0,2);
		@mysql_free_result($results);
		$last_logon = time();
		@mysql_query("update es_client set last_logon = '$last_logon' where c_id = '$c_id' and c_pass = '$c_pass' and status = 'Y'",$sms_connect);

		if($destination&&(substr($destination,0,3)=="010"||substr($destination,0,3)=="011"||substr($destination,0,3)=="016"||substr($destination,0,3)=="017"||substr($destination,0,3)=="018"||substr($destination,0,3)=="019")){


			if(str_count($tran_msg)>80){
				$subject = strcut_utf8($tran_msg,40);
				$tran_msg = iconv("utf-8","euc-kr",$tran_msg);

				$result2 = mysql_query("insert into em_mmt_tran (mt_refkey,date_client_req,subject,content,attach_file_group_key,callback,service_type,broadcast_yn,msg_status,recipient_num) values ('$c_id',sysdate(),'$subject','$tran_msg',0,'$callback','2','N','1','$destination')",$sms_connect);
				$point = $money_lms;
			}else{
				$tran_msg = iconv("utf-8","euc-kr",$tran_msg);

				$result2 = mysql_query("insert into em_smt_tran (mt_refkey,date_client_req,content,callback,service_type,broadcast_yn,msg_status,recipient_num) values ('$c_id',sysdate(),'$tran_msg','$callback','0','N','1','$destination')",$sms_connect);
				$point = $money_sms;
			}

			if($result2){
				$reserve_ = "N";
				$reserve_date = date("Y-m-d H:i:s");
				if(!$admin)		$tran_msg = iconv("euc-kr","utf-8",$tran_msg);
				@mysql_query("insert into es_sms_result (id,recipient_num,callback,content,reserve,wdate,ip) values ('$USESSION[0]','$destination','$callback','$tran_msg','$reserve_','$reserve_date','$REMOTE_ADDR')",$connect);

				if($point>0){
					//발송성공할 경우 적립금에서 차감
					@mysql_query("insert into es_point (content,point,state,wdate,c_id,ip) values ('사용','$point','-',".time().",'$c_id','$REMOTE_ADDR')",$sms_connect);
				}
			}
		}
	}
}
?>