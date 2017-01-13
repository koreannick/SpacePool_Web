<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

$table = "es_product";

$num_per_page = 12;
$page_per_block = 5;
if(!$page)			$page=1;

if(!$orderby)		$orderby = "o1";

$tmp_where = " where status='ok' ";

if($sido){
	$results = mysql_query("select sido from es_sido where uid=$sido");
	if($results&&mysql_num_rows($results)>0){
		$sido_str = stripslashes(mysql_result($results,0,0));
	}
	@mysql_free_result($results);

	$tmp_where .= " and addr1 like '%".$sido_str."%'";
}else{
	$gugun = "";
}

if($gugun){
	$results = mysql_query("select gugun from es_gugun where uid=$gugun");
	if($results&&mysql_num_rows($results)>0){
		$gugun_str = stripslashes(mysql_result($results,0,0));
	}
	@mysql_free_result($results);

	$tmp_where .= " and addr1 like '%".$gugun_str."%'";
}

if($gubun)		$tmp_where .= " and gubun=$gubun";

if($p_min&&$p_max)		$tmp_where .= " and (price>=$p_min and price<=$p_max)";

if($skeyword)	$tmp_where .= " and subject like '%".$skeyword."%'";

if($p_opt){
	$p_opt_arr = explode(",",$p_opt);
	for($i=0;$i<count($p_opt_arr);$i++){
		$tmp_where .= " and p_opt like '%:".$p_opt_arr[$i].":%'";
	}
}else{

}

$result = mysql_query("Select count(uid) From $table $tmp_where");
if(!$result)		redir_proc3("/","");
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);
flush2();

$ss="Select count(uid) From $table $tmp_where";

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)		$total_page = 1;
$start = $num_per_page * ($page - 1);
$index = $total_record - ($num_per_page * ($page - 1));
?>
<script type="text/javascript">
var sido = "<?=$sido?>";
var gugun = "<?=$gugun?>";
var gubun = "<?=$gubun?>";
var skeyword = "<?=$skeyword?>";
var orderby = "<?=$orderby?>";
var p_min = "<?=$p_min?>";
var p_max = "<?=$p_max?>";
var p_opt = "<?=$p_opt?>";

$(document).ready(function(){
	$('#data_cnt',parent.document).text('<?=number_format($total_record)?>');
});
</script>
<div class="pt_all_wrap">
	<div class="pt_wrap">
		<?
		if($total_record>0){
			if($orderby=="o1")			$order_by_qry = "uid desc";
			elseif($orderby=="o2")		$order_by_qry = "price asc, uid desc";

			$result = mysql_query("Select uid,bimg,img1,img2,img3,subject,addr1,addr2,gubun,p_limit,price,g1_d,g1_d_price,g1_s,g1_s_price,g2,img4,img5,img6 From $table $tmp_where Order By $order_by_qry Limit $start, $num_per_page");
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
						<a href="/<?=$uid?>"><b><?=$subject?></b></a>
					</div>
					<div class="pt_box_txt_03">
						분류 : <?=$gubun_arr[$gubun]?>
					</div>
					<div class="pt_box_txt_02">
						위치 : <?=$address?>
					</div>
					<div class="pt_box_txt_05">
						<div class="pt_st_img_left">
							<img src="/images/icon/icon_desk.png">
							<?
							if($gubun==1){
								if($g1_d=="Y"&&$g1_s=="Y"){
									echo "Desk";
								}elseif($g1_d=="Y"&&$g1_s=="N"){
									echo "Desk";
								}elseif($g1_d=="N"&&$g1_s=="Y"){
									echo "Space";
								}
							}elseif($gubun==2){
								if($g2=="1")			echo "1인실";
								elseif($g2=="2")		echo "2인실";
								elseif($g2=="4")		echo "4인실";
								elseif($g2=="6")		echo "6인실이상";
								elseif($g2=="O")		echo "오픈스페이스";
								elseif($g2=="D")		echo "Desk";
							}elseif($gubun==3){
							}elseif($gubun==4){
								echo "세미나/미팅룸";
							}
							?>
						</div>
						<div class="pt_st_img_right">
							<?=$p_limit?>명 <img src="/images/icon/icon_person.png">
						</div>
					</div>
					<!-- <div class="pt_box_star">
						<img src="/images/common/star_1.png">
						<img src="/images/common/star_2.png">
						<img src="/images/common/star_3.png">
						<img src="/images/common/star_4.png">
						<img src="/images/common/star_5.png">
					</div> -->
				</div>
				<span class="pt_cost">&#92;<?=number_format($price)?></span>
			</div>
			<!-- <div class="pt_type">
				<?if($pay_auth=="Y"){?>
				<span class="pt_type_01">바로결제</span>
				<?}else{?>
				<span class="pt_type_02">멤버십할인</span>
				<span class="pt_type_03">승인결제</span>
				<?}?>
			</div> -->
		</div>
		<?
			}
			@mysql_free_result($result);
		}
		?>
	</div>
	<script type="text/javascript">
		var slider_01 = $('.bxslider_01').bxSlider({
			mode: 'fade',
			useCSS: false
		});

	</script>
</div>
<div class="list_page_wrap">
	<div class="page_wrap">
		<?
			// 페이징
			$link = "/include/_ajax_list.php?sido=$sido&gugun=$gugun&gubun=$_GET[gubun]&p_min=$p_min&p_max=$p_max&p_opt=$p_opt&orderby=$orderby&skeyword=".urlencode($skeyword);
			Ajax_paging($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
		?>
	</div>
</div>
