<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect=dbcon();	}

if(!$num_per_page)		$num_per_page = 15;
if(!$page_per_block)	$page_per_block = 10;
if(!$page)					$page = 1;

if(auth_lev()==8){
	redir_proc($PHP_SELF."?mode=edit","");
}

$tmp_where = " where 1=1 ";

if($m_kinds)		$tmp_where .= " and m_kind='$m_kinds' ";
if($search)			$tmp_where .= " and $skey Like '%$search%' ";
if($statuss)			$tmp_where .= " and status = '$statuss' ";

if($login_non_chk=="Y"){
	$prev_date = mktime(0,0,0,date("m"),date("d"),(date("Y")-1));
	$tmp_where .= " and (last_log_date < '$prev_date' and wdate < '$prev_date') ";
}

if($h_chk=="Y")	$tmp_where .= " and m_kind='m1' and host='Y'";

$result = mysql_query("Select count(*) From $t_member $tmp_where");
if(!$result){
	redir_proc("back","오류가 발생하였습니다.");
	exit;
}
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
		alert("검색어를 입력하세요.");
		form.search.focus();
		return;
	}
	form.target = "";
	form.method = "get";
	form.submit();
}

// 상세보기
function view(uid){
	var form = document.form0;
	form.target = "";
	form.mode.value='view';
	form.method = "get";
	form.uid.value = uid;
	form.submit();
}

function input(){
	var form = document.form0;
	form.target = "";
	form.method = "get";
	form.mode.value='input';
	form.submit();
}

function checkall(bool){
    var obj = document.getElementsByName("uid[]");

    for(var i=0 ; i < obj.length ; i++) {
        obj[i].checked = bool;
    }
}

function status_chg(){
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
			form.mode.value = "status_chg_ok";
			form.method = "post";
			form.submit();
		}
	}else{
		alert('하나이상을 체크하세요.');
	}
}
-->
</script>
<table width="<?if($h_chk=="Y"){?>1200<?}else{?>1100<?}?>" border="0">
<form name="form0" method="get" action="<?=$_SERVER["PHP_SELF"]?>">
<input type="hidden" name="mode" value='<?=$mode?>'>
<input type="hidden" name="uid">
<input type="hidden" name="page" value="<?=$page?>">
<tr>
	<td>
		<input type="checkbox" name="login_non_chk" id="login_non_chk" value="Y" <?if($login_non_chk=="Y")		echo " checked";?> onclick="form0.target='';form0.mode.value='list';form0.page.value='1';form0.submit();">1년간 미사용자만 조회&nbsp;
		<select name="statuss" class="feldline" onchange="form0.target='';form0.mode.value='list';form0.page.value='1';form0.submit();">
			<option value="" <?if($statuss=="")	echo "selected";?>>:: 상태별 ::</option>
			<option value="ok" <?if($statuss=="ok")	echo "selected";?>>허가</option>
			<option value="wait" <?if($statuss=="wait")	echo "selected";?>>대기</option>
			<option value="leave" <?if($statuss=="leave")	echo "selected";?>>탈퇴</option>
		</select>&nbsp;&nbsp;
		<select name="m_kinds" class="feldline" onchange="form0.target='';form0.mode.value='list';form0.page.value='1';form0.submit();">
			<option value="" <?if($statuss=="")	echo "selected";?>>:: 등급별 ::</option>
			<?foreach ($m_level_arr as $key => $val) {?>
			<option value="<?=$key?>" <?if($key==$m_kinds)	echo "selected";?>><?=$val?></option>
			<?}?>
		</select>
		<?
		$arr_val=array("id|아이디","name|이름","email|이메일","addr1|주소","addr2|상세주소");
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
		<input type=button value='찾아보기' onClick="check_search();" class=feldline><?if(auth_lev()==9){?>&nbsp;&nbsp;&nbsp;<input type=button value="엑셀저장" onclick="location.href='<?=$PHP_SELF?>?mode=excel&skey=<?=$skey?>&search=<?=$search?>&statuss=<?=$statuss?>&m_kinds=<?=$m_kinds?>&login_non_chk=<?=$login_non_chk?>&h_chk=<?=$h_chk?>';" class="feldline"><?}?>
	</td>
	<td width="15%"><input type="checkbox" name="h_chk" id="h_chk" value="Y" <?if($h_chk=="Y")		echo " checked";?> onclick="form0.target='';form0.mode.value='list';form0.page.value='1';form0.submit();">HOST 신청자만 보기</td>
