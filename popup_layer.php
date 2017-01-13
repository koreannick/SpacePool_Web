<?
 

$result = mysql_query("Select * From es_popup Where status='on' and layer = 'Y' Order By wdate Desc");
if(mysql_num_rows($result)>0){
?>
<script language="JavaScript">
function closeWin(uid,chk) {
	if ( document.getElementById(chk).checked==true){
		setCookie2( uid, "done" , 1 );
	}
	document.getElementById(uid).style.display = "none";
}

function sclose(uid){
	document.getElementById(uid).style.display = 'none';
}
</script>
<?
	$i = 1;
	while($row=mysql_fetch_array($result)){
		$uid = $row[uid];
		$position = explode("|",$row["pos"]);
		$xx = $position[0];
		$yy = $position[1];
		$title = stripslashes($row["title"]);
		$contents = stripslashes($row["contents"]);
		$size = explode("|", stripslashes($row["size"]));
		$ctime = $row["ctime"];
?>
<div id="popupl_<?=$uid?>" style="position:absolute;top:<?=$yy?>px;left:<?=$xx?>px;width:<?=$size[0]?>px;height:<?=$size[1]?>px;z-index:<?=$i?>00000;border: 1px solid #cccccc;background-color:#FFFFFF;">
	<table border="0" width="<?=$size[0]?>" cellpadding="0" cellspacing="0" height="<?=$size[1]?>">
	<tr>
		<td bgcolor="#FFFFFF"><?=$contents?></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="right"><input type='checkbox' name="chk<?=$i?>" id="chk<?=$i?>" onclick="javascript:closeWin('popupl_<?=$uid?>','chk<?=$i?>');"> 오늘 하루동안 열지않기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.getElementById('popupl_<?=$uid?>').style.display = 'none';">그냥 닫기</a></td>
	</tr>
	</table>
</div>
<script language="JavaScript">
var eventCookie=getCookie("popupl_<?=$uid?>")
if(eventCookie=="done"){
	document.getElementById('popupl_<?=$uid?>').style.display = "none";
}else{
	document.getElementById('popupl_<?=$uid?>').style.display = "";
}
<?if($ctime>0){?>
setTimeout("sclose('popupl_<?=$uid?>')",<?=$ctime?>*1000);
<?}?>
</script>
<?
		$i++;
	}
}
@mysql_free_result($result);
?>
