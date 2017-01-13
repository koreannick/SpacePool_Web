<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($uid){
	$result = mysql_query("Select * From $t_member Where uid='$uid'");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$$key = stripslashes(trim($val));
		}
		$wdate = date("Y년 m월 d일  H시 i분 s초", $wdate);
		if($last_mod_date)			$last_mod_date = date("Y년 m월 d일 H시 i분 s초", $last_mod_date);
		if($last_log_date)			$last_log_date = date("Y년 m월 d일  H시 i분 s초", $last_log_date);
	}else{
		redir_proc("back","잘못된 접근입니다.");
	}
	@mysql_free_result($result);
}else{
	redir_proc("back","잘못된 접근입니다.");
}
?>
<script language=javascript>
<!--
// 리스트
function go_list(){
	var form = document.form0;
	form.method = "get";
	form.mode.value = "list";
	form.submit();
}
// 수정
function edit(){
	var form = document.form0;
	form.method = "get";
	form.mode.value = "edit";
	form.submit();
}
// 삭제
function del(){
	var form = document.form0;
	if(confirm("삭제 하시겠습니까?")){
		form.method = "post";
		form.mode.value = "del_ok";
		form.submit();
	}
}
-->
</script>
<form name=form0 method="get" action='<?=$_SERVER["PHP_SELF"]?>'>
<input type="hidden" name=mode>
<input type="hidden" name="uid" value="<?=$uid?>">
<input type="hidden" name="page" value='<?=$page?>'>
<table width=800 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr height="30">
			<th width=150 bgcolor="#F6F6F6">회원등급</th>
			<td width=650 bgcolor="#FFFFFF" style="padding:5px;"><?=$m_level_arr[$m_kind]?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">아이디</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?
				echo("<b style=color:green>$id</b>");
				switch($status){
					case"wait":	$status="<font color=gray>대기</font>";		break;
					case"ok":	$status="<font color=blue>허가</font>";		break;
					case"leave":	$status="<font color=red>탈퇴</font>";	break;
				}
				echo("&nbsp;");
				echo("(" . $status . ")");
			?>
			</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이름</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$name?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">닉네임</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$nickname?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이메일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$email?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">주소</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?="[".$post."] ".$addr1." ".$addr2?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">전화번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$tel?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">휴대폰</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$mobile?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">프로필</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><img src="<?=$profile_image?>"></td>
		</tr>
		<?if($host=="Y"){?>
		<tr height="30">
			<th bgcolor="#F6F6F6">업체명</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$company?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">업종</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$cetc?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">직원 수</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$cperson?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업기간</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$cdate1?>년 <?=$cdate2?>개월</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업내용</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=nl2br($comment)?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업자등록번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$creg?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">네이버톡톡</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><a href="<?=$n_talk?>" target="_blank"><?=$n_talk?></a></td>
		</tr>

		<tr height="30">
			<th bgcolor="#F6F6F6">HOST신청일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=date("Y-m-d H:i:s",$h_wdate)?></td>
		</tr>


		<?}?>
		<tr height="30">
			<th bgcolor="#F6F6F6">가입일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$wdate?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">마지막 수정일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$last_mod_date?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">최근접속일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$last_log_date?></td>
		</tr>
	</table></td>
</tr>
<tr>
	<td height="30" align=center style="padding:10px;">
		<input type=button value='목 록' style="width:100px;" onClick="go_list();">
		<input type=button value='수 정' style="width:100px;color:green;" onClick="edit();">
		<input type=button value='탈퇴(삭제)' style="width:100px;color:red;" onClick="del();">
	</td>
</tr>
</table>
</form>