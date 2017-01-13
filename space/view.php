<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

$table = "es_product";

if($uid){


	$result = mysql_query("select * from $table where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}

		if($status=="wait"){
			redir_proc("back","사용할수 없는 데이터입니다.");
			exit;
		}

		$address = $addr1." ".$addr2;
		$c_phone = $c_phone;

		if($bimg){
			//put_gdimage($bimg, 2000, 474, $bimg,"$table");
		}
		for($i=1;$i<=6;$i++){
			if(${"img".$i}){
				//put_gdimage(${"img".$i}, 2000, 474, ${"img".$i},"$table");
			}
		}

		//HOST정보
		$result2 = mysql_query("select company,tel,mobile,profile_image from es_member where email='$id'");
		if($result2&&mysql_num_rows($result2)>0){
			$company = stripslashes(mysql_result($result2,0,0));
			$tel = mysql_result($result2,0,1);
			$mobile = mysql_result($result2,0,2);
			$profile_image = mysql_result($result2,0,3);
		}
		@mysql_free_result($result2);

		$id_arr = explode("@",$id);
		$host_id = $id_arr[0];
	}
	@mysql_free_result($result);
}else{
	redir_proc("back","잘못된 접근입니다.");
	exit;
}
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?=$n_client_id?>"></script>
<link rel="stylesheet" type="text/css" href="/space/_Map_css.css" />
<link rel="stylesheet" href="/space/calendar.css" />
<script type="text/javascript" src="/space/calendar.js"></script>
<script type="text/javascript" src="/s_inc/js_string.js"></script>
<SCRIPT src="/js/jquery.bxslider.min.js"></SCRIPT>
<?if($gubun==4){?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<?}?>

<style>
        .black_overlay{
            display: none;
            position: fixed;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 1500px;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=80);
        }
        .white_content {
            display: none;
            position: fixed;;
            top: 15%;
            left: 25%;
            width: 50%;
            height: 50%;
            padding: auto;
        }
    </style>

