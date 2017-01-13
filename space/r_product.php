<?
if(!defined("__GAUTECH__"))	 exit;

$address = urldecode($address);

if($address){
	$address_arr = explode(" ",$address);

	$sido = $address_arr[0];
	$gugun = $address_arr[1];
	$dong = $address_arr[2];

	$addr = $sido." ".$gugun;

	// $tmp_where = " where uid!=$uid and status='ok' and address like '%".$addr."%'";
	$tmp_where = " where uid!=$uid and status='ok'";
?>
	<div class="s_view_info_label_wrap">
		<div class="s_view_info_label">당신이 좋아할 만한 공간</div>
		<span class="s_view_info_label_line"></span>
	</div>
	<div class="s_view_info_box">
		<div class="pt_all_wrap">
			<div class="pt_wrap">
				<?
				$result = mysql_query("Select * From $table $tmp_where Order By rand() Limit 0,6");
				if($result&&mysql_num_rows($result)>0){
					while($r=mysql_fetch_array($result)){
						foreach($r as $key=>$val){
							$$key = stripslashes($val);
						}
				?>
				<div class="pt_box">
					<div class="slider_01">
						<ul class="bxslider_01">
							<?if($bimg){?>
							<li>
								<a href="/<?=$uid?>">
									<img src="/DATAS/<?=$table?>/thum/<?=$bimg?>" alt="">
								</a>
							</li>
							<?
							}
							for($i=1;$i<=6;$i++){
								if(${"img".$i}){
							?>
							<li>
								<a href="/<?=$uid?>">
									<img src="/DATAS/<?=$table?>/thum/<?=${"img".$i}?>" alt="">
								</a>
							</li>
							<?}
							}?>
						</ul>
					</div>
					<div class="pt_box_info">
						<div class="pt_box_info_in">
							<div class="pt_box_txt_01">
								<a href="/<?=$uid?>"><?=$subject?></a>
							</div>
							<div class="pt_box_txt_03">
								분류 : <?=$gubun_arr[$gubun]?>
							</div>
							<div class="pt_box_txt_02">
								위치 : <?=$addr1?>
							</div>

						</div>
						<span class="pt_cost">&#92;<?=number_format($price)?></span>
					</div>

				</div>
				<?
					}
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
<?
}
?>
