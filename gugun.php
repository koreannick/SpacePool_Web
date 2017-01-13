<SCRIPT type="text/javascript">
function sido_chg1(sido){
	document.<?=$form_name?>.gugun.options[0] = new Option("시/구/군(전체)","0")
	document.<?=$form_name?>.gugun.options.length=1;

	if(sido){
		document.getElementById('tempFrame').src = "/_gugun.php?sido="+sido+"&form_name=<?=$form_name?>";
	}else{
	<?if($gugun){?>
		document.getElementById('tempFrame').src = "/_gugun.php?sido="+sido+"&gugun=<?=$gugun?>&form_name=<?=$form_name?>";
	<?}else{?>
		document.getElementById('tempFrame').src = "/_gugun.php?sido="+sido+"&form_name=<?=$form_name?>";
	<?}?>
	}

	document.tempFrame.submit();
}
</SCRIPT>

<SELECT NAME="sido" id="sido" onchange="sido_chg1(this.value);" class="inputbox_single" style="width:10%;">
<option value="" <?if($sido=="")		echo "selected";?>>시/도</option>
	<?
	$results = mysql_query("select * from es_sido order by uid asc");
	while($rs=mysql_fetch_array($results)){
		if($rs["uid"]==$sido)		$sel = " selected";
		else								$sel = "";
		echo "<option value=$rs[uid] $sel>".stripslashes($rs["sido"])."</option>\r";
	}
	@mysql_free_result($results);
	?>
</select>&nbsp;
<SELECT NAME="gugun" id="gugun" class="inputbox_single" style="width:22%;">
	<option value="" <?if($gugun=="")		echo "selected";?>>시/구/군(전체)</option>
	<?
	if($sido){
		$results = mysql_query("select * from es_gugun where suid = $sido order by uid asc");
		while($rs=mysql_fetch_array($results)){
			if($rs["uid"]==$gugun)		$sel = " selected";
			else								$sel = "";
			echo "<option value=$rs[uid] $sel>".stripslashes($rs["gugun"])."</option>\r";
		}
		@mysql_free_result($results);
	}
	?>
</select>