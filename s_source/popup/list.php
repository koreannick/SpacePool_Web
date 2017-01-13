<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
$num_per_page = 10;
$page_per_block = 10;
if(!$page)	$page= 1;

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$skey Like '%$search%' ";
}

if($tmp_where){
	$tmp_where = "Where " . $tmp_where;
}

if(!$connect){	$connect=dbcon();	}
$result = mysql_query("Select count(*) From $table $tmp_where",$connect);
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)	$total_page = 1;
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
		return true;
	}else{
		return err_proc(form.search, "검색어를 입력하세요!");
	}
}

// 쓰기
function go_input(){
	var form = document.form0;
	form.mode.value = "input";
	form.submit();
}
// view
function go_view(uid){
	window.open('<?=$_SERVER[PHP_SELF]?>?mode=view&uid='+uid,'dd','width=1,height=1');
}
// del
function go_del(uid){
	var form = document.form0;
	if(confirm("삭제하시겠습니까..??")){
		form.mode.value = "del_ok";
		form.uid.value = uid;
		form.submit();
	}
}
-->
</script>
<table width=800 border=0 >
<form name="form0" method="post" action=<?=$_SERVER[PHP_SELF]?> onSubmit="return check_search();">
<input type="hidden" name="mode" value="list">
<input type="hidden" name="uid">
<input type="hidden" name="page" value="<?=$page?>">
<tr bgcolor="#FFFFFF">
	<td>
		<table width=100% border=0>
		<tr>
			<td>
				<?
				$arr_val=array("title|제목","contents|내용");
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
				<input type="text" name="search" value="<?=$search?>" size="20" maxlength="30" class="inputbox_single">
				<input type="submit" value='찾아보기' class="inputbox_single">
			</td>
			<td align=right><input type=button value=" 등 록 " onClick="go_input();" class="inputbox_single"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width=50>No</th>
				<th width=450>제목</th>
				<th width=60>상태</th>
				<th width=80>등록일</th>
				<th width=100>&nbsp;</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("Select * From $table $tmp_where Order By wdate Desc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					$uid = stripslashes($row[uid]);
					$title = stripslashes($row[title]);
					$status = stripslashes($row[status]);
					$wdate = date("Y-m-d",$row[wdate]);

					$title = "&nbsp;<a href=# onClick=\"go_view('$uid');return false;\">" . $title . "</a>";

					echo("<tr bgcolor=#FFFFFF height=25 align=center onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td>$index</td>");
					echo("<td>$title</td>");
					echo("<td>$status</td>");
					echo("<td>$wdate</td>");
					echo("<td><a href='$_SERVER[PHP_SELF]?mode=edit&uid=$uid&page=$page'>수정</a>/<a href=# onClick=\"go_del('$uid');return false;\">삭제</a></td>");
					echo("</tr>");
					$index--;

				}
			}else{
				echo "<tr><td colspan=5 height=30 align=center bgcolor=#FFFFFF>등록된 데이터가 없습니다.</td></tr>";
			}
			?>

		</table>
	</td>
</tr>
<tr bgcolor="#FFFFFF">
	<td align=center  style="padding:5px 5px 5px 5px;"><?
		$link = $_SERVER[PHP_SELF] . "?mode=list&skey=$skey&search=$search";
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?></td>
</tr>
</form>
</table>