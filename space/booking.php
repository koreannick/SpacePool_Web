<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

foreach($_POST as $key => $val){
	$$key = bad_tag_convert2($val);
}

define("_BOOKING_",true);

require "_booking_chk_qry.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_book">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<form name="bFrm" method="post" action="/space/_booking_proc.php" target="tempFrame">
					<input type="hidden" name="mode" value="insert_ok">
					<input type="hidden" name="uid" value="<?=$uid?>">
					<input type="hidden" name="btype" value="<?=$btype?>">
					<input type="hidden" name="sDate" value="<?=$sDate?>">
					<input type="hidden" name="eDate" value="<?=$eDate?>">
					<input type="hidden" name="person" value="<?=$person?>">
					<input type="hidden" name="sTime" value="<?=$sTime?>">
					<input type="hidden" name="eTime" value="<?=$eTime?>">
					<input type="hidden" name="s_1" value="<?=$s_1?>">
					<input type="hidden" name="s_2" value="<?=$s_2?>">
					<input type="hidden" name="s_3" value="<?=$s_3?>">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">예약하기</div>
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

												<?if($gubun!=4){?>
												<tr>
													<th align="left" valign="middle" scope="row">평수/실평수</th>
													<td align="left" valign="middle"><?=$size1?>평/<?=$size2?>평</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">보증금</th>
													<td align="left" valign="middle"><?=number_Format($e3_price)?>원</td>
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
													<td align="left" valign="middle"><?=$OpenHour.":".$OpenTime?> ~ <?=$CloseHour.":".$CloseTime?></td>
												</tr>
												<?if($holiday){?>
												<tr>
													<th align="left" valign="middle" scope="row">휴무일</th>
													<td align="left" valign="middle"><?=$holiday?></td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">공간유형</th>
													<td align="left" valign="middle"><?=$gubun_arr[$gubun]?></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">수용인원</th>
													<td align="left" valign="middle"><?=$p_limit?>명</td>
												</tr>
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
												<?if($gubun!=1){?>
												<tr>
													<th align="left" valign="middle" scope="row">부가서비스</th>
													<td align="left" valign="middle">
														<?
														if($sc_1=="Y")		echo $s_1." (".number_format($s_1_price)."원)<br>";
														if($sc_2=="Y")		echo $s_2." (".number_format($s_2_price)."원)<br>";
														if($sc_3=="Y")		echo $s_3." (".number_format($s_3_price)."원)";
														?>
													</td>
												</tr>
												<?}?>
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
											</table>
										</div>
									</div>
								</div>

								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">보유시설</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<?
									for($i=1;$i<=count($p_opt_arr);$i++){
										if(preg_match("/:".$i.":/",$p_opt)){
									?>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/acc_<?=sprintf("%02d",$i)?>_on.png">
												</th>
												<td align="left" valign="middle"><?=$p_opt_arr[$i]?></td>
											</tr>
										</table>
									</div>
									<?
										}
									}?>
								</div>
								<?
								$result2 = mysql_query("select mobile from es_member where email='$USESSION[0]'");
								if($result2&&mysql_num_rows($result2)>0){
									$mobile = mysql_result($result2,0,0);
								}
								@mysql_free_result($result2);

								?>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">예약자정보</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이름</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="name" class="book_input_01" value="<?=$USESSION[1]?>" readonly placeholder="이름을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">연락처</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="mobile" class="book_input_01" value="<?=$mobile?>" readonly placeholder="(-)를 제외하고 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이메일</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="email" class="book_input_01" value="<?=$USESSION[0]?>" readonly placeholder="이메일을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">메모</div>
										<div class="s_view_desc_txt_desc">
											<textarea class="book_area_01" placeholder="남기고 싶은말을 적어주세요." name="comment"></textarea>
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">결제방법 선택</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="pay_type_wrap">
										<?if($pay_card=="Y"){?>
										<div class="pay_type">
											<input type="radio" name="payment" id="pay_card" value="card">
											<label for="pay_card">
												신용카드
											</label>
										</div>
										<?}?>
										<?if($pay_bank=="Y"){?>
										<div class="pay_type">
											<input type="radio" name="payment" id="pay_bank" value="bank">
											<label for="pay_bank">
												무통장입금
											</label>
										</div>
										<?}?>
										<?if($pay_offline=="Y"){?>
										<div class="pay_type">
											<input type="radio" name="payment" id="pay_offline" value="offline">
											<label for="pay_offline">
												현장결제
											</label>
										</div>
										<?}?>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">서비스 동의
									<div class="right_op_box_wrap">
										<div class="right_op_box">
											<input type="checkbox" name="" id="all_agree_chk">
											<label for="all_agree_chk">전체 동의</label>
										</div>
									</div>
									</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="agree_all_box_wrap">
										<div class="agree_box_wrap selected">
											<div class="agree_box">
												<div class="agree_label">
													<div class="agree_label_in">
														<input type="checkbox" name="" id="agree_01">
														<label for="agree_01">
															 공간약정서에 대한 동의 <span>(필수)</span>
														</label>
													</div>

												</div>
												<a href="javascript:void(0)">
													<span class="a_btn">열기/닫기</span>
												</a>
											</div>
											<div class="agree_desc_wrap">
												<div class="agree_desc">
													<textarea>1. 개인정보를 제공받는 자: 해당 공간의 호스트
2. 제공하는 개인정보 항목 - 필수항목: 네이버 아이디, 이름, 연락처, 결제정보(결제방식 및 결제금액)
- 선택항목: 이메일 주소

3. 개인정보의 제공목적: 공간예약 및 이용 서비스 제공, 환불처리
4. 개인정보의 제공기간: 서비스 제공기간(단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 및 사전 동의를 득한 경우에는 해당 기간 동안 보관합니다.)
5. 개인정보의 제공을 거부할 권리: 개인정보 주체는 개인정보의 제공을 거부할 권리가 있으나, 공간 예약을 위해 반드시 필요한 개인정보의 제공으로서 이를 거부할 시 공간 예약이 어려울 수 있습니다.
</textarea>
												</div>
											</div>
										</div>
										<div class="agree_box_wrap">
											<div class="agree_box">
												<div class="agree_label">
													<div class="agree_label_in">
														<input type="checkbox" name="" id="agree_02">
														<label for="agree_02">
															 개인정보이용처리방침 동의 <span>(필수)</span>
														</label>
													</div>

												</div>
												<a href="javascript:void(0)">
													<span class="a_btn">열기/닫기</span>
												</a>
											</div>
											<div class="agree_desc_wrap">
												<div class="agree_desc">
													<textarea>1. 개인정보를 제공받는 자: 해당 공간의 호스트
2. 제공하는 개인정보 항목 - 필수항목: 네이버 아이디, 이름, 연락처, 결제정보(결제방식 및 결제금액)
- 선택항목: 이메일 주소

3. 개인정보의 제공목적: 공간예약 및 이용 서비스 제공, 환불처리
4. 개인정보의 제공기간: 서비스 제공기간(단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 및 사전 동의를 득한 경우에는 해당 기간 동안 보관합니다.)
5. 개인정보의 제공을 거부할 권리: 개인정보 주체는 개인정보의 제공을 거부할 권리가 있으나, 공간 예약을 위해 반드시 필요한 개인정보의 제공으로서 이를 거부할 시 공간 예약이 어려울 수 있습니다.
</textarea>
												</div>
											</div>
										</div>
										<div class="agree_box_wrap">
											<div class="agree_box">
												<div class="agree_label">
													<div class="agree_label_in">
														<input type="checkbox" name="" id="agree_03">
														<label for="agree_03">
															 보안정책 동의 <span>(필수)</span>
														</label>
													</div>

												</div>
												<a href="javascript:void(0)">
													<span class="a_btn">열기/닫기</span>
												</a>
											</div>
											<div class="agree_desc_wrap">
												<div class="agree_desc">
													<textarea>1. 개인정보를 제공받는 자: 해당 공간의 호스트
2. 제공하는 개인정보 항목 - 필수항목: 네이버 아이디, 이름, 연락처, 결제정보(결제방식 및 결제금액)
- 선택항목: 이메일 주소

3. 개인정보의 제공목적: 공간예약 및 이용 서비스 제공, 환불처리
4. 개인정보의 제공기간: 서비스 제공기간(단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 및 사전 동의를 득한 경우에는 해당 기간 동안 보관합니다.)
5. 개인정보의 제공을 거부할 권리: 개인정보 주체는 개인정보의 제공을 거부할 권리가 있으나, 공간 예약을 위해 반드시 필요한 개인정보의 제공으로서 이를 거부할 시 공간 예약이 어려울 수 있습니다.
</textarea>
												</div>
											</div>
										</div>
										<div class="agree_box_wrap">
											<div class="agree_box">
												<div class="agree_label">
													<div class="agree_label_in">
														<input type="checkbox" name="" id="agree_04">
														<label for="agree_04">
															 환불정책에 대한 동의 <span>(필수)</span>
														</label>
													</div>

												</div>
												<a href="javascript:void(0)">
													<span class="a_btn">열기/닫기</span>
												</a>
											</div>
											<div class="agree_desc_wrap">
												<div class="agree_desc">
													<textarea>1. 개인정보를 제공받는 자: 해당 공간의 호스트
2. 제공하는 개인정보 항목 - 필수항목: 네이버 아이디, 이름, 연락처, 결제정보(결제방식 및 결제금액)
- 선택항목: 이메일 주소

3. 개인정보의 제공목적: 공간예약 및 이용 서비스 제공, 환불처리
4. 개인정보의 제공기간: 서비스 제공기간(단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 및 사전 동의를 득한 경우에는 해당 기간 동안 보관합니다.)
5. 개인정보의 제공을 거부할 권리: 개인정보 주체는 개인정보의 제공을 거부할 권리가 있으나, 공간 예약을 위해 반드시 필요한 개인정보의 제공으로서 이를 거부할 시 공간 예약이 어려울 수 있습니다.
</textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="view_fixed_all_wrap">
						<div class="view_fixed_wrap">
							<div class="view_fixed_box">
								<a href="javascript:history.back();" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/s_menu_close_btn.png">
									</span>
									<span class="view_fixed_cancel_txt">취소</span>
								</a>
							</div>
							<div class="view_fixed_box">
								<a href="javascript:void(0)" class="view_fixed_book_box">
									<span class="view_fixed_book_icon">
										<img src="/images/common/view_fixed_pay_icon.png">
									</span>
									<span class="view_fixed_book_txt">신청하기</span>
								</a>
							</div>
						</div>
					</div>
					</form>
					<script type="text/javascript">
					$(window).load(function(){
						$('input[name=payment]').each(function(i,elements){
							index = $(elements).index('input[name=payment]');
							if(index==0){
								$('input[name=payment]').eq(index).prop("checked","checked");
								$('input[name=payment]').eq(index).attr("checked","checked");
								$('input[name=payment]').eq(index).next("label").addClass('radio_on');
							}
						});

						$('.view_fixed_book_box').click(function(){
							if($('#agree_01').is(':checked')==false){
								alert('공간약정서에 대한 동의에 체크해주세요.');
								return;
							}
							if($('#agree_02').is(':checked')==false){
								alert('개인정보이용처리방침 동의에 체크해주세요.');
								return;
							}
							if($('#agree_03').is(':checked')==false){
								alert('보안정책 동의에 체크해주세요.');
								return;
							}
							if($('#agree_04').is(':checked')==false){
								alert('환불정책에 대한 동의에 체크해주세요.');
								return;
							}

							$('form[name="bFrm"]').submit();
						});
					});
					</script>

					<div class="f_pop_wrap">
						<a href="/member/book_list.php" class="f_pop_bg"></a>
						<div class="f_pop">
							<div class="f_pop_label2">신청 완료</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name2">
									신청 완료되었습니다.
								</div>
							</div>
							<div class="f_pop_comment">
								내역을 마이페이지에서<br> 확인하실 수 있습니다.
							</div>
							<div class="f_pop_close">
								<a href="/member/book_list.php" class="f_pop_close_btn">확인</a>
							</div>
						</div>
					</div>
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
