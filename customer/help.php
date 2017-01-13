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
	<div id="wrap" class="sub sub_customer sub_board sub_help">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
							<a href="/customer/notice.php" class="">공지사항</a>
							<a href="/customer/help.php" class="active">도움말</a>
							<a href="/customer/qna.php" class="">질문하기</a>
							<a href="/customer/space.php" class="">공간별 설명</a>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">도움말</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<?include_once($DOCUMENT_ROOT."/s_source/faq/_list.php");?>
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
