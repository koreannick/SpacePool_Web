<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect=dbcon();	}

$tmp_where = " where 1=1";

if($search)		$tmp_where .= " and subject like '%${search}%' or comment like '%${search}%'";
if($kind)			$tmp_where .= " and kind = '$kind'";

$num_per_page = 10;
$page_per_block = 10;
if(!$page){			$page=1;	}

$result = mysql_query("Select count(*) From $table $tmp_where");
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)			$total_page = 1;

$start = $num_per_page * ($page - 1);
$index = $total_record - ($num_per_page * ($page - 1));

?>
<div class="s_view_info_box">
	<div class="cate_nav_label">
		<a href="<?=$PHP_SELF?>" class="<?if(!$kind)		echo "active";?>">전체<span></span></a>
		<?for($i=1;$i<=count($faq_kind_arr);$i++){?>
		<a href="<?=$PHP_SELF?>?kind=<?=$i?>" class="<?if($kind==$i)		echo "active";?>"><?=$faq_kind_arr[$i]?><span></span></a>
		<?}?>
	</div>
	<div class="agree_all_box_wrap">

		<?
		if($total_record>0){
			$result = mysql_query("Select * From $table $tmp_where Order By uid Desc");
			while($row = mysql_fetch_array($result)){
				foreach($row as $key=>$val){
					$$key = stripslashes($val);
				}
		?>
		<div class="agree_box_wrap">
			<div class="agree_box">
				<div class="agree_label">
					<div class="agree_label_in">
						<a href="javascript:void(0)" class="agree_atag">
							<?=$subject?>
						</a>
					</div>
					<div class="cate_txt">
						<?=$faq_kind_arr[$kind]?>
					</div>
				</div>
				<a href="javascript:void(0)">
					<span class="a_btn">열기/닫기</span>
				</a>
			</div>
			<div class="agree_desc_wrap">
				<div class="agree_desc">
					<div class="txt_box">
						<?=$comment?>
					</div>
				</div>
			</div>
		</div>
		<?
				$index--;
				flush2();
			}
			@mysql_free_result($result);
		}
		?>
	</div>
</div>