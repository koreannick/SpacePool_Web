<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$connect = dbcon();

if(preg_match("/[\,]?{$id}/i", $CONF_noid)){
	echo "<b class=\"alert_no\">사용불가</b>";
}else{
	$query = "select id from es_member where id = '$id'";
	$result = mysql_query($query, $connect);
	$id_total = mysql_num_rows($result);

	@mysql_free_result($result);
	@mysql_close($connect);

	if($id_total){
		echo "<b class=\"alert_no\">사용불가</b>";
	}else{
		echo "<b class=\"alert_ok\">사용가능</b>";
	}
}

exit;
?>