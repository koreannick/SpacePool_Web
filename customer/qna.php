<?
$table = "es_free2";
include_once($_SERVER[DOCUMENT_ROOT] . "/s_source/esboard/_esboard_config.php");
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_customer sub_board">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
							<a href="/customer/notice.php" class="">공지사항</a>
							<a href="/customer/help.php" class="">도움말</a>
							<a href="/customer/qna.php" class="active">질문하기</a>
							<a href="/customer/space.php" class="">공간별 설명</a>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">질문과답변</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="board_wrap">
										<?include_once($_SERVER[DOCUMENT_ROOT] . $page_source);?>
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
