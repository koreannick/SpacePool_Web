<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

if(preg_match("/[\,]?{$nickname}/i", $CONF_noid)){
	echo "<b class=\"alert_no\">사용불가</b>";
}else{
	$query = "select nickname from es_member where nickname = '$nickname'";
	$result = mysql_query($query, $connect);
	$nickname_total = mysql_num_rows($result);

	@mysql_free_result($result);
	@mysql_close($connect);

	if($nickname_total){
		echo "<b class=\"alert_no\">사용불가</b>";
	}else{
		echo "<b class=\"alert_ok\">사용가능</b>";
	}
}

exit;
?>