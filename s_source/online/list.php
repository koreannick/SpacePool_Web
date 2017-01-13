<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
$num_per_page = 15;
$page_per_block = 10;
if(!$page){			$page=1;	}

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$skey Like '%$search%' ";
}
if($tmp_where){
	$tmp_where = "Where " . $tmp_where;
}
if(!$connect){	$connect=dbcon();	}

$result = mysql_query("Select count(*) From $table $tmp_where");
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
	if(!form.search.value){
		err_proc(form.search, "검색어를 입력하세요.");
	}else{
		form.submit();
	}
}
// 상세보기
function view(uid){
	var form = document.form0;
	form.mode.value='view';
	form.uid.value = uid;
	form.submit();
}

-->
</script>
<table width="1000" border=0>
<form name=form0 method=get action='<?=$_SERVER["PHP_SELF"]?>'>
<input type=hidden name=mode value='<?=$mode?>'>
<input type=hidden name=uid>
<input type=hidden name="page" value="<?=$page?>">
<tr>
	<td>
			<?
			$arr_val=array("name|이름","email|이메일","subject|제목","comment|설명");
			echo("<select name='skey' class=inputbox_single>\n");
			for($i=0; $i<sizeof($arr_val); $i++){
				$val = explode("|", $arr_val[$i]);
				if($val[0]==$skey){
					echo("<option value='$val[0]' selected>$val[1]</option>\n");
				}else{
					echo("<option value='$val[0]'>$val[1]</option>\n");
				}
			}
			echo("</select>\n");
			?>
			<input type="text" name="search" value='<?=$search?>' size=20 maxlength="30" class=inputbox_single>
			<input type=button value='찾아보기' onClick="check_search();" class=inputbox_single>
	</td>
</tr>

<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width=50>No</th>
				<th width=200>제안타입</th>
				<th width=500>제목</th>
				<th width=150>이름</th>
				<th width=100>등록일</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("select * From $table $tmp_where order by uid Desc Limit $start, $num_per_page");
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						foreach($row as $key => $val){
							$$key = stripslashes(trim($val));
						}

						$wdate = date("Y.m.d", $wdate);

						echo("<tr height=25 bgcolor=#FFFFFF align=center onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
						echo("<td>$index</td>");
						echo("<td><a href=# onclick=\"view('$uid');return false;\">$gubun</a></td>");
						echo("<td><a href=# onclick=\"view('$uid');return false;\">$subject</a></td>");
						echo("<td>$name</td>");
						echo("<td>$wdate</td>");
						echo("</tr>");
						$index--;
					}
				}
				@mysql_Free_result($result);
			}else{
				echo "<tr height=25 bgcolor=#FFFFFF align=center><td colspan=5 align=center>데이터가 없습니다.</td></tr>";
			}
			?>
		</table>
	</td>
</tr>
<?
if($total_record>0){
?>
<tr bgcolor="#FFFFFF" height=25>
	<td align=center>
	<?
		$link = "$_SERVER[PHP_SELF]?mode=list&skey=$skey&search=".urlencode($search);
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?>
	</td>
</tr>
<?
}
?>
</form>
</table>