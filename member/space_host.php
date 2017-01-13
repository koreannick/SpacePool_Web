<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";

$connect = dbcon();
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member sp_host">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<?require "member_top_m.php";?>
						<div class="pt_all_wrap">
							<div class="pt_wrap">
								<?
								$table = "es_product";

								$num_per_page = 20;
								$page_per_block = 10;

								if(!$page)			$page = 1;

								if(auth_lev()==9){
									$tmp_where = " where 1=1 ";
								}else{
									$tmp_where = " where id='$USESSION[0]' ";
								}

								if($search)		$tmp_where .= "$skey Like '%$search%' ";

								$result = mysql_query("Select count(*) From $table $tmp_where");
								$total_record = mysql_result($result,0,0);
								@mysql_free_result($result);

								$total_page = ceil($total_record/$num_per_page);
								if($total_page==0)			$total_page = 1;
								$start = $num_per_page * ($page - 1);
								$index = $total_record - ($num_per_page * ($page - 1));

								if($total_record>0){
									$result = mysql_query("select * From $table $tmp_where order by uid desc");
									while($row = mysql_fetch_array($result)){
										foreach($row as $key => $val){
											$$key = stripslashes(trim($val));
										}
								?>
								<div class="pt_box">
									<div class="sp_list_top_wrap">
										<a href="/<?=$uid?>">
										<div class="sp_list_top_bg">
											<img src="/DATAS/<?=$table?>/thum/<?=$bimg?>" alt="">
										</div>
										<div class="<?if($status=="wait"){?>screen_on<?}else{?>screen_off<?}?>" id="screen_<?=$uid?>">
											<div class="sp_list_top_screen"></div>
											<div class="sp_list_top_txt">
												비공개 중입니다.
											</div>
										</div>
										</a>
									</div>
									<div class="sp_list_info_wrap">
										<div class="sp_list_info_label">
											<?=$subject?>
										</div>
										<div class="sp_list_info_desc">
											<div class="sp_list_info_date">
												등록일 <?=date("Y.m.d",$wdate)?>
											</div>
											<div class="sp_list_info_onoff">
												<input type="checkbox" name="" id="sp_list_<?=$uid?>" onchange="sChg('sp_list_<?=$uid?>',<?=$uid?>)" <?if($status=="ok")	echo " checked=\"checked\"";?>>
												<label for="sp_list_<?=$uid?>">
													<img src="/images/common/sp_list_info_on.png" class="img_on">
													<img src="/images/common/sp_list_info_off.png" class="img_off">
												</label>
											</div>
										</div>
									</div>
									<div class="sp_list_info_btn_wrap">
										<div class="sp_list_info_btn">
											<a href="/member/space_apply.php?uid=<?=$uid?>" class="sp_list_info_btn_edit">
												<div>공간정보 수정</div>
											</a>
											<a href="javascript:P_Del(<?=$uid?>);" class="sp_list_info_btn_del">
												<div>삭제</div>
											</a>
										</div>
									</div>
								</div>
								<?
									}
									@mysql_free_result($result);
								}
								?>
							</div>
							<script type="text/javascript">
								function P_Del(uid){
									if(confirm('정말 삭제하시겠습니까?')){
										$('#uid').val(uid);
										$('#mode').val('del_ok');
										$('form[name="form0"]').submit();
									}
								}

								function sChg(clickedid,uid) {
									if (document.getElementById(clickedid).checked == true) {
										var box= confirm("공개하시겠습니까?");
									} else {
										var box= confirm("비공개하시겠습니까?");
									}

									if (box==true){
										if(document.getElementById(clickedid).checked==true){
											$('#screen_'+uid).hide();
										}else{
											$('#screen_'+uid).show();
										}

										$('#uid').val(uid);
										$('#mode').val('s_update_ok');
										$('form[name="form0"]').submit();
									}else{
										if(document.getElementById(clickedid).checked==true){
											document.getElementById(clickedid).checked = false;
										}else{
											document.getElementById(clickedid).checked = true;
										}
										return;
									}
								}
							</script>
						</div>
						<div class="cm_wrap">
							<a href="/member/space_apply.php" class="cm_ok_btn">새 공간 등록하기</a>
						</div>
						<form name="form0" method="post" target="tempFrame" action="_product_proc.php">
						<input type="hidden" name="mode" id="mode">
						<input type="hidden" name="uid" id="uid">
						</form>
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