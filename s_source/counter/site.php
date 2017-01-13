<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가


if(!$sdate)		$sdate = date("Y-m-d");
if(!$edate)		$edate = date("Y-m-d");

$where_query = "where con_date >= '$sdate' and con_date <= '$edate'";

if($smobile)		$where_query .= " and mobile = '$smobile'";
if($smweb)		$where_query .= " and mweb = '$smweb'";


//이전 접속 경로별로 그룹화 한다.
$result = mysql_query("SELECT site, count(*) as b FROM $table $where_query group by site order by b desc");
$total_record = mysql_num_rows($result);
$i=0;
while($row = mysql_fetch_array($result)){

	$site[$i] = $row["site"];
	$count[$i] = $row[1];

	//월 전체합산 구하기
	$total_count = $total_count + $count[$i];

	//최대값 구하기
	if($max_count < $count[$i]){
		$max_count = $count[$i];
	}

	$i++;
}
@mysql_free_result($result);
flush2();
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
			<th width="300">사이트 명</th>
			<th width="100">총 접속수</th>
			<th width="100">비율</th>
			<th align="center">그래프</th>
		</tr>
<?

for($i = 0; $i < $total_record; $i++){

	$a= $i + 1;
	//이미지 길이를 설정
	if($max_count){
		$count_img_width = intval(($count[$i] / $max_count) * 140);
	}else{
		$count_img_width=0;
	}

	//월전체중 해당 일별 비율 설정
	if($total_count){
		$count_rate = number_format(($count[$i] / $total_count * 100),1);
		$count_rate .= " %";
	}else{
		$count_rate = "";
	}
	$count1 = number_format($count[$i]);
	if($site[$i] == ""){
		$site1 = "주소 직접입력";
		$go_url = "#";
	}else{
		$site1 = $site[$i];
		$go_url = "http://$site1";
	}
	echo("<tr bgcolor=\"white\" height=\"23\" onMouseOver=\"this.style.backgroundColor='#F2F2F2';\"  onMouseOut=\"this.style.backgroundColor='#FFFFFF';\">
		<td style=\"padding:5px;\"><a href=\"$go_url\" target=\"_blank\">$site1</a></td>
		<td align=\"center\">$count1</td>
		<td align=\"center\">$count_rate</td>
		<td style=\"padding:5px;\"><img src=\"/s_source/images/green_bar1.gif\" height=10><img src=\"/s_source/images/green_bar2.gif\" width=$count_img_width height=10><img src=\"/s_source/images/green_bar3.gif\" height=10></td>
	</tr>");
}
echo("<tr bgcolor=\"white\" height=\"23\">
	<td>&nbsp;</td>
	<td align=\"center\">$total_count</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>");
?>
	</table></td>
</tr>
</table>
<br /><br /><br />