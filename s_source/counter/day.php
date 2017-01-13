<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if(!$sdate)		$sdate = date("Y-m-")."01";
if(!$edate)		$edate = date("Y-m-d");

$max_dd = end_day($year,$month);

$where_query = "";

if($smobile)		$where_query .= " and mobile = '$smobile'";
if($smweb)		$where_query .= " and mweb = '$smweb'";
?>
<script language='javascript' src="/s_inc/calendar.js"></script>
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
		<input size="10" id="sdate" type="text" name="sdate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('sdate');" class="inputbox" value="<?=$sdate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('sdate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a>&nbsp;~&nbsp;<input size="10" id="edate" type="text" name="edate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('edate');" class="inputbox" value="<?=$edate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('edate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a>
		&nbsp;&nbsp;<input type="submit" value="보 기" class="inputbox_single"></td>
</tr>
</form>
<tr>
	<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
		<tr bgcolor="#F2F2F2" height="23">
			<th width="100">날 짜</th>
			<th width="100">총 접속수</td>
			<th width="100">단독 접속수</td>
			<th width="100">단독 비율</td>
			<!-- <th width="100">전체 비율</td> -->
			<th>그래프</th>
		</tr>
<?
//echo "SELECT count(uid),count(distinct ip) FROM $table where (con_date >= '$sdate' and con_date <= '$edate') $where_query";
	$result = mysql_query("SELECT distinct con_date FROM $table where (con_date >= '$sdate' and con_date <= '$edate') $where_query");
	if(mysql_num_rows($result)>0){
		while($r=mysql_fetch_array($result)){
			$con_date = $r[0];

			$result2 = mysql_query("select count(uid),count(distinct ip) FROM $table where con_date ='$con_date' $where_query");
			$day_total = mysql_result($result2,0,0);
			$day_unique_total = mysql_result($result2,0,1);
			@mysql_free_result($result2);

			//월 전체합산 구하기
			$month_total = $month_total + $day_total;
			$month_unique_total = $month_unique_total + $day_unique_total;

			//최대값 구하기
			if($max_day_total < $day_total)							$max_day_total = $day_total;
			if($max_day_unique_total < $day_unique_total)		$max_day_unique_total = $day_unique_total;

			//이미지 길이를 설정
			if($max_day_total)		$day_img_width = intval(($day_total / $max_day_total) * 140);

			//월전체중 해당 일별 비율 설정
			if($month_total&&$day_total)		$day_rate = number_format(($day_total / $month_total * 100),1)." %";
			else										$day_rate = "";

			if($day_total)		$unique_rate = number_format($day_unique_total / $day_total*100,1)." %";
			else					$unique_rate = "";

?>
<tr bgcolor="white" height="23" onMouseOver="this.style.backgroundColor='#F2F2F2';"  onMouseOut="this.style.backgroundColor='#FFFFFF';">
	<td align="center"><?=$con_date?></td>
	<td align="center"><?=number_format($day_total)?></td>
	<td align="center"><?=number_format($day_unique_total)?></td>
	<td align="center"><?=$unique_rate?></td>
	<!-- <td align="center"><?=$day_rate?></td> -->
	<td style="padding:5px;"><img src="/s_source/images/green_bar1.gif" height=10><img src="/s_source/images/green_bar2.gif" width="<?=$day_img_width?>" height=10 alt="PC" /><img src="/s_source/images/green_bar3.gif" height=10></td>
</tr>
<?
			$tot_day_total += $day_total;
			$tot_day_unique_total += $day_unique_total;
			flush2();
		}
		$tot_unique_rate = number_format($tot_day_unique_total / $tot_day_total*100,1)." %";
	}
	@mysql_free_result($result);
?>
<tr bgcolor="white" height="23" onMouseOver="this.style.backgroundColor='#F2F2F2';"  onMouseOut="this.style.backgroundColor='#FFFFFF';">
	<th align="center">합계</th>
	<th align="center"><?=number_format($tot_day_total)?></th>
	<th align="center"><?=number_format($tot_day_unique_total)?></th>
	<th align="center"><?=$tot_unique_rate?></th>
	<!-- <td align="center"></td> -->
	<td style="padding:5px;">&nbsp;</th>
</tr>

	</table></td>
</tr>
</table>
<br /><br /><br />