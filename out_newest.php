<?
if(!defined("__GAUTECH__"))	 exit;

if(!$connect)		$connect = dbcon();

$table = "es_free1";
$result = mysql_query("Select * from $table Order By uid desc Limit 0,5");
if($result&&mysql_num_rows($result)>0){
	$i = 1;
	while($row=mysql_fetch_array($result)){
		$uid = $row["uid"];
		$wdate = $row["wdate"];
		$subject = han_cut(stripslashes($row["subject"]),54);

		$new_time = 1 * 24 * 60 * 60 * 2;	//일주일

		$new_img = "";
		if($wdate > (time() - $new_time))				$new_img = "<img src=/images/icon/new.jpg align=absmiddle>";

		$wdate = date("Y.m.d", $wdate);

		$board_str1 .= "<a href=\"/05/02.php?mode=view&uid=$uid\" class=\"font_black_basic\">${subject}</a>";

		$i++;
	}
}else{
	$board_str1 = "&nbsp;";
}
@mysql_free_result($result);
?>