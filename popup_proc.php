<?
 

$result = mysql_query("Select * From es_popup Where status='on' and layer = 'N' Order By wdate Desc");
if(mysql_num_rows($result)>0){
	$arr_popup = "";
	while($row=mysql_fetch_array($result)){
		$uid = $row[uid];
		$pos = explode("|",$row["pos"]);
		$pos1 = $pos[0];
		$pos2 = $pos[1];
		$arr_popup[] = $uid;
		$arr_pos1[] = $pos1;
		$arr_pos2[] = $pos2;
		$size = explode("|", $row[size]);
		$arr_size1[] = $size[0];
		$arr_size2[] = $size[1];
	}
	flush2();
	@mysql_free_result($result);

	if($arr_popup){
	?>
	<script language="javascript">
	function openMsgBox(){
	<?
	for($i=0; $i<sizeof($arr_popup); $i++){
		echo("var eventCookie=getCookie(\"$arr_popup[$i]\");\n");
		echo("if (eventCookie != \"ok\")\n");
		echo("window.open('/popup.php?uid=" . $arr_popup[$i] . "','popup_" . $arr_popup[$i] . "','width=".($arr_size1[$i]+30).",height=".($arr_size2[$i]+30).",top=".$arr_pos2[$i].",left=".$arr_pos1[$i].",scrollbars,resizable');\n");
	}
	?>
	}

	openMsgBox();
	</script>
	<?
	}else{
		unset($arr_popup);
	}
}
?>