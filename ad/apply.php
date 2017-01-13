<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member sp_apply">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
							<a href="/partner/contact.php" class="">제휴문의</a>
							<a href="/ad/apply.php" class="active">광고 신청</a>
							<!-- <a href="/ad/ad_set.php" class="">광고 관리</a> -->
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="space_box">
									<div class="s_view_info_box">
										<div class="s_view_info_label_wrap">
											<div class="s_view_info_label">광고신청
												<span class="label_span"><b>*</b>광고기간은 1달 기준입니다.</span>
											</div>
										</div>
										<div class="s_view_info_box_100">
											<div class="table_01">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tbody>
														<tr>
															<th align="left" valign="middle" scope="row">광고타입</th>
															<td align="left" valign="middle">
																<div class="pay_type_wrap">
																	<div class="pay_type">
																		<input type="radio" name="adtype" id="adtype_01" value="" checked="">
																		<label for="adtype_01">
																			인기공간배너노출광고 - 2만원/월
																		</label>
																	</div>
																</div>
																<div class="pay_type_wrap">
																	<div class="pay_type">
																		<input type="radio" name="adtype" id="adtype_02" value="" >
																		<label for="adtype_02">
																			이벤트광고 - 10만원/15일
																		</label>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<th align="left" valign="middle" scope="row">광고시작일</th>
															<td align="left" valign="middle">
																<input type="text" name="sDate" id="sDate" placeholder="년/월/일" value="2016.11.02" class="sign_input_03" maxlength="10" required="required" readonly="">
															</td>
														</tr>
														<tr>
															<th align="left" valign="middle" scope="row">결제 금액</th>
															<td align="left" valign="middle">
																<div class="total_pay">
																	20,000원
																</div>
															</td>
														</tr>
													</tbody></table>
												</div>
												<div class="s_view_btn_all_wrap" id="non_btn">
													<div class="s_view_btn_wrap">
														<div class="s_view_btn_in">
															<a href="javascript:history.back()" class="s_view_btn_fav">
																<div>
																	<span class="s_view_btn_txt">취소</span>
																</div>
															</a>
															<a href="#" class="s_view_btn_book">
																<div>
																	<span class="s_view_btn_txt">결제하기</span>
																</div>
															</a>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
	<script type="text/javascript">
		function Save_Go(){
			<?if($gubun==1){?>
				if($('#sp_st_desk').is(':checked')==false&&$('#sp_st_space').is(':checked')==false){
					alert('공간유형을 선택해주세요.');
					return;
				}
				if($('#sp_st_desk').is(':checked')&&$('#g1_d_price').val()==""){
					alert('책상단위당 가격을 입력해주세요.');
					$('#g1_d_price').focus();
					return;
				}
				if($('#sp_st_space').is(':checked')&&$('#g1_s_price').val()==""){
					alert('방 전체 가격을 입력해주세요.');
					$('#g1_s_price').focus();
					return;
				}
				<?}elseif($gubun==2){?>
					if($('#gPrice_1').val()==""){
						alert('가격을 입력해주세요.');
						$('#gPrice_1').focus();
						return;
					}
					<?}elseif($gubun==3){?>
						if($('#sp_class_01').is(':checked')&&$('#g3_price1').val()==""){
							alert('Bronze 가격을 입력해주세요.');
							$('#g3_price1').focus();
							return;
						}
						if($('#sp_class_02').is(':checked')&&$('#g3_price2').val()==""){
							alert('Silver 가격을 입력해주세요.');
							$('#g3_price2').focus();
							return;
						}
						if($('#sp_class_03').is(':checked')&&$('#g3_price3').val()==""){
							alert('Gold 가격을 입력해주세요.');
							$('#g3_price3').focus();
							return;
						}
						if($('#sp_class_04').is(':checked')&&$('#g3_price4').val()==""){
							alert('Platinum 가격을 입력해주세요.');
							$('#g3_price4').focus();
							return;
						}
						<?}elseif($gubun==4){?>
							if($('#g4_person').val()==""){
								alert('수용인원을 입력해주세요.');
								$('#g4_person').focus();
								return;
							}
							if($('#g4_price').val()==""){
								alert('가격을 입력해주세요.');
								$('#g4_price').focus();
								return;
							}
							if($('#g4_hour1').val()==""){
								alert('최소이용시간을 입력해주세요.');
								$('#g4_hour1').focus();
								return;
							}
							if($('#g4_hour2').val()==""){
								alert('최대이용시간을 입력해주세요.');
								$('#g4_hour2').focus();
								return;
							}
							<?}?>

							$('form[name="form0"]').submit();
						}
					</script>
				</body>
				</html>