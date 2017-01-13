<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

$table = "es_booking";

## 페이징 설정 ##
$num_per_page = 20;
$page_per_block = 10;

if(!$page)			$page = 1;

if(!$puid)	redir_proc("close","잘못된 접근입니다.");

$tmp_where = " where puid=$puid ";

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
		form.mode.value = "list2";
		form.page.value = 1;
		form.submit();
	}
}

function go_del(uid){
	var form = document.form0;
	if(confirm("삭제하시겠습니까..??")){
		form.mode.value = "del2_ok";
		form.target = "tempFrame";
		form.uid.value = uid;
		form.submit();
	}
}


function checkall(bool){
    var obj = document.getElementsByName("uid[]");

    for(var i=0 ; i < obj.length ; i++) {
        obj[i].checked = bool;
    }
}

function S_Chg(main){
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
				form.mode.value = "b_update_ok";
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
<input type=hidden name="puid" value="<?=$puid?>">
<table width="1000" border=0>
<tr>
	<td><table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<?
				$arr_val = array("name|이름","mobile|연락처","email|E-mail");
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
				<th width=120>이름</th>
				<th width=130>연락처</th>
				<th width=250>이메일</th>
				<th width=150>예약일</th>
				<th width=100>상태</th>
				<th width=150>등록일</th>
				<th width=50>&nbsp;</th>
			</tr>
			<?
			if($total_record>0){
				$result = mysql_query("select * From $table $tmp_where order by uid desc Limit $start, $num_per_page");
				while($row = mysql_fetch_array($result)){
					foreach($row as $key => $val){
						$$key = stripslashes(trim($val));
					}

					$wdate = date("Y.m.d",$wdate);

					$status_str = "";
					if($status=="ok"){
						if($pay_status=="N"){
							$status_str = "<font color=#ff3300>결제대기</font>";
						}else{
							if($eDate<date("Y-m-d")||($eDate==date("Y-m-d")&&$eTime<=date("H"))){
								$status_str = "<font color=#0033ff>이용완료</font>";
							}else{
								if(($sDate<=date("Y-m-d")&&$eDate>=date("Y-m-d"))||($eDate==date("Y-m-d")&&$eTime>date("H"))){
									$status_str = "<font color=#ff00ff>이용중</font>";
								}else{
									$status_str = "<font color=#800000>결제승인</font>";
								}
							}
						}
					}elseif($status=="cancel"){
						$status_str = "<font color=#c0c0c0>취소</font>";
					}

					$id_arr = explode("@",$id);
					$guest_id = $id_arr[0];

					$sDate_str = $day_str[date("w",strtotime($sDate))];

					echo("<tr height=25 bgcolor=#FFFFFF align=center onMouseOver=\"this.style.backgroundColor='#eeeeee'\"  onMouseOut=\"this.style.backgroundColor=''\">");
					echo("<td align=center><input type=checkbox name=uid[] value=$uid></td>");
					echo("<td>$index</td>");
					echo("<td style=\"padding:5px;\"><a href=\"/member/host_book_detail.php?uid=$uid\" target=\"_blank\">$name</a></td>");
					echo("<td style=\"padding:5px;\">$mobile</td>");
					echo("<td style=\"padding:5px;\"><a href=\"/".$guest_id."\" target=\"_blank\">$email</a></td>");
					echo("<td style=\"padding:5px;\">".date("Y.m.d",strtotime($sDate))." (".$sDate_str.")</td>");
					echo("<td style=\"padding:5px;\">$status_str</td>");
					echo("<td style=\"padding:5px;\">$wdate</td>");
					echo("<td align=center><a href=# onClick=\"go_del('$uid');return false;\">삭제</a></td>");
					echo("</tr>");

					$index--;
				}
			}else{
				echo "<tr height=25><td colspan=9 bgcolor=#FFFFFF align=center>등록된 데이터가 없습니다.<td></tr>";
			}
			?>
			<tr>
				<td colspan=9 align="left" style="padding:5px 5px 5px 15px;" bgcolor="#FFFFFF">
					&nbsp;┗ 체크한 항목을
					<select name="SCHG" class="inputbox_single" onchange="S_Chg(this.value);">
						<option value=""></option>
						<option value="1">결제대기</option>
						<option value="2">결제승인</option>
						<option value="3">신청취소</option>
						<option value="4">삭제하기</option>
					</select>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr bgcolor="#FFFFFF" height=25>
	<td align=center>
	<?
		$link = "$_SERVER[PHP_SELF]?mode=list2&puid=$puid&sgubun=$sgubun&skey=$skey&search=".urlencode($search);
		$img_dir = "/s_source/images/bbs/";
		paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
	?>
	</td>
</tr>
</table>
</form>
