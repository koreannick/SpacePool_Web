<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<script>
<?
if($gugun){
	$connect = dbcon();
	$result = mysql_query("select uid,dong from es_dong where guid = $gugun order by uid asc");
	if(mysql_num_rows($result)>0){
		$i = 1;
		while($r=mysql_fetch_array($result)){
?>
			parent.document.<?=$form_name?>.dong.options[<?=$i?>] = new Option('<?=$r["dong"]?>','<?=$r["uid"]?>');
<?
			if($dong){
			?>
				if(<?=$r["uid"]?>==<?=$dong?>){
					parent.document.<?=$form_name?>.dong.options[<?=$i?>].selected = true;
				}
			<?
			}
		$i++;
		}
?>
	parent.document.<?=$form_name?>.dong.options.length = (<?=$i?>);
<?
	}else{
?>
	parent.document.<?=$form_name?>.dong.options.length = (1);
<?
	}
	@mysql_free_Result($result);
}
?>
</script>