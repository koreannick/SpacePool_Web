<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

$table = "es_product";

if($uid&&$sDate&&$btype){
	$result = mysql_query("select minHour,maxHour from $table where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$minHour = mysql_result($result,0,0);
		$maxHour = mysql_result($result,0,1);
	}
	@mysql_free_result($result);
?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<input type="hidden" name="sTime" id="sTime">
<input type="hidden" name="eTime" id="eTime">
	<div class="time_slider_wrap">
	<div class="time_slider">
		<?
		for($i=$minHour;$i<$maxHour;$i++){
			//해당 시간에 예약이 된것인지 체크
			$result2 = mysql_query("select uid from es_booking where puid=$uid and sDate='$sDate' and btype='$btype' and (sTime<=$i and eTime>=$i)");
			if($result2&&mysql_num_rows($result2)>0){
				$checked = "disiable";
			}else{
				$checked = "able";
			}
			@mysql_free_result($result2);
			?>
			<div>
				<a <?if($checked=="able"){?>href="javascript:void(0);"<?}?> class="time_box <?=$checked?>">
					<span class="time"><?=$i?></span>
					<span class="price"></span>
				</a>
			</div>
			<?
		}
		?>
		<div>
			<span class="time"><?=$i?></span>
		</div>
	</div>
	<script type="text/javascript">
		$('.time_slider').slick({
			dots: false,
			infinite: false,
			slidesToShow: 8,
			slidesToScroll: 4,
			swipeToSlide:true,
			appendArrows: false,
			responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 3
				}
			}
			]
		});
	</script>
	</div>
<script type="text/javascript">
$(window).ready(function(){
	$('.time_box').click(function () {
		if ($(this).hasClass('able')){
			if ($(this).parent('.slick-slide').hasClass('pick')){
				$('.slick-slide').removeClass('pick');
				$(this).parent('.slick-slide').removeClass('pick');
				$('#sTime').val('');
				$('#eTime').val('');
			}else{
				$(this).parent('.slick-slide').addClass('pick');
				firstIndex = $(".pick:first").index();
				thisIndex = $(".pick:last").index();
				start = Math.min(thisIndex, firstIndex);
				end = Math.max(firstIndex, thisIndex) + 1;

				$('.time_box').slice(start, end).each(function(){
					$(this).parent('.slick-slide').addClass('pick');
					var sTime = start + parseInt(<?=$minHour?>);
					var eTime = end + parseInt(<?=$minHour?>);
					$('#sTime').val(sTime);
					$('#eTime').val(eTime);
				})
			}
		}
	});
});
</script>
<?}?>