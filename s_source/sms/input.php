<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

$connect = dbcon();

$sms_send_call = $destination;

$where = " where mobile != '' ";

$uid = $_GET[uid];

if(count($uid)>0){
	for($i=0;$i<count($uid);$i++){
		$result2 = mysql_query("select mobile from $t_member where uid = $uid[$i]");
		if(mysql_num_rows($result2)>0){
			$r2 = mysql_fetch_array($result2);
			$mobile = str_replace("-","",$r2["mobile"]);

			$phone .= $mobile;

			if($i<>(count($uid)-1))			$phone .= ",";
		}
		@mysql_free_result($result2);
	}
}
?>
<script language=javascript>
<!--
// 입력체크
function send_check(){
	var form = document.form0;
	if(!form.destination.disabled){
		if(form.destination.value.length<7){	return err_proc(form.destination, "수신번호를 입력하세요.");	}
	}
	if(form.callback.value.length<7){	return err_proc(form.callback, "발신번호를 입력하세요.");	}
	if(form.body.value.length<1){		return err_proc(form.body, "내용을 입력하세요.");	}
	if(confirm("전송하시겠습니까...??")){
		form.submit();
	}
}

// SMS 문자체크
function ch_byte() {
	string = document.form0.body.value;
	string_len = string.length
	cal_byte = 0
	f_string_len = 0
	f_cal_byte = 0

	for (k=0;k<string_len;k++){
		onechar = string.charAt(k);

		if (escape(onechar).length > 4) {
			cal_byte += 2;
		}
		else if (onechar!='\r') {
			cal_byte++;
		}
		if(cal_byte <= 80)
		{
			f_string_len = k + 1
			f_cal_byte = cal_byte
		}
	}

	new_byte = cal_byte;

	document.all.byte.innerText = new_byte;
	document.form0.body.focus()
}
-->
</script>
<script language=javascript>
<!--
// 날짜
function check_date(obj){
	var form = document.form0;
	if(obj.checked){
		form.yy.disabled = false;
		form.mm.disabled = false;
		form.dd.disabled = false;
		form.hh.disabled = false;
		form.ss.disabled = false;

		form.yy.style.backgroundColor="";
		form.mm.style.backgroundColor="";
		form.dd.style.backgroundColor="";
		form.hh.style.backgroundColor="";
		form.ss.style.backgroundColor="";
		// 날짜버튼 못쓰게
	}else{
		form.yy.disabled = true;
		form.mm.disabled = true;
		form.dd.disabled = true;
		form.hh.disabled = true;
		form.ss.disabled = true;

		form.yy.style.backgroundColor="#aaaaaa";
		form.mm.style.backgroundColor="#aaaaaa";
		form.dd.style.backgroundColor="#aaaaaa";
		form.hh.style.backgroundColor="#aaaaaa";
		form.ss.style.backgroundColor="#aaaaaa";
		// 날짜버튼 못쓰게
	}
}

function gom(val){
	if(document.form0.destination.value.indexOf(val)=="-1"){
		if(document.form0.destination.value==""){
			document.form0.destination.value = val;
		}else{
			document.form0.destination.value = document.form0.destination.value+","+val;
		}
	}
}
-->
</script>
<table width=700 cellpadding=5 cellspacing=0 border=1 bordercolor=#aaaaaa>
<form name=form0 method=post action='<?=$_SERVER["PHP_SELF"]?>' target="tempFrame">
<input type=hidden name=mode value='<?=$mode?>_ok'>
<tr>
	<td bgcolor=#eeeee0 width="70">발송구분</td>
	<td>
		<input type="radio" name="m_kind" value="" checked onclick="document.form0.mlist.disabled=false;document.form0.destination.disabled=false;">개별발송
		<input type="radio" name="m_kind" value="all" onclick="document.form0.mlist.disabled=true;document.form0.destination.disabled=true;">전체회원
			<?
				foreach ($m_level_arr as $key => $val) {
					echo("<input type=radio name=m_kind value='$key'  onclick=\"document.form0.mlist.disabled=true;document.form0.destination.disabled=true;\">${val}\n");
				}
			?>
	</td>
