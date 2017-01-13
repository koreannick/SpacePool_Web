<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect)		$connect = dbcon();

if(!$year)		$year = date("Y");

$where_query = "";

if($smobile)		$where_query .= " and mobile = '$smobile'";
if($smweb)		$where_query .= " and mweb = '$smweb'";

for($i=1;$i<=12;$i++){
	$month = sprintf("%02d",$i);

	$result = mysql_query("SELECT count(uid), count(distinct ip) FROM $table where con_date like '${year}-${month}-%' $where_query");
	$month_total[$i] = mysql_result($result,0,0);
	$day_unique_total[$i] = mysql_result($result,0,1);
	@mysql_free_result($result);

	//월 전체합산 구하기
	$year_total = $year_total + $month_total[$i];
	$month_unique_total = $month_unique_total + $day_unique_total[$i];

	//최대값 구하기
	if($max_month_total < $month_total[$i])		$max_month_total = $month_total[$i];

	if($max_day_unique_total < $day_unique_total[$i])		$max_day_unique_total = $day_unique_total[$i];

	flush2();
}
?>
<table width="90%" cellpadding="0" cellspacing="0" border="0">
<form name="form0" method="get" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<tr>
	<td style="padding:5px;"><select name="smweb" class="inputbox_single" onchange="document.form0.submit();">
			<option value="" <?if(!$smweb)		echo "selected";?>>:: 버전별 ::</option>
			<option value="N" <?if($smweb=="N")		echo "selected";?>>PC버전</option>
			<option value="Y" <?if($smweb=="Y")		echo "selected";?>>모바일웹</option>
		</select>&nbsp;&nbsp;
		<select name="smobile" class="inputbox_single" onchange="document.form0.submit();">
			<option value="" <?if(!$smobile)		echo "selected";?>>:: 접속기기별 ::</option>
			<option value="N" <?if($smobile=="N")		echo "selected";?>>PC로 접속한 내역</option>
			<option value="Y" <?if($smobile=="Y")		echo "selected";?>>모바일기기로 접속한 내역</option>
		</select>
		<select name="year" class="inputbox_single">
		<?
		for($i=2014;$i<=date("Y")+1;$i++){
			if($i==$year)		$sel = " selected";
			else					$sel = "";
			echo "<option value=".$i." $sel>".$i."년</option>";
		}
		?>
		</select>&nbsp;&nbsp;<input type="submit" value="보 기" class="inputbox_single"></td>
</tr>
</form>
<tr>
	<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
		<tr bgcolor="#F2F2F2" height="23">
			<th width="100">월</th>
			<th width="100">총 접속수</th>
			<th width="100">단독 접속수</th>
			<th width="100">단독 비율</th>
			<th width="100">전체 비율</th>
			<th>그래프</th>
		</tr>
<?
for($i=1; $i<=12; $i++){
	$month = sprintf("%02d",$i);

	//이미지 길이를 설정
	if($max_month_total)		$day_img_width = intval(($month_total[$i] / $max_month_total) * 140);

	//월전체중 해당 일별 비율 설정
	if($year_total&&$month_total[$i])		$day_rate = number_format(($month_total[$i] / $year_total * 100),1)." %";
	else					$day_rate = "";

	if($month_total[$i])		$unique_rate = number_format($day_unique_total[$i] / $month_total[$i]*100,1)." %";
	else							$unique_rate = "";

	$month_total1 = number_format($month_total[$i]);
	$day_unique_total1 = number_format($day_unique_total[$i]);
?>
<tr bgcolor="white" height="23" onMouseOver="this.style.backgroundColor='#F2F2F2';"  onMouseOut="this.style.backgroundColor='#FFFFFF';">
	<td align="center"><?=$year."-".$month?></td>
	<td align="center"><?=$month_total1?></td>
	<td align="center"><?=$day_unique_total1?></td>
	<td align="center"><?=$unique_rate?></td>
	<td align="center"><?=$day_rate?></td>
	<td style="padding:5px;"><img src="/s_source/images/green_bar1.gif" height=10><img src="/s_source/images/green_bar2.gif" width="<?=$day_img_width?>" height=10><img src="/s_source/images/green_bar3.gif" height=10></td>
</tr>
<?
	flush2();
}
?>
	</table></td>
</tr>
</table>
<br /><br /><br />