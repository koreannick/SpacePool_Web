<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_page">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="sub_visual_wrap">
				<div class="sub_visual">
					<div class="slider2">
						<ul class="bxslider2">
							<li>
								<a href="#">
									<img src="/images/sub/about_01.jpg" alt="">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="/images/sub/about_02.jpg" alt="">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="/images/sub/about_03.jpg" alt="">
								</a>
							</li>
							<li>
								<a href="#">
									<img src="/images/sub/about_04.jpg" alt="">
								</a>
							</li>
						</ul>
					</div>
					<div class="view_visual_wrap">
						<div class="vs_in">
							<div class="vs_txt_01">
								About Us
							</div>
							<div class="vs_img">
								<img src="/images/common/b_logo.png" alt="">
							</div>
							<div class="vs_txt_02">
								공간을 더욱 더 스마트하게!<br>
								당신의 사업에 도약의 발판을 마련합니다.
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							var slider2 = $('.bxslider2').bxSlider({
								auto: true,
								autoControls: false,
								useCSS: false,
								mode: 'fade'
							});
						});
					</script>
				</div>
			</div>
			<div class="con_wrap">
				<div class="ab_box_wrap">
					<div class="ab_box_label">
						<div class="ab_box_label_01">
							공간을 나누다, 가능성을 더하다
						</div>
						<div class="ab_box_label_02">
							"SpacePool은 공유의 개념을 사무실에 도입하여 기업들이<br>
							성공하기 위한 공간과 기회를 제공하는 플랫폼"
						</div>
					</div>
					<div class="ab_box_in">
						<div class="ab_box">
							<div class="ab_box_33">
								<img src="/images/sub/ab_img_01.jpg">
							</div>
							<div class="ab_box_33">
								<img src="/images/sub/ab_img_02.jpg">
							</div>
							<div class="ab_box_33">
								<img src="/images/sub/ab_img_03.jpg">
							</div>
						</div>
					</div>
					<div class="ab_box_label">
						<div class="ab_box_label_01">
							사무실 공유 플랫폼
						</div>
					</div>
				</div>
				<div class="con_in">
					<div class="about_box_02">
						<div class="font_label_03">스페이스풀은 공간에 대한 새로운 생각을 제안합니다.</div>
					</div>
					<div class="about_box_03">
						<div class="img_33">
							<div class="icon_box_a">
								<img src="/images/sub/about_icon_01.png">
							</div>
							<div class="font_label_04">더욱 쉽고 빠르게</div>
							<div class="font_label_05">
								PC및 모바일에서<br>
								필요한 장소를 예약부터<br>
								결제까지 쉽고 빠르게
							</div>
						</div>
						<div class="img_33">
							<div class="icon_box_a">
								<img src="/images/sub/about_icon_02.png">
							</div>
							<div class="font_label_04">나에게 맞는 공간</div>
							<div class="font_label_05">
								내가 필요한 공간을<br>
								지역 및 가격별로<br>
								찾아드립니다.
							</div>
						</div>
						<div class="img_33">
							<div class="icon_box_a">
								<img src="/images/sub/about_icon_03.png">
							</div>
							<div class="font_label_04">사무공간 특화</div>
							<div class="font_label_05">
								사무공간에 특화된<br>
								스페이스 풀에서 모든 사무공간을<br>
								만나보실 수 있습니다.
							</div>
						</div>
					</div>
					<!-- <div class="about_box_01">
						<div class="font_label_03">사무실 공간은 Space Pool과 함께!</div>
						<div class="font_label_02">나에게 맞는 공간을 스페이스 풀에서 찾아보세요.</div>
					</div>
					<div class="main_con_01_box">
						<div class="main_con_01_box_left">
							<img src="/images/main/main_con_01_box_left.jpg">
						</div>
						<div class="main_con_01_box_right">
							<div class="main_con_01_box_right_in">
								<div class="font_label_01">
									공간을 나누고 수익을 창출하세요.
								</div>
								<div class="font_label_02">
									남는 공간, 사용하지 않는 공간, 함께 나누고 싶은 공간이 있다면, 스페이스풀에
									공유해주세요! <br>
									편리한 공간등록 부터 예약이 들어오면 문자로 알려드려며 승인 버튼을 누르면
									곧바로 예약이 완료되고 스마트하고 편리한 관리시스템까지.<br>
									무의미한 공간에서 수익을 창출하는 황금오리로!
								</div>
								<div>
									<a href="/member/space_apply.php" class="main_go_space_regi">
										공간 등록하기
									</a>
								</div>
							</div>
						</div>
					</div> -->
					<div class="about_box_04">
						<div class="about_box_04_left">
							<div class="font_label_01">
							당신의 성공파트너 SpacePool
							</div>
							<div class="about_con">
								<div class="about_con_box">
									<div class="about_con_label">
										고객센터 :
									</div>
									<div class="about_con_desc">
										051-000-0000
									</div>
								</div>
								<div class="about_con_box">
									<div class="about_con_label">
										운영시간 :
									</div>
									<div class="about_con_desc">
										10시 00분 ~ 17시 00분 까지<br>
										<span class="txt_color_red">(토,일, 공휴일 휴무입니다. 점심 12시 ~ 13시까지)</span>
									</div>
								</div>
								<div class="about_con_box">
									<div class="about_con_label">
										이메일문의 :
									</div>
									<div class="about_con_desc">
										<a href="mailto:help@spacepool.com">help@spacepool.com</a>
									</div>
								</div>
								<div class="about_con_box">
									<div class="about_con_label">
										주소 :
									</div>
									<div class="about_con_desc">
										부산광역시 00구 00로 00번길 00 (00동)
									</div>
								</div>
							</div>
							<div>
								<a href="/partner/contact.php" class="main_go_space_regi go_contact">
									제휴문의 바로가기
								</a>
							</div>
						</div>
						<div class="about_box_04_right">
							<img src="/images/sub/about_box_04_right.jpg">
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