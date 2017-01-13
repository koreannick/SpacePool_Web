<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if(!$sdate)		$sdate = date("Y-m-d");
if(!$edate)		$edate = date("Y-m-d");

$s_ip = trim($s_ip);
$my_ip = getenv("REMOTE_ADDR");
$s_length = strlen($s_ip);

if(!$mdate)		$mdate = date("Y-m-d");

$where_query = " where (con_date >= '$sdate' and con_date <= '$edate') ";

if($smobile)		$where_query .= " and mobile = '$smobile'";
if($smweb)		$where_query .= " and mweb = '$smweb'";

if($s_ip)			$where_query .= " and ip like '$s_ip%'";

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
		</select>&nbsp;&nbsp;<b>접속일</b> : <input size="10" id="sdate" type="text" name="sdate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('sdate');" class="inputbox" value="<?=$sdate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('sdate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a> ~ <input size="10" id="edate" type="text" name="edate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('edate');" class="inputbox" value="<?=$edate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('edate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a>&nbsp;&nbsp;/&nbsp;&nbsp;<b>현재IP : <font color=green><?=$my_ip?></font> / 검색 IP : <font color=futshica><?=$s_ip?></font></b> <input type="text" name="s_ip" value="<?=$s_ip?>" size=20 class=inputbox_single> <input type="submit" value="검색" class=inputbox_single></td>
</tr>
</form>
<tr>
	<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
		<tr bgcolor="#F2F2F2" height="23">
			<th width="100">접속일자</th>
			<th width="50">시각</th>
			<th width="150">IP</th>
			<th width="200">유입경로</th>
			<th>검색어</th>
		</tr>
<?
	$result = mysql_query("SELECT * FROM $table $where_query order by ip, con_date desc");
	$total_record = mysql_num_rows($result);
	while($row = mysql_fetch_array($result)){
		$ip = $row["ip"];
		$con_date = $row["con_date"];
		$con_hour = $row["con_hour"];
		$site = $row["site"];
		$search_word = $row["search_word"];
		if(!$site)						$site = "&nbsp;";
		if(!$search_word)		$search_word = "&nbsp;";
?>
		<tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#F2F2F2';"  onMouseOut="this.style.backgroundColor='#FFFFFF';">
			<td height="23" align="center"><?=$con_date?></td>
			<td align="center"><?=$con_hour?></td>
			<td align="center"><?=$ip?></td>
			<td align="center"><?=$site?></td>
			<td align="center"><?=$search_word?></td>
		</tr>
<?
	}
	@mysql_free_result($result);
	flush2();
?>
	</table></td>
</tr>
</table>
<br /><br /><br />