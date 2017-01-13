<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

$connect = dbcon();
$sms_connect = sms_dbcon();

$table = "es_sms_result";

if(!$nyear)		$nyear = date("Y");
//if(!$nmonth)		$nmonth = date("m");

## 페이징 설정 ##
$num_per_page = 15;
$page_per_block = 10;
if(!$page){			$page=1;	}

//$tmp_where = " where reserve != 'Y'";
$tmp_where = " where 1=1 ";

if($nyear&&$nmonth){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "wdate Like '${nyear}-${nmonth}-%' ";
}elseif($nyear&&!$nmonth){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "wdate Like '${nyear}-%' ";
}

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$skey Like '%$search%' ";
}

$result = mysql_query("Select count(*) From $table $tmp_where and length(content) <= 80",$connect);
$total_record1 = mysql_result($result,0,0);
@mysql_free_result($result);

$result = mysql_query("Select count(*) From $table $tmp_where and length(content) > 80",$connect);
$total_record2 = mysql_result($result,0,0);
@mysql_free_result($result);


$result = mysql_query("Select count(*) From $table $tmp_where",$connect);
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)			$total_page = 1;

$start = $num_per_page * ($page - 1);
$index = $total_record - ($num_per_page * ($page - 1));


$my_point = 0;
$result2 = mysql_query("select sum(case when state = '+' then point end),sum(case when state = '-' then point end) from es_point where c_id='$sms_cid'",$sms_connect);
if($result2&&mysql_num_rows($result2)>0){
	$my_point = mysql_result($result2,0,0)-mysql_result($result2,0,1);
}
@mysql_free_result($result2);
?>
<script language=javascript>
<!--
// 검색
function check_search(){
	var form = document.form0;
	if(!form.search.value){
		err_proc(form.search, "검색어를 입력하세요.");
	}
	form.submit();
}
-->
</script>
<form name=form0 method=post action='<?=$_SERVER["PHP_SELF"]?>'>
<input type=hidden name=mode value='<?=$mode?>'>
<input type=hidden name=idx>
<input type=hidden name=page value='<?=$page?>'>


<table width="95%" border=0>
<tr>
	<td colspan=6 bgcolor="#FFFFFF" height="25" style="padding:5px 5px 5px 15px;"><font color="red" size="4">※ 건수는 실제 발송되는 서버와의 오차는 있을 수 있습니다.</font><br />
	<b><font size="4">※ <?=$nyear?>년 <?if($nmonth)		echo $nmonth."월"?> 전송건수 : 총 <?=number_format($total_record)?>건 (총 금액 : <?=number_format($total_record1*20+$total_record2*60)?>원)</b>&nbsp;SMS : <?=number_format($total_record1)?>건 x 20원 = <?=number_format($total_record1*20)?>원&nbsp;&nbsp;/&nbsp;&nbsp;LMS : <?=number_format($total_record2)?>건 x 60원 = <?=number_format($total_record2*60)?>원<br><br>
	<font color="red"><b>※ 현재 충전잔액 : <?=number_format($my_point)?>원</b></font> -> 충전하실때는 입금후 연락(051-464-0117)부탁드립니다.(충전금액은 원하시는대로 가능하며 부가세는 별도입니다.)</font><br /><br /></td>
</tr>

