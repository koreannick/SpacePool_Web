<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$sdate)		$sdate = date("Y-m-d");
if(!$edate)		$edate = date("Y-m-d");

$where_query = "where con_date >= '$sdate' and con_date <= '$edate'";

if($smobile)		$where_query .= " and mobile = '$smobile'";
if($smweb)		$where_query .= " and mweb = '$smweb'";

for($i=0; $i <= 23; $i++){
	$result = mysql_query("SELECT count(uid),count(distinct ip) FROM $table $where_query and con_hour = $i");
	$time_total[$i] = mysql_result($result,0,0);
	$time_unique_total[$i] = mysql_result($result,0,1);
	@mysql_free_result($result);

	//월 전체합산 구하기
	$month_total = $month_total + $time_total[$i];
	$month_unique_total = $month_unique_total + $time_unique_total[$i];

	//최대값 구하기
	if($max_day_total < $time_total[$i])		$max_day_total = $time_total[$i];

	if($max_day_unique_total < $time_unique_total[$i])		$max_day_unique_total = $time_unique_total[$i];

	flush2();
}


	/// 그래프 이미지의 길이를 결정한다.
?>
<script language='javascript' src="/s_inc/calendar.js"></script>
<table width="90%" cellpadding="0" cellspacing="0" border="0">
<form name="form0" action="<?=$PHP_SELF?>" method="get">
<input type="hidden" name="mode" value="<?=$mode?>">
<tr>
	<td style="padding:5px;"><select name="smweb" class="inputbox_single" onchange="document.form0.submit();">
			<option value="" <?if(!$smweb)		echo "selected";?>>:: 버전별 ::</option>
			<option value="N" <?if($smweb=="N")		echo "selected";?>>PC버전</option>
			<option value="Y" <?if($smweb=="Y")		echo "selected";?>>모바일웹</option>
		</select>&nbsp;&nbsp;<select name="smobile" class="inputbox_single" onchange="document.form0.submit();">
			<option value="" <?if(!$smobile)		echo "selected";?>>:: 접속기기별 ::</option>
			<option value="N" <?if($smobile=="N")		echo "selected";?>>PC로 접속한 내역</option>
			<option value="Y" <?if($smobile=="Y")		echo "selected";?>>모바일기기로 접속한 내역</option>
		</select>&nbsp;&nbsp;<input size="10" id="sdate" type="text" name="sdate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('sdate');" class="inputbox" value="<?=$sdate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('sdate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a> ~ <input size="10" id="edate" type="text" name="edate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('edate');" class="inputbox" value="<?=$edate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('edate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a>&nbsp;&nbsp;<input type="submit" value="보 기" class="inputbox_single"></td>
</tr>
</form>
<tr>
	<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
		<tr bgcolor="#F2F2F2" height="23">
			<th width="100">시간대</th>
			<th width="100">총 접속수</th>
			<th width="100">단독 접속수</th>
			<th width="100">단독 비율</th>
			<th width="100">전체 비율</th>
			<th>기간전체 중 비율</th>
		</tr>
<?
for($i = 0; $i <= 23; $i++) {
	$a= $i + 1;
	//이미지 길이를 설정
	if($max_day_total)  $time_img_width = intval(($time_total[$i] / $max_day_total) * 140);

	//월전체중 해당 일별 비율 설정
	if($month_total&&$time_total[$i])		$time_rate = number_format(($time_total[$i] / $month_total * 100),1)." %";
	else											$time_rate = "";

	if($time_total[$i])				$unique_rate = number_format($time_unique_total[$i] / $time_total[$i]*100,1)." %";
	else								$unique_rate = "";

	$time_total1 = number_format($time_total[$i]);
	$time_unique_total1 = number_format($time_unique_total[$i]);
?>
<tr bgcolor="white" height="23" onMouseOver="this.style.backgroundColor='#F2F2F2';"  onMouseOut="this.style.backgroundColor='#FFFFFF';">
	<td align="center"><?=$i.":00 ~ ".$i.":59"?></td>
	<td align="center"><?=$time_total1?></td>
	<td align="center"><?=$time_unique_total1?></td>
	<td align="center"><?=$unique_rate?></td>
	<td align="center"><?=$time_rate?></td>
	<td style="padding:5px;"><img src="/s_source/images/green_bar1.gif" height=10><img src="/s_source/images/green_bar2.gif" width="<?=$time_img_width ?>" height=10><img src="/s_source/images/green_bar3.gif" height=10></td>
</tr>
<?
	flush2();
	}
?>
	</table></td>
</tr>
</table>
<br /><br /><br />