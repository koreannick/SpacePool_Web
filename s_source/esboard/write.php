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
		$original_comment = $comment;
		$wdate = date("Y-m-d",$wdate);

		if($mode=="reply"){
			$original_subject = $subject;
			$original_comment = ">>>>>>>>>>>>>" . $name . "님의 글 >>>>>>>>>>>>><br>";
			$original_comment .= "제목 : " . $original_subject . "<br>";
			$original_comment .= stripslashes($comment);
			$original_comment .= "<br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
			$name = $USESSION[1];
		}
	}else{
		redir_proc("back","데이터가 존재하지 않습니다.");
		exit;
	}
	@mysql_free_result($result);
}else{
	$mode = "write";
	$kind = $skind;
	$name = $USESSION[1];
}
?>
<script language='javascript' src="/s_inc/calendar.js"></script>
<script language="javascript" src="/s_inc/total_script.js"></script>
<script type="text/javascript" src="/s_source/SmartEditor2/js/HuskyEZCreator.js"></script>
<script language="javascript">
<!--
// 쓰기 체크 ////////////////////////////////////////////////////
function check_write(){
	var form = document.form0;
	if(form.subject.value.length < 1){
		err_proc(form.subject, "제목을 입력하세요");
	}else{
		oEditors.getById["comment"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		form.submit();
	}
}
-->
</script>
<form name="form0" method="post" enctype="multipart/form-data" action="<?=$_SERVER["PHP_SELF"]?>" target="tempFrame">
<input type=hidden name="mode" value="<?=$mode?>_ok">
<input type=hidden name="skind" value="<?=$skind?>">
<input type=hidden name="uid" value="<?=$uid?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="table" value="<?=$table?>">
<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<?if($kind_chk){?>
		<tr>
			<th bgcolor="#F6F6F6" height=30>구분</th>
			<td bgcolor="#FFFFFF">&nbsp;<select name="kind" class="inputbox_single">
					<?for($i=1;$i<=count($kind_arr);$i++){
						if($kind_arr[$i]){
						if($kind==$i)			$sel = "selected";
						else						$sel = "";
					?>
					<option value="<?=$i?>" <?=$sel?>><?=$kind_arr[$i]?></option>
					<?}
						}
					?>
				</select></td>
		</tr>
		<?}?>
		<tr>
			<th width="100" bgcolor="#F6F6F6" height=30>제목</th>
			<td bgcolor="#FFFFFF">&nbsp;<input size=80 maxlength=70 name="subject" style=height:20 value="<?=$subject?>" class="inputbox"></td>
		</tr>
		<tr>
			<th bgcolor="#F6F6F6" height=30>작성자</th>
			<td bgcolor="#FFFFFF">&nbsp;<input size="20" maxlength="20" name="name" value="<?=$name?>" class="inputbox"></td>
		</tr>
		<?if($mode=="edit"){?>
		<tr>
			<th bgcolor="#F6F6F6" height=30>등록일</th>
			<td bgcolor="#FFFFFF">&nbsp;<input size="10" id="wdate" type="text" name="wdate" title="YYYY-MM-DD" readonly onclick="displayCalendarFor('wdate');" class="inputbox" value="<?=$wdate?>">&nbsp;<a href="javascript:" onclick="displayCalendarFor('wdate');"><img src="/s_source/images/calendar.jpg" border="0" align="absmiddle"></a></td>
		</tr>
		<tr>
			<th bgcolor="#F6F6F6" height=30>조회수</th>
			<td bgcolor="#FFFFFF">&nbsp;<input size=10 maxlength=10 name="readno" style=height:20 value="<?=$readno?>" class="inputbox"></td>
		</tr>
		<?}?>
		<!-- 내용 -->
		<tr>
			<td valign=top colspan="2" bgcolor="#FFFFFF" style="padding:5px;"><textarea name="comment" id="comment" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"><?=$original_comment?></textarea>
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
		<!-- Top 게시물 -->
		<tr>
			<th bgcolor="#F6F6F6" height=30>Top 게시물</th>
			<td bgcolor="#FFFFFF">&nbsp;<input type=checkbox name=top value=1 style="border-style:none" <?=($top)?"checked":""?> onClick="check_bg(this);">
				체크하시면 글이 Top에 위치 합니다.(TOP게시물은 공개로 등록됩니다.)
			</td>
		</tr>
		<?if($w_secret){?>
		<tr>
			<th bgcolor="#F6F6F6" height=30>비밀번호</th>
			<td bgcolor="#FFFFFF">&nbsp;<input maxlength=15 name="pwd" type="text" class="inputbox" size="20" value="<?=$pwd?>">
				<?if($oneone_chk==1){?>
					<input type="hidden" name="secret" value="1">&nbsp;비공개로 등록됩니다.
				<?}else{?>
					<?	if($w_secret){	?>
					&nbsp;비밀글 사용<input type="radio" name="secret" value="1" style="border-style:none" <?=($secret=="1")?"checked":""?>>&nbsp;
					사용않음<input type="radio" name="secret" value="0" style="border-style:none" <?=($secret=="0"||empty($secret))?"checked":""?>>
					<?	}	?>
				<?}?>
			</td>
		</tr>
		<?}?>
	</table></td>
</tr>
<tr>
	<td colspan=2 align=center style="padding:10px;">
		<input type=button style="height:26px;width:100px;" value='  저장하기  ' onClick='check_write();'>
		<input type=button style="height:26px;width:100px;" value='   취 소   ' onClick='history.back();'>
	</td>
</tr>
</table>
</form>
