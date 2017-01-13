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
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?=$map_client_id?>"></script>
<link rel="stylesheet" type="text/css" href="./_Map_css.css" />
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_view">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">이용완료</div>
						</div>
						<div class="s_view_desc">
							<div class="s_view_info_wrap">
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">예약정보</div>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_box_100">
										<div class="table_01">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<th align="left" valign="middle" scope="row">주소</th>
													<td align="left" valign="middle">
														<a href="/space/view.php" target="_blank">동래센트럴파크 오피스텔</a>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">공간유형</th>
													<td align="left" valign="middle">쉐어오피스</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">수용인원</th>
													<td align="left" valign="middle">2명</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">책상 수</th>
													<td align="left" valign="middle">2개</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">평수/실평수</th>
													<td align="left" valign="middle">40평/30평</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">체크인</th>
													<td align="left" valign="middle">
														2016.10.27.(목)
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">체크아웃</th>
													<td align="left" valign="middle">
														2016.10.28.(금)
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">예약형태</th>
													<td align="left" valign="middle">
														Space -250,000원/월
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">인원</th>
													<td align="left" valign="middle">
														2 명
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">추가사항</th>
													<td align="left" valign="middle">
														<div class="plus_pay">
															+20,000원 (관리비/월)
														</div>
														<div class="plus_pay">
															+10,000원 (청소비/월)
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제 금액</th>
													<td align="left" valign="middle">
														<div class="total_pay">
															137,500원
														</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제방식</th>
													<td align="left" valign="middle">
														<div class="plus_pay">계좌이체</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">계좌번호</th>
													<td align="left" valign="middle">
														<div class="plus_pay">부산은행 454-48454054-44474</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">결제방식</th>
													<td align="left" valign="middle">
														<div class="plus_pay">신용카드</div>
													</td>
												</tr>
												<tr>
													<th align="left" valign="middle" scope="row">카드정보</th>
													<td align="left" valign="middle">
														<div class="plus_pay">신한카드 8894-4544-4477-1525</div>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">지도</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="s_view_info_map">
										<div class="temp_map">
											<?
											$address = "전포동207-2천일빌딩2층";

											$json_result = geocode($address);

											$data = json_decode($json_result,true);

											$map_x = $data['result']['items'][0]['point']['x'];

											$map_y = $data['result']['items'][0]['point']['y'];
											?>
											<div id="map" style="width:100%;height:500px;">
											</div>
											<script type="text/javascript">
											$(function() {
												var $window = $(window),
													$article = $('#map').parent(),
													magic = 0;

												if ($article[0].tagName === 'BODY') {
													magic = 0;
												}

												//function getMapSize() {
												//	return new naver.maps.Size($article.width(), $window.height() - magic);
												//}

												var map = new naver.maps.Map('map', {
													center: new naver.maps.LatLng(<?=$map_y?>, <?=$map_x?>),
													scaleControl: true,
													logoControl: true,
													mapDataControl: true,
													mapTypeControl: true,
													zoomControl: true,
													zoomControlOptions: {
														position: naver.maps.Position.TOP_LEFT
													},
													//size: getMapSize(),
													minZoom: 1,
													zoom: 12
												});

												var marker = new naver.maps.Marker({
													position: new naver.maps.LatLng(<?=$map_y?>, <?=$map_x?>),
													map: map
												});

												function fitMap() {
													map.setSize(getMapSize());
												}

												$window.on("resize", fitMap);
											});
											</script>
										</div>
									</div>
									<div class="s_view_info_map_find">
										<a href="http://map.naver.com/?queryType=departure&elng=<?=$map_x?>&elat=<?=$map_y?>&eText=가우테크&pinType=site&dlevel=12&enc=utf8" class="map_find_btn" target="_blank">
											<span class="map_find_icon">
												<img src="/images/common/mpa_find_icon.png">
											</span>
											<span class="map_find_txt">길찾기</span>
										</a>
									</div>
									<div class="s_view_host_info_wrap">
										<div class="s_view_host_info_left">
											<div class="s_view_host_info_img">
												<img src="/images/temp/host.jpg" alt="호스트이름" title="호스트이름">
											</div>
										</div>
										<div class="s_view_host_info_right">
											<div class="s_view_host_label">HOST</div>
											<div class="s_view_host_name">동래센트럴파크 오피스텔</div>
											<div class="s_view_host_address">부산 동래구 온천동 1가 668-97 1층</div>
										</div>
									</div>
								</div>
								<div class="s_view_info_label_wrap">
									<div class="s_view_info_label">이용후기</div>
									<span class="s_view_info_label_line"></span>
								</div>
								<div class="s_view_info_box">
									<div class="view_board_wrap">
										<div class="view_board">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<th align="center" valign="middle" scope="col">이용후기</th>
													<th width="100" align="center" valign="middle" scope="col">만족도</th>
													<th width="100" align="center" valign="middle" scope="col">ID</th>
													<th width="100" align="center" valign="middle" scope="col">등록일</th>
												</tr>
												<tr>
													<td align="left" valign="middle">잘 놀다 갑니다.</td>
													<td width="100" align="center" valign="middle">
														<img src="/images/common/star_1.png">
													</td>
													<td width="100" align="center" valign="middle">saja****</td>
													<td width="100" align="center" valign="middle">2016.10.04</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="view_fixed_all_wrap">
						<div class="view_fixed_wrap">
							<div class="view_fixed_box">
								<a href="#" class="view_fixed_cancel_box pay_end">
									<span class="view_fixed_cancel_icon">
										<img src="/images/common/review_icon.png">
									</span>
									<span class="view_fixed_cancel_txt">후기수정</span>
								</a>
							</div>
							<div class="view_fixed_box">
								<a href="https://talk.naver.com" class="view_fixed_book_box " target="_blank">
									<span class="view_fixed_book_icon">
										<img src="/images/common/talk.png">
									</span>
									<span class="view_fixed_book_txt">네이버톡톡</span>
								</a>
							</div>
						</div>
					</div>
					<div class="f_pop_wrap">
						<a href="#내역" class="f_pop_bg"></a>
						<div class="f_pop">
							<div class="f_pop_label3">후기수정</div>
							<div class="f_pop_review">
								<div class="review_star">
									<div class="review_label">별점</div>
									<div class="view_board_write_select">
										<div class="star_wrap">
											<div class="star_top txt_none star_04">
												<div class="star_input">
													<span>만족도를 선택하세요.</span>
													<div class="star_img_view"></div>
												</div>
												<a href="javascript:void(0)" class="star_open">열기</a>
											</div>
											<div class="star_option" style="display: none; height: 0px;">
												<label for="star_5" class="star_label_05">
												</label>
												<input type="radio" name="star" id="star_5" value="star_05">
												<label for="star_4" class="star_label_04">
												</label>
												<input type="radio" name="star" id="star_4" value="star_04">
												<label for="star_3" class="star_label_03">
												</label>
												<input type="radio" name="star" id="star_3" value="star_03">
												<label for="star_2" class="star_label_02">
												</label>
												<input type="radio" name="star" id="star_2" value="star_02">
												<label for="star_1" class="star_label_01">
												</label>
												<input type="radio" name="star" id="star_1" value="star_01">
											</div>
										</div>
										<script type="text/javascript">
											$(document).ready(function(){
												$(".star_open").click(function(){
													if($(".star_option ").css("display") == "none"){
														$('.star_option').show();
														$('.star_option').animate({
															height: "145px"
														}, 200);
													} else {
														$('.star_option').animate({
															height: "0px"
														}, 200);
														$('.star_option').hide({
														}, 10);
													}
												})
											});
											$(document).ready(function(){
												$(".star_option input").on('change', function() {
													var selectStar_name = $('.star_option input:checked').val();
													$('.star_top').addClass("txt_none");
													$('.star_top').removeClass("star_01");
													$('.star_top').removeClass("star_02");
													$('.star_top').removeClass("star_03");
													$('.star_top').removeClass("star_04");
													$('.star_top').removeClass("star_05");
													$('.star_top').addClass(selectStar_name);
													$('.star_option').animate({
														height: "0px"
													}, 200);
													$('.star_option').hide({
													}, 10);
												});
											});
										</script>
									</div>
								</div>
							</div>
							<div class="f_pop_review_input">
								<div class="f_pop_review_input_in">
									<div class="review_label">후기내용</div>
									<div class="view_board_write_select">
										<textarea></textarea>
									</div>
								</div>
							</div>
							<div class="f_pop_close">
								<a href="#" class="f_pop_close_btn">확인</a>
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