<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

$connect = dbcon();

?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_customer sub_board sub_space">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
							<a href="/customer/notice.php" class="">공지사항</a>
							<a href="/customer/help.php" class="">도움말</a>
							<a href="/customer/qna.php" class="">질문하기</a>
							<a href="/customer/service.php" class="active">부가서비스</a>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">부가서비스</div>
									<span class="s_view_info_label_line"></span>
								</div>
								곧 더 다양하고 좋은 서비스들로 다가가겠습니다.
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