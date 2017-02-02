<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";



$connect = dbcon();

require "count.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<?
require "popup_proc.php";
require "popup_layer.php";
?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="main">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="main_con_wrap">
				<div class="main_con_slider">
					<div class="slider1">
						<ul class="bxslider1">
							<li>
								<a href="#">
									<img src="/images/main/main_visual_01.jpg" alt="">
									<div class="main_slider_txt_wrap">
										<span class="main_slider_txt_01">공간을 나누다, 가능성을 더하다</span><br>
										<span class="main_slider_txt_02">수많은 오피스 공간들이 당신을 기다립니다</span>
									</div>
								</a>
							</li>
						</ul>
						<div class="main_search_wrap">
							<?require "include/search2.php";?>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							var slider1 = $('.bxslider1').bxSlider({
								auto: false,
								autoControls: false,
								pause:5000,
								useCSS: false,
								onSliderLoad: function () {
									$('.slider1 .bx-default-pager a').click(function () {
										var i = $(this).data('slide-index');
										slider1.goToSlide(i);
										slider1.stopAuto();
										slider1.startAuto();
										return false;
									});
									$('.slider1 .bx-controls-direction a').click(function () {
										var i = $(this).data('slide-index');
										slider1.goToSlide(i);
										slider1.stopAuto();
										slider1.startAuto();
										return false;
									});
								}
							});
						});
					</script>
				</div>
			</div>
			<div class="con_wrap">
				<div class="con_in">
					<div class="main_con_01_box">
						<div class="main_con_01_box_left">
							<img src="/images/main/main_con_01_box_left.jpg">
						</div>
						<div class="main_con_01_box_right">
							<div class="font_label_01">
								공간을 나누고 수익을 창출하세요.
							</div>
							<div class="font_label_02">
								남는 공간, 사용하지 않는 공간, 함께 나누고 싶은 공간이 있다면,<br>
								스페이스풀에 공유해주세요! <br>
								편리한 공간등록 부터 예약이 들어오면 문자로 알려드려며<br>
								승인 버튼을 누르면 곧바로 예약이 완료되고<br>
								스마트하고 편리한 관리시스템까지.<br>
								무의미한 공간에서 수익을 창출하는 황금오리로!
							</div>
							<div class="main_con_01_box_right_in">

								<!-- 이미지로 변경
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
							-->
								<div>
									<a href="/member/space_apply.php" class="main_go_space_regi">
										공간 등록하기
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="main_con_02_box">
						<div class="main_con_02_box_top">
							<div class="font_label_03">핫 스페이스</div>
							<div class="font_label_02">스페이스풀에서 최근 인기가 좋은 공간들을 모아서 보여드립니다.</div>
							<a href="/space/list.php" class="main_con_02_box_more_btn">더보기</a>
						</div>
						<div class="pt_all_wrap">
							<div class="pt_wrap">
								<?
								$result = mysql_query("Select uid,bimg,img1,img2,img3,subject,addr1,addr2,gubun,price From es_product where status='ok' and main='Y' Order By rand() limit 0,9");
								if($result&&mysql_num_rows($result)>0){
									while($r=mysql_fetch_array($result)){
										foreach($r as $key=>$val){
											$$key = stripslashes($val);
										}

										$address = $addr1." ".$addr2;
								?>
								<div class="pt_box">
									<div class="slider_01">
										<ul class="bxslider_01">
											<?if($bimg){?>
											<li>
												<a href="/<?=$uid?>">
													<img src="/DATAS/es_product/thum/<?=$bimg?>" alt="">
												</a>
											</li>
											<?
											}
											for($i=1;$i<=6;$i++){
												if(${"img".$i}){
											?>
											<li>
												<a href="/<?=$uid?>">
													<img src="/DATAS/es_product/thum/<?=${"img".$i}?>" alt="">
												</a>
											</li>
											<?}
											}?>
										</ul>
									</div>
									<div class="pt_box_info">
										<div class="pt_box_info_in">
											<div class="pt_box_txt_01">
												<a href="/<?=$uid?>"><b><?=$subject?></b></a>
											</div>
											<div class="pt_box_txt_03">
												분류 : <?=$gubun_arr[$gubun]?>
											</div>
											<div class="pt_box_txt_02">
												위치 : <?=$address?>
											</div>

										</div>
										<span class="pt_cost">&#92;<?=number_format($price)?></span>
									</div>

								</div>
								<?
									}
									flush2();
								}
								@mysql_free_result($result);
								?>

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
			</div>
            <div class="new_wrap">
            	<div class="con_in center">
                    <div class="img_box_wrap">
                        <a href="javascript:void(0)">
                            <img src="/images/temp/banner_01.jpg">
												</a>
                    </div>
                 </div>
            </div>
			<div class="main_review_wrap">
				<div class="main_review">
					<div class="main_review_top">
						<div class="font_label_03">스페이스풀 Review</div>
						<div class="font_label_02">스페이스풀을 통해 공간을 이용한 고객님들이 직접 남겨주신 후기입니다.</div>
					</div>
					<div class="main_review_box_wrap">
						<div class="main_review_box_in">
							<div class="main_review_box">
								<div class="main_review_txt_wrap">
									<div class="pt_box_txt_01">
										<a href="#">아름다운SNS 어쓰 CEO 이정훈</a>
									</div>
									<div class="pt_box_txt_02">
										저희 어쓰팀은 열정을 쏟을 수 있는 공간이 항상 필요했는데 딱 맞는 공간을 찾을 수 있어서 좋았습니다. 스페이스풀은 창업자들에게 도약의 기회를 제공하는 좋은 서비스입니다.
									</div>
									<!-- <div class="main_review_more_btn">
										<a href="#">더보기</a>
									</div> -->
								</div>
								<a href="#" class="main_review_img">
									<img src="/images/temp/user_01.jpg">
								</a>
							</div>
							<div class="main_review_box">
								<div class="main_review_txt_wrap">
									<div class="pt_box_txt_01">
										<a href="#">버디찬스 대표 박희락</a>
									</div>
									<div class="pt_box_txt_02">
										아직은 작은 기업으로서 1년씩 계약하는 사무실들은 너무 부담이었어요. 기업이 성장하면서 공간도 유동적으로 변하기에 스페이스풀의 서비스는 저희가 마음껏 성장할 수 있도록 도와주었습니다.
									</div>
									<!-- <div class="main_review_more_btn">
										<a href="#">더보기</a>
									</div> -->
								</div>
								<a href="#" class="main_review_img">
									<img src="/images/temp/user_02.jpg">
								</a>
							</div>
							<div class="main_review_box">
								<div class="main_review_txt_wrap">
									<div class="pt_box_txt_01">
										<a href="#">애즈원 CDO 김석환</a>
									</div>
									<div class="pt_box_txt_02">
										개인 사무실은 없지만 외부인들을 만나야 하는 경우가 많아요. 접대실도 회의실도 없어 초라해 보였지만 이제는 언제든지 원하는 공간을 찾을 수 있어 매우 기쁩니다.
									</div>
									<!-- <div class="main_review_more_btn">
										<a href="#">더보기</a>
									</div> -->
								</div>
								<a href="#" class="main_review_img">
									<img src="/images/temp/user_03.jpg">
								</a>
							</div>
						</div>
						<!--원래 소스코드
             <div class="m_review">
							<div class="slider3">
								<ul class="bxslider3">
									<li>
										<a href="#">
											<div class="main_review_box">
												<div class="main_review_txt_wrap">
													<div class="pt_box_txt_01">
														<a href="#">동래센트럴파크 오피스텔</a>
													</div>
													<div class="pt_box_txt_02">
														해외 바이어 미팅에 최적회된 공간 센트럴더파크<br>
														다양한 분야에 종사하는 사람들이 모여 아이디어를 공유하고
														협업할 수 있는 공유 오피스인데요. 스타트업 지망생은 물론
														프리랜서, 취업준비생들들도 많이 찾는다...
													</div>
												</div>
												<a href="#" class="main_review_img">
													<img src="/images/temp/user_01.jpg">
												</a>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="main_review_box">
												<div class="main_review_txt_wrap">
													<div class="pt_box_txt_01">
														<a href="#">동래센트럴파크 오피스텔</a>
													</div>
													<div class="pt_box_txt_02">
														해외 바이어 미팅에 최적회된 공간 센트럴더파크<br>
														다양한 분야에 종사하는 사람들이 모여 아이디어를 공유하고
														협업할 수 있는 공유 오피스인데요. 스타트업 지망생은 물론
														프리랜서, 취업준비생들들도 많이 찾는다...
													</div>
												</div>
												<a href="#" class="main_review_img">
													<img src="/images/temp/user_01.jpg">
												</a>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="main_review_box">
												<div class="main_review_txt_wrap">
													<div class="pt_box_txt_01">
														<a href="#">동래센트럴파크 오피스텔</a>
													</div>
													<div class="pt_box_txt_02">
														해외 바이어 미팅에 최적회된 공간 센트럴더파크<br>
														다양한 분야에 종사하는 사람들이 모여 아이디어를 공유하고
														협업할 수 있는 공유 오피스인데요. 스타트업 지망생은 물론
														프리랜서, 취업준비생들들도 많이 찾는다...
													</div>
												</div>
												<a href="#" class="main_review_img">
													<img src="/images/temp/user_01.jpg">
												</a>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<script type="text/javascript">
								$(document).ready(function(){
									var slider3 = $('.bxslider3').bxSlider({
										auto: false,
										autoControls: false,
										useCSS: false
									});
								});
							</script>
						</div> -->
            <!-- 바꾼코드-->
            <div class="m_review">
            <div class="slider3">
              <ul class="bxslider3">
                <li>
                  <a href="#">
                    <div class="main_review_box">
                      <div class="main_review_txt_wrap">
                        <div class="pt_box_txt_01">
                          <a href="#">아름다운SNS 어쓰 CEO 이정훈</a>
                        </div>
                        <div class="pt_box_txt_02">
                          저희 어쓰팀은 열정을 쏟을 수 있는 공간이 항상 필요했는데 딱 맞는 공간을 찾을 수 있어서 좋았습니다. 스페이스풀은 창업자들에게 도약의 기회를 제공하는 좋은 서비스입니다.
                        </div>
                      </div>
                      <a href="#" class="main_review_img">
                        <img src="/images/temp/user_01.jpg">
                      </a>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="main_review_box">
                      <div class="main_review_txt_wrap">
                        <div class="pt_box_txt_01">
                          <a href="#">버디찬스 대표 박희락</a>
                        </div>
                        <div class="pt_box_txt_02">
                          	아직은 작은 기업으로서 1년씩 계약하는 사무실들은 너무 부담이었어요. 기업이 성장하면서 공간도 유동적으로 변하기에 스페이스풀의 서비스는 저희가 마음껏 성장할 수 있도록 도와주었습니다.
                        </div>
                      </div>
                      <a href="#" class="main_review_img">
                        <img src="/images/temp/user_02.jpg">
                      </a>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="main_review_box">
                      <div class="main_review_txt_wrap">
                        <div class="pt_box_txt_01">
                          <a href="#">애즈원 CDO 김석환</a>
                        </div>
                        <div class="pt_box_txt_02">
                          개인 사무실은 없지만 외부인들을 만나야 하는 경우가 많아요. 접대실도 회의실도 없어 초라해 보였지만 이제는 언제든지 원하는 공간을 찾을 수 있어 매우 기쁩니다.
                        </div>
                      </div>
                      <a href="#" class="main_review_img">
                        <img src="/images/temp/user_03.jpg">
                      </a>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                var slider3 = $('.bxslider3').bxSlider({
                  auto: false,
                  autoControls: false,
                  useCSS: false
                });
              });
            </script>
          </div>
          <!-- 여기까지 -->
					</div>
				</div>
			</div>
			<div class="main_event_wrap">
				<div class="slider2">
					<ul class="bxslider2">
						<li>
							<a href="#">
								<img src="/images/temp/event.jpg" alt="">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/temp/event.jpg" alt="">
							</a>
						</li>
					</ul>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						var slider2 = $('.bxslider2').bxSlider({
							auto: true,
							autoControls: false,
							useCSS: false
						});
					});
				</script>
			</div>
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>
