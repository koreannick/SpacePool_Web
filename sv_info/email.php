<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

$connect = dbcon();

$table = "es_faq";

?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_customer sub_board sub_privacy">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
							<a href="/sv_info/terms.php" class="">이용약관</a>
							<a href="/sv_info/privacy.php" class="">개인정보처리방침</a>
							<a href="/sv_info/email.php" class="active">이메일무단수집거부</a>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">이메일무단수집거부</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="board_wrap">
										<dl>
											<dd>본 웹사이트는 게시된 이메일 주소가 전자우편 수집 프로그램이나 그 밖의 기술적 장치를 이용하여 무단 수집되는 것을 거부합니다.
이를 위반시 『정보통신망 이용 촉진 및 정보보호 등에 관한 법률』등에 의해 처벌 받을 수 있습니다.</dd>
										</dl>
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