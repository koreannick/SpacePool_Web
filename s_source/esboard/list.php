<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
$num_per_page = 15;
if(!$page_per_block){	$page_per_block = 10;	}
if(!$page){			$page=1;	}

$tmp_where = "Where top=0 ";

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$key Like '%$search%' ";
}

if($skind){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "kind = '$skind' ";
}

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
<input type=hidden name=table value='<?=$table?>'>
<input type=hidden name=uid>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name="skind" value='<?=$skind?>'>
<table width=800 border=0>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width=50>No</th>
				<th width=550>제목</th>
				<th width=70>작성자</th>
				<th width=80>등록일</th>
				<th width=50>조회</th>
			</tr>
			<?
			$result = mysql_query("Select * From $table where top = 1 Order By uid desc Limit 0,10");
			while($row = mysql_fetch_array($result)){
				$uid = $row[uid];
				$name = $row[name];
				$subject = strcut_utf8(stripslashes($row[subject]),70);
				$readno = $row[readno];
				$wdate = $row[wdate];
				$kind = $row[kind];
				$new_time = 1 * 24 * 60 * 60;	// 하루

				// 파일정보
				$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1";
				$sresult = mysql_query($sql);
				if($srow=mysql_fetch_array($sresult)){
					$file = $srow['file'];
					$extension = selectExtension($file);
					$file_icon = "<img src=/s_source/images/file/" . $extension . ".gif align=absmiddle>";
				}else{
					$file_icon = "";
				}

				// new 글
				$new_img = "";
				if($wdate > (time() - $new_time))			$new_img = "<img src='/s_source/images/bbs/icon_n.jpg'>";
				$wdate = date("Y.m.d", $wdate);

				$resultc = mysql_query("select count(uid) from es_comment_board where puid = '$uid' and tbl = '$table'");
				if($resultc){
					$comment_cnt = mysql_result($resultc,0,0);
				}
				@mysql_free_result($resultc);


				if($kind_chk&&$kind)		$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\">[".$kind_arr[$kind]."]&nbsp;" . $subject . "</a> " . $new_img;
				else								$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\">" . $subject . "</a> " . $new_img;

				echo("<tr height=25 bgcolor=#ffeeee onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
				echo("<td align=center ><a href=# onClick=\"view('$uid');return false;\"><b style=color:red;>top</b></a></td>");
				if($comment_cnt>0)		echo("<td>&nbsp;$file_icon $subject $secret_img [$comment_cnt]</td>");
				else							echo("<td>&nbsp;$file_icon $subject $secret_img</td>");
				echo("<td align=center>$name</td>");
				echo("<td align=center>$wdate</td>");
				echo("<td align=center>".number_format($readno)."</td>");
				echo("</tr>");

				flush2();
			}
			@mysql_free_result($result);

			if($total_record>0){
				$result = mysql_query("Select * From $table $tmp_where Order By top Desc, gid desc, thread Asc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					$uid = $row[uid];
					$name = $row[name];
					$subject = strcut_utf8(stripslashes($row[subject]),70);
					$readno = $row[readno];
					$wdate = $row[wdate];
					$thread = $row[thread];
					$kind = $row[kind];
					$new_time = 1 * 24 * 60 * 60;	// 하루
					$top = $row[top];
					$secret = $row[secret];

					// 파일정보
					$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1";
					$sresult = mysql_query($sql);
					if($srow=mysql_fetch_array($sresult)){
						$file = $srow['file'];
						$extension = selectExtension($file);
						$file_icon = "<img src=/s_source/images/file/" . $extension . ".gif align=absmiddle>";
					}else{
						$file_icon = "";
					}

					// new 글
					$new_img = "";
					if($wdate > (time() - $new_time))			$new_img = "<img src='/s_source/images/bbs/icon_n.jpg'>";
					$wdate = date("Y.m.d", $wdate);

					//들여쓰기
					$blank = "";
					for($k=1; $k<strlen($thread); $k++){ $blank .= "&nbsp;&nbsp;";	}

					if($blank)			$icon = "$blank<img src='/s_source/images/bbs/reply.gif'> ";
					else					$icon = "";
					// 공개
					if($secret==1)		$secret_img = "<img src='/s_source/images/key.gif'>";
					else						$secret_img = "";

					$resultc = mysql_query("select count(uid) from es_comment_board where puid = '$uid' and tbl = '$table'");
					if($resultc){
						$comment_cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);


					if($kind_chk&&$kind)		$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\">[".$kind_arr[$kind]."]&nbsp;" . $subject . "</a> " . $new_img;
					else								$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\">" . $subject . "</a> " . $new_img;

					echo("<tr height=25 " . (($top)?"bgcolor=#ffeeee":" bgcolor=#FFFFFF") . " onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td align=center ><a href=# onClick=\"view('$uid');return false;\">" . (($top)?"<b style=color:red;>top</b>":"$index") . "</a></td>");
					if($comment_cnt>0)		echo("<td>&nbsp;$file_icon $subject $secret_img [$comment_cnt]</td>");
					else								echo("<td>&nbsp;$file_icon $subject $secret_img</td>");
					echo("<td align=center>$name</td>");
					echo("<td align=center>$wdate</td>");
					echo("<td align=center>".number_format($readno)."</td>");
					echo("</tr>");
					$index--;

					flush2();
				}
			}else{
				echo("<tr bgcolor=#FFFFFF height=25>");
				echo("<td colspan=5 align=center style=color:red;>------------------------- 데이터가 없습니다. --------------------</td>");
				echo("</tr>");
			}
			?>
			<tr bgcolor="#FFFFFF">
				<td colspan=6 style="padding:5px 5px 5px 5px;">
					<table width=100% border=0>
					<tr>
						<td width=500>
							<?
							$arr_val=array("subject|제목","comment|내용");
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
	<td align=center style="padding:5px 5px 5px 5px;">
	<?
		// 페이징
		$link = $_SERVER[PHP_SELF] . "?mode=list&table=$table&key=$key&search=$search&skind=$skind";
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?>
	</td>
</tr>
</table>
</form>
<br /><br />