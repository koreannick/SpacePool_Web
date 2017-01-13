<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
$num_per_page = 20;
$page_per_block = 10;

if(!$page)			$page = 1;

$tmp_where = " where 1=1 ";

if($sgubun)		$tmp_where .= " and gubun='".$sgubun."' ";

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$skey Like '%$search%' ";
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
	if(!form.search.value){
		err_proc(form.search, "검색어를 입력하세요.");
	}else{
		form.target = "";
		form.mode.value = "list";
		form.page.value = 1;
		form.submit();
	}
}

function input(){
	var form = document.form0;
	form.mode.value = "input";
	form.target = "";
	form.uid.value = "";
	form.submit();
}

function go_del(uid){
	var form = document.form0;
	if(confirm("삭제하시겠습니까..??")){
		form.mode.value = "del_ok";
		form.target = "tempFrame";
		form.uid.value = uid;
		form.submit();
	}
}

function nsave(num,uid){
	tempFrame.location.href='<?=$PHP_SELF?>?mode=nsave_ok&num='+num+'&uid='+uid;
}


function checkall(bool){
    var obj = document.getElementsByName("uid[]");

    for(var i=0 ; i < obj.length ; i++) {
        obj[i].checked = bool;
    }
}

function Main_Chg(main){
	if(main){
		var form = document.form0;
		var obj = document.getElementsByName("uid[]");

		var result = false;

		for(var i=0 ; i < obj.length ; i++) {
			if(obj[i].checked==true){
				result = true;
				break;
			}
		}

		if(result){
			if(confirm('선택하신 항목을 변경하시겠습니까?')){
				form.target = "tempFrame";
				form.mode.value = "main_chg_ok";
				form.method = "post";
				form.submit();
			}
		}else{
			alert('하나이상을 체크하세요.');
		}
	}
}
function Host_Chg(main){
	if(main){
		var form = document.form0;
		var obj = document.getElementsByName("uid[]");

		var result = false;

		for(var i=0 ; i < obj.length ; i++) {
			if(obj[i].checked==true){
				result = true;
				break;
			}
		}

		if(result){
			if(confirm('선택하신 항목의 HOST를 변경하시겠습니까?')){
				form.target = "tempFrame";
				form.mode.value = "host_chg_ok";
				form.method = "post";
				form.submit();
			}
		}else{
			alert('하나이상을 체크하세요.');
		}
	}
}

-->
</script>
<form name=form0 method="get" action="<?=$_SERVER["PHP_SELF"]?>">
<input type=hidden name=mode value='<?=$mode?>'>
<input type=hidden name=uid>
<input type=hidden name="page" value="<?=$page?>">
<table width="1250" border=0>
<tr>
	<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td><select name="sgubun" class="feldline" onchange="document.form0.mode.value='list';document.form0.page.value='1';document.form0.submit();">
					<option value="">:: 공간별 ::</option>
					<?
					for($i=1;$i<=count($gubun_arr);$i++){
						if($gubun_arr[$i]){
							$sel = "";
							if($i==$sgubun)		$sel = " selected";
							echo "<option value=\"$i\" $sel>".$gubun_arr[$i]."</option>";
						}
					}
					?>
				</select>
				<?
				$arr_val = array("subject|제목","id|HOST");
				echo("<select name='skey' class=feldline>\n");
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
				<input type="text" name="search" value='<?=$search?>' size=15 maxlength="30" class="feldline">
				<input type=button value='찾아보기' onClick="check_search();" class="feldline">
		</tr>
	</table></td>
</tr>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width="50"><input type="checkbox" name="all_chk" value="Y" onclick="checkall(this.checked)"></th>
				<th width=50>No</th>
				<th width=150>구분</th>
				<th width=100>지역</th>
				<th width=380>제목</th>
				<th width=150>HOST</th>
				<th width=100>상태</th>
				<th width=50>메인</th>
				<th width=70>등록일</th>
				<th width=150>&nbsp;</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("select * From $table $tmp_where order by uid desc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					foreach($row as $key => $val){
						$$key = stripslashes(trim($val));
					}

					$wdate = date("Y.m.d",$wdate);

					if($address){
						$address_arr = explode(" ",$address);
						$address_str = $address_arr[0]." ".$address_arr[1];
					}

					if($status=="wait")		$status_str = "<font color=red>대기중</font>";
					elseif($status=="ok")		$status_str = "<font color=blue><b>사용중</b></font>";

					if($main=="Y")		$main_str = "O";
					else						$main_str = "";

					$id_arr = explode("@",$id);
					$host_id = $id_arr[0];

					echo("<tr height=25 bgcolor=#FFFFFF align=center onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td align=center><input type=checkbox name=uid[] value=$uid></td>");
					echo("<td>$index</td>");
					echo("<td style=\"padding:5px;\">$gubun_arr[$gubun]</td>");
					echo("<td style=\"padding:5px;\">$address_str</td>");
					echo("<td style=\"padding:5px;\"><a href=\"/".$uid."\" target=\"_blank\">$subject</a></td>");
					echo("<td style=\"padding:5px;\"><a href=\"/".$host_id."\" target=\"_blank\">$id</a></td>");
					echo("<td style=\"padding:5px;\">$status_str</td>");
					echo("<td style=\"padding:5px;\">$main_str</td>");
					echo("<td style=\"padding:5px;\">$wdate</td>");
					echo("<td align=center><a href=\"javascript:;\" onclick=\"window.open('".$PHP_SELF."?mode=list2&puid=$uid','','width=1050,height=700,scrollbar=yes');\">예약현황</a> / <a href='/member/space_apply.php?uid=$uid' target='_blank'>수정</a> / <a href=# onClick=\"go_del('$uid');return false;\">삭제</a></td>");
					echo("</tr>");

					$index--;
				}
			}else{
				echo "<tr height=25><td colspan=10 bgcolor=#FFFFFF align=center>등록된 데이터가 없습니다.<td></tr>";
			}
			?>
			<tr>
				<td colspan=10 align="left" style="padding:5px 5px 5px 15px;" bgcolor="#FFFFFF">
					&nbsp;┗ 체크한 항목을 메인페이지에
					<select name="main" class="inputbox_single" onchange="Main_Chg(this.value);">
						<option value=""></option>
						<option value="Y">진열하기</option>
						<option value="N">진열취소하기</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan=10 align="left" style="padding:5px 5px 5px 15px;" bgcolor="#FFFFFF">
					&nbsp;┗ Host변경
					<select name="main2" class="inputbox_single" onchange="Host_Chg(this.value);">
						<option value=""></option>
						<?
						if(!$connect){	$connect=dbcon();	}
						$result_host = mysql_query("select email,name from es_member");
						if(mysql_num_rows($result_host)>0){
						  while($r=mysql_fetch_array($result_host)){
								echo "<option value=".str_replace("-","",$r[email]).">".$r[name]." (".$r[email]." / ".$r[name].")</option>";
						  }
						}
						@mysql_free_result($result_host);
						?>
					</select>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr bgcolor="#FFFFFF" height=25>
	<td align=center>
	<?
		$link = "$_SERVER[PHP_SELF]?mode=list&sgubun=$sgubun&skey=$skey&search=".urlencode($search);
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?>
	</td>
</tr>
</table>
</form>
