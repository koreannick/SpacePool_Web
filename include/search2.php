<?
if(!$connect)		$connect = dbcon();


if(defined("__MAIN__")){
	$sido_str = "어디(지역)";
	$gubun_str = "이런(타입)공간이 필요해요";
}else{
	if(!$sido){
		$sido_str = "전체지역";
	}else{
		$results = mysql_query("select sido from es_sido where uid=$sido");
		if($results&&mysql_num_rows($results)>0){
			$sido_str = stripslashes(mysql_result($results,0,0));
		}
		@mysql_free_result($results);

		if(!$gugun){
			$gugun_str = " 전체지역";
		}else{
			$results = mysql_query("select gugun from es_gugun where uid=$gugun");
			if($results&&mysql_num_rows($results)>0){
				$gugun_str = " ".stripslashes(mysql_result($results,0,0));
			}
			@mysql_free_result($results);
		}
	}

	if(!$gubun)		$gubun_str = "전체공간";
	else				$gubun_str = $gubun_arr[$gubun]." 공간";
}

?>
<form name="sFrm" method="get" action="/space/list.php">
<div class="search_all_wrap">
	<div class="main_area_wrap">
		<div class="main_area_txt"><span class="sarea_str"><?=$sido_str.$gugun_str?></span>에 있는<span class="b_arr"><img src="/images/common/b_arr.png"></span></div>
		<div class="main_area">
			<div class="main_area_top">
				<div class="dp_box">
					<input type="radio" name="sido" id="sido_all" value="" <?if(!$sido)		echo " checked=\"checked\"";?> onclick="search_f1('전체지역','');">
					<label for="sido_all">전체지역</label>
				</div>
			</div>
			<div class="main_area_in">
				<div class="main_area_depth_01">
					<?
					$results = mysql_query("select * from es_sido where uid in (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17) order by uid asc");
					if($results&&mysql_num_rows($results)>0){
						while($rs=mysql_fetch_array($results)){
					?>
					<div class="dp_box">
						<input type="radio" name="sido" id="main_area_<?=sprintf("%02d",$rs["uid"])?>" value="<?=$rs["uid"]?>" <?if($rs["uid"]==$sido)		echo " checked=\"checked\"";?> onclick="search_f1('<?=stripslashes($rs["sido"])?>',<?=$rs["uid"]?>);">
						<label for="main_area_<?=sprintf("%02d",$rs["uid"])?>"><?=stripslashes($rs["sido"])?></label>
					</div>
					<?
						}
					}
					@mysql_free_result($results);
					?>
				</div>
				<div id="gugun_area">
				<?
				if($sido){
				?>
				<div class="main_area_depth_02">
					<div class="dp_box">
						<input type="radio" name="gugun" id="gugun_<?=$sido?>_00" value="" <?if(!$gugun)		echo " checked=\"checked\"";?> onclick="search_f3('<?=$sido_str?> 전체지역');">
						<label for="gugun_<?=$sido?>_00"><?=$sido_str?> 전체지역</label>
					</div>
					<?
						$results = mysql_query("select * from es_gugun where suid=$sido order by uid asc");
						if($results&&mysql_num_rows($results)>0){
							while($rs=mysql_fetch_array($results)){
					?>
					<div class="dp_box">
						<input type="radio" name="gugun" id="gugun_<?=$sido?>_<?=sprintf("%02d",$rs["uid"])?>" value="<?=$rs["uid"]?>" <?if($rs["uid"]==$gugun)		echo " checked=\"checked\"";?> onclick="search_f3('<?=$sido_str." ".stripslashes($rs["gugun"])?>');">
						<label for="gugun_<?=$sido?>_<?=sprintf("%02d",$rs["uid"])?>"><?=stripslashes($rs["gugun"])?></label>
					</div>
					<?
							}
						}
						@mysql_free_result($results);
					?>

				</div>
				<?
				}else{
					$gugun = "";
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="main_space_wrap">
		<div class="main_space_txt"><span class="gubun_str"><?=$gubun_str?></span><span class="b_arr"><img src="/images/common/b_arr.png"></span></div>
		<div class="main_space">
			<div class="main_space_top">
				<div class="dp_box">
					<input type="radio" name="gubun" id="main_space_all" value="" <?if(!$gubun)		echo " checked=\"checked\"";?> onclick="search_f2('전체공간');">
					<label for="main_space_all">전체공간</label>
				</div>
			</div>
			<div class="main_space_in">
				<div class="main_space_depth_01">
					<?
					for($i=1;$i<=count($gubun_arr);$i++){
						if($gubun_arr[$i]){
					?>
					<div class="dp_box">
						<input type="radio" name="gubun" id="main_space_0<?=$i?>" value="<?=$i?>" onclick="search_f2('<?=$gubun_arr[$i]?>');" <?if($i==$gubun)		echo " checked=\"checked\"";?>>
						<label for="main_space_0<?=$i?>"><?=$gubun_arr[$i]?></label>
					</div>
					<?
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:document.sFrm.submit();" class="m_space_find_btn">공간 찾기</a>

</div>
<script type="text/javascript">
function search_f1(str,sido){
	$('.sarea_str').html(str);

	if(sido){
		Ajax_Request("/include/_ajax_gugun.php?sido="+sido,"gugun_area");
	}else{
		$('input[name=gugun]').val('');
		$('.main_area_wrap').removeClass('on');
	}
}

function search_f2(str){
	$('.gubun_str').html(str);
	$('.main_space_wrap').removeClass('on');
}

function search_f3(str){
	$('.sarea_str').html(str);
	$('.main_area_wrap').removeClass('on');
}
</script>
<?if(!defined("__MAIN__")){?>
<div class="price_range_wrap" background-color="#ffffff">
	<div class="price_range_label">
		가격범위
	</div>
	<div class="price_range_in">
		<div class="price_range_in_left">
			최저
		</div>
		<div class="price_range_box">
			<div id="seokRange"></div>
			<a id="seokRangemin">
				<div class="pick_arr"></div>
			</a>
			<a id="seokRangemax">
				<div class="pick_arr"></div>
			</a>
		</div>
		<div class="price_range_in_right">
			최고
		</div>
	</div>
	<input type="hidden" id="price_range_min" value="0" readonly >
	<input type="hidden" id="price_range_max" value="0" readonly>
</div>
<div class="price_range_wrap" background-color="#ffffff">
	<div class="price_range_label">
		보유시설
	</div>
	<div class="price_range_in">
		<div class="option_box_wrap">
			<?for($i=1;$i<=count($p_opt_arr);$i++){?>
			<div class="option_box">
				<input type="checkbox" name="p_opt[]" id="option_<?=sprintf("%02d",$i)?>" value="<?=$i?>">
				<label for="option_<?=sprintf("%02d",$i)?>">
				<span class="option_box_label"><?=$p_opt_arr[$i]?></span>
				</label>
			</div>
			<?}?>

		</div>
	</div>
</div>
<script>
var stopMin = 1000;
var stopMax = 1000000;

$("#seokRange").slider({
	range: true,
	min: 1000,
	max: 1000000,
	step: 10,
	values: [1000, 1000000],
	animate: 'slow',
	create: function() {
		$('#seokRangemin').appendTo($('#seokRange span').get(0));
		$('#seokRangemax').appendTo($('#seokRange span').get(1));
	},
	slide: function(event, ui) {
		$(ui.handle).find('.pick_arr').html('&#8361;' + ui.value);
		$("#price_range_min").val(ui.values[ 0 ]);
		$("#price_range_max").val(ui.values[ 1 ]);
	},
	stop: function(event, ui) {
		stopMin = ui.values[ 0 ];
		stopMax = ui.values[ 1 ];
		//alert(stopMin);
		//alert(stopMax);

		List_PageLoad(page_url+"&p_min="+stopMin+"&p_max="+stopMax,1);
	}
});

$('#seokRangemin .pick_arr').html('&#8361;' + $('#seokRange').slider('values', 0)).position({
	my: 'center top',
	at: 'center bottom',
	of: $('#seokRange span:eq(0)'),
	offset: "0, 10"
});

$('#seokRangemax .pick_arr').html('&#8361;' + $('#seokRange').slider('values', 1)).position({
	my: 'center top',
	at: 'center bottom',
	of: $('#seokRange span:eq(1)'),
	offset: "0, 10"
});

$(".price_range_in input[type=checkbox]").click(function(){
	//if($(".price_range_in input").is(':checked')){
		//alert('dd1');
	//}else{
		//alert('dd2');
	//}

	var p_opt = "";

	var obj = document.getElementsByName("p_opt[]");
	c = 0;
    for(var i=0 ; i < obj.length ; i++) {
        if(obj[i].checked==true){
			if(p_opt){
				p_opt = p_opt + "," + obj[i].value;
			}else{
				p_opt = obj[i].value;
			}
			c++;
		}
    }
	if(c==0){
		p_opt = "";
	}

	List_PageLoad(page_url+"&p_min="+stopMin+"&p_max="+stopMax+"&p_opt="+p_opt,1);
});
</script>
<?}?>
</form>
