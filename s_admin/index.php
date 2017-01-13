<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

if($mode == "logout_ok"){
	session_destroy();
	redir_proc($CONF_ADMIN_START, "로그아웃 되었습니다.\\n안녕히 가세요..");
}

if(!$id || !$pass){
		if(auth_lev()==9)				redir_proc("/s_source/a2_main.php","");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$CONF_TITLE_TAG?> 관리자모드에 접속하셨습니다.</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.inputbox {
	border: 1px solid #cccccc;
	font-size: 12px;
	background-color: #F9FAF2;
	height: 18px;
	font-family: "굴림", "굴림체", Verdana;
}
-->
</style>
<script language="JavaScript">
<!--
function checkIt(){
	var form = document.login_form;
	if(!form.id.value){
		alert("ID를 입력하세요");
		form.id.focus();
		return false;
	}
	if(!form.pass.value){
		alert("패스워드를 입력하세요");
		form.pass.focus();
		return false;
	}
	return true;
}
//-->
</script>

</head>

<body onLoad=document.login_form.id.focus()>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="363" align="left" valign="top" background="/s_admin/images/bg.gif" style="padding-left:90px; padding-top:150px;">
		<table width="180" border="0" cellspacing="0" cellpadding="0">
		<form name=login_form method=post action=<?=$_SERVER["PHP_SELF"]?> onSubmit="return checkIt();">
          <tr>
            <td height="25" align="center"><input name="id" type="text" size="24" maxlength="12" class="inputbox"></td>
          </tr>
          <tr>
            <td height="25" align="center"><input name="pass" type="password" size="24" maxlength="12" class="inputbox"></td>
          </tr>
          <tr>
            <td height="30" align="center"><input type="image" src="/s_admin/images/but.gif" width="163" height="26" border="0"></td>
          </tr></form>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?
}else{

	$connect = dbcon();

	// 관리자
	$sql = "Select * From es_member Where id = '$id'";
	$result = mysql_query($sql);
	if($row=mysql_fetch_array($result)){
		if(sql_password($pass) == $row["pwd"]){
			$m_kind = $row["m_kind"];
			$name = $row["name"];
			$status = $row["status"];
			$email = $row["email"];
			$nickname = $row["nickname"];
			$profile_image = $row["profile_image"];

			if(!$profile_image)		$profile_image = "/images/common/logo.png";

			if($status!="ok")		redir_proc("/","승인되지않았습니다.");

			$SN_USESSION = $email."|".$name."|".$m_kind."|".$nickname."|".$profile_image;
			$_SESSION["SN_USESSION"] = $SN_USESSION;

			@mysql_query("update es_member set last_log_date = ".time()." where id='$id'");
		 
			if($m_kind!="admin"){
				redir_proc("/","");
			}else{
			 
				redir_proc("/s_source/a2_main.php","");
			}
		}else{
			redir_proc("/s_admin/","비밀번호가 일치 하지 않습니다.");
		}
	}else{
		redir_proc("/s_admin/","아이디와 비밀번호를 확인해 주세요");
	}
}
?>