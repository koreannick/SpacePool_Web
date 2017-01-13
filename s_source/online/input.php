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
	redir_proc("back","잘못된 접근입니다.");
	exit;
}
?>
<form name=form0 method=post action="<?=$_SERVER[PHP_SELF]?>" onSubmit="return ValidChk(this);" target="tempFrame"  enctype="multipart/form-data">
<input type=hidden name=mode value="<?=$mode?>_ok">
<input type=hidden name=uid value="<?=$uid?>">
<input type=hidden name=page value="<?=$page?>">

<table width=800 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr height="30">
			<th width="120" bgcolor="#F6F6F6">이름</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="name" size="30" maxLength="30" value="<?=$name?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이메일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="email" size="50" maxLength="100" value="<?=$email?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">전화번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="tel" size="30" maxLength="30" value="<?=$tel?>" class="inputbox_single" style="ime-mode:disabled;"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">휴대폰번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="mobile" size="30" maxLength="30" value="<?=$mobile?>" class="inputbox_single" style="ime-mode:disabled;"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">제안타입</th>
			<td bgcolor="#FFFFFF" style="padding:5px;">
				<select class="inputbox_single" name="gubun">
					<option value="비즈니스 제안" <?if($gubun=="비즈니스 제안")	echo "selected";?>>비즈니스 제안</option>
					<option value="서비스 제안" <?if($gubun=="서비스 제안")	echo "selected";?>>서비스 제안</option>
					<option value="기타" <?if($gubun=="기타")	echo "selected";?>>기타</option>
				</select>
			</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">제목</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="subject" size="50" maxLength="100" value="<?=$subject?>" class="inputbox_single" style="ime-mode:active;"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">설명</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><textarea name="comment" cols=80 rows=10 class="inputbox_multi"><?=$comment?></textarea></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">관리자 메모</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><textarea name="admin_comment" cols=80 rows=10 class="inputbox_multi"><?=$admin_comment?></textarea></td>
		</tr>
	</table></td>
</tr>
<tr>
	<td align=center style="padding:5px;">
		<input type=submit value='저 장' style=width:100;>
		<input type=button value='취 소' style=width:100; onClick="history.back();">
	</td>
</tr>
</table>
</form>