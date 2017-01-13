<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";

$connect = dbcon();

if($uid){
	$result = mysql_query("select g1_d,g1_d_price,g1_s,g1_s_price,g2,g2_p,g2_price,g3_t,g3_price,g4_person,g4_price,g4_hour1,g4_hour2,id,minHour,maxHour from es_product where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$g1_d = mysql_result($result,0,0);
		$g1_d_price = mysql_result($result,0,1);
		$g1_s = mysql_result($result,0,2);
		$g1_s_price = mysql_result($result,0,3);
		$g2 = mysql_result($result,0,4);
		$g2_p = mysql_result($result,0,5);
		$g2_price = mysql_result($result,0,6);
		$g3_t = mysql_result($result,0,7);
		$g3_price = mysql_result($result,0,8);
		$g4_person = mysql_result($result,0,9);
		$g4_price = mysql_result($result,0,10);
		$g4_hour1 = mysql_result($result,0,11);
		$g4_hour2 = mysql_result($result,0,12);
		$id = mysql_result($result,0,13);
		$minHour = mysql_result($result,0,14);
		$maxHour = mysql_result($result,0,15);

		if($id!=$USESSION[0]&&auth_lev()!=9){
			redir_proc3("/member/space_host.php","본인데이터가 아니므로 수정하실 수 없습니다.");
			exit;
		}
	}
	@mysql_free_result($result);
}else{
	$minHour = 9;
	$maxHour = 18;
}
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
						<form name="form0" target="" method="get" action="space_apply3.php">
						<input type="hidden" name="gubun" id="gubun" value="<?=$gubun?>">
						<input type="hidden" name="subject" value="<?=rawurlencode($subject)?>">
						<?if($uid){?>
						<input type="hidden" name="uid" value="<?=$uid?>">
						<?}?>
						<div class="page_label_wrap">
							<div class="page_label">공간<?if($uid)		echo "수정";		else		echo "등록";?></div>
						</div>
						<div class="m_top_nav_wrap">
							<a href="javascript:void(0)" class="">1. 공간타입</a>
							<a href="javascript:void(0)" class="active">2. 가격설정</a>
							<a href="javascript:void(0)" class="">3. 정보입력</a>
						</div>
						<div class="s_view_desc">
							<div class="space_box">
								<?if($gubun==1){?>
								<!-- 쉐어오피스 시작-->
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간유형 선택<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input type="checkbox" name="g1_d" id="sp_st_desk" value="Y" <?if($g1_d=="Y")		echo "checked=\"checked\"";?>>
											<label for="sp_st_desk" <?if($g1_d=="Y")		echo "class=\"checkbox_on\"";?>>Desk - 책상단위당 공유</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g1_d_price" id="g1_d_price" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g1_d_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input type="checkbox" name="g1_s" id="sp_st_space" value="Y" <?if($g1_s=="Y")		echo "checked=\"checked\"";?>>
											<label for="sp_st_space" <?if($g1_s=="Y")		echo "class=\"checkbox_on\"";?>>Space - 방 전체 공유</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g1_s_price" id="g1_s_price" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g1_s_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="help_txt">
										Share office 의 경우 하나의 공간을 두가지 유형으로 등록할 수 있습니다.
										책상단위 당 공유는 Desk, 방 전체를 공유하려면 Space 를 선택하세요.
										두가지 유형 모두 선택하는것도 가능합니다.
										단, Desk 에 예약이 발생 할 경우 Space 유형은 자동으로 비활성화 되며
										남는 Desk 가 있을경우에는 Desk가 계속 활성화 됩니다.
									</div>
								</div>
								<!-- 쉐어오피스 끝-->
								<?}elseif($gubun==2){?>
								<!-- 서비스드오피스 시작-->
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간유형 선택<span>*</span>
									</div>
									<!-- <div class="space_box_label_right">
										<a href="javascript:Add_G();" class="add_btn">
											+ 추가
										</a>
									</div> -->
								</div>
								<div class="space_box_input">
									<div class="input_table">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" id="GroupOption">
											<tr>
												<th align="center" valign="middle" scope="col" class="tb_01">공간유형</th>
												<th align="center" valign="middle" scope="col" class="tb_02" >기간(월,일)</th>
												<th align="center" valign="middle" scope="col" class="tb_03">가격입력</th>
											</tr>

											<tr>
												<td align="left" valign="middle" class="tb_01">
													<select name="g2" id="g2">
														<option value="1" <?if($g2=="1")		echo " selected";?>>1인실</option>
														<option value="2" <?if($g2=="2")		echo " selected";?>>2인실</option>
														<option value="4" <?if($g2=="4")		echo " selected";?>>4인실</option>
														<option value="6" <?if($g2=="6")		echo " selected";?>>6인실이상</option>
														<option value="O" <?if($g2=="O")		echo " selected";?>>오픈스페이스</option>
														<option value="D" <?if($g2=="D")		echo " selected";?>>Desk</option>
													</select>
												</td>
												<td align="right" valign="middle" class="tb_02">
													<select name="g2_p" id="g2_p">
														<option value="M" <?if($g2_p=="M")		echo " selected";?>>월</option>
														<option value="D" <?if($g2_p=="D")		echo " selected";?>>일</option>
													</select>
												</td>
												<td align="right" valign="middle" class="tb_03">
													<input type="text" name="g2_price" id="g2_price" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g2_price?>">
												</td>
											</tr>



										</table>
									</div>
								</div>
								<!-- 서비스드오피스 끝-->
								<?}elseif($gubun==3){?>
								<!-- 가상오피스 시작-->
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간유형 선택<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="space_st_wrap2">
										<div class="space_st_top pay_type">
											<input type="radio" name="g3_t" id="sp_class_01" value="Bronze"  <?if($g3_t=="Bronze")		echo "checked=\"checked\"";?>>
											<label for="sp_class_01" <?if($g3_t=="Bronze")		echo "class=\"checkbox_on\"";?>>Bronze</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g3_price1" id="g3_price1" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g3_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap2">
										<div class="space_st_top pay_type">
											<input type="radio" name="g3_t" id="sp_class_02" value="Silver" <?if($g3_t=="Silver")		echo "checked=\"checked\"";?>>
											<label for="sp_class_02" <?if($g3_t=="Silver")		echo "class=\"checkbox_on\"";?>>Silver</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g3_price2" id="g3_price2" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g3_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap2">
										<div class="space_st_top pay_type">
											<input type="radio" name="g3_t" id="sp_class_03" value="Gold" <?if($g3_t=="Gold")		echo "checked=\"checked\"";?>>
											<label for="sp_class_03" <?if($g3_t=="Gold")		echo "class=\"checkbox_on\"";?>>Gold</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g3_price3" id="g3_price3" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g3_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap2">
										<div class="space_st_top pay_type">
											<input type="radio" name="g3_t" id="sp_class_04" value="Platinum" <?if($g3_t=="Platinum")		echo "checked=\"checked\"";?>>
											<label for="sp_class_04" <?if($g3_t=="Platinum")		echo "class=\"checkbox_on\"";?>>Platinum</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="g3_price4" id="g3_price4" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g3_price?>">
											<span>원/월</span>
										</div>
									</div>
								</div>
								<!-- 가상오피스 끝-->
								<?}elseif($gubun==4){?>
								<!-- 세미나/미팅룸 시작-->
								<div class="space_box_label">
									<div class="space_box_label_left">
										가격 설정<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="sp_semi_wrap">
										<span>세미나/미팅룸 : </span>
										<span>
											<input type="text" name="g4_price" id="g4_price" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$g4_price?>">원/시간
										</span>
									</div>

								</div>
								<!-- 세미나/미팅룸 끝-->
								<?}?>
							</div>
						</div>
						<div class="s_view_btn_wrap">
							<div class="s_view_btn_in">
								<a href="javascript:history.back(-1)" class="s_view_btn_fav">
									<div>
										<span class="s_view_btn_txt">이전</span>
									</div>
								</a>
								<a href="javascript:Save_Go();" class="s_view_btn_book">
									<div>
										<span class="s_view_btn_txt">다음</span>
									</div>
								</a>
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
