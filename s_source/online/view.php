<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($uid){
	$result = mysql_query("Select * From $table Where uid=$uid");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$$key = stripslashes(trim($val));
		}
	}
	@mysql_free_result($result);
}else{
	redir_proc("back","잘못된 접근입니다.");
	exit;
}
?>
<script language=javascript>
<!--
// list
function page_list(){
	var form = document.form0;
	form.mode.value = "list";
	form.submit();
}
// del
function del(){
	var form = document.form0;
	if(confirm("삭제하시겠습니까...??")){
		form.mode.value = "del_ok";
		form.submit();
	}
}
// edit
function edit(){
	var form = document.form0;
	form.mode.value = "edit";
	form.submit();
}
-->
</script>
<form name=form0 method=get action='<?=$_SERVER[PHP_SELF]?>'>
<input type=hidden name=mode value='list'>
<input type=hidden name=uid value='<?=$uid?>'>
<table width=800 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr height="30">
			<th width="120" bgcolor="#F6F6F6">이름</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$name?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이메일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$email?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">전화번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$tel?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">휴대폰번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$mobile?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">제안타입</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$gubun?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">제목</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$subject?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">설명</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=nl2br($comment)?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">관리자 메모</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=nl2br($admin_comment)?></td>
		</tr>
	</table></td>
</tr>
<tr>
	<td align=center style="padding:5px;">
		<input type=button value="확    인" onClick="page_list();" style=width:100;>
		<input type=button value="수    정" onClick="edit();" style="width:100px;color:green;">
		<input type=button value="삭    제" onClick="del();" style="width:100px;color:red;">
	</td>
</tr>
</table>
</form>

