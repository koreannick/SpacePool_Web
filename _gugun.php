<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<script>
<?
if($sido){
	$connect = dbcon();
	$result = mysql_query("select uid,gugun from es_gugun where suid = $sido order by uid asc");
	if(mysql_num_rows($result)>0){
		$i = 1;
		while($r=mysql_fetch_array($result)){
?>
			parent.document.<?=$form_name?>.gugun.options[<?=$i?>] = new Option('<?=$r["gugun"]?>','<?=$r["uid"]?>');
<?
			if($gugun){
			?>
				if(<?=$r["uid"]?>==<?=$gugun?>){
					parent.document.<?=$form_name?>.gugun.options[<?=$i?>].selected = true;
				}
			<?
			}
		$i++;
		}
?>
	parent.document.<?=$form_name?>.gugun.options.length = (<?=$i?>);
<?
	}else{
?>
	parent.document.<?=$form_name?>.gugun.options.length = (1);
<?
	}
	@mysql_free_Result($result);
}
?>
</script>