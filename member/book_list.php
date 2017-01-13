<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

if(!$kind)		$kind = 1;

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
						<div class="m_top_nav_wrap">
							<a href="/member/book_list.php?kind=1" class="<?if($kind==1)	echo "active";?>">신청/결제</a>
							<a href="/member/book_list.php?kind=2" class="<?if($kind==2)	echo "active";?>">취소/환불</a>
							<a href="/member/book_list.php?kind=3" class="<?if($kind==3)	echo "active";?>">이용중</a>
							<a href="/member/book_list.php?kind=4" class="<?if($kind==4)	echo "active";?>">이용완료</a>
						</div>
						<div class="pt_all_wrap">
							<div class="pt_wrap">
								<?
								if($kind==1){
									$tmp_where = " and status='ok' and not (eDate<'".date("Y-m-d")."' or (eDate<='".date("Y-m-d")."' and eTime<=".date("H")."))";
								}elseif($kind==2){
									$tmp_where = " and status='cancel'";
								}elseif($kind==3){
									$tmp_where = " and status='ok' and pay_status='Y' and (((sDate<='".date("Y-m-d")."' and eDate>='".date("Y-m-d")."') or (sDate<='".date("Y-m-d")."' and eDate>='".date("Y-m-d")."')) or (eDate='".date("Y-m-d")."' and eTime>".date("H")."))";
								}elseif($kind==4){
									$tmp_where = " and status='ok' and pay_status='Y' and (eDate<'".date("Y-m-d")."' or (eDate='".date("Y-m-d")."' and eTime<=".date("H")."))";
								}

								//페이징
								$num_per_page = 6;
								$page_per_block = 5;
								if(!$page)			$page=1;

								$result = mysql_query("Select count(uid) From es_booking where id='$USESSION[0]' $tmp_where");
								if(!$result)		redir_proc3("/","");
								$total_record = mysql_result($result,0,0);
								@mysql_free_result($result);
								flush2();

								$total_page = ceil($total_record/$num_per_page);
								if($total_page==0)		$total_page = 1;
								$start = $num_per_page * ($page - 1);
								$index = $total_record - ($num_per_page * ($page - 1));

								if($total_record>0){
									$result = mysql_query("select * from es_booking where id='$USESSION[0]' $tmp_where order by uid desc");
									if($result&&mysql_num_rows($result)>0){
										while($r=mysql_fetch_array($result)){
											foreach($r as $key=>$val){
												$$key = stripslashes($val);
											}

											$order_code_arr = explode("_",$order_code);
											$order_num = $order_code_arr[1];

											if($puid){
												$result2 = mysql_query("Select bimg,img1,img2,img3,subject,img4,img5,img6 From es_product where uid=$puid");
												if($result2&&mysql_num_rows($result2)>0){
													$bimg = mysql_result($result2,0,0);
													$img1 = mysql_result($result2,0,1);
													$img2 = mysql_result($result2,0,2);
													$img3 = mysql_result($result2,0,3);
													$subject = stripslashes(mysql_result($result2,0,4));
													$img4 = mysql_result($result2,0,5);
													$img5 = mysql_result($result2,0,6);
													$img6 = mysql_result($result2,0,7);

												}
												@Mysql_free_result($result2);
											}

											$review = false;
											$result2 = mysql_query("select count(uid) from es_product_review where buid=$uid and id='$USESSION[0]' order by uid desc");
											if($result2&&mysql_num_rows($result2)>0){
												if(mysql_result($result2,0,0)>0)	$review = true;
											}
											@Mysql_free_result($result2);
								?>
								<div class="pt_box">
									<div class="slider_01">
										<ul class="bxslider_01">
											<?if($bimg){?>
											<li>
												<a href="/member/book_detail.php?kind=<?=$kind?>&uid=<?=$uid?>&page=<?=$page?>">
													<img src="/DATAS/es_product/thum/<?=$bimg?>" alt="">
												</a>
											</li>
											<?
											}
											for($i=1;$i<=6;$i++){
												if(${"img".$i}){
											?>
											<li>
												<a href="/member/book_detail.php?kind=<?=$kind?>&uid=<?=$uid?>&page=<?=$page?>">
													<img src="/DATAS/es_product/thum/<?=${"img".$i}?>" alt="">
												</a>
											</li>
											<?}
											}?>
										</ul>
									</div>
									<div class="pt_box_info">
										<div class="pt_box_info_in">
											<div class="pt_box_txt_00">
												<?
												if($kind==1){
													if($pay_status=="Y")		echo "결제승인";	else	echo "결제대기";
												}elseif($kind==2){
													echo "취소/환불";
												}elseif($kind==3){
													echo "이용중";
												}elseif($kind==4){
													if($review)		echo "후기작성";		else		echo "후기미작성";
												}
												?>
											</div>
											<div class="pt_box_txt_01">
												<a href="/member/book_detail.php?kind=<?=$kind?>&uid=<?=$uid?>&page=<?=$page?>"><?=$subject?></a>
											</div>
											<div class="pt_box_txt_02">
												예약일  : <?=date("Y.m.d",strtotime($sDate))?> (<?=$day_str[date("w",strtotime($sDate))]?>)
											</div>
											<?if($kind==2){?>
												<div class="pt_box_txt_02">
													취소일 : <?=date("Y.m.d",$cancel_date)?>
												</div>
											<?}else{?>
												<?if($pay_status=="Y"){?>
												<div class="pt_box_txt_02">
													결제일 : <?=$pay_date?>
												</div>
												<?}?>
											<?}?>
											<div class="pt_box_txt_04">
												예약번호 : <?=$order_num?>
											</div>
										</div>
										<span class="pt_cost">&#92;<?=number_format($total_price)?></span>
									</div>
								</div>
								<?
										}
									}
									@Mysql_free_result($result);
								}
								?>
							</div>
							<?if($total_record>0){?>
							<script type="text/javascript">
								var slider_01 = $('.bxslider_01').bxSlider({
									mode: 'fade',
									useCSS: false
								});
							</script>
							<div class="list_page_wrap">
								<div class="page_wrap">
									<?
										// 페이징
										$link = $PHP_SELF."?kind=".$kind;
										Ajax_paging($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
									?>
								</div>
							</div>
							<?}?>
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
