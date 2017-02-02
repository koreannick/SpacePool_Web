<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";

$connect = dbcon();

if($uid){
	$result = mysql_query("select subject,gubun,id from es_product where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$subject = check_box(stripslashes(mysql_result($result,0,0)));
		$gubun = mysql_result($result,0,1);
		$id = mysql_result($result,0,2);

		if($id!=$USESSION[0]&&auth_lev()!=9){
			redir_proc3("/member/space_host.php","본인데이터가 아니므로 수정하실 수 없습니다.");
			exit;
		}
	}
	@mysql_free_result($result);
}else{
	$gubun = 1;
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
						<form name="form0" target="" method="get" action="space_apply2.php">
						<?if($uid){?>
						<input type="hidden" name="uid" value="<?=$uid?>">
						<?}?>
						<div class="page_label_wrap">
							<div class="page_label">공간<?if($uid)		echo "수정";		else		echo "등록";?></div>
						</div>
						<div class="m_top_nav_wrap">
							<a href="javascript:void(0)" class="active">1. 공간유형</a>
							<a href="javascript:void(0)" class="">2. 가격설정</a>
							<a href="javascript:void(0)" class="">3. 정보입력</a>
						</div>
						<div class="s_view_desc">
							<div class="space_box">
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간명 입력<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="space_input">
										<input type="text" name="subject" maxlength="20" value="<?=$subject?>" style="ime-mode:active;" must="Y" mval="공간명은">
									</div>
									<span>공간명은 20자로 제한됩니다.</span>
								</div>
							</div>
							<div class="space_box">
								<div class="space_box_label">
									<div class="space_box_label_left">
										공간타입 선택<span>*</span>
									</div>
									<div class="space_box_label_right"></div>
								</div>
								<div class="space_box_input">
									<div class="pay_type_wrap">
										<?
										for($i=1;$i<=count($gubun_arr);$i++){
										if($gubun_arr[$i]){
										?>
										<div class="pay_type">
											<input type="radio" name="gubun" value="<?=$i?>" id="gubun<?=$i?>" <?if($i==$gubun)		echo " checked";?>>
											<label for="gubun<?=$i?>">
												<?=$gubun_arr[$i]?>
											</label>
										</div>
										<?}
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="s_view_btn_wrap">
							<div class="s_view_btn_in">
								<a href="javascript:history.back()" class="s_view_btn_fav">
									<div>
										<span class="s_view_btn_txt">취소</span>
									</div>
								</a>
								<a href="javascript:ValidChk3(document.form0);" class="s_view_btn_book">
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
</body>
</html>
