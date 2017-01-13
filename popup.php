<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

$connect = dbcon();

$sql = "Select * From es_popup Where uid='$uid'";
$result = mysql_query($sql);
if($row=mysql_fetch_array($result)){
	foreach($row as $key => $val){
		$$key = stripslashes($val);
	}
	$size = explode("|", $size);
}
@mysql_free_result($result);
@mysql_close($connect);
?>
<HTML>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href=/s_inc/total_style.css type=text/css rel=stylesheet>
<script language=javascript src="/s_inc/total_script.js"></script>
<script language=javascript>
function closeWin(){
	if ( document.Colseform.event.checked )
			setCookie2("<?=$uid?>", "ok" , 1); // 1일동안 쿠키를 보존합니다.
			self.close();
}
</script>
<title><?=$title?></title>
<style>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>
<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width=100% height=100% cellpadding=0 cellspacing=0 border=0>
<form name="Colseform" method="post" action="">
<tr>
	<td valign=top height="<?=$size[1]?>"><?=$contents?></td>
</tr>
<tr>
	<td height=30 align=left bgcolor=#eeeeee>&nbsp;&nbsp;<INPUT TYPE=checkbox NAME=event >오늘 하루동안 열지 않기&nbsp;&nbsp;<input type=button value='닫기' onClick="closeWin();"></td>
</tr>
</form>
</table>
</body>
</html>