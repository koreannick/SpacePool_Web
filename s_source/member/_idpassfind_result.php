<?
if(!defined("__GAUTECH__"))		exit;

if($kind == "id"){
	$title_img = "id_img.gif";
	$sql = "Select id, pwd From $t_member Where name='$name' And email='$email'";
}elseif($kind == "pass"){
	$title_img = "pw_img.gif";
	$sql = "Select id, pwd From $t_member Where id='$id' And name='$name' And email='$email'";
}

if(!$connect){	$connect = dbcon();	}
$result = mysql_query($sql);
if($row=mysql_fetch_array($result)){
	$id = $row[id];
	$pass = $row[pwd];

	//임시 비밀번호 발급
	$rand_string = "abcdefghijklmnopqrstuvwxyz0123456789"; //영 소문자
	$mb_pass = "";//임시비밀번호
	for($i=0;$i<8;$i++){//8자리만 만들 수 있게
		$mb_pass.=substr($rand_string,rand(0,strlen($rand_string)),1);//랜덤으로 영문자 또는 숫자 지정
	}

	@mysql_query("update $t_member set pwd=password('$mb_pass') where id='$id'");

	if($kind=="pass"){
		$subject = $CONF_TITLE_TAG." - 비밀번호 검색결과입니다.";
		$title_str = "검색된 회원님의 비밀번호는 등록하신 이메일로 발송해드렸습니다.";
		$content = "회원님의 임시 비밀번호는 $mb_pass 입니다. 로그인 하셔서 변경해주시기바랍니다.";
	}else{
		$subject = $CONF_TITLE_TAG." - ID 검색결과입니다.";
		$title_str = "검색된 회원님의 ID는 등록하신 이메일로 발송해드렸습니다.";
		$content = "회원님의 ID는 $id 입니다. 유출되지않도록 각별히 주의하시기바랍니다.";
	}
	$to_email = $email;
	$from_email = $adminmail;
	$from_name = $name;
	basic_sendmail($to_email, $from_email, $subject, $content);

}else{
	redir_proc("close", "해당하는 데이터가 없습니다.!!");
}
?>
<script language=javascript>
<!--
function body_load(){
	window.resizeTo(600,270);
}
-->
</script>
<br>
<table width="95%" border=1 align="center" cellpadding=4 cellspacing=0 bgcolor=#cccccc bordercolor=#cccccc>
<tr>
	<td bgcolor=#f5f5f5>
		<table cellspacing=0 cellpadding=0 width="100%" border=0>
		<tr align=center bgcolor=#ffffff>
			<td width="100%"><br>
				<table width="85%" border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td height=12 align="left"><img src="/s_source/images/member/<?=$title_img?>"></td>
				</tr>
				<tr>
					<td>
						<table cellspacing=1 cellpadding=6 width="100%" border=3 bordercolor=#eeeeee align=center>
						<tr>
							<td bgcolor=fcf8e6 align=center><?=$title_str?></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 10px" align=center>
						<img src="/s_source/images/member/btn_ok.gif" style=cursor:hand; onClick="self.close();">
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>