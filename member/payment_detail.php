<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";

$connect = dbcon();

if(!$kind)		$kind = 1;

if($uid){
	$result = mysql_query("select * from es_booking where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}

		if($pid!=$USESSION[0]&&auth_lev()!=9){
			redir_proc("back","본인의 예약내역이 아닙니다.");
			exit;
		}

		$buid = $uid;

		$b_name = $name;
		$b_email = $email;
		$b_mobile = $mobile;
		$b_comment = $comment;
	}
	@mysql_free_result($result);
	if($kind==1){
		$page_title = "결제대기";
	}elseif($kind==2){
		$page_title = "결제완료";
	}elseif($kind==3){
		$page_title = "취소";
	}elseif($kind==4){
		$page_title = "이용중";
	}elseif($kind==5){
		$page_title = "이용완료";
	}

	$result = mysql_query("select subject,gubun,g1_d,g1_d_price,g1_s,g1_s_price,g4_person,g4_price,g4_hour1,g4_hour2,e1,e1_price,e2,e2_price,p_limit,size1,size2,etc1,etc2,p_opt,address,pay_bank_1 ,pay_bank_2,pay_bank_3 from es_product where uid=$puid");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}
	}
	@mysql_free_result($result);

	$sDate = date("Y-m-d",strtotime($sDate));
	$sDate_arr = explode("-",$sDate);
	if($gubun==1){
		$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));

		if($btype=="Desk"){
			$price = $g1_d_price;
			$btype_str = "Desk";
		}elseif($btype=="Space"){
			$price = $g1_s_price;
			$btype_str = "Space";
		}
		$Period_str = "월";
	}elseif($gubun==2){
		$result = mysql_query("select * from es_product_g2 where uid=$btype",$connect);
		if($result&&mysql_num_rows($result)>0){
			$r = mysql_fetch_array($result);

			if($r["gName"]=="1")		$btype_str = "1인실";
			elseif($r["gName"]=="2")	$btype_str = "2인실";
			elseif($r["gName"]=="4")	$btype_str = "4인실";
			elseif($r["gName"]=="6")	$btype_str = "6인실이상";
			elseif($r["gName"]=="O")	$btype_str = "오픈스페이스";
			elseif($r["gName"]=="D")	$btype_str = "Desk";

			if($r["gPeriod"]=="M"){
				$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));
				$Period_str = "월";
			}else{
				$eDate = $sDate;
				$Period_str = "일";
			}

			$price = $r["gPrice"];
		}
		@mysql_free_result($result);
	}elseif($gubun==3){

	}elseif($gubun==4){
		$eDate = $sDate;
		$price = $g4_price;
		$Period_str = "시간";
		$btype_str = "세미나/미팅룸";
	}

	$sDate_str = $day_str[date("w",strtotime($sDate))];
	if($eDate)		$eDate_str = $day_str[date("w",strtotime($eDate))];

}else{
	redir_proc("back","잘못된 접근입니다.");
	exit;
}
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?=$map_client_id?>"></script>
<link rel="stylesheet" type="text/css" href="./_Map_css.css" />
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_view">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label"><?=$page_title?></div>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">예약정보</div>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_box_100">
										<div class="table_01">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<th align="left" valign="middle" scope="row">주소</th>
													<td align="left" valign="middle">
														<a href="/<?=$uid?>" target="_blank"><?=$address?></a>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">공간유형</th>
													<td align="left" valign="middle"><?=$gubun_arr[$gubun]?></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">수용인원</th>
													<td align="left" valign="middle"><?=$p_limit?>명</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">평수/실평수</th>
													<td align="left" valign="middle"><?=$size1?>평/<?=$size2?>평</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">이용일자</th>
													<td align="left" valign="middle">
														<?=date("Y.m.d",strtotime($sDate))?> (<?=$sDate_str?>)
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">종료일자</th>
													<td align="left" valign="middle">
														<?=date("Y.m.d",strtotime($eDate))?> (<?=$eDate_str?>)
													</td>
												</tr>
												<?if($gubun==4){?>
												<tr>
													<th align="left" valign="middle" scope="row">예약시간</th>
													<td align="left" valign="middle">
														<?=$sTime?>시 부터 <?=$eTime?>시 까지 <?=($eTime-$sTime)?>시간 이용
													</td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">예약형태</th>
													<td align="left" valign="middle">
														<?=$btype_str?> - <?=number_Format($price)?>원/<?=$Period_str?>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">인원</th>
													<td align="left" valign="middle">
														<?=$person?> 명
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">추가사항</th>
													<td align="left" valign="middle">
														<?if($e1=="Y"){?>
														<div class="plus_pay">
															+<?=number_Format($e1_price)?>원 (관리비/월)
														</div>
														<?}?>
														<?if($e2=="Y"){?>
														<div class="plus_pay">
															+<?=number_Format($e2_price)?>원 (청소비/월)
														</div>
														<?}?>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제방식</th>
													<td align="left" valign="middle">
														<div class="plus_pay"><?if($payment=="card")	echo "신용카드";	elseif($payment=="bank")	echo "무통장입금";	elseif($payment=="offline")		echo "현장결제";?></div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제 금액</th>
													<td align="left" valign="middle">
														<div class="total_pay">
															<?=number_Format($total_price)?>원
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">수수료</th>
													<td align="left" valign="middle">
														<div class="total_pay2">
															-23,500원
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">입금금액</th>
													<td align="left" valign="middle">
														<div class="total_pay3">
															223,500원
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">입금계좌</th>
													<td align="left" valign="middle">
														<div class="plus_pay">
															부산은행 1238912-31241-123
														</div>
													</td>
												</tr>
												<?if($payment=="bank"){?>
												<tr>
													<th align="left" valign="middle" scope="row">계좌번호</th>
													<td align="left" valign="middle">
														<div class="plus_pay"><?=$pay_bank_1." ".$pay_bank_2." ".$pay_bank_3?></div>
													</td>
												</tr>
												<?}?>
												<?if($status=="cancel"){?>
												<tr>
													<th align="left" valign="middle" scope="row">비고</th>
													<td align="left" valign="middle">
														<span class="color_cost">
															예약 취소가 완료되었습니다.
														</span>
													</td>
												</tr>
												<?}?>
											</table>
										</div>
									</div>
								</div>
								<?
								//예약자정보
								$result2 = mysql_query("select * from es_member where email='$id'");
								if($result2&&mysql_num_rows($result2)>0){
									$r2 = mysql_fetch_array($result2);
									foreach($r2 as $key=>$val){
										$$key = stripslashes($val);
									}
								}
								@mysql_free_result($result2);
								?>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">예약자정보</div>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_box_100">
										<div class="table_01">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<th align="left" valign="middle" scope="row">이름</th>
													<td align="left" valign="middle">
														<?=$b_name?>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">연락처</th>
													<td align="left" valign="middle"><?=$b_mobile?></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">이메일</th>
													<td align="left" valign="middle"><?=$b_email?></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">메모</th>
													<td align="left" valign="middle"><?=nl2br($comment)?></td>
												</tr>

												<?if($m_kind=="m2"){?>
												<tr>
													<th align="left" valign="middle" scope="row">업종</th>
													<td align="left" valign="middle">
														<?=$cetc?>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">직원 수</th>
													<td align="left" valign="middle">
														<?=$cperson?>명
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">사업기간</th>
													<td align="left" valign="middle">
														<?=$cdate1?>년 <?=$cdate2?>개월
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">사업내용</th>
													<td align="left" valign="middle">
														<?=nl2br($comment)?>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">사업자<br>등록번호</th>
													<td align="left" valign="middle">
														<a href="javascript:void(0)" onclick="onopen();" class="sing_btn_01">정보확인</a>
														<script language="JavaScript">
															function onopen(){
																var url =
																"http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=<?=str_replace('-','',$creg)?>";
																window.open(url, "communicationViewPopup", "width=750, height=700;");
															}
														</script>
													</td>
												</tr>
												<?}?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="view_fixed_all_wrap">
						<div class="view_fixed_wrap">
							<?if($kind==1||$kind==2){?>
							<div class="view_fixed_box">
								<a href="#" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/s_menu_close_btn.png">
									</span>
									<span class="view_fixed_cancel_txt">취소</span>
								</a>
							</div>
							<?}?>
							<div class="view_fixed_box">
								<a href="/member/payment.php" class="view_fixed_book_box ">
									<span class="view_fixed_book_icon">

									</span>
									<span class="view_fixed_book_txt">확인</span>
								</a>
							</div>
						</div>
					</div>
					<?if($kind==1||$kind==2){?>
					<div class="f_pop_wrap">
						<a href="/member/host_book_list.php?kind=3" class="f_pop_bg"></a>
						<div class="f_pop">
							<div class="f_pop_label2">취소 완료</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name2">
									취소가 완료되었습니다.
								</div>
							</div>
							<div class="f_pop_comment">
								코멘트
							</div>
							<div class="f_pop_close">
								<a href="/member/host_book_list.php?kind=3" class="f_pop_close_btn">확인</a>
							</div>
						</div>
					</div>
					<form name="eFrm" method="post" action="/space/_booking_proc.php" target="tempFrame">
						<input type="hidden" name="mode" id="mode">
						<input type="hidden" name="buid" id="buid" value="<?=$buid?>">
						<input type="hidden" name="kind" id="kind" value="<?=$kind?>">
						<input type="hidden" name="host" id="host" value="Y">
						<input type="hidden" name="page" id="page" value="<?=$page?>">
					</form>
					<script type="text/javascript">
					$(window).load(function(){
						$('.view_fixed_cancel_box').click(function(){
							if(confirm('신청취소하시겠습니까?')){
								$('#mode').val('cancel_ok');
								$('form[name=eFrm]').submit();
							}
						});
					});
					</script>
					<?}?>
				</div>
			</div>
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>