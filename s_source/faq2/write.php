<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($uid){
	$result = mysql_query("select * from $table where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$val = check_box($val);
			$$key = stripslashes($val);
		}
	}else{
		redir_proc("back","데이터가 존재하지 않습니다.");
		exit;
	}
	@mysql_free_result($result);
}else{
	$mode = "write";
}
?>
<script language="javascript" src="/inc/total_script.js"></script>
<script type="text/javascript" src="/s_source/SmartEditor2/js/HuskyEZCreator.js"></script>
<script language="javascript">
<!--
// 쓰기 체크 ////////////////////////////////////////////////////
function check_write(val){
	var form = document.form_write;
	if(form.subject.value.length < 1){
		err_proc(form.subject, "질문을 입력하세요");
	}else{
		oEditors.getById["comment"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		form.submit();
	}
}
-->
</script>
<form name=form_write method=post enctype=multipart/form-data action=<?=$_SERVER["PHP_SELF"]?>>
<input type=hidden name="mode" value='<?=$mode?>_ok'>
<input type=hidden name="uid" value='<?=$uid?>'>
<input type=hidden name="page" value='<?=$page?>'>
<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr>
			<th width="100" bgcolor="#F6F6F6" height=30>제목</th>
			<td bgcolor="#FFFFFF" style="padding:5px;">&nbsp;<input size=80 maxlength=70 name="subject" value="<?=$subject?>" class="inputbox"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" colspan="2" style="padding:5px;"><textarea name="comment" id="comment" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"><?=$comment?></textarea>
			<script type="text/javascript">
			var oEditors = [];
			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "comment",
				sSkinURI: "/s_source/SmartEditor2/SmartEditor2Skin.html",
				fCreator: "createSEditor2"
			});
			</script></td>
		</tr>
	</table></td>
</tr>
<tr>
	<td colspan=2 align=center style="padding:10px;">
		<input type=button style=height:26;width:100; value='  저 장  ' onClick='check_write();'>
		<input type=button style=height:26;width:100; value='  취 소  ' onClick='history.back();'>
	</td>
</tr>
</table>
</form>
