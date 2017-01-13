<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

if($id){
	$result = mysql_query("select * from es_member where email like '$id%'");
	if($result&&mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		foreach($r as $key=>$val){
			$$key = stripslashes($val);
		}
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
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_list">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">
								회원정보
							</div>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_box">
									<?if($m_kind=="m1"){?>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이름</div>
										<div class="s_view_desc_txt_desc">
											<?=$name?>
										</div>
									</div>
									<?}elseif($m_kind=="m2"){?>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">업체명</div>
										<div class="s_view_desc_txt_desc">
											<?=$company?>
										</div>
									</div>
									<?}?>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">전화번호</div>
										<div class="s_view_desc_txt_desc">
											<?=$tel?>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">휴대폰번호</div>
										<div class="s_view_desc_txt_desc">
											<?=$mobile?>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">주소</div>
										<div class="s_view_desc_txt_desc">
											<?=$post?> <?=$addr1?> <?=$addr2?>
										</div>
									</div>
									<?if($m_kind=="m2"){?>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">업종</div>
										<div class="s_view_desc_txt_desc">
											<?=$cetc?>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">직원 수</div>
										<div class="s_view_desc_txt_desc">
											<?=$cperson?>명
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">사업기간</div>
										<div class="s_view_desc_txt_desc">
											<?=$cdate1?>년 <?=$cdate2?>개월
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">사업내용</div>
										<div class="s_view_desc_txt_desc">
											<?=nl2br($comment)?>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">사업자등록번호</div>
										<div class="s_view_desc_txt_desc">
											<a href="javascript:void(0)" onclick="onopen();" class="sing_btn_01">정보확인</a>
										</div>
									</div>
									<script language="JavaScript">
										function onopen(){
											var url =
											"http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=<?=str_replace('-','',$creg)?>";
											window.open(url, "communicationViewPopup", "width=750, height=700;");
										}
									</script>
									<?}?>
								</div>
							</div>
						</div>
						<div class="cm_wrap">
							<a href="javascript:close();" class="cm_ok_btn">확인</a>
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