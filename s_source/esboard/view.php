<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect)			$connect=dbcon();

if($uid){
	$result = mysql_query("select * from $table where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$$key = stripslashes($val);
		}

		$wdate = date("Y.m.d H:i:s", $wdate);

		$comment = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' \\2 \\3", $comment);

		$puid = $uid;
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
		tempFrame.location.href="<?=$_SERVER[PHP_SELF]?>?mode=del_ok&table=<?=$table?>&uid=<?=$puid?>&skind=<?=$skind?>&page=<?=$page?>";
	}
}
-->
</script>
<link href="/s_source/SmartEditor2/css/smart_editor2.css" rel="stylesheet" type="text/css">
<link href="/s_source/thumbnail.css" rel="stylesheet" type="text/css" />
<script src="/s_source/thumbnailviewer.js" type="text/javascript"></script>
<form name="form0" method="post" action=<?=$_SERVER["PHP_SELF"]?>>
<input type="hidden" name="mode">
<input type="hidden" name="uid" value="<?=$puid?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="skind" value="<?=$skind?>">
</form>
<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr bgcolor="#F6F6F6">
			<th width=100 height="30">제목</th>
			<td width=700 bgcolor="#FFFFFF" style="padding:5px;"><?=$subject?></td>
		</tr>
		<tr bgcolor="#F6F6F6">
			<th height="30">작성자</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$name?><?if($id)		echo "(".$id.")";?></td>
		</tr>
		<tr bgcolor="#F6F6F6">
			<th height="30">등록일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$wdate?> (Hit : <?=$readno?> / IP : <?=$ip?>)</td>
		</tr>
		<?if($pwd){?>
		<tr bgcolor="#F6F6F6">
			<th height="30">비밀번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$pwd?></td>
		</tr>
		<?}?>
		<?	if($file_num){	?>
		<tr bgcolor="#F6F6F6">
			<th height="30">파일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?
				$img_chk = 0;
				$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc";
				$result = mysql_query($sql, $connect);
				while($row=mysql_fetch_array($result)){
					$file = $row[file];
					$ext = strtolower(substr($file, strrpos($file, ".")+1));
					if($ext=="gif" || $ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="bmp"||$ext=="wmv"||$ext=="avi"){
						$img_chk++;
					}
					echo("<a href='/s_source/download.php?table=$table&uid=$uid&filename=".rawurlencode($file)."'>$file</a>");
					echO("&nbsp;&nbsp;");
				}
			?>
			</td>
		</tr>
		<?	}	?>

		<?	if($img_chk){	?>
		<tr>
			<td colspan=4 valign=top align=center bgcolor="#FFFFFF"><table width="100%" cellpadding=5 cellspacing=5 bgcolor=#f7f7f7>
				<tr>
					<td valign=top align=center bgcolor="#FFFFFF"><?
					@mysql_data_seek($result, 0);
					while($row=mysql_fetch_array($result)){
						$file = $row[file];
						$ext = strtolower(substr($file, strrpos($file, ".")+1));
						if($ext=="gif" || $ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="bmp"){
							echo("<img src='$link_path".rawurlencode($file)."' name='target_resize_image[]' onclick='image_window(this)' border=0><br>");
						}elseif($ext=="wmv"||$ext=="avi"){
							echo "<embed src='$link_path".rawurlencode($file)."' width=500 height=400></embed>";
						}
					}
					@mysql_free_result($result);
					?></td>
				</tr>
			</table></td>
		</tr>
		<?	}	?>
		<tr height=200>
			<td colspan=2 style="padding:10px;	line-height:6px;" valign=top bgcolor="#FFFFFF"><?=$comment?></td>
		</tr>
		<?if($commentable){?>
		<tr>
			<td colspan="2" align="center" bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td><?
						// 코멘트
						$tbl = $table;
						$puid = $uid;
						include_once($_SERVER[DOCUMENT_ROOT] . "/s_source/esboard/comment.php");
					?></td>
				</tr>
			</table></td>
		</tr>
		<?}?>
	</table></td>
</tr>
<tr>
	<td colspan=2 style="padding:10px;" align=center bgcolor="#FFFFFF"><input type=button value="목록" onClick="location.href='<?=$_SERVER["PHP_SELF"]?>?mode=list&table=<?=$table?>&page=<?=$page?>&skind=<?=$skind?>';" style="width:100px;">
	<?	if($board_type!="notice"){	?>
		<?	if(!$top&&$replable){	?>
			<input type=button value='답글' onClick="location.href='<?=$_SERVER["PHP_SELF"]?>?mode=reply&table=<?=$table?>&uid=<?=$puid?>&skind=<?=$skind?>&page=<?=$page?>';" style="width:100px;color:blue;">
		<?	}	?>
	<?	}	?>
	<input type=button value='수정' onClick="location.href='<?=$_SERVER["PHP_SELF"]?>?mode=edit&table=<?=$table?>&uid=<?=$puid?>&skind=<?=$skind?>&page=<?=$page?>';" style="width:100;color:green;">
	<input type=button value='삭제' onClick="del_check();" style="width:100px;color:red;"></td>
</tr>
</table>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(750);
}
</script>
