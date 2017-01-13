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
						<div class="pt_all_wrap">
							<div class="pt_wrap">
								<?
								$resultw = mysql_query("select * from es_product_wish where id='$USESSION[0]' order by uid desc");
								if($resultw&&mysql_num_rows($resultw)>0){
									while($rw=mysql_fetch_array($resultw)){
										$puid = $rw["puid"];

										if($puid){
											$result2 = mysql_query("Select bimg,img1,img2,img3,subject,address,gubun,price,img4,img5,img6 From es_product where uid=$puid");
											if($result2&&mysql_num_rows($result2)>0){
												$bimg = mysql_result($result2,0,0);
												$img1 = mysql_result($result2,0,1);
												$img2 = mysql_result($result2,0,2);
												$img3 = mysql_result($result2,0,3);
												$subject = stripslashes(mysql_result($result2,0,4));
												$address = stripslashes(mysql_result($result2,0,5));
												$gubun = mysql_result($result2,0,6);
												$price = mysql_result($result2,0,7);
												$img4 = mysql_result($result2,0,8);
												$img5 = mysql_result($result2,0,9);
												$img6 = mysql_result($result2,0,10);
											}
											@Mysql_free_result($result2);
										}
								?>
								<div class="pt_box">
									<div class="slider_01">
										<ul class="bxslider_01">
											<?if($bimg){?>
											<li>
												<a href="/<?=$puid?>">
													<img src="/DATAS/es_product/thum/<?=$bimg?>" alt="">
												</a>
											</li>
											<?
											}
											for($i=1;$i<=6;$i++){
												if(${"img".$i}){
											?>
											<li>
												<a href="/<?=$puid?>">
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
												<a href="/<?=$puid?>"><?=$subject?></a>
											</div>
											<div class="pt_box_txt_02">
												위치 : <?=$address?>
											</div>
											<div class="pt_box_txt_03">
												분류 : <?=$gubun_arr[$gubun]?>
											</div>
										</div>
										<span class="pt_cost">&#92;<?=number_format($price)?></span>
									</div>
								</div>
								<?
									}
								}
								@mysql_free_result($resultw);
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
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>