</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_view">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="sub_visual_wrap" style="height: 550px;">
				<div class="sub_visual">
					<div class="slider2">
						<ul class="bxslider2">
							<?
							if($bimg){
							?>
							<li>
								<img src="/DATAS/<?=$table?>/<?=$bimg?>"style="width: 100%" alt="">
							</li>
							<?
							}
							for($i=1;$i<=6;$i++){
								if(${"img".$i}){
							?>
							<li>
								<img src="/DATAS/<?=$table?>/<?=${"img".$i}?>"  style="width: 100%" alt="">
							</li>
							<?}
							}
							?>
						</ul>
					</div>
					<div class="view_visual_wrap">
						<?
						$wish_chk = false;
						$result2 = mysql_query("select uid from es_product_wish where puid=$uid and id='$USESSION[0]'");
						if($result2&&mysql_num_rows($result2)>0){
							$wish_chk = true;
						}
						@mysql_free_result($result2);
						?>
						<div class="view_visual_love">
							<input type="checkbox" name="wish" id="love_chk" <?if($wish_chk)		echo "checked";?>>
							<label for="love_chk">
								<div class="love_chk_off">
									<img src="/images/common/love_chk.png">
								</div>
								<div class="love_chk_on">
									<img src="/images/common/love_chk_on.png">
								</div>
							</label>
							<form name="wFrm" method="post" action="/member/_product_proc.php" target="tempFrame">
							<input type="hidden" name="mode" value="wish_ok">
							<input type="hidden" name="uid" value="<?=$uid?>">
							</form>
						</div>
					</div>
					<?
					//후기 평균점수
					$re_score_avg = 0;
					$result3 = mysql_query("select count(uid),sum(score) from es_product_review where puid=$uid");
					if($result3&&mysql_num_rows($result3)>0){
						$re_cnt = mysql_result($result3,0,0);
						$re_score = mysql_result($result3,0,1);

						if($re_cnt>0&&$re_score>0)		$re_score_avg = ceil($re_score/$re_cnt);

					}
					@mysql_free_result($result3);

					if($re_score_avg>0){
						if($re_score_avg>5)		$re_score_avg = 5;
					?>
					<div class="pt_box_star">
						<img src="/images/common/star_b_0<?=$re_score_avg?>.png">
					</div>
					<?}?>
					<script type="text/javascript">
						$(document).ready(function(){
							var slider2 = $('.bxslider2').bxSlider({
								auto: true,
								autoControls: false,
								useCSS: false,
								mode: 'fade'
							});
						});
					</script>
				</div>
			</div>
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="s_view_title_wrap">
							<div class="s_view_sns">
								<?php virtual('/include/sns.php'); ?>
							</div>
							<div class="s_view_title">
								<div class="s_view_title_txt">
									<?=$subject?>
								</div>
							</div>
						</div>

						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_nav_point">
									<div id="s_view_nav_info"></div>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_box_50">
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
												<div class="s_view_host_address"><?=$address?></div>
											</div>
										</div>
									</div>
									<div class="s_view_info_box_50">
										<div class="s_view_mini_info">
											<div class="s_view_mini_info_box">
												<div class="s_view_mini_info_box_img">
													<img src="/images/icon/icon_share.png">
												</div>
												<div class="s_view_mini_info_box_txt">
													<?=$gubun_arr[$gubun]?>
												</div>
											</div>
											<div class="s_view_mini_info_box">
												<div class="s_view_mini_info_box_img">
													<img src="/images/icon/icon_desk.png">
												</div>
												<div class="s_view_mini_info_box_txt" id="btype_str">
													<?
													if($gubun==1){
														if($g1_d=="Y"&&$g1_s=="Y"){
															echo "Desk";

															$price = $g1_d_price;
														}elseif($g1_d=="Y"&&$g1_s=="N"){
															echo "Desk";

															$price = $g1_d_price;
														}elseif($g1_d=="N"&&$g1_s=="Y"){
															echo "Space";

															$price = $g1_s_price;
														}
													}elseif($gubun==2){
														if($g2=="1"){
															$gName_str = "1인실";
															$p_limit = 1;
														}elseif($g2=="2"){
															$gName_str = "2인실";
															$p_limit = 2;
														}elseif($g2=="4"){
															$gName_str = "4인실";
															$p_limit = 4;
														}elseif($g2=="6"){
															$gName_str = "6인실이상";
														}elseif($g2=="O"){
															$gName_str = "오픈스페이스";
														}elseif($g2=="D"){
															$gName_str = "Desk";
														}

														echo $gName_str;
														$price = $g2_price;
													}elseif($gubun==3){
													}elseif($gubun==4){
														echo "세미나/미팅룸";

														$price = $g4_price;
													}
													?>

												</div>
											</div>
											<div class="s_view_mini_info_box">
												<div class="s_view_mini_info_box_img">
													<img src="/images/icon/icon_person.png">
												</div>
												<div class="s_view_mini_info_box_txt">
													<?=$p_limit?>명 한도
												</div>
											</div>
										</div>
									</div>
								</div>
								<form name="bFrm" method="post" action="/space/_booking_chk.php" target="tempFrame">
								<input type="hidden" name="mode" id="mode">
								<input type="hidden" name="uid" value="<?=$uid?>">
								<input type="hidden" name="gubun" id="gubun" value="<?=$gubun?>">
								<div class="s_view_info_box">
									<div class="s_view_info_box_100">
										<div class="table_01">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
													<?if($OpenHout<10){?>
													<td align="left" valign="middle"><?=$OpenHour.":0".$OpenTime?> ~ <?=$CloseHour.":0".$CloseTime?></td>
													<?}else{?>
													<td align="left" valign="middle"><?=$OpenHour.":".$OpenTime?> ~ <?=$CloseHour.":0".$CloseTime?></td>
													<?}?>
												</tr>
												<?if($holiday){?>
												<tr>
													<th align="left" valign="middle" scope="row">휴무일</th>
													<td align="left" valign="middle"><?=$holiday?></td>
												</tr>
												<?}?>
												<?if($gubun==1){?>
												<tr>
													<th align="left" valign="middle" scope="row">예약형태</th>
													<td align="left" valign="middle">
														<?if($g1_d=="Y"){?>
														<div class="pay_type_wrap">
															<div class="pay_type">
																<input type="radio" name="btype" id="sp_type_desk" value="Desk" checked price="<?=$g1_d_price?>" title="Desk">
																<label for="sp_type_desk" class="radio_on">
																	Desk - <?=number_Format($g1_d_price)?>원/월
																</label>
															</div>
														</div>
														<?}?>
														<?if($g1_s=="Y"){?>
														<div class="pay_type_wrap">
															<div class="pay_type">
																<input type="radio" name="btype" id="sp_type_space" value="Space" <?if($g1_d=="N"){?>checked<?}?> price="<?=$g1_s_price?>" title="Space">
																<label for="sp_type_space" class="">
																	Space - <?=number_Format($g1_s_price)?>원/월
																</label>
															</div>
														</div>
														<?}?>
													</td>
												</tr>
												<?}elseif($gubun==2){?>
												<tr>
													<th align="left" valign="middle" scope="row">예약형태</th>
													<td align="left" valign="middle">
														<div class="pay_type_wrap">
															<div class="pay_type">
																<input type="radio" name="btype" id="sp_type2" value="<?=$g2?>" price="<?=$g2_price?>" checked title="<?=$gName_str?>">
																<label for="sp_type2" class="radio_on">
																	<?=$gName_str?> - <?=number_format($price)?>원/<?if($g2_p=="M")		echo "월";	else	echo "일";?>
																</label>
															</div>
														</div>
													</td>
												</tr>
												<?}elseif($gubun==3){?>
												<?}elseif($gubun==4){?>
												<tr>
													<th align="left" valign="middle" scope="row">예약형태</th>
													<td align="left" valign="middle">
														<div class="pay_type_wrap">
															<div class="pay_type">
																<input type="radio" name="btype" id="sp_type3" value="SM" checked price="<?=$g4_price?>" title="세미나/미팅룸">
																<label for="sp_type3" class="radio_on">
																	<?=number_Format($g4_price)?>원/시간
																</label>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">예약시간</th>
													<td align="left" valign="middle">
														<div id="time_bar">

														</div>
													</td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">이용기간</th>
													<td align="left" valign="middle">
														<input type="text" name="sDate" id="sDate" placeholder="년/월/일" value="<?=$etc2?>" class="sign_input_04" maxlength="10" required="required" readonly> ~ <span id="eDate"></span>
													</td>
												</tr>
												<?if($gubun!=1){?>
												<!-- <tr>
													<th align="left" valign="middle" scope="row">부가서비스</th>
													<td align="left" valign="middle">
														<?
														for($i=1;$i<=3;$i++){
															if(${"s_".$i}){
														?>
														<div class="agree_label_in">
															<input type="checkbox" name="sc_<?=$i?>" id="sc_<?=$i?>" value="Y" price="<?=${"s_".$i."_price"}?>" title="sc_<?=$i?>">
																<label for="sc_<?=$i?>">
																	<?=${"s_".$i}?> (<?=number_format(${"s_".$i."_price"})?>원)
																</label>
														</div>
														<?
															}
														}
														?>
													</td>
												</tr> -->
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">인원</th>
													<td align="left" valign="middle">
														<div class="select_num_wrap">
															<div class="select_num">
																<input type="text" name="person" id="person" readonly="" value="1" maxlength="3" required="required">
															</div>
															<a href="javascript:void(0)" class="select_num_minus">-</a>
															<a href="javascript:void(0)" class="select_num_plus">+</a>
														</div>
													</td>
												</tr>
												<?if($gubun==1){?>
												<tr>
													<th align="left" valign="middle" scope="row">관리비</th>
													<td align="left" valign="middle">
														<?if($e1=="Y"){?>
														<div class="plus_pay">
															+<?=number_Format($e1_price)?>원 (관리비/월)
														</div>
														<?}?>
													</td>
												</tr>
												<tr>

														<th align="left" valign="middle" scope="row">청소비</th>
														<td align="left" valign="middle">
														<?if($e2=="Y"){?>
														<div class="plus_pay">
															+<?=number_Format($e2_price)?>원 (청소비/월)
														</div>
														<?}?>
														</td>
												</tr>
												<?}?>
												<tr>
													<th align="left" valign="middle" scope="row">결제 금액</th>
													<td align="left" valign="middle">
														<div class="total_pay" id="total_price">
															<?=number_format($price+$e1_price+$e2_price)?>원
														</div>
													</td>
												</tr>
											</table>
										</div>
										<div class="s_view_btn_all_wrap" id="non_btn">
											<div class="s_view_btn_wrap">
												<div class="s_view_btn_in">
													<a href="#" class="s_view_btn_fav pay_end">
														<div>
															<span class="s_view_btn_img">
																<img src="/images/icon/tel.png">
															</span>
															<span class="s_view_btn_txt">전화문의</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="s_view_btn_book">
														<div>
															<span class="s_view_btn_img">
																<img src="/images/icon/book.png">
															</span>
															<span class="s_view_btn_txt">예약하기</span>
														</div>
													</a>
												</div>

											</div>
										</div>
									</div>

								</div>
								</form>
								<script type="text/javascript">
								$(window).load(function(){
									function CAL(b_price){
										var total_price = 0;
										var person = parseInt($('#person').val());
										var e1_price = parseInt(<?=$e1_price?>);
										var e2_price = parseInt(<?=$e2_price?>);
										var etc_price = 0;

										b_price = parseInt(b_price);

										<?for($i=1;$i<=3;$i++){?>
										if($('#sc_<?=$i?>').is(':checked')==true){
											etc_price += parseInt(<?=${"s_".$i."_price"}?>);
										}
										<?}?>

										<?if($gubun==4){?>
										var sTime = parseInt($('#sTime').val());
										var eTime = parseInt($('#eTime').val());

										if(sTime&&eTime){
											var diffTime = eTime - sTime;
										}else{
											var diffTime = 1;
										}
										total_price = (b_price*diffTime) + e1_price + e2_price + etc_price;
										<?}else{?>
											var btype_val = $('input[name=btype]:checked').val();

											if(btype_val=="Space"||btype_val=="1"||btype_val=="2"||btype_val=="4"||btype_val=="6"){
												total_price = b_price + e1_price + e2_price + etc_price;
											}else{
												total_price = (b_price*person) + e1_price + e2_price + etc_price;
											}
										<?}?>

										$('#total_price').text(total_price.number_format()+"원");
									}

									$('input[name=btype]').click(function(){
										CAL($(this).attr('price'));
										B_CHK();
									});

									$('.select_num_minus').click(function(){
										var person = parseInt($('#person').val());

										if(person>1){
											$('#person').val(person-1);
										}else{
											alert('최소 1명은 예약하셔야합니다.');
											$('#person').val('1');
										}
										var b_price = $('input[name=btype]:checked').attr('price');

										CAL(b_price);
									});
									$('.select_num_plus').click(function(){
										var person = parseInt($('#person').val());
										var maxPerson = <?=$p_limit?>;

										if(person<maxPerson){
											$('#person').val(person+1);
										}else{
											alert("최대 "+maxPerson+'명까지 예약가능합니다.');
											$('#person').val(maxPerson);
										}

										var b_price = $('input[name=btype]:checked').attr('price');

										CAL(b_price);
									});

									$('#love_chk').click(function(){
										<?if($USESSION[0]){?>
										$('form[name="wFrm"]').submit();
										<?}Else{?>
											$('.love_chk_off').show();
											alert('로그인하셔야 이용가능합니다.');
											return;
										<?}?>
									});

									$('.s_view_btn_book').click(function(){
										<?if($USESSION[0]){?>
										$('form[name=bFrm]').attr('action','/space/_booking_chk.php');
										$('form[name=bFrm] > #mode').val('');
										$('form[name="bFrm"]').submit();
										<?}Else{?>
											alert('로그인하셔야 이용가능합니다.');
											return;
										<?}?>
									});

									<?for($i=1;$i<=3;$i++){?>
									$('#sc_<?=$i?>').click(function(){
										var b_price = $('input[name=btype]:checked').attr('price');
										CAL(b_price);
									});
									<?}?>

									function B_CHK(){
										$('form[name=bFrm]').attr('action','/space/_booking_proc.php');
										$('form[name=bFrm] > #mode').val('booking_chk_ok');
										$('form[name=bFrm]').submit();
									}

									eDate();

									<?if($gubun==4){?>
									Time_Bar($('#sDate').val());

									$('.time_box').click(function () {
										var b_price = $('input[name=btype]:checked').attr('price');
										CAL(b_price);

										B_CHK();
									});
									<?}?>
								});

								<?if($gubun==4){?>
								function Time_Bar(sDate){
									var btype = $('input[name=btype]:checked').val();

									if(sDate==""){
										var sDate = $('#sDate').val();
									}

									Ajax_Request('/space/time.php?uid=<?=$uid?>&btype='+btype+'&sDate='+sDate,'time_bar','post');
								}
								<?}?>

								function eDate(){
									Ajax_Request('/space/_booking_proc.php?mode=edate_cal_ok&uid=<?=$uid?>&sDate='+$('#sDate').val(),'eDate','post');
								}
								</script>
								<div class="s_view_nav">
									<a href="#s_view_nav_info" class="go_ani active">정보</a>
                  <a href="#s_view_space_img" class = "go_ani">공간사진</a>
									<a href="#s_view_nav_map" class="go_ani">지도</a>
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

								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">상세설명</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<?
									$result = mysql_query("select * from es_product_c where kind=1 and puid=$uid order by uid asc");
									if($result&&mysql_num_rows($result)>0){
										$i = 1;
										while($r=mysql_fetch_array($result)){
									?>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num"><?=$i?></div>
										<div class="s_view_desc_txt_desc">
											<?=stripslashes($r["comment"])?>
										</div>
									</div>
									<?
										$i++;
										}
									}
									@mysql_free_result($result);
									?>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">유의사항</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<?
									$result = mysql_query("select * from es_product_c where kind=2 and puid=$uid order by uid asc");

									if($result&&mysql_num_rows($result)>0){
										$i = 1;
										while($r=mysql_fetch_array($result)){
									?>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num"><?=$i?></div>
										<div class="s_view_desc_txt_desc">
											<?=stripslashes($r["comment"])?>
										</div>
									</div>
									<?
										$i++;
										}
									}
									@mysql_free_result($result);
									?>
								</div>

                <div class="s_view_nav_point">
									<div id="s_view_space_img"></div>
								</div>
								<div class="s_view_nav">
									<a href="#s_view_nav_info" class="go_ani">정보</a>
                  <a href="#s_view_space_img" class = "go_ani active">공간사진</a>
									<a href="#s_view_nav_map" class="go_ani">지도</a>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">공간사진</div>
									<span class="s_view_info_label_line"></span>
								</div>

                <div class="s_view_info_box">


								<div class="main_event_wrap" style="width: 75%; height: 550px">
									<div class="slider3">
										<ul class="bxslider3">
												<?if($bimg){?>
												<li>
														<img src="/DATAS/<?=$table?>/<?=$bimg?>" alt="">
												</li>
												<?
												}
												for($i=1;$i<=6;$i++){
													if(${"img".$i}){
												?>
												<li>
														<img src="/DATAS/<?=$table?>/<?=${"img".$i}?>" alt="">
												</li>
												<?}
												}?>
											</ul>
										</div>

										<script type="text/javascript">
											$(document).ready(function(){
												var slider3 = $('.bxslider3').bxSlider({
													auto: true,
													autoControls: false,
													useCSS: false,
													mode: 'fade'
												});
											});
										</script>
										<br>
										<br>
										</div>


								<div class="s_view_nav_point">
									<div id="s_view_nav_map"></div>
								</div>
								<div class="s_view_nav">
									<a href="#s_view_nav_info" class="go_ani">정보</a>
                  <a href="#s_view_space_img" class = "go_ani">공간사진</a>
									<a href="#s_view_nav_map" class="go_ani active">지도</a>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">지도</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<?
								if(trim($address)){
									require "Map.php";
								}else{
								?>
								<div class="s_view_info_box">
									등록된 주소가 없으므로 지도를 불러올 수 없습니다.
								</div>
								<?
								}

								require "review.php";

								require "r_product.php";
								?>

							</div>
						</div>
						<div class="view_fixed_all_wrap">
							<div class="view_fixed_wrap">
							<div class="s_view_btn_all_wrap" id="non_btn">
								<div class="s_view_btn_wrap">
									<div class="s_view_btn_in">
										<a href="#" class="s_view_btn_fav pay_end">
											<div>
												<span class="s_view_btn_img">
													<img src="/images/icon/tel.png">
												</span>
												<span class="s_view_btn_txt">전화문의</span>
											</div>
										</a>
										<a href="javascript:void(0);" class="s_view_btn_book">
											<div>
												<span class="s_view_btn_img">
													<img src="/images/icon/book.png">
												</span>
												<span class="s_view_btn_txt">예약하기</span>
											</div>
										</a>
									</div>

								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="f_pop_wrap">
						<div class="f_pop_bg"></div>
						<div class="f_pop">
							<div class="f_pop_label">전화문의 안내</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name">
									<?=$company?>
								</div>
								<div class="f_pop_desc_tel">
									<a href="tel:<?=$c_phone?>"><?=$c_phone?></a>
								</div>
							</div>
							<div class="f_pop_comment">
								HOST에게 사전 방문을 요청하세요!!
							</div>
							<div class="f_pop_close">
								<a href="#" class="f_pop_close_btn">닫기</a>
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
<script type="text/javascript">
$(function() {
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		var nonBtn = $('#non_btn').offset().top;

		if (scroll >= nonBtn) {
			$('#wrap').addClass("fix_view");
		} else {
			$('#wrap').removeClass("fix_view");
		}
	});
});
</script>
</body>
</html>
