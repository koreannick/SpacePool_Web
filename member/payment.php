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
							<div class="space_box">
								<div class="space_box_label">
									<div class="space_box_label_left">
										지불정보
									</div>
									<div class="space_box_label_right">

									</div>
								</div>
								<div class="space_box_input">
									<div class="input_table pay_table">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="col" class="pay_tb_01">예약번호</th>
												<th align="center" valign="middle" scope="col" class="pay_tb_02">결제일</th>
												<th align="center" valign="middle" scope="col" class="pay_tb_03">예정금액</th>
												<th align="center" valign="middle" scope="col" class="pay_tb_04">입금일</th>
											</tr>
											<tr>
												<td align="center" valign="middle" class="pay_tb_01">
													<a href="host_book_detail.php?kind=5&uid=2&page=1" target="_blank">15115</a>
												</td>
												<td align="center" valign="middle" class="pay_tb_02">
													16.10.28
												</td>
												<td align="center" valign="middle" class="pay_tb_03">
													240,000원
												</td>
												<td align="center" valign="middle" class="pay_tb_04">
													<span class="pay_span_01">
														대기
													</span>
												</td>
											</tr>
											<tr>
												<td align="center" valign="middle" class="pay_tb_01">
													<a href="host_book_detail.php?kind=5&uid=2&page=1" target="_blank">15115</a>
												</td>
												<td align="center" valign="middle" class="pay_tb_02">
													16.10.28
												</td>
												<td align="center" valign="middle" class="pay_tb_03">
													240,000원
												</td>
												<td align="center" valign="middle" class="pay_tb_04">
													<span class="pay_span_02">
														16.10.29
													</span>
												</td>
											</tr>
											<tr>
												<td align="center" valign="middle" class="pay_tb_01">
													<a href="host_book_detail.php?kind=5&uid=2&page=1" target="_blank">15115</a>
												</td>
												<td align="center" valign="middle" class="pay_tb_02">
													16.10.28
												</td>
												<td align="center" valign="middle" class="pay_tb_03">
													240,000원
												</td>
												<td align="center" valign="middle" class="pay_tb_04">
													<span class="pay_span_02">
														16.10.29
													</span>
												</td>
											</tr>
											<tr>
												<td align="center" valign="middle" class="pay_tb_01">
													<a href="host_book_detail.php?kind=5&uid=2&page=1" target="_blank">15115</a>
												</td>
												<td align="center" valign="middle" class="pay_tb_02">
													16.10.28
												</td>
												<td align="center" valign="middle" class="pay_tb_03">
													240,000원
												</td>
												<td align="center" valign="middle" class="pay_tb_04">
													<span class="pay_span_02">
														16.10.29
													</span>
												</td>
											</tr>
										</table>
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