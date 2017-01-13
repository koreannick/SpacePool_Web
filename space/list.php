<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

if(!$orderby)		$orderby = "o1";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<script type="text/javascript">
var page_url = "/include/_ajax_list.php?sido=<?=$sido?>&gugun=<?=$gugun?>&gubun=<?=$gubun?>&orderby=<?=$orderby?>&skeyword=<?=urlencode($skeyword)?>&page=";
var d_id = "list_result";
var method = "post";

$(document).ready(function(){
	List_PageLoad(page_url,1);
});

function Orderby_Page(orderby){
	page_url = "/include/_ajax_list.php?sido=<?=$sido?>&gugun=<?=$gugun?>&gubun=<?=$gubun?>&skeyword=<?=urlencode($skeyword)?>&orderby="+orderby+"&page=1&p_min=<?=$p_min?>&p_max=<?=$p_max?>&p_opt=<?=$p_opt?>";
	List_PageLoad(page_url,1);
	//location.href = page_url;
}

$(function ()
{
	$(window).unbind('hashchange').bind('hashchange', function (e){
		page_url = "/include/_ajax_list.php?sido="+sido+"&gugun="+gugun+"&gubun="+gubun+"&skeyword="+skeyword+"&orderby="+orderby+"&p_min="+p_min+"&p_max="+p_max+"&p_opt="+p_opt+"&page=";
		List_PageLoad(page_url,1);
	});
});
</script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_list">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="sub_search_wrap">
				<div class="sub_search">
					<?php virtual('/include/search.php'); ?>
				</div>
			</div>
			<div class="con_wrap">
				<div class="con_in">
					<div class="list_search_top_wrap">
						<div class="list_search_top_select">
							<select name="orderby" onchange="Orderby_Page(this.value);">
								<option value="o1" <?if($orderby=="o1")		echo " selected";?>>최신순</option>
								<option value="o2" <?if($orderby=="o2")		echo " selected";?>>가격순</option>
							</select>
						</div>
						<div class="list_search_top_txt">
							<span class="dot_b">·</span> <span class="color_black"><?=$sido_str.$gugun_str?></span> 에 있는 <span class="color_black"><?=str_replace("공간","",$gubun_str)?></span> 공간<?if($skeyword)		echo "에 <span class=\"color_blank\">".$skeyword."</span>";?>으로 총 <span class="color_red" id="data_cnt">0</span>건이 검색되었습니다.
						</div>
					</div>
					<div id="list_result">
						
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