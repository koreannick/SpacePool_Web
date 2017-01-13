<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}
?>
<script language=javascript>
// 삭제 체크
function comment_del_check(uid){
	if(confirm("삭제 하시겠습니까?")){
		document.cFrm2.uid.value = uid;
		document.cFrm2.submit();
	}
}

$(document).ready(function() {
	Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&table=<?=$table?>&puid=<?=$puid?>","result_frame");
});
</script>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor=F6F6F6 align=center>
		<tr>
			<td height=30 bgcolor=#e5dfbb>&nbsp;&nbsp;<b>댓글 : </b></td>
		</tr>
		<tr bgcolor=DDDED0>
			<td height=1 colspan=3></td>
		</tr>
		<tr align=center bgcolor="#FAFBF1">
			<td id="result_frame"></td>
		</tr>
		<tr>
			<td bgcolor=#e5dfbb><table width=100% border=0 cellpadding=5 cellspacing=0>
				<form name="cFrm1" method="post" action="<?=$PHP_SELF?>" onSubmit="return ValidChk(this);" target="tempFrame">
				<input type="hidden" name="mode" value="comment_ok">
				<input type="hidden" name="tbl" value="<?=$tbl?>">
				<input type="hidden" name="puid" value="<?=$puid?>">
				<input type="hidden" name="table" value="<?=$table?>">
				<tr>
					<td width=120 valign=top align=right>
						작성자 : <input type="text" name="name" size=10 maxLength=20 value="<?=$USESSION[1]?>" style="width:80px;height:23px;" class="inputbox_single" must="Y" mval="작성자는"><br>
					</td>
					<td><textarea name=comment style="width:100%;" rows="5" class="inputbox_multi" must="Y" mval="내용은"></textarea></td>
					<td width=50 align="center"><input type=submit value="저장" style="width:50px;height:50px;" class="inputbox_single"></td>
				</tr>
				</form>
			</table></td>
		</tr>
	</table></td>
</tr>
</table>
<form name="cFrm2" method="POST" action="<?=$PHP_SELF?>" target="tempFrame">
<input type="hidden" name="mode" value="comment_del_ok">
<input type="hidden" name="tbl" value="<?=$tbl?>">
<input type="hidden" name="puid" value="<?=$puid?>">
<input type="hidden" name="table" value="<?=$table?>">
<input type="hidden" name="uid">
<input type="hidden" name="pwd">
</form>