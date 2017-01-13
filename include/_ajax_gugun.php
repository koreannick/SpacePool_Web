<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

if($sido){
		$results = mysql_query("select sido from es_sido where uid=$sido");
		if($results&&mysql_num_rows($results)>0){
			$sido_str = stripslashes(mysql_result($results,0,0));
		}
		@mysql_free_result($results);
?>
<script src="/js/jquery-1.11.2.min.js"></script>
<div class="main_area_depth_02">
	<div class="dp_box">
		<input type="radio" name="gugun" id="gugun_<?=$sido?>_00" value="" <?if(!$gugun)		echo " checked=\"checked\"";?> onclick="parent.search_f3('<?=$sido_str?> 전체지역');">
		<label for="gugun_<?=$sido?>_00"><?=$sido_str?> 전체지역</label>
	</div>
	<?
		$results = mysql_query("select * from es_gugun where suid=$sido order by uid asc");
		if($results&&mysql_num_rows($results)>0){
			while($rs=mysql_fetch_array($results)){
	?>
	<div class="dp_box">
		<input type="radio" name="gugun" id="gugun_<?=$sido?>_<?=sprintf("%02d",$rs["uid"])?>" value="<?=$rs["uid"]?>" <?if($rs["uid"]==$gugun)		echo " checked=\"checked\"";?> onclick="parent.search_f3('<?=$sido_str." ".stripslashes($rs["gugun"])?>');">
		<label for="gugun_<?=$sido?>_<?=sprintf("%02d",$rs["uid"])?>"><?=stripslashes($rs["gugun"])?></label>
	</div>
	<?
			}
		}
		@mysql_free_result($results);
	?>
</div>
<script type="text/javascript">
$(".main_area_depth_02 .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');

	}else{
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');

	}


});
</script>
<?
}else{
	echo "&nbsp;";
}
?>