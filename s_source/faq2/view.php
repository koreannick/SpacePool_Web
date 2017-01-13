<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect=dbcon();	}

if($uid){
	$result = mysql_query("select * from $table where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$$key = stripslashes($val);
		}

		$wdate = date("Y.m.d H:i:s", $wdate);
	}else{
		redir_proc("back","데이터가 존재하지 않습니다.");
		exit;
	}
	@mysql_free_result($result);
}else{
	redir_proc("back","잘못된 접근입니다.");
	exit;
}
?>
<script language=javascript>
<!--
function del_check(){
	if(confirm('삭제하시겠습니까?')){
		location.href='<?=$_SERVER["PHP_SELF"]?>?mode=del_ok&uid=<?=$uid?>&page=<?=$page?>';
	}
}
-->
</script>
<link href="/s_source/SmartEditor2/css/smart_editor2.css" rel="stylesheet" type="text/css">
<form name=form_write method=post action=<?=$_SERVER["PHP_SELF"]?>>
<input type=hidden name=mode>
<input type=hidden name="uid" value="<?=$uid?>">
<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr bgcolor="#F6F6F6">
			<th width=100 height="30">제목</th>
			<td width=700 bgcolor="#FFFFFF" style="padding:5px;"><?=$subject?></td>
		</tr>
		<tr bgcolor="#F6F6F6">
			<th height="30">날짜</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$wdate?></td>
		</tr>
		<tr height=200>
			<td colspan=2 style="padding:10px;" valign=top bgcolor="#FFFFFF"><?=$comment?></td>
		</tr>
	</table></td>
</tr>
<tr>
	<td colspan=2 style="padding:10px;" align=center bgcolor="#FFFFFF">
		<input type=button value='목록' onClick="location.href='<?=$_SERVER["PHP_SELF"]?>?mode=list&table=<?=$table?>&page=<?=$page?>';" style=width:100;>
		<input type=button value='수정' onClick="location.href='<?=$_SERVER["PHP_SELF"]?>?mode=edit&table=<?=$table?>&uid=<?=$uid?>';" style=width:100;color:green;>
		<input type=button value='삭제' onClick="del_check();" style=width:100;color:red;>
	</td>
</tr>
</table>
</form>
