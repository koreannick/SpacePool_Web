<?
// 각종 설정값 포함
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";

//데이터베이스 연결
$connect = dbcon();

$subject = rawurldecode($subject);

//데이터 베이스 select 쿼리 es_product에 저장된 값을 불러옴 (수정시)
if($uid){
	$result = mysql_query("select e1,e1_price,e2,e2_price,p_limit,size1,size2,n_talk,bimg,img1,img2,img3,p_opt,id,pay_auth,pay_card,pay_bank,pay_bank_1,pay_bank_2,pay_bank_3,pay_offline,e3_price,e4_price,c_phone,post,addr1,addr2,etc1,etc2,holiday,img4,img5,img6 from es_product where uid=$uid");


	if($result&&mysql_num_rows($result)>0){
		$e1 = mysql_result($result,0,0);
		$e1_price = mysql_result($result,0,1);
		$e2 = mysql_result($result,0,2);
		$e2_price = mysql_result($result,0,3);
		$p_limit = mysql_result($result,0,4);
		$size1 = mysql_result($result,0,5);
		$size2 = mysql_result($result,0,6);
		$n_talk = mysql_result($result,0,7);
		$bimg = mysql_result($result,0,8);
		$img1 = mysql_result($result,0,9);
		$img2 = mysql_result($result,0,10);
		$img3 = mysql_result($result,0,11);
		$p_opt = mysql_result($result,0,12);
		$id = mysql_result($result,0,13);
		$pay_auth = mysql_result($result,0,14);
		$pay_card = mysql_result($result,0,15);
		$pay_bank = mysql_result($result,0,16);
		$pay_bank_1 = mysql_result($result,0,17);
		$pay_bank_2 = mysql_result($result,0,18);
		$pay_bank_3 = mysql_result($result,0,19);
		$pay_offline = mysql_result($result,0,20);
		$e3_price = mysql_result($result,0,21);
		$e4_price = mysql_result($result,0,22);
		$c_phone = mysql_result($result,0,23);
		$post = mysql_result($result,0,24);
		$addr1 = mysql_result($result,0,25);
		$addr2 = mysql_result($result,0,26);
		$etc1 = mysql_result($result,0,27);
		$etc2 = mysql_result($result,0,28);
		$holiday = mysql_result($result,0,29);
		$img4 = mysql_result($result,0,30);
		$img5 = mysql_result($result,0,31);
		$img6 = mysql_result($result,0,32);

		if($id!=$USESSION[0]&&auth_lev()!=9){
			redir_proc3("/member/space_host.php","본인데이터가 아니므로 수정하실 수 없습니다.");
			exit;
		}
		//사진저장 디렉토리 체크
		if( !is_dir($save_path) ){
		   @mkdir($save_path,0777);
		   @chmod($save_path,0777);
			 @mkdir($save_path."/thum",0777);
		   @chmod($save_path."/thum",0777);
		}
		if( !is_dir($save_path_tmp) ){
		   @mkdir($save_path_tmp,0777);
		   @chmod($save_path_tmp,0777);
			 @mkdir($save_path_tmp."/thum",0777);
		   @chmod($save_path_tmp."/thum",0777);
		}

//사진저장 경로
		$save_path_tmp = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product_tmp/";
		$save_path = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product/";

		$org_id = $id;

		//수정시 임시테이블로 데이터 복사
		if($bimg){
			// $result2 = mysql_query("select uid from es_img_tmp where id='$org_id' and file1='$bimg' and gubun='b' and sid='$_SESSION[SN_GUEST_ID]'");
			$result2 = mysql_query("select uid from es_img_tmp where file1='$bimg' and gubun='b' and sid='$_SESSION[SN_GUEST_ID]'");
			if($result2&&mysql_num_rows($result2)==0){
				// $result3 = mysql_query("insert into es_img_tmp (puid,id,file1,ip,wdate,gubun,sid) values ('$uid','$org_id','$bimg','$REMOTE_ADDR',".time().",'b','$_SESSION[SN_GUEST_ID]')");
				$result3 = mysql_query("insert into es_img_tmp (puid,file1,ip,wdate,gubun,sid) values ('$uid','$bimg','$REMOTE_ADDR',".time().",'b','$_SESSION[SN_GUEST_ID]')");
				if($result3){
					if(file_exists($save_path.$bimg))					copy($save_path.$bimg,$save_path_tmp.$bimg);
					if(file_exists($save_path."thum/".$bimg))		copy($save_path."thum/".$bimg,$save_path_tmp."thum/".$bimg);
				}
				@mysql_free_result($result3);
			}
			@mysql_free_result($result2);
		}

		for($i=1;$i<=6;$i++){
			if(${"img".$i}){
				$result2 = mysql_query("select uid from es_img_tmp where file1='".${"img".$i}."' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]'");
				if($result2&&mysql_num_rows($result2)==0){
					$result3 = mysql_query("insert into es_img_tmp (puid,id,file1,ip,wdate,gubun,sid,num) values ('$uid','$org_id','".${"img".$i}."','$REMOTE_ADDR',".time().",'s','$_SESSION[SN_GUEST_ID]','$i')");
					if($result3){
						if(file_exists($save_path.${"img".$i}))					copy($save_path.${"img".$i},$save_path_tmp.${"img".$i});
						if(file_exists($save_path."thum/".${"img".$i}))		copy($save_path."thum/".${"img".$i},$save_path_tmp."thum/".${"img".$i});
					}
					@mysql_free_result($result3);
				}
				@mysql_free_result($result2);
			}
		}
		$result2 = mysql_query("select * from es_product_c_tmp where id='$org_id' and puid='$uid'");
		if($result2&&mysql_num_rows($result2)==0){
			$result3 = mysql_query("select * from es_product_c where id='$org_id' and puid='$uid' order by kind asc, uid asc");
			if($result3&&mysql_num_rows($result3)>0){
				while($r3=mysql_fetch_array($result3)){
					@mysql_query("insert into es_product_c_tmp (puid,id,sid,kind,comment) values ('$uid','$org_id','$_SESSION[SN_GUEST_ID]','$r3[kind]','$r3[comment]')");
				}
			}
			@mysql_free_result($result3);
		}
		@mysql_free_result($result2);
	}
	@mysql_free_result($result);
}