<tr>
<td colspan=6>
	<table width=100% border=0>
		<tr>
			<td width="100%">
				<select name="nyear" onchange="form0.page.value='1';form0.submit();" class="inputbox_single">
				<?for($i=2014;$i<=date("Y")+1;$i++){?>
					<option value="<?=$i?>" <?if($nyear==$i)		echo "selected";?>><?=$i?>년</option>
				<?}?>
				</select>
				<select name="nmonth" onchange="document.form0.page.value='1';document.form0.submit();" class="inputbox_single">
					<option value="" <?if($nmonth=="")		echo "selected";?>>전체</option>
					<option value="01" <?if($nmonth=="01")		echo "selected";?>>01월</option>
					<option value="02" <?if($nmonth=="02")		echo "selected";?>>02월</option>
					<option value="03" <?if($nmonth=="03")		echo "selected";?>>03월</option>
					<option value="04" <?if($nmonth=="04")		echo "selected";?>>04월</option>
					<option value="05" <?if($nmonth=="05")		echo "selected";?>>05월</option>
					<option value="06" <?if($nmonth=="06")		echo "selected";?>>06월</option>
					<option value="07" <?if($nmonth=="07")		echo "selected";?>>07월</option>
					<option value="08" <?if($nmonth=="08")		echo "selected";?>>08월</option>
					<option value="09" <?if($nmonth=="09")		echo "selected";?>>09월</option>
					<option value="10" <?if($nmonth=="10")		echo "selected";?>>10월</option>
					<option value="11" <?if($nmonth=="11")		echo "selected";?>>11월</option>
					<option value="12" <?if($nmonth=="12")		echo "selected";?>>12월</option>
				</select>&nbsp;&nbsp;
				<?
				$arr_val=array("id|발송자ID","callback|회신번호","recipient_num|수신번호","content|메세지");
				echo("<select name='skey' class=inputbox_single>\n");
				for($i=0; $i<sizeof($arr_val); $i++){
					$val = explode("|", $arr_val[$i]);
					if($val[0]==$key){
						echo("<option value='$val[0]' selected>$val[1]</option>\n");
					}else{
						echo("<option value='$val[0]'>$val[1]</option>\n");
					}
				}
				echo("</select>\n");
				?>
				<input type="text" name="search" value='<?=$search?>' size=20 maxlength="30" class="inputbox_single">
				<input type=button value='찾아보기' onClick="check_search();" class="inputbox_single">
			</td>
		</tr>
	</table>
</td>
</tr>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width=40>번호</th>
				<th width=100>발송자ID</th>
				<th width=100>수신번호</th>
				<th>메세지</th>
				<th width=100>회신번호</th>
				<th width=130>전송일시</th>
				<th width=50>LMS</th>
				<th width=50>예약</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("select * From $table $tmp_where order by wdate Desc Limit $start, $num_per_page", $connect);
				while($row = mysql_fetch_array($result)){
					$id = $row["id"];
					$callback = $row["callback"];
					$content = $row["content"];
					$recipient_num = $row["recipient_num"];
					$wdate = $row["wdate"];
					$name = $row["name"];

					if(str_count($content)>80)		$lms = "O";
					else									$lms = "";
					if($row["reserve"]=="Y")		$reserve_str = "O";
					else									$reserve_str = "";


					echo("<tr height=25 bgcolor=#FFFFFF align=center onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td>$index</td>");
					echo("<td>$id</td>");
					echo("<td>$recipient_num</td>");
					echo("<td style=\"padding:3px 3px 3px 3px;\">".nl2br($content)."</td>");
					echo("<td>$callback</td>");
					echo("<td>$wdate</td>");
					echo("<td>$lms</td>");
					echo("<td>$reserve_str</td>");
					echo("</tr>");
					$index--;
					unset($mt_refkey);
					unset($company);

				}
				@mysql_free_result($result);
			}else{
			?>
			<tr>
				<td height="25" align="center" colspan="9" bgcolor="#FFFFFF">데이터가 없습니다.</td>
			</tr>
			<?
			}
			?>

		</table>
	</td>
</tr>
<tr>
	<td bgcolor="#FFFFFF" height=25 style="padding:5px 5px 5px 5px;" align="center"><?
	$link = "$_SERVER[PHP_SELF]?mode=result&skey=$skey&search=$search&nyear=$nyear&nmonth=$nmonth&reserve=$reserve";
	$img_dir = "/s_source/images/bbs/";
	paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
?></td>
</tr>
</table>
</form>