<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_view sub_book">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">예약하기</div>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">요약정보</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_box_50">
										<div class="table_01">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<th align="left" valign="middle" scope="row">주소</th>
													<td align="left" valign="middle">부산 동래구 온천동 1가 668-97 1층</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">보증금/임대료</th>
													<td align="left" valign="middle"><span class="color_red">300/50</span> 만원</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">사업자등록가능여부</th>
													<td align="left" valign="middle">가능</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">최소예약기간</th>
													<td align="left" valign="middle">1개월</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">ETC</th>
													<td align="left" valign="middle"></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">공간유형</th>
													<td align="left" valign="middle">가상오피스</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">평수/실평수</th>
													<td align="left" valign="middle">40평/30평</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">주차장</th>
													<td align="left" valign="middle">20,000/월</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">모집인원</th>
													<td align="left" valign="middle"></td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">상주인원</th>
													<td align="left" valign="middle"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="s_view_info_box_50">
										<div class="table_01">
											<div class="pt_box">
												<div class="slider_01">
													<ul class="bxslider_01">
														<li>
															<a href="/space/view.php" target="_blank">
																<img src="/images/temp/item_01.jpg" alt="">
															</a>
														</li>
														<li>
															<a href="/space/view.php" target="_blank">
																<img src="/images/temp/item_02.jpg" alt="">
															</a>
														</li>
													</ul>
												</div>
												<div class="pt_box_info">
													<div class="pt_box_info_in">
														<div class="pt_box_txt_01">
															<a href="/space/view.php" target="_blank">동래센트럴파크 오피스텔</a>
														</div>
														<div class="pt_box_txt_02">
															위치 : 부산 동래구 온천동
														</div>
														<div class="pt_box_txt_03">
															분류 : 쉐어오피스
														</div>
														<div class="pt_box_star">
															<img src="/images/common/star_5.png">
														</div>
													</div>
													<span class="pt_cost">&#92;150,000</span>
												</div>
												<div class="pt_type">
													<span class="pt_type_01">바로결제</span>
													<span class="pt_type_02">멤버십할인</span>
													<span class="pt_type_03">승인결제</span>
												</div>
											</div>
											<script type="text/javascript">
												var slider_01 = $('.bxslider_01').bxSlider({
													mode: 'fade',
													useCSS: false
												});

											</script>
										</div>
									</div>
								</div>
								
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">편의시설</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_tv.png">
												</th>
												<td align="left" valign="middle">TV/프로젝터</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_it.png">
												</th>
												<td align="left" valign="middle">인터넷/WIFI</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_photo.png">
												</th>
												<td align="left" valign="middle">영상촬영가능</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_print.png">
												</th>
												<td align="left" valign="middle">복사/인쇄기</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_av.png">
												</th>
												<td align="left" valign="middle">음향시설</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_fire.png">
												</th>
												<td align="left" valign="middle">취사시설</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_eat.png">
												</th>
												<td align="left" valign="middle">음실물반입가능</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_alcohol.png">
												</th>
												<td align="left" valign="middle">주류반입가능</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_shower.png">
												</th>
												<td align="left" valign="middle">샤워시설</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_park.png">
												</th>
												<td align="left" valign="middle">주차가능</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_nosmoke.png">
												</th>
												<td align="left" valign="middle">금연</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_pc.png">
												</th>
												<td align="left" valign="middle">PC/노트북</td>
											</tr>
										</table>
									</div>
									<div class="s_view_expend">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th align="center" valign="middle" scope="row">
													<img src="/images/icon/icon_table.png">
												</th>
												<td align="left" valign="middle">의자/테이블</td>
											</tr>
										</table>
									</div>
								</div>
								
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">날짜 선택</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="cal_input_label">
										2016.10.04.(수) - 2016.10.09.(화)
									</div>
									<div class="cal_top">
										<div class="cal_date_label">2016년 10월</div>
										<a href="javascript:void(0)" class="cal_prev_month">이전달</a>
										<a href="javascript:void(0)" class="cal_next_month">이전달</a>
									</div>
									<div class="day_to_day">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th scope="col">일</th>
												<th scope="col">월</th>
												<th scope="col">화</th>
												<th scope="col">수</th>
												<th scope="col">목</th>
												<th scope="col">금</th>
												<th scope="col">토</th>
											</tr>
											<tr>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">1</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable today_on">
													<a href="javascript:void(0)">
														<span class="date">2</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">3</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">4</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">5</span>
														<span class="date_price">40,000</span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">6</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">7</span>
														<span class="date_price">40,000</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">8</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">9</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">10</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">11</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">12</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">13</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">14</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">15</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">16</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">17</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">18</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">19</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">20</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">21</span>
														<span class="date_price"></span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">22</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">23</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">24</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">25</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">26</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">27</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">28</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">29</span>
														<span class="date_price">35,000</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">30</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">31</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">1</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">2</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">3</span>
														<span class="date_price"></span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">4</span>
														<span class="date_price"></span>
													</a>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">날짜 선택</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="cal_input_label">
										2016.10.04.(수)
									</div>
									<div class="cal_top">
										<div class="cal_date_label">2016년 10월</div>
										<a href="javascript:void(0)" class="cal_prev_month">이전달</a>
										<a href="javascript:void(0)" class="cal_next_month">이전달</a>
									</div>
									<div class="day_to_day day_to_time">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th scope="col">일</th>
												<th scope="col">월</th>
												<th scope="col">화</th>
												<th scope="col">수</th>
												<th scope="col">목</th>
												<th scope="col">금</th>
												<th scope="col">토</th>
											</tr>
											<tr>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">1</span>
													</a>
												</td>
												<td class="disiable today_on">
													<a href="javascript:void(0)">
														<span class="date">2</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">3</span>
													</a>
												</td>
												<td class="able day_pick">
													<a href="javascript:void(0)">
														<span class="date">4</span>
													</a>
												</td>
												<td class="able ">
													<a href="javascript:void(0)">
														<span class="date">5</span>
													</a>
												</td>
												<td class="able ">
													<a href="javascript:void(0)">
														<span class="date">6</span>
													</a>
												</td>
												<td class="able ">
													<a href="javascript:void(0)">
														<span class="date">7</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able ">
													<a href="javascript:void(0)">
														<span class="date">8</span>
													</a>
												</td>
												<td class="able ">
													<a href="javascript:void(0)">
														<span class="date">9</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">10</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">11</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">12</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">13</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">14</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">15</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">16</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">17</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">18</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">19</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">20</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">21</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">22</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">23</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">24</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">25</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">26</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">27</span>
													</a>
												</td>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">28</span>
													</a>
												</td>
											</tr>
											<tr>
												<td class="able">
													<a href="javascript:void(0)">
														<span class="date">29</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">30</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">31</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">1</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">2</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">3</span>
													</a>
												</td>
												<td class="disiable">
													<a href="javascript:void(0)">
														<span class="date">4</span>
													</a>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">시간 선택</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="cal_input_label">
										12시~17시, 5시간
									</div>
									<div class="time_slider_wrap">
										<div class="time_slider">
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time_txt">오전</span>
													<span class="time">0</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">1</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">2</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">3</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">4</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">5</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">6</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">7</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">8</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box disiable">
													<span class="time">9</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box disiable">
													<span class="time">10</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box disiable">
													<span class="time">11</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time_txt">오전</span>
													<span class="time">12</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">13</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">14</span>
													<span class="price">25,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">15</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">16</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">17</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">18</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">19</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">20</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">21</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">22</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">23</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time_txt">익일</span>
													<span class="time">24</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">1</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">2</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">3</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">4</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">5</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">6</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">7</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">8</span>
													<span class="price">33,000</span>
												</a>
											</div>
											<div>
												<a href="javascript:void(0);" class="time_box able">
													<span class="time">9</span>
													<span class="price">44,000</span>
												</a>
											</div>
										</div>
										<script type="text/javascript">
											$('.time_slider').slick({
												dots: false,
												infinite: false,
												slidesToShow: 8,
												slidesToScroll: 4,
												swipeToSlide:true,
												appendArrows: false,
												responsive: [
												{
													breakpoint: 1024,
													settings: {
														slidesToShow: 6,
														slidesToScroll: 3
													}
												},
												{
													breakpoint: 600,
													settings: {
														slidesToShow: 6,
														slidesToScroll: 3
													}
												},
												{
													breakpoint: 480,
													settings: {
														slidesToShow: 6,
														slidesToScroll: 3
													}
												}
												]
											});
										</script>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">예약자정보</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이름</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="book_input_01" value="홍길동" placeholder="이름을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">연락처</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="book_input_01" value="010-1234-5678" placeholder="(-)를 제외하고 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이메일</div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="book_input_01" value="hong@naver.com" placeholder="이메일을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">메모</div>
										<div class="s_view_desc_txt_desc">
											<textarea class="book_area_01" placeholder="남기고 싶은말을 적어주세요."></textarea>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">사용인원</div>
										<div class="s_view_desc_txt_desc">
											<div class="select_num_wrap">
												<div class="select_num">
													<input type="text" name="" readonly value="5">
												</div>
												<a href="javascript:void(0)" class="select_num_minus">-</a>
												<a href="javascript:void(0)" class="select_num_plus">+</a>
											</div>
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">옵션선택</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="option_box_wrap">
										<div class="option_box">
											<input type="checkbox" name="" id="option_01">
											<label for="option_01">
												<span class="option_box_label">주차장</span>
												<span class="option_box_cost">월/20000원</span>
											</label>
										</div>
										<div class="option_box">
											<input type="checkbox" name="" id="option_02">
											<label for="option_02">
												<span class="option_box_label">CCTV 설치 요청</span>
												<span class="option_box_cost">설치비/30000원</span>
											</label>
										</div>
										<div class="option_box">
											<input type="checkbox" name="" id="option_03">
											<label for="option_03">
												<span class="option_box_label">입주청소</span>
												<span class="option_box_cost">1회/50000원</span>
											</label>
										</div>
										<div class="option_box">
											<input type="checkbox" name="" id="option_04">
											<label for="option_04">
												<span class="option_box_label">화이트보드</span>
												<span class="option_box_cost">5000원</span>
											</label>
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">호스트정보</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이름</div>
										<div class="s_view_desc_txt_desc">
											홍길동
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">연락처</div>
										<div class="s_view_desc_txt_desc">
											<a href="tel:05012345678">050-1234-5678</a>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이메일</div>
										<div class="s_view_desc_txt_desc">
											<a href="mailto:spacepool@naver.com">spacepool@naver.com</a>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">소재지</div>
										<div class="s_view_desc_txt_desc">
											서울특별시 서초구 양재동 84-13 지하2층 카페온베이프
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">이용규칙, 예약시 주의사항</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num">1</div>
										<div class="s_view_desc_txt_desc">
											공간 이용 후 깨끗하게 정리 당부드립니다.
										</div>
									</div>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num">2</div>
										<div class="s_view_desc_txt_desc">
											주택가에 위치하여 있어 소음에 민감합니다. 지나치게 시끄럽거나 주변에 방해가 되는 모임은 지양해주세요
										</div>
									</div>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num">3</div>
										<div class="s_view_desc_txt_desc">
											외부 음식물 중 포장이 되어 있고, 냄새가 심하지 않은 케이터링 및 도시락 반입은 가능합니다.
										</div>
									</div>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num">4</div>
										<div class="s_view_desc_txt_desc">
											대관 시 상황에 따라 1층과 지하 1층 중 다른 한 쪽은 살롱 공간으로 정상 운영될 수 있습니다. 외부인의 진입에 대한 통제가 필요한 경우 사전에 말씀 부탁드립니다.
										</div>
									</div>
									<div class="s_view_desc_txt">
										<div class="s_view_desc_txt_num">5</div>
										<div class="s_view_desc_txt_desc">
											주차 공간이 협소하므로, 가급적 대중교통을 이용해 주시면 감사드리겠습니다. 부득이하게 승용차를 이용하시는 경우에는 서울숲 공영주차장을 이용 부탁드립니다.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="view_fixed_all_wrap">
						<div class="view_fixed_wrap">
							<div class="view_fixed_box">
								<a href="/space/view.php" class="view_fixed_cancel_box">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/s_menu_close_btn.png">
									</span>
									<span class="view_fixed_cancel_txt">취소</span>
								</a>
							</div>
							<div class="view_fixed_box">
								<a href="/space/order.php" class="view_fixed_book_box">
									<span class="view_fixed_book_icon">
										<img src="/images/common/view_fixed_book_icon.png">
									</span>
									<span class="view_fixed_book_txt">예약신청</span>
								</a>
							</div>
						</div>
					</div>
					<div class="f_pop_wrap">
						<div class="f_pop_bg"></div>
						<div class="f_pop">
							<div class="f_pop_label">전화문의 안내</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name">
									동래센트럴파크 오피스텔
								</div>
								<div class="f_pop_desc_tel">
									<a href="tel:05012345678">050-1234-5678</a>
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
</body>
</html>