?>

<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
	<link rel="stylesheet" href="/space/calendar.css" />
	<script type="text/javascript" src="/member/calendar.js"></script>
	<script type="text/javascript" src="/s_inc/js_string.js"></script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member sp_apply">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
					<!--
						<form name="form0" id="form0" target="tempFrame" method="post" action="_product_proc.php" enctype="multipart/form-data">
						-->
						<form name="form0" id="form0"  target="tempFrame"  method="post" action="_product_proc.php" enctype="multipart/form-data">
						<input type="hidden" name="gubun" id="gubun" value="<?=$gubun?>">
						<input type="hidden" name="mode" id="mode">
						<input type="hidden" name="c_t_uid" id="c_t_uid">
						<input type="hidden" name="c_t_kind" id="c_t_kind">
						<input type="hidden" name="subject" value="<?=rawurlencode($subject)?>">
						<?if($uid){?>
						<input type="hidden" name="uid" value="<?=$uid?>">
						<?}?>
						<?
						// 구분이 1일때 쉐어오피스
						if($gubun==1){
							if($g1_d=="Y"){
						?>
							<input type="hidden" name="g1_d" value="<?=$g1_d?>">
							<input type="hidden" name="g1_d_price" value="<?=$g1_d_price?>">
							<?}
							if($g1_s=="Y"){?>
							<input type="hidden" name="g1_s" value="<?=$g1_s?>">
							<input type="hidden" name="g1_s_price" value="<?=$g1_s_price?>">
						<?
							}
						}elseif($gubun==2){
							?>
								<input type="hidden" name="g2" value="<?=$g2?>">
								<input type="hidden" name="g2_p" value="<?=$g2_p?>">
								<input type="hidden" name="g2_price" value="<?=$g2_price?>">
						<?
							$gName = $_POST["gName"];
							$gPeriod = $_POST["gPeriod"];
							$gPrice = $_POST["gPrice"];

							for($i=0;$i<count($gName);$i++){
								if($gPrice[$i]){
								?>
								<input type="hidden" name="gName[]" value="<?=$gName[$i]?>">
								<input type="hidden" name="gPeriod[]" value="<?=$gPeriod[$i]?>">
								<input type="hidden" name="gPrice[]" value="<?=$gPrice[$i]?>">
								<?
								}
							}
							// 구분이 3일때 서비스드 오피스
						}elseif($gubun==3){
							if($g3_t=="Bronze")			$g3_price = $g3_price1;
							elseif($g3_t=="Silver")		$g3_price = $g3_price2;
							elseif($g3_t=="Gold")		$g3_price = $g3_price3;
							elseif($g3_t=="Platinum")		$g3_price = $g3_price4;
						?>
						<input type="hidden" name="g3_t" value="<?=$g3_t?>">
						<input type="hidden" name="g3_price" value="<?=$g3_price?>">
						<?
						// 구분 4일때 세미나/미팅룸
						}elseif($gubun==4){
						?>
						<input type="hidden" name="g4_person" value="<?=$g4_person?>">
						<input type="hidden" name="g4_price" value="<?=$g4_price?>">
						<input type="hidden" name="g4_hour1" value="<?=$g4_hour1?>">
						<input type="hidden" name="g4_hour2" value="<?=$g4_hour2?>">
						<input type="hidden" name="minHour" value="<?=$minHour?>">
						<input type="hidden" name="maxHour" value="<?=$maxHour?>">
						<?
						}
						?>

						<div class="page_label_wrap">
							<div class="page_label">
								<!--uid가 있으면 수정 없으면 등록  -->
							공간<?if($uid)		echo "수정";		else		echo "등록";?></div>
						</div>
						<div class="m_top_nav_wrap">
							<a href="javascript:void(0)" class="">1. 공간타입</a>
							<a href="javascript:void(0)" class="">2. 가격설정</a>
							<a href="javascript:void(0)" class="active">3. 정보입력</a>
						</div>
						<div class="s_view_desc">
							<div class="space_box">
							   <div class="space_box_label">
									<div class="space_box_label_left">
										주소 <span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="space_st_wrap">
										<div class="space_st_cost">
											<!-- 주소검색 -->
											<input type="text" name="post" id="post" class="sign_input_03" value="<?=$post?>" placeholder="주소검색" readonly onClick="execDaumPostcode(1);">
											<span class="span_desc">
												<a href="#" class="sing_btn_01" onClick="execDaumPostcode(1);">우편번호 찾기</a>
											</span>
											<div id="Post_Layer" style="display:none;position:absolute;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
												<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
											</div>
											<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
											<script type="text/javascript" src="/s_inc/Daum_Post.js"></script>
										</div>
										<div class="space_st_cost">
											<span class="span_desc">
												<input type="text" name="addr1" id="addr1" class="sign_input_01" value="<?=$addr1?>" placeholder="주소" onClick="execDaumPostcode(1);" readonly>
											</span>
											<span class="span_desc">
												<input type="text" name="addr2" id="addr2"  class="sign_input_01" value="<?=$addr2?>" maxlength="50" placeholder="나머지주소">
											</span>
										</div>
									</div>
								</div>
								<?if($gubun==1){?>
									<!-- 쉐어오피스 시작-->
								<div class="space_box_label">
									<div class="space_box_label_left">
										추가 사항<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input type="checkbox" name="e1" id="ex_01" value="Y" <?if($e1=="Y")		echo "checked=\"checked\"";?>>
											<label for="ex_01" <?if($e1=="Y")		echo "class=\"checkbox_on\"";?>>관리비</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="e1_price" id="e1_price" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$e1_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input type="checkbox" name="e2" id="ex_02" value="Y" <?if($e2=="Y")		echo "checked=\"checked\"";?>>
											<label for="ex_02" <?if($e2=="Y")		echo "class=\"checkbox_on\"";?>>청소비</label>
										</div>
										<div class="space_st_cost">
											<input type="text" name="e2_price" id="e2_price" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$e2_price?>">
											<span>원/월</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>평수</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="size1" id="size1" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$size1?>">
											<span>평</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>실평수</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="size2" id="size2" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$size2?>">
											<span>평</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>최대수용인원</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="p_limit" id="p_limit" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$p_limit?>">
											<span>명</span>
										</div>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>입주희망업종</span>
										</div>
										<span>
											<input type="text" name="etc1" id="etc1" maxlength="60" value="<?=$etc1?>" >
										</span>
										<span class="sp_semi_desc">ex) 무관, 디자인업체, IT업체</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>입주가능시기</span>
										</div>
										<span>
											<!-- <input type="text" name="etc2" id="etc2" maxlength="20" value="<?=$etc2?>" > -->
											<input type="text" name="etc2" id="etc2" placeholder="년/월/일" value="<?=$etc2?>" class="sign_input_04" maxlength="10" required="required" readonly>
										</span>
										<span class="sp_semi_desc">ex) 11월 중순, 즉시 입주가능</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>운영시간</span>
										</div>
										<span>
											<select class="sign_input_02" name="OpenHour">
												<?for($i=0;$i<=24;$i++){?>
												<option value="<?=$i?>" <?if($OpenHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 부터</span>
											<select class="sign_input_02" name="CloseHour">
												<?for($i=0;$i<=24;$i++){?>
												<option value="<?=$i?>" <?if($CloseHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 까지</span>
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>담당자 연락처</span>
										</div>
										<span>
											<input type="text" name="c_phone" id="c_phone" maxlength="30" value="<?=$c_phone?>" style="ime-mode:active;">
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>휴무일</span>
										</div>
										<span>
											<input type="text" name="holiday" id="holiday" maxlength="30" value="<?=$holiday?>" style="ime-mode:active;">
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>보증금</span>
										</div>
										<span>
											<input type="text" name="e3_price" id="e3_price" maxlength="10" value="<?=$e3_price?>"  onkeypress="onlyNumber();" style="ime-mode:disabled;">
											<span>원</span>
										</span>
										<!-- <span class="sp_semi_desc">- 보증금은 직거래로 운영됩니다.</span> -->
									</div>

									<!-- <div class="sp_semi_wrap">
										<span>주차비</span>
										<span>
											<input type="text" name="e4_price" id="e4_price" maxlength="10" value="<?=$e4_price?>"  onkeypress="onlyNumber();" style="ime-mode:disabled;">
											<span>원/월</span>
										</span>
										<span class="sp_semi_desc">- 주차비는 직거래로 운영됩니다.</span>
									</div> -->
								</div>
								<!-- 쉐어오피스 끝-->
								<?}elseif ($gubun==2) {?>
									<!-- 서비스드오피스 시작-->

									<div class="space_box_label">
									<div class="space_box_label_left">
										추가 사항<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
									</div>
									<div class="space_box_input">
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>모집인원</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="p_limit" id="p_limit" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$p_limit?>">
											<span>명</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>평수</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="size1" id="size1" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$size1?>">
											<span>평</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>실평수</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="size2" id="size2" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$size2?>">
											<span>평</span>
										</div>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>입주가능시기</span>
										</div>
										<span>
											<!-- <input type="text" name="etc2" id="etc2" maxlength="20" value="<?=$etc2?>" > -->
											<input type="text" name="etc2" id="etc2" placeholder="년/월/일" value="<?=$etc2?>" class="sign_input_04" maxlength="10" required="required" readonly>
										</span>
										<span class="sp_semi_desc">ex) 11월 중순, 즉시 입주가능</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>운영시간</span>
										</div>
										<span>
											<select class="sign_input_02" name="OpenHour">
												<?for($i=0;$i<=24;$i++){?>
												<option value="<?=$i?>" <?if($OpenHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 부터</span>
											<select class="sign_input_02" name="CloseHour">
												<?for($i=0;$i<=24;$i++){?>
												<option value="<?=$i?>" <?if($CloseHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 까지</span>
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>담당자 연락처</span>
										</div>
										<span>
											<input type="text" name="c_phone" id="c_phone" maxlength="30" value="<?=$c_phone?>" style="ime-mode:active;">
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>휴무일</span>
										</div>
										<span>
											<input type="text" name="holiday" id="holiday" maxlength="30" value="<?=$holiday?>" style="ime-mode:active;">
										</span>
									</div>

									<!-- <div class="sp_semi_wrap">
										<span>주차비</span>
										<span>
											<input type="text" name="e4_price" id="e4_price" maxlength="10" value="<?=$e4_price?>"  onkeypress="onlyNumber();" style="ime-mode:disabled;">
											<span>원/월</span>
										</span>
										<span class="sp_semi_desc">- 주차비는 직거래로 운영됩니다.</span>
									</div> -->
									</div>

									<!-- 서비스드오피스 끝-->
									<?}elseif($gubun==4){?>
									<!-- 세미나/미팅룸 시작-->

									<div class="space_box_label">
									<div class="space_box_label_left">
										추가 사항<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
									</div>
									<div class="space_box_input">
										<div class="sp_semi_wrap">
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>모집인원</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="p_limit" id="p_limit" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$p_limit?>">
											<span>명</span>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<span>평수</span>
										</div>
										<div class="space_st_cost">
											<input type="text" name="size1" id="size1" class="sp_st_input_01" onkeypress="onlyNumber();" maxlength="10" style="ime-mode:disabled;" value="<?=$size1?>">
											<span>평</span>
										</div>
									</div>
									<div class="sp_semi_wrap">
										<span>최소이용시간</span>
										<span>
											<input type="text" name="g4_hour1" id="g4_hour1" onkeypress="onlyNumber();" maxlength="2" style="ime-mode:disabled;" value="<?=$g4_hour1?>">시간
										</span>
									</div>
									<div class="sp_semi_wrap">
										<span>최대이용시간</span>
										<span>
											<input type="text" name="g4_hour2" id="g4_hour2" onkeypress="onlyNumber();" maxlength="2" style="ime-mode:disabled;" value="<?=$g4_hour2?>">시간
										</span>
									</div>


									<div class="sp_semi_wrap">
										<span>예약가능시간</span>
										<span>
											<select class="sign_input_02" name="minHour">
												<?for($i=0;$i<=23;$i++){?>
												<option value="<?=$i?>" <?if($minHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 부터</span>
											<select class="sign_input_02" name="maxHour">
												<?for($i=1;$i<=24;$i++){?>
												<option value="<?=$i?>" <?if($maxHour==$i)		echo " selected";?>><?=sprintf("%02d",$i)?></option>
												<?}?>
											</select>
											<span class="span_col">시 까지</span>
										</span>
									</div>

									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>담당자 연락처</span>
										</div>
										<span>
											<input type="text" name="c_phone" id="c_phone" maxlength="30" value="<?=$c_phone?>" style="ime-mode:active;">
										</span>
									</div>
									<div class="sp_semi_wrap">
										<div class="space_st_top agree_label_in">
											<span>휴무일</span>
										</div>
										<span>
											<input type="text" name="holiday" id="holiday" maxlength="30" value="<?=$holiday?>" style="ime-mode:active;">
										</span>
									</div>

									<!-- <div class="sp_semi_wrap">
										<span>주차비</span>
										<span>
											<input type="text" name="e4_price" id="e4_price" maxlength="10" value="<?=$e4_price?>"  onkeypress="onlyNumber();" style="ime-mode:disabled;">
											<span>원/월</span>
										</span>
										<span class="sp_semi_desc">- 주차비는 직거래로 운영됩니다.</span>
									</div> -->
									</div>

									<!-- 세미나/미팅룸 끝-->
									<?}?>
								<div class="space_box_label">
									<div class="space_box_label_left">
										대표이미지<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											2000 *1197 권장, 한 장당 최대 10MB
										</div>
									</div>
								</div>
								<div class="space_box_cal_wrap">
									<div class="space_box_cal_left">
										<div class="space_box_cal_in">
											<h5>※사진 용량이 클 경우, 썸네일 이미지 생성 시간이 오래 걸릴 수도 있습니다.</h5>
											<div class="space_box_bg">
												<!-- 사진미리보기 -->
												<span id="bimg"><?if($bimg)		echo "<img src=\"/DATAS/es_product/thum/".$bimg."\" />";?></span>
											</div>
										</div>
									</div>

									<div class="space_box_cal_right">
												<input type="file" name="file1" id="img_file_01">
												<label for="img_file_01">
														파일첨부
												</label>
									</div>
								</div>
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간이미지<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											2000 *1197 권장, 한 장당 최대 10MB/ 최대 6장
										</div>
									</div>
								</div>
								<div class="space_box_cal_wrap">
									<div class="space_box_cal_left">
										<div class="space_box_cal_in">
											<div class="space_box_bg">
												<h5>※사진 용량이 클 경우, 썸네일 이미지 생성 시간이 오래 걸릴 수도 있습니다.</h5>
												<div class="sp_img_input">
													<!-- 여기서부터 사진미리보기 -->
													<input type="checkbox" name="del_1" id="image_01" value="Y">
													<label for="image_01">
														<span class="sp_img_bg" id="img1">
															<?if($img1)		echo "<img src=\"/DATAS/es_product/thum/".$img1."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label1">

														</span>
													</label>
												</div>
												<div class="sp_img_input">
													<input type="checkbox" name="del_2" id="image_02" value="Y">
													<label for="image_02">
														<span class="sp_img_bg" id="img2">
															<?if($img2)		echo "<img src=\"/DATAS/es_product/thum/".$img2."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label2">

														</span>
													</label>
												</div>
												<div class="sp_img_input">
													<input type="checkbox" name="del_3" id="image_03" value="Y">
													<label for="image_03">
														<span class="sp_img_bg" id="img3">
															<?if($img3)		echo "<img src=\"/DATAS/es_product/thum/".$img3."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label3">

														</span>
													</label>
												</div>
												<div class="sp_img_input">
													<input type="checkbox" name="del_4" id="image_04" value="Y">
													<label for="image_04">
														<span class="sp_img_bg" id="img4">
															<?if($img4)		echo "<img src=\"/DATAS/es_product/thum/".$img4."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label4">

														</span>
													</label>
												</div>
												<div class="sp_img_input">
													<input type="checkbox" name="del_5" id="image_05" value="Y">
													<label for="image_05">
														<span class="sp_img_bg" id="img5">
															<?if($img5)		echo "<img src=\"/DATAS/es_product/thum/".$img5."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label5">

														</span>
													</label>
												</div>
												<div class="sp_img_input">
													<input type="checkbox" name="del_6" id="image_06" value="Y">
													<label for="image_06">
														<span class="sp_img_bg" id="img6">
															<?if($img6)		echo "<img src=\"/DATAS/es_product/thum/".$img6."\" />";?>
														</span>
														<span class="sp_img_label" id="sp_img_label6">

														</span>
													</label>
												</div>
											</div>

										</div>
									</div>
									<div class="space_box_cal_right">
										<input type="file" name="file2" id="img_file_02">
										<label for="img_file_02">
											파일첨부
										</label>
										<div>
											<a href="javascript:File2_Del();">삭제</a>
										</div>
									</div>
								</div>
								<div class="space_box_label">
									<div class="space_box_label_left">
										보유시설<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											보유시설을 선택해주세요.
										</div>
									</div>
								</div>
								<div class="space_box_input">

									<?for($i=1;$i<=count($p_opt_arr);$i++){?>
									<div class="acc_box">
										<input type="checkbox" name="p_opt[]" id="acc_<?=sprintf("%02d",$i)?>" value="<?=$i?>" <?if(preg_match("/:".$i.":/",$p_opt))		echo "checked=\"checked\"";?>>
										<label for="acc_<?=sprintf("%02d",$i)?>">
											<span class="acc_img">
												<img src="/images/icon/acc_<?=sprintf("%02d",$i)?>.png" class="acc_img_off">
												<img src="/images/icon/acc_<?=sprintf("%02d",$i)?>_on.png" class="acc_img_on">
											</span>
											<span class="acc_txt">
												<?=$p_opt_arr[$i]?>
											</span>
										</label>
									</div>
									<?}?>
								</div>
								<div class="space_box_label">
									<div class="space_box_label_left">
										상세설명<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											최대 10줄 까지 추가 가능합니다.
										</div>
									</div>
								</div>
								<div class="space_box_cal_wrap">
									<div class="space_box_cal_left">
										<div class="space_box_cal_in">
											<div class="txt_input_box_01">
												<input type="text" name="comment1" id="comment1" maxlength="150" >
											</div>
										</div>
									</div>
									<div class="space_box_cal_right">
										<input type="image" name="txt_apply1" id="txt_apply1" onclick="Save_C(1);">
										<label for="txt_apply1">
											입력추가
										</label>
									</div>
								</div>
								<div class="txt_input_desc_wrap" id="c_list1">

								</div>
								<div class="space_box_label">
									<div class="space_box_label_left">
										유의사항<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											최대 10줄 까지 추가 가능합니다.
										</div>
									</div>
								</div>
								<div class="space_box_cal_wrap">
									<div class="space_box_cal_left">
										<div class="space_box_cal_in">
											<div class="txt_input_box_01">
												<input type="text" name="comment2" id="comment2" maxlength="150" >
											</div>
										</div>
									</div>
									<div class="space_box_cal_right">
										<input type="image" name="txt_apply2" id="txt_apply2" onclick="Save_C(2);">
										<label for="txt_apply2">
											입력추가
										</label>
									</div>
								</div>
								<div class="txt_input_desc_wrap" id="c_list2">

								</div>
								<?
								if($uid){
								?>
								<script type="text/javascript">
								$(document).ready(function(){
									Ajax_Request('/member/_product_proc.php?mode=c_tmp_list&kind=1&uid=<?=$uid?>','c_list1','post');
									Ajax_Request('/member/_product_proc.php?mode=c_tmp_list&kind=2&uid=<?=$uid?>','c_list2','post');
								});
								</script>
								<?
								}
								?>
								<div class="space_box_label">
									<div class="space_box_label_left">
										결제타입<span>*</span>
									</div>
									<div class="space_box_label_right">
										<div class="desc_txt">
											중복선택가능합니다.
										</div>
									</div>
								</div>
								<div class="space_box_input">
									<!-- <div class="pay_type_wrap">
										<div class="pay_type ">
											<input name="pay_auth" id="pay_auth1" value="Y" type="radio" <?if($pay_auth=="Y"||!$pay_auth)		echo " checked";?>>
											<label for="pay_auth1">바로 결제</label>
										</div>
										<div class="pay_type ">
											<input name="pay_auth" id="pay_auth2" value="N" type="radio" <?if($pay_auth=="N")		echo " checked";?>>
											<label for="pay_auth2">승인후 결제</label>
										</div>
									</div> -->
									  <div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input name="pay_card" id="pay_type_01" value="Y" type="checkbox" <?if($pay_card=="Y")		echo " checked";?>>
											<label for="pay_type_01" <?if($pay_card=="Y")		echo "class=\"checkbox_on\"";?>>카드결제</label>
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input name="pay_bank" id="pay_type_02" value="Y" type="checkbox" <?if($pay_bank=="Y")		echo " checked";?>>
											<label for="pay_type_02" <?if($pay_bank=="Y")		echo "class=\"checkbox_on\"";?>>무통장입금</label>
										</div>
										<div class="space_st_cost">
											<input name="pay_bank_1" id="pay_bank_1" class="sp_st_input_01" type="text" placeholder="은행명" maxlength="20" style="ime-mode:active;" value="<?=$pay_bank_1?>">
										</div>
										<div class="space_st_cost">
											<input name="pay_bank_2" id="pay_bank_2" class="sp_st_input_01" type="text" placeholder="예금주명" maxlength="20" style="ime-mode:active;" value="<?=$pay_bank_2?>">
										</div>
										<div class="space_st_cost2">
											<input name="pay_bank_3" id="pay_bank_3"  value="<?=$pay_bank_3?>" maxlength="20" class="sp_st_input_02" style="ime-mode:disabled;" type="text" placeholder="계좌번호를 입력하세요." onkeypress="onlyNumber();">
										</div>
									</div>
									<div class="space_st_wrap">
										<div class="space_st_top agree_label_in">
											<input name="pay_offline" id="pay_type_03" value="Y" type="checkbox" <?if($pay_offline=="Y")		echo " checked";?>>
											<label for="pay_type_03" <?if($pay_offline=="Y")		echo "class=\"checkbox_on\"";?>>현장결제</label>
										</div>
									</div>
									<!-- <div class="help_txt">
										Share office 의 경우 하나의 공간을 두가지 유형으로 등록할 수 있습니다.
										책상단위 당 공유는 Desk, 방 전체를 공유하려면 Space 를 선택하세요.
										두가지 유형 모두 선택하는것도 가능합니다.
										단, Desk 에 예약이 발생 할 경우 Space 유형은 자동으로 비활성화 되며
										남는 Desk 가 있을경우에는 Desk가 계속 활성화 됩니다.
									</div> -->
								</div>
							</div>
						</div>
						<div class="s_view_btn_wrap">
							<div class="s_view_btn_in">
								<a href="javascript:history.back()" class="s_view_btn_fav">
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
function Save_C(num){
	if(CheckStr($('#comment'+num).val()," ","")==0){
		if(num==1){
			alert('상세설명을 입력해주세요.');
		}else{
			alert('유의사항을 입력해주세요.');
		}
		$('#comment'+num).focus();
		return;
	}
	$('#mode').val('c_tmp_ok');
	$('form[name="form0"]').submit();
}

function C_Del(uid,kind){
	$('#c_t_uid').val(uid);
	$('#c_t_kind').val(kind);
	$('#mode').val('c_tmp_del_ok');
	$('form[name="form0"]').submit();
}

function Save_Go(){
	if($('#ex_01').is(':checked')&&$('#e1_price').val()==""){
		alert('관리비 가격을 입력해주세요.');
		$('#e1_price').focus();
		return;
	}
	if($('#ex_02').is(':checked')&&$('#e2_price').val()==""){
		alert('청소비 가격을 입력해주세요.');
		$('#e2_price').focus();
		return;
	}
	if($('#p_limit').val()==""){
		alert('모집인원을 입력해주세요.');
		$('#p_limit').focus();
		return;
	}
	if($('#size1').val()==""){
		alert('평수를 입력해주세요.');
		$('#size1').focus();
		return;
	}
	if($('#size2').val()==""){
		alert('실평수를 입력해주세요.');
		$('#size2').focus();
		return;
	}
	if($('#pay_type_02').is(':checked')){
		if(CheckStr($('#pay_bank_1').val()," ","")==0){
			alert('은행명을 입력해주세요.');
			$('#pay_bank_1').focus();
			return;
		}
		if(CheckStr($('#pay_bank_2').val()," ","")==0){
			alert('예금주명을 입력해주세요.');
			$('#pay_bank_2').focus();
			return;
		}
		if(CheckStr($('#pay_bank_3').val()," ","")==0){
			alert('계좌번호를 입력해주세요.');
			$('#pay_bank_3').focus();
			return;
		}
	}
	 if($('#pay_type_01').is(':checked')==false&&$('#pay_type_02').is(':checked')==false&&$('#pay_type_03').is(':checked')==false){
//	if($('#pay_type_02').is(':checked')==false&&$('#pay_type_03').is(':checked')==false){
		alert('결제방식을 체크해주세요.');
		return;
	}

	<?if($uid){?>
	$('#mode').val('edit_ok');
	<?}else{?>
	$('#mode').val('insert_ok');
	<?}?>
	$('form[name="form0"]').submit();
}

function File2_Del(){
	if($('#image_01').is(':checked')||$('#image_02').is(':checked')||$('#image_03').is(':checked')){
		$('#mode').val('file_upload2_del_ok');
		$('form[name="form0"]').submit();
	}else{
		alert('삭제하실 이미지를 체크해주세요.');
		return;
	}
}

$('input[type=file]').change(function(){
	if (window.File && window.FileReader && window.FileList && window.Blob){
		var extension = $(this).val().split('.').pop().toLowerCase();
		if (extension == "") return;
		var validFileExtensions = ['jpeg', 'jpg', 'gif', 'png'];
		if ($.inArray(extension, validFileExtensions) == -1) {
			alert('사진은 오직 jpg, jpeg, gif, png 가능합니다.');
			return;
		} else {
			if ($(this).get(0).files[0].size > (1024 * 1024 * 10)) {
				alert('한 장당 최대 10MB까지 등록가능합니다.');
				return;
			}
		}

		if($('#img_file_01').val()){
			$('#mode').val('file_upload1_ok');
			$('form[name="form0"]').submit();
		}
		if($('#img_file_02').val()){
			$('#mode').val('file_upload2_ok');
			$('form[name="form0"]').submit();
		}
    }else{
        alert('브라우저 버전이 너무 낮습니다. html5를 지원하는 버전의 브라우저를 사용해주십시오.');
    }
});




$('#image_01').click(function(){
	if($("#image_01").is(':checked')){
		$('#image_01').next("label").addClass('checkbox_on');
	}else{
		$('#image_01').next("label").removeClass('checkbox_on');
	}
});

$('#image_02').click(function(){
	if($("#image_02").is(':checked')){
		$('#image_02').next("label").addClass('checkbox_on');
	}else{
		$('#image_02').next("label").removeClass('checkbox_on');
	}
});

$('#image_03').click(function(){
	if($("#image_03").is(':checked')){
		$('#image_03').next("label").addClass('checkbox_on');
	}else{
		$('#image_03').next("label").removeClass('checkbox_on');
	}
});

$('#image_04').click(function(){
	if($("#image_04").is(':checked')){
		$('#image_04').next("label").addClass('checkbox_on');
	}else{
		$('#image_04').next("label").removeClass('checkbox_on');
	}
});
$('#image_05').click(function(){
	if($("#image_05").is(':checked')){
		$('#image_05').next("label").addClass('checkbox_on');
	}else{
		$('#image_05').next("label").removeClass('checkbox_on');
	}
});
$('#image_06').click(function(){
	if($("#image_06").is(':checked')){
		$('#image_06').next("label").addClass('checkbox_on');
	}else{
		$('#image_06').next("label").removeClass('checkbox_on');
	}
});
</script>
</body>
</html>
