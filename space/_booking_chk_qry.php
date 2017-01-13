<?
if(!defined("__GAUTECH__"))	 exit;

$sDate = date("Y-m-d",strtotime($sDate));

if(!$uid){
	redir_proc3("/".$uid,"잘못된 접근입니다.");
	exit;
}

if(!$btype){
	redir_proc3("/".$uid,"예약형태를 선택해주세요.");
	exit;
}

if(!$sDate){
	redir_proc3("/".$uid,"이용일자를 선택해주세요.");
	exit;
}else{
	$sDate = date("Y-m-d",strtotime($sDate));

	if($sDate<$etc2){
		if(!define("_BOOKING_")){
			redir_proc2("이용일자는 입주가능시기 이후로 선택해주세요.");
			exit;
		}else{
			redir_proc3("/".$uid,"이용일자는 입주가능시기 이후로 선택해주세요.");
			exit;
		}
	}
}

$table = "es_product";

$result = mysql_query("select * from $table where uid=$uid",$connect);
if($result&&mysql_num_rows($result)>0){
	$r = mysql_fetch_array($result);
	foreach($r as $key=>$val){
		$$key = stripslashes($val);
	}

	$pid = $id;

	$address = $addr1." ".$addr2;

	if($status=="wait"){
		redir_proc3("/".$uid,"예약이 불가능한 상태입니다.");
		exit;
	}
}
@mysql_free_result($result);

if($p_limit<$person){
	if(!define("_BOOKING_")){
		redir_proc3("/".$uid,"최대수용인원을 초과하였습니다.");
		exit;
	}else{
		redir_proc2("최대수용인원을 초과하였습니다.");
		exit;
	}
}