</tr>
<tr>
	<td bgcolor="#E7E7E7" colspan="2">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30" align="center" bgcolor="#F6F6F6">
				<th width="30"><input type="checkbox" name="all_chk" value="Y" onclick="checkall(this.checked)"></th>
				<th width="50">No</th>
				<th width="130">아이디</th>
				<th width="80">등급</th>
				<th width="190">이름</th>
				<th width="110">연락처</th>
				<th width="280">이메일</th>
				<th width="50">상태</th>
				<th width="80">등록일</th>
				<?if($h_chk=="Y"){?>
				<th width="100">HOST<br />신청일</th>
				<?}?>
				<th width="100">최근로그인</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("select * From $t_member $tmp_where order by wdate Desc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					$uid = $row["uid"];
					$id = $row["id"];
					$name = $row["name"];
					$email = $row["email"];
					$status = $row["status"];
					$wdate = $row["wdate"];
					$mobile = $row["mobile"];
					$h_wdate = $row["h_wdate"];
					$m_kind = $row["m_kind"];
					$last_log_date = $row["last_log_date"];
					if($last_log_date)		$last_log_date = date("Y.m.d", $last_log_date);
					else						$last_log_date = "";

					$wdate = date("Y.m.d", $wdate);

					switch($status){
						case"wait":	$status="<font color=gray>대기</font>";		break;
						case"ok":	$status="<font color=blue>허가</font>";		break;
						case"leave":	$status="<font color=red>탈퇴</font>";	break;
					}


					echo("<tr  bgcolor=#FFFFFF onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td align=center><input type=checkbox name=uid[] value=$uid></td>");
					echo("<td align=center height=23>$index</td>");
					echo("<td align=center><a href=# onClick=\"view('$uid');return false;\">$id</a></td>");
					echo("<td align=center>$m_level_arr[$m_kind]</td>");
					echo("<td align=center>$name</td>");
					echo("<td align=center>$mobile</td>");
					echo("<td align=center><a href=mailto:$email>$email</a></td>");
					echo("<td align=center>$status</td>");
					echo("<td align=center>$wdate</td>");
					if($h_chk=="Y"){
					echo("<td align=center style=\"padding:3px;\">".date("Y.m.d H:i:s",$h_wdate)."</td>");
					}
					echo("<td align=center>$last_log_date</td>");
					echo("</tr>");
					$index--;

				}
				@mysql_free_result($result);
			}else{

			}
			?>
			<?if(auth_lev()==9){?>
			<tr  bgcolor="#FFFFFF">
				<td colspan=8 align=left style="padding:5px 5px 5px 5px;">
				&nbsp;┗ 체크한 항목을
				<select name="status" class=inputbox_single>
					<option value="ok">승인 상태로</option>
					<option value="wait">대기 상태로</option>
					<option value="exit">탈퇴 상태로</option>
					<option value="">---------------------------</option>
					<?
					foreach ($m_level_arr as $mkey => $val) {
					?>
					<option value="<?=$mkey?>"><?=$val?>로 등급을</option>
					<?
					}
					?>
				</select>
				<input type="button" value="변경" onclick="status_chg();" class=feldline>
				</td>
				<td colspan=<?if($h_chk=="Y"){?>4<?}else{?>3<?}?> align=center><input type="button" value="신규등록" onclick="input();" class=feldline></td>
			</tr>
			<?}?>
		</table>
	</td>
</tr>
<tr>
	<td align=center style="padding:5px 5px 5px 5px;">
		<?
			// 페이징
			$link = $_SERVER[PHP_SELF] . "?mode=list&skey=$skey&search=$search&statuss=$statuss&m_kinds=$m_kinds&login_non_chk=$login_non_chk&h_chk=$h_chk";
			$img_dir = "/s_source/images/bbs/";
			paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
		?>
	</td>
</tr>
</table>
</form>
