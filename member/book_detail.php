<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

if(!$kind)		$kind = 1;

if($uid){
	$result = mysql_query("select * from es_booking where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}

		if($id!=$USESSION[0]){
			redir_proc("back","본인의 예약내역이 아닙니다.");
			exit;
		}

		$buid = $uid;
	}
	@mysql_free_result($result);

	if($status=="ok"){
		if($pay_status=="N"){
			$kind = 1;
		}else{
			if($eDate<date("Y-m-d")||($eDate==date("Y-m-d")&&$eTime<=date("H"))){
				$kind = 4;
			}else{
				if(($sDate<=date("Y-m-d")&&$eDate>=date("Y-m-d"))||($eDate==date("Y-m-d")&&$eTime>date("H"))){
					$kind = 3;
				}else{
					$kind = 1;
				}
			}
		}
	}elseif($status=="cancel"){
		$kind = 2;
	}

	if($kind==1){
		$page_title = "신청/결제";
	}elseif($kind==2){
		$page_title = "취소/환불";
	}elseif($kind==3){
		$page_title = "이용중";
	}elseif($kind==4){
		$page_title = "이용완료";
	}

	$result = mysql_query("select subject,gubun,g1_d,g1_d_price,g1_s,g1_s_price,g2,g2_p,g2_price,g4_person,g4_price,g4_hour1,g4_hour2,e1,e1_price,e2,e2_price,p_limit,size1,size2,etc1,etc2,p_opt,pay_bank_1 ,pay_bank_2,pay_bank_3,e3_price,OpenHour,CloseHour,holiday,addr1,addr2 from es_product where uid=$puid");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}
		$address = $addr1." ".$addr2;
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
		if($g2=="1")		$btype_str = "1인실";
		elseif($g2=="2")	$btype_str = "2인실";
		elseif($g2=="4")	$btype_str = "4인실";
		elseif($g2=="6")	$btype_str = "6인실이상";
		elseif($g2=="O")	$btype_str = "오픈스페이스";
		elseif($g2=="D")	$btype_str = "Desk";

		if($g2_p=="M"){
			$eDate = date("Y-m-d",mktime(0,0,0,$sDate_arr[1]+1,$sDate_arr[2],$sDate_arr[0]));
			$Period_str = "월";
		}else{
			$eDate = $sDate;
			$Period_str = "일";
		}

		$price = $g2_price;
	}elseif($gubun==3){

	}elseif($gubun==4){
		$eDate = $sDate;
		$price = $g4_price;
		$Period_str = "시간";
		$btype_str = "세미나/미팅룸";
	}

	$sDate_str = $day_str[date("w",strtotime($sDate))];
	if($eDate)		$eDate_str = $day_str[date("w",strtotime($eDate))];

	//HOST정보
	$result2 = mysql_query("select company,tel,mobile,profile_image,n_talk from es_member where email='$id'");
	if($result2&&mysql_num_rows($result2)>0){
		$company = stripslashes(mysql_result($result2,0,0));
		$tel = mysql_result($result2,0,1);
		$mobile = mysql_result($result2,0,2);
		$profile_image = mysql_result($result2,0,3);
		$n_talk = mysql_result($result2,0,4);

		if(!$n_talk)		$n_talk = "#";
	}
	@mysql_free_result($result2);

	$id_arr = explode("@",$id);
	$host_id = $id_arr[0];
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
<link rel="stylesheet" type="text/css" href="/space/_Map_css.css" />
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
												<?if($gubun!=4){?>
												<tr>
													<th align="left" valign="middle" scope="row">평수/실평수</th>
													<td align="left" valign="middle"><?=$size1?>평/<?=$size2?>평</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">보증금</th>
													<td align="left" valign="middle"><?=number_Format($e3_price)?>만원</td>
												</tr>
												<?}?>
												<?if($etc1){?>
												<tr>
													<th align="left" valign="middle" scope="row">입주희망업종</th>
													<td align="left" valign="middle"><?=$etc1?></td>
												</tr>
												<?}?>
												<?if($etc2){?>
												<tr>
													<th align="left" valign="middle" scope="row">입주가능시기</th>
													<td align="left" valign="middle"><?=$etc2?></td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">운영시간</th>
													<td align="left" valign="middle"><?=$OpenHour?> ~ <?=$CloseHour?></td>
												</tr>
												<?if($holiday){?>
												<tr>
													<th align="left" valign="middle" scope="row">휴무일</th>
													<td align="left" valign="middle"><?=$holiday?></td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">이용기간</th>
													<td align="left" valign="middle">
														<?=date("Y.m.d",strtotime($sDate))?> (<?=$sDate_str?>) ~ <?=date("Y.m.d",strtotime($eDate))?> (<?=$eDate_str?>)
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
													<th align="left" valign="middle" scope="row">결제 금액</th>
													<td align="left" valign="middle">
														<div class="total_pay">
															<?=number_Format($total_price)?>원
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제방식</th>
													<td align="left" valign="middle">
														<div class="plus_pay"><?if($payment=="card")	echo "신용카드";	elseif($payment=="bank")	echo "무통장입금";	elseif($payment=="offline")		echo "현장결제";?></div>
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
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">지도</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<?require "../space/Map.php";?>
								<div class="s_view_info_box">
									<div class="s_view_host_info_wrap">
										<div class="s_view_host_info_left">
											<div class="s_view_host_info_img">
												<a href="/<?=$host_id?>" target="_blank">
													<img src="<?=$profile_image?>" alt="<?=$company?>" title="<?=$company?>" onerror="this.src='/images/small_logo.png';">
												</a>
											</div>
										</div>
										<div class="s_view_host_info_right">
											<div class="s_view_host_label">HOST</div>
											<div class="s_view_host_name"><?=$company?></div>
											<div class="s_view_host_address"><?=urldecode($address)?></div>
										</div>
									</div>
								</div>
								<?
								//후기작성시
								$review = false;
								$result2 = mysql_query("select * from es_product_review where buid=$buid and id='$USESSION[0]' order by uid desc");
								if($result2&&mysql_num_rows($result2)>0){
									$review = true;
								?>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">이용후기</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="view_board_wrap">
										<div class="view_board">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<th align="center" valign="middle" scope="col">이용후기</th>
													<th width="100" align="center" valign="middle" scope="col">만족도</th>
													<th width="100" align="center" valign="middle" scope="col">닉네임</th>
													<th width="100" align="center" valign="middle" scope="col">등록일</th>
												</tr>
												<?
												while($r2=mysql_fetch_array($result2)){
												?>
												<tr>
													<td align="left" valign="middle"><?=stripslashes($r2["comment"])?></td>
													<td width="100" align="center" valign="middle">
														<img src="/images/common/star_<?=$r2["score"]?>.png">
													</td>
													<td width="100" align="center" valign="middle"><?=$r2["nickname"]?></td>
													<td width="100" align="center" valign="middle"><?=date("Y.m.d",$r2["wdate"])?></td>
												</tr>
												<?
												}
												?>
											</table>
										</div>
									</div>
								</div>
								<?
								}
								@mysql_free_result($result2);
								?>
							</div>
						</div>
					</div>
					<div class="view_fixed_all_wrap">
						<div class="view_fixed_wrap">
							<?if($kind==1){?>
							<div class="view_fixed_box">
								<a href="#" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/s_menu_close_btn.png">
									</span>
									<span class="view_fixed_cancel_txt">신청취소</span>
								</a>
							</div>
							<div class="view_fixed_box">
								<a href="<?=$n_talk?>" class="view_fixed_book_box "<?if($n_talk)	echo " target=\"_blank\"";?>>
									<span class="view_fixed_book_icon">
										<img src="/images/common/talk.png">
									</span>
									<span class="view_fixed_book_txt">네이버톡톡</span>
								</a>
							</div>
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
							<?}elseif($kind==2){?>
							<div class="view_fixed_box">
								<a href="/member/book_list.php?kind=<?=$kind?>&page=<?=$page?>" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/s_menu_close_btn.png">
									</span>
									<span class="view_fixed_cancel_txt">뒤로가기</span>
								</a>
							</div>
							<?}elseif($kind==3){?>
							<div class="view_fixed_box">
								<a href="/member/book_list.php?kind=<?=$kind?>&page=<?=$page?>" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/review_icon.png">
									</span>
									<span class="view_fixed_cancel_txt">뒤로가기</span>
								</a>
							</div>
							<?
							}elseif($kind==4){
								if(!$review){
							?>
								<div class="view_fixed_box">
									<a href="#" class="view_fixed_cancel_box pay_end">
										<span class="view_fixed_cancel_icon">
											<img src="/images/common/review_icon.png">
										</span>
										<span class="view_fixed_cancel_txt">후기작성</span>
									</a>
								</div>
								<?}else{?>
								<div class="view_fixed_box">
									<a href="/member/book_list.php?kind=<?=$kind?>&page=<?=$page?>" class="view_fixed_cancel_box">
										<span class="view_fixed_cancel_icon">
											<img src="/images/common/review_icon.png">
										</span>
										<span class="view_fixed_cancel_txt">뒤로가기</span>
									</a>
								</div>
								<?}?>
							<div class="view_fixed_box">
								<a href="<?=$n_talk?>" class="view_fixed_book_box "<?if($n_talk)	echo " target=\"_blank\"";?>>
									<span class="view_fixed_book_icon">
										<img src="/images/common/talk.png">
									</span>
									<span class="view_fixed_book_txt">네이버톡톡</span>
								</a>
							</div>
							<?}?>
						</div>
					</div>

					<?if($kind==1){?>
					<div class="f_pop_wrap">
						<a href="#내역" class="f_pop_bg"></a>
						<div class="f_pop">
							<div class="f_pop_label2">취소 완료</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name2">
									취소가 완료되었습니다.
								</div>
							</div>
							<div class="f_pop_comment">
								내역을 마이페이지에서<br> 확인 및 수정할 수 있습니다.
							</div>
							<div class="f_pop_close">
								<a href="/member/book_list.php?kind=2" class="f_pop_close_btn">확인</a>
							</div>
						</div>
					</div>
					<?}elseif($kind==2){?>

					<?}elseif($kind==3){?>
					<?
					}elseif($kind==4){
						if(!$review){
					?>
					<div class="f_pop_wrap">
						<a href="#내역" class="f_pop_bg"></a>
						<div class="f_pop">
							<form name="rFrm" method="post" action="/space/_booking_proc.php" target="tempFrame">
							<input type="hidden" name="mode" id="mode" value="review_ok">
							<input type="hidden" name="puid" id="puid" value="<?=$puid?>">
							<input type="hidden" name="buid" id="buid" value="<?=$buid?>">
							<input type="hidden" name="kind" id="kind" value="<?=$kind?>">
							<input type="hidden" name="page" id="page" value="<?=$page?>">
							<div class="f_pop_label3">후기작성</div>
							<div class="f_pop_review">
								<div class="review_star">
									<div class="review_label">별점</div>
									<div class="view_board_write_select">
										<div class="star_wrap">
											<div class="star_top txt_none star_04">
												<div class="star_input">
													<span>만족도를 선택하세요.</span>
													<div class="star_img_view"></div>
												</div>
												<a href="javascript:void(0)" class="star_open">열기</a>
											</div>
											<div class="star_option" style="display: none; height: 0px;">
												<label for="star_5" class="star_label_05">
												</label>
												<input type="radio" name="score" id="star_5" value="star_05" >
												<label for="star_4" class="star_label_04">
												</label>
												<input type="radio" name="score" id="star_4" value="star_04" checked>
												<label for="star_3" class="star_label_03">
												</label>
												<input type="radio" name="score" id="star_3" value="star_03">
												<label for="star_2" class="star_label_02">
												</label>
												<input type="radio" name="score" id="star_2" value="star_02">
												<label for="star_1" class="star_label_01">
												</label>
												<input type="radio" name="score" id="star_1" value="star_01">
											</div>
										</div>
										<script type="text/javascript">
											$(document).ready(function(){
												$(".star_open").click(function(){
													if($(".star_option ").css("display") == "none"){
														$('.star_option').show();
														$('.star_option').animate({
															height: "145px"
														}, 200);
													} else {
														$('.star_option').animate({
															height: "0px"
														}, 200);
														$('.star_option').hide({
														}, 10);
													}
												})
											});
											$(document).ready(function(){
												$(".star_option input").on('change', function() {
													var selectStar_name = $('.star_option input:checked').val();
													$('.star_top').addClass("txt_none");
													$('.star_top').removeClass("star_01");
													$('.star_top').removeClass("star_02");
													$('.star_top').removeClass("star_03");
													$('.star_top').removeClass("star_04");
													$('.star_top').removeClass("star_05");
													$('.star_top').addClass(selectStar_name);
													$('.star_option').animate({
														height: "0px"
													}, 200);
													$('.star_option').hide({
													}, 10);
												});
											});
										</script>
									</div>
								</div>
							</div>
							<div class="f_pop_review_input">
								<div class="f_pop_review_input_in">
									<div class="review_label">후기내용</div>
									<div class="view_board_write_select">
										<textarea name="comment" id="comment"></textarea>
									</div>
								</div>
							</div>
							<div class="f_pop_close">
								<a href="#" class="f_pop_close_btn">확인</a>
							</div>
							</form>
							<script type="text/javascript">
							$(window).load(function(){
								$('.f_pop_close_btn').click(function(){
									$('.f_pop_wrap').show();

									if(CheckStr($('#comment').val()," ","")==0){
										alert('후기내용을 입력하세요.');
										$('#comment').focus();
										return;
									}
									$('form[name=rFrm]').submit();
								});
							});
							</script>
						</div>
					</div>
					<?}
					}
					?>

					<form name="eFrm" method="post" action="/space/_booking_proc.php" target="tempFrame">
						<input type="hidden" name="mode" id="mode">
						<input type="hidden" name="buid" id="buid" value="<?=$buid?>">
						<input type="hidden" name="kind" id="kind" value="<?=$kind?>">
						<input type="hidden" name="page" id="page" value="<?=$page?>">
					</form>
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