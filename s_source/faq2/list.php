<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
$num_per_page = 15;
$page_per_block = 10;
if(!$page){			$page=1;	}

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$key Like '%$search%' ";
}

if($tmp_where)			$tmp_where = "Where " . $tmp_where;

if(!$connect){	$connect=dbcon();	}

$result = mysql_query("Select count(*) From $table $tmp_where");
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)			$total_page = 1;

$start = $num_per_page * ($page - 1);
$index = $total_record - ($num_per_page * ($page - 1));
?>
<script language=javascript>
<!--
// 검색
function check_search(){
	var form = document.form0;
	if(form.search.value){
		form.mode.value = "list";
		form.page.value = 1;
		form.submit();
	}else{
		return err_proc(form.search, "검색어를 입력하세요!");
	}
}
// 전체보기
function total_view(){
	var form = document.form0;
	form.mode.value = "list";
	form.search.value = "";
	form.page.value = "";
	form.submit();
}
// 쓰기
function go_write(){
	var form = document.form0;
	form.mode.value = "write";
	form.submit();
}
// view
function view(uid){
	var form = document.form0;
	form.mode.value = "view";
	form.uid.value = uid;
	form.submit();
}
-->
</script>
<form name=form0 method=get action="<?=$_SERVER[PHP_SELF]?>">
<input type=hidden name=mode value='list'>
<input type=hidden name=uid>
<input type=hidden name=page value='<?=$page?>'>
<table width=800 border=0>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width=50>No</th>
				<th width=650>질문</th>
				<th width=100>날짜</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("Select * From $table $tmp_where Order By uid Desc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					$uid = $row[uid];
					$id = $row[id];
					$name = $row[name];
					$subject = $row[subject];
					$subject = stripslashes($subject);
					$wdate = date("Y-m-d",$row[wdate]);

					$subject = "<a href=# onClick=\"view('$uid');return false;\">" . $subject . "</a> ";

					echo("<tr height=25 bgcolor=#FFFFFF onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td align=center>$index</td>");
					echo("<td>&nbsp;$subject</td>");
					echo("<td align=center>$wdate</td>");
					echo("</tr>");
					$index--;
				}
			}else{
				echo("<tr bgcolor=#FFFFFF height=25>");
				echo("<td colspan=3 align=center style=color:red;>------------------------- 데이터가 없습니다. --------------------</td>");
				echo("</tr>");
			}
			?>
			<tr bgcolor="#FFFFFF">
				<td colspan=3 style="padding:5px 5px 5px 5px;">
					<table width=100% border=0>
					<tr>
						<td width=500>
							<?
							$arr_val=array("subject|질문","comment|답변");
							echo("<select name='key'>\n");
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

							<input type="text" name="search" value='<?=$search?>' size=20 maxlength="30">
							<input type=button value='찾아보기' onClick="check_search();">
						</td>
						<td align=right>
							<input type=button value='새글 쓰기' onClick="go_write();">
						</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
	</td>
</tr>
<tr bgcolor="#FFFFFF">
	<td colspan=3 align=center style="padding:5px 5px 5px 5px;">
	<?
		// 페이징
		$link = $_SERVER[PHP_SELF] . "?mode=list&key=$key&search=$search";
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?>
	</td>
</tr>
</table>
</form>