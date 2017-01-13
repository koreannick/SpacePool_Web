<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if($uid){
	$result = mysql_query("Select * From $table Where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$val = check_box($val);
			$$key = stripslashes(trim($val));
		}

		$mode = "edit";
	}
	@mysql_free_result($result);
}else{
	$mode = "input";
	$status = "Y";
	$cate = 1;
}
?>
<script type="text/javascript" src="/s_source/SmartEditor2/js/HuskyEZCreator.js"></script>
<link href="/s_source/thumbnail.css" rel="stylesheet" type="text/css" />
<script src="/s_source/thumbnailviewer.js" type="text/javascript"></script>
<form name=form0 method=post action="<?=$_SERVER[PHP_SELF]?>"  enctype="multipart/form-data" onsubmit="return ValidChk_E(this);" target="tempFrame">
<input type=hidden name=mode value='<?=$mode?>_ok'>
<input type=hidden name=uid value='<?=$uid?>'>
<input type=hidden name="page" value='<?=$page?>'>
<?for($i=1;$i<=1;$i++){?>
<input type="hidden" name="file<?=$i?>_old" value="<?=${"file".$i}?>">
<?}?>
<table width=900 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30">
				<th bgcolor="#F6F6F6" width="100">카테고리</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input type="radio" name="cate" value="1" <?if($cate==1)		echo " checked";?>>블렌딩 커피&nbsp;&nbsp;<input type="radio" name="cate" value="2" <?if($cate==2)		echo " checked";?>>싱글 커피</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6">제목</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input name="subject" type="text" class="inputbox_single" id="subject" size="80" maxlength="80" value="<?=$subject?>" must="Y" mval="제목은" /></td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6">소비자가격</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input name="b_price" type="text" class="inputbox_single" id="m_price" size="20" maxlength="20" value="<?=$b_price?>" must="Y" mval="소비자가격은" onkeypress="onlyNumber();" style="ime-mode:disabled;" />원</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6">회원가격</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input name="m_price" type="text" class="inputbox_single" id="m_price" size="20" maxlength="20" value="<?=$m_price?>" must="Y" mval="회원가격은" onkeypress="onlyNumber();" style="ime-mode:disabled;" />원</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6">내용</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><textarea name="comment" id="comment" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"><?=$comment?></textarea>
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
			<?for($i=1;$i<=1;$i++){?>
			<tr height="30">
				<th bgcolor="#F6F6F6" >사진<?=$i?></th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input name="file<?=$i?>" type="file" class="inputbox_single" size="50" ><?if(${"file".$i})			echo "<br>현재 등록된 파일 : <a href=$link_path".rawurlencode(${"file".$i})." rel=thumbnail>".${"file".$i}."</a> <input type=checkbox name=del".$i."_chk value=Y>삭제시 체크";?>
				</td>
			</tr>
			<?}?>
			<tr height="30">
				<th bgcolor="#F6F6F6">상태</th>
				<td bgcolor="#FFFFFF" style="padding:5px;"><input type="radio" name="status" value="Y" <?if($status=="Y")		echo " checked";?>>사용함&nbsp;&nbsp;<input type="radio" name="status" value="N" <?if($status=="N")		echo " checked";?>>사용안함</td>
			</tr>
		</table></td>
	</tr>
<tr>
	<td colspan=2 align=center style="padding:10px;">
		<input type="submit" value='저장' style="width:100px;">
		<input type=button value='취소' style="width:100px;" onClick="location.href='<?=$PHP_SELF?>?mode=list&page=<?=$page?>';">
	</td>
</tr>
</table>
</form>