$sDate_arr = explode("-",$sDate);
if($gubun==1){
	$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));

	if($btype=="Desk"){
		$price = $g1_d_price;
		$btype_str = "Desk";
		//Space가 예약된 상태라면 예약안되게
		$b_chk_sql = "select uid from es_booking where puid=$uid and btype='Space' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) and status='ok'";
		$result = mysql_query($b_chk_sql,$connect);
		if($result&&mysql_num_rows($result)>0){
			$booking = mysql_result($result,0,0);
		}
		@mysql_free_result($result);

		if($booking){
			if(!define("_BOOKING_")){
				redir_proc2("해당 날짜에 Space로 예약되어있어서 Desk는 예약할 수 없습니다.");
				exit;
			}else{
				redir_proc3("/".$uid,"해당 날짜에 Space로 예약되어있어서 Desk는 예약할 수 없습니다.");
				exit;
			}
		}

		//Desk 인원수 체크하여 예약여부 확인
		$b_chk_sql = "select sum(person) from es_booking where puid=$uid and btype='$btype' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) and status='ok'";
		$result = mysql_query($b_chk_sql,$connect);
		if($result&&mysql_num_rows($result)>0){
			$Desk_Person = mysql_result($result,0,0);
		}
		@mysql_free_result($result);

		if(($p_limit-$Desk_Person)<$person){
			if(!define("_BOOKING_")){
				redir_proc2("Desk의 자리가 부족하여 예약하실 수 없습니다.\\r\\r남은 Desk : ".($p_limit-$Desk_Person));
				exit;
			}else{
				redir_proc3("/".$uid,"Desk의 자리가 부족하여 예약하실 수 없습니다.\\r\\r남은 Desk : ".($p_limit-$Desk_Person));
				exit;
			}
		}

	}elseif($btype=="Space"){
		$price = $g1_s_price;
		$btype_str = "Space";
		//Desk가 예약된 상태라면 예약안되게
		$b_chk_sql = "select uid from es_booking where puid=$uid and btype='Desk' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) and status='ok'";
		$result = mysql_query($b_chk_sql,$connect);
		if($result&&mysql_num_rows($result)>0){
			$booking = mysql_result($result,0,0);
		}
		@mysql_free_result($result);

		if($booking){
			if(!define("_BOOKING_")){
				redir_proc2("해당 날짜에 Desk로 예약되어있어서 Space는 예약할 수 없습니다.");
				exit;
			}else{
				redir_proc3("/".$uid,"해당 날짜에 Desk로 예약되어있어서 Space는 예약할 수 없습니다.");
				exit;
			}
		}
	}
	$Period_str = "월";
}elseif($gubun==2){

	if($btype=="1")		$btype_str = "1인실";
	elseif($btype=="2")	$btype_str = "2인실";
	elseif($btype=="4")	$btype_str = "4인실";
	elseif($btype=="6")	$btype_str = "6인실이상";
	elseif($btype=="O")	$btype_str = "오픈스페이스";
	elseif($btype=="D")	$btype_str = "Desk";

	if($g2_p=="M"){
		$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));
		$Period_str = "월";

		$b_chk_sql = "select uid from es_booking where puid=$uid and btype='$btype' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) and status='ok'";
	}else{
		$eDate = $sDate;
		$Period_str = "일";

		$b_chk_sql = "select uid from es_booking where puid=$uid and btype='$btype' and sDate='$sDate' and status='ok'";
	}

	$price = $g2_price;

}elseif($gubun==3){

}elseif($gubun==4){
	$eDate = $sDate;
	$price = $g4_price;
	$Period_str = "시간";
	$btype_str = "세미나/미팅룸";

	//예약가능시간인지 체크
	if($sTime&&$eTime){
		if($minHour>$sTime||$maxHour<$eTime){
			redir_proc3("/".$uid,"예약이 불가능한 시간입니다.");
			exit;
		}


		if(($eTime-$sTime)<$g4_hour1){
			if(!define("_BOOKING_")){
				redir_proc2("최소이용시간(".$g4_hour1."시간)이상을 선택하셔야합니다.");
				exit;
			}else{
				redir_proc3("/".$uid,"최소이용시간(".$g4_hour1."시간)이상을 선택하셔야합니다.");
				exit;
			}
		}
		if(($eTime-$sTime)>$g4_hour2){
			if(!define("_BOOKING_")){
				redir_proc2("최대이용시간(".$g4_hour2."시간)이상을 초과하실 수 없습니다.");
				exit;
			}else{
				redir_proc3("/".$uid,"최대이용시간(".$g4_hour2."시간)이상을 초과하실 수 없습니다.");
				exit;
			}
		}

		$diffTime = $eTime-$sTime;

		$b_chk_sql = "select uid from es_booking where puid=$uid and btype='$btype' and sDate='$sDate' and status='ok' and ((sTime<='$sTime' and eTime>'$sTime') or (sTime<='$eTime' and eTime>'$eTime'))";
	}else{
		$diffTime = 1;
	}

}
if($gubun!=1){
	if($b_chk_sql){
		$result = mysql_query($b_chk_sql,$connect);
		if($result&&mysql_num_rows($result)>0){
			$booking = mysql_result($result,0,0);
		}
		@mysql_free_result($result);

		if($booking){
			if(!define("_BOOKING_")){
				redir_proc2("이미 예약완료된 공간입니다.");
				exit;
			}else{
				redir_proc3("/".$uid,"이미 예약완료된 공간입니다.");
				exit;
			}
		}
	}else{

	}
}

$sDate_str = $day_str[date("w",strtotime($sDate))];
if($eDate)		$eDate_str = $day_str[date("w",strtotime($eDate))];

$etc_price = 0;
if($sc_1=="Y")		$etc_price += $s_1_price;
if($sc_2=="Y")		$etc_price += $s_2_price;
if($sc_3=="Y")		$etc_price += $s_3_price;

if($gubun==4){
	$total_price = $price*$diffTime+$e1_price+$e2_price+$etc_price;
}else{
	if($btype=="Space"||$btype=="1"||$btype=="2"||$btype=="4"||$btype=="6"){
		$total_price = $price+$e1_price+$e2_price+$etc_price;
	}else{
		$total_price = $price*$person+$e1_price+$e2_price+$etc_price;
	}
}

?>
