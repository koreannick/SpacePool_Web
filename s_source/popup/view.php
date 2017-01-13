<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

	if(!$connect){	$connect = dbcon();	}
	$sql = "Select * From $table Where uid='$uid'";
	$result = mysql_query($sql, $connect);
	if($row=mysql_fetch_array($result)){
		$uid = stripslashes($row[uid]);
		$title = stripslashes($row[title]);
		$contents = trim(stripslashes($row[contents]));
		$size = stripslashes($row[size]);
		$status = stripslashes($row[status]);
		$sort = $row[sort];
		$wdate = $row[wdate];
		$size = explode("|", $size);

	}
?>
<script language=javascript>
<!--
function body_load(){
	window.resizeTo(<?=$size[0]?>+50,<?=($size[1]+200)?>);
}
-->
</script>
<table width=100% height=100% cellpadding=0 cellspacing=0 border=1 bordercolor=#aaaaaa>
<tr>
	<td valign=top><?=$contents?></td>
</tr>
<tr>
<td height=30 align=center bgcolor=#eeeeee>
	<input type=button value='close' style=width:100; onClick="self.close();">
</td>
</tr>
</table>