</tr>
<tr>
	<td bgcolor=#eeeee0 width="70">회원목록</td>
	<td><select name="mlist" multiple size="10" class="inputbox_multi" onclick="gom(this.value)">
	<?
	$result = mysql_query("select id,name,mobile from $t_member $where order by name asc");
	if(mysql_num_rows($result)>0){
		while($r=mysql_fetch_array($result)){
			echo "<option value=".str_replace("-","",$r[mobile]).">".$r[name]." (".$r[id]." / ".$r[mobile].")</option>";
		}
	}
	@mysql_free_result($result);
	?>
	</select></td>
</tr>
<tr>
	<td bgcolor=#eeeee0 width="70">수신번호</td>
	<td><input name=destination size=100 maxLength=150 style="ime-mode:disabled" class="inputbox_single" value="<?=$phone?>"><br>&nbsp;여러명일 경우 콤마(,)를 기준으로 입력하세요.</td>
</tr>
<tr>
	<td bgcolor=#eeeee0>발신번호</td>
	<td><input name=callback size=20 maxLength=13 value="<?=$sms_send_call?>" class="inputbox_single"></td>
</tr>
<tr>
	<td bgcolor=#eeeee0>내용</td>
	<td>
		<textarea name=body style=background-color:#eeffff; cols=30 rows=10 onKeyup='ch_byte();'></textarea>&nbsp;<span id="byte">0</span> Byte<br>80Byte가 넘을 경우 LMS문자로 발송됩니다.(장문메시지)
	</td>
</tr>

<tr>
<td bgcolor=#eeeee0>예약</td>
<td>
	<?
	if(!$tmp_date){
		$tmp_date = time();
	}
	// 년
	$tmp_yy = date("Y", $tmp_date);
	$yy = date("Y", time());
	echo("<select name=yy style=background-color:#aaaaaa; disabled>");
	for($i=$yy; $i<($yy+2); $i++){
		if($i==$tmp_yy){	$tmp_sel = "selected";	}
		else{			$tmp_sel = "";		}
		echo("<option value='$i' $tmp_sel>" . $i . "년</option>");
	}
	echo("</select>");

	// 월
	$tmp_mm = date("n", $tmp_date);
	echo("<select name=mm style=background-color:#aaaaaa; disabled>");
	for($i=1; $i<=12; $i++){
		if($i==$tmp_mm){	$tmp_sel = "selected";	}
		else{			$tmp_sel = "";		}
		if($i < 10){	$str_i="0".$i;	}
		else{		$str_i=$i;	}
		echo("<option value='$str_i' $tmp_sel>" . $str_i . "월</option>");
	}
	echo("</select>");

	// 일
	$tmp_dd = date("j", $tmp_date);
	echo("<select name=dd style=background-color:#aaaaaa; disabled>");
	for($i=1; $i<=31; $i++){
		if($i==$tmp_dd){	$tmp_sel = "selected";	}
		else{			$tmp_sel = "";		}
		if($i < 10){	$str_i="0".$i;	}
		else{		$str_i=$i;	}
		echo("<option value='$str_i' $tmp_sel>" . $str_i . "일</option>");
	}
	echo("</select>");

	// 시
	$tmp_hh = date("H", $tmp_date);
	echo("<select name=hh style=background-color:#aaaaaa; disabled>");
	for($i=0; $i<=23; $i++){
		if($i==$tmp_hh){	$tmp_sel = "selected";	}
		else{				$tmp_sel = "";		}
		if($i < 10){	$str_i="0".$i;	}
		else{			$str_i=$i;	}
		echo("<option value='$str_i' $tmp_sel>" . $str_i . "시</option>");
	}
	echo("</select>");

	// 분
	$tmp_ss = date("i", $tmp_date);
	echo("<select name=ss style=background-color:#aaaaaa; disabled>");
	for($i=0; $i<=59; $i++){
		if($i==$tmp_ss){	$tmp_sel = "selected";	}
		else{				$tmp_sel = "";		}
		if($i < 10){	$str_i="0".$i;	}
		else{			$str_i=$i;	}
		echo("<option value='$str_i' $tmp_sel>" . $str_i . "분</option>");
	}
	echo("</select>");


	?>
	<input type=checkbox name=reserve value=1 onClick='check_date(this)'>예약발송시 체크
</td>
</tr>

<tr>
<td align=center colspan=2>
	<input type=button value='보내기' onClick="send_check();">
	<input type=reset value='새로입력'>
</td>
</tr>
</form>
</table>
<iframe name="tempFrame" width="0" height="0" style="display:none;"></iframe>