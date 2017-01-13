<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<script language=javascript>
	<!--
// 탈퇴 체크
function check_leave(){
	if(confirm("회원탈퇴 하시겠습니까?\r\r탈퇴하시면 회원님의 모든 정보가 즉시 삭제됩니다.")){
		location.href="<?=$_SERVER[PHP_SELF]?>?mode=leave_ok";
	}
}
-->
</script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_list">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<?require "member_top_m.php";?>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">서비스 탈퇴</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="member_wrap">
										<div class="member_title_wrap">
											<div class="member_title_01">회원탈퇴와 동시에 해당 개인정보 및 홈페이지 관련 정보는 삭제됩니다.</div>
											<div class="member_title_02">일부 정보는 추후 일어날 수 있는 문제로 일정기간 동안 보관 될 수 있습니다.</div>
										</div>
										<div class="member_form_wrap">
											<div class="member_form">
												<div class="title">회원탈퇴에 동의하며 회원 탈퇴를 신청합니다.</div>
												<div class="member_form_in_wrap">
													<div class="member_form_in">
														가입하신 아이디 : <strong><?=$USESSION[0]?></strong><br>
														회원탈퇴 하시겠습니까?<br>
														회원 탈퇴로 인한 개인정보 삭제 및 관련 정보 삭제로 인해 발생하는 문제는 책임지지 않습니다.
													</div>
												</div>
											</div>
										</div>
										<div class="member_btn_wrap">
											<button type="button" onclick="check_leave();"><img src="/s_source/images/member/btn-orange-big-dropout.gif" alt=""></button>
										</div>
									</div>
								</div>
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