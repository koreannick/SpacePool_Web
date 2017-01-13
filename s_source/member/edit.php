<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($uid){
	// 회원기본정보
	$result = mysql_query("Select * From $t_member Where uid='$uid'");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$$key = stripslashes(trim($val));
		}
		if($tel){
			$tel_arr = explode("-",$tel);
			$tel1 = $tel_arr[0];
			$tel2 = $tel_arr[1];
			$tel3 = $tel_arr[2];
		}
		if($mobile){
			$mobile_arr = explode("-",$mobile);
			$mobile1 = $mobile_arr[0];
			$mobile2 = $mobile_arr[1];
			$mobile3 = $mobile_arr[2];
		}
		if($creg){
			$creg_arr = explode("-",$creg);
			$creg1 = $creg_arr[0];
			$creg2 = $creg_arr[1];
			$creg3 = $creg_arr[2];
		}
	}
	@mysql_free_result($result);
}else{
	$m_kind = "admin";
	$status = "ok";
}

?>
<script language="javascript">
<!--
function check_insert(){
	var form = document.form0;
	if(form.id.value == ""){				return err_proc(form.id, "아이디를 입력하세요.");		}
	if(!form.pwd.disabled){
		if(form.pwd.value.length < 4){				return err_proc(form.pwd, "비밀번호를 4 ~ 16자로 입력하세요!");	}
		if(form.pwd.value != form.re_pwd.value){		return err_proc(form.pwd, "비밀번호가 일치하지 않습니다!");	}
	}
	if(form.name.value == ""){				return err_proc(form.name, "이름을 입력하세요.");		}
	<?if($mode!="edit"){?>
	if(form.email.value == ""){				return err_proc(form.email, "이메일을 입력하세요.");		}
	<?}?>
}

// 비번수정
function check_edit_pwd(obj){
	var form = document.form0;
	if(obj.checked){
		form.pwd.disabled = false;
		form.re_pwd.disabled = false;
		form.pwd.style.backgroundColor="";
		form.re_pwd.style.backgroundColor="";
	}else{
		form.pwd.disabled = true;
		form.re_pwd.disabled = true;
		form.pwd.style.backgroundColor="#dddddd";
		form.re_pwd.style.backgroundColor="#dddddd";
	}
}

// 리스트
function go_list(){
	var form = document.form0;
	form.mode.value='list';
	form.submit();
}
-->
</script>
<form name=form0 method=post enctype=multipart/form-data action='<?=$_SERVER["PHP_SELF"]?>' onSubmit="return check_insert();">
<input type=hidden name=mode value='<?=$mode?>_ok'>
<input type=hidden name="uid" value="<?=$uid?>">
<input type=hidden name="page" value='<?=$page?>'>

<table width=800 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7"><table width="100%" cellpadding="0" cellspacing="1" border="0">
		<tr height="30">
			<th bgcolor="#F6F6F6" width=150>회원등급<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?
				// 상태 ////////////////////////////////////////////
				foreach ($m_level_arr as $key => $val) {
					if($key==$m_kind)	$checked = "checked";
					else						$checked = "";
					echo("<input type=radio name=m_kind value='$key' $checked>${val}\n");

				}
			?></td>
		</tr>
		<?if($mode=="edit"){?>
		<tr height="30">
			<th bgcolor="#F6F6F6">ID</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$id?>
				<?
					echo("&nbsp;&nbsp;&nbsp;&nbsp;");
					echo("(");
					// 상태 ////////////////////////////////////////////
					$arr_val=array("wait|대기","ok|허가");
					for($i=0; $i<sizeof($arr_val); $i++){
						$val = explode("|", $arr_val[$i]);
						if($val[0]==$status){	$checked="checked";	}
						else{			$checked="";		}
						echo("<input type=radio name=status value='$val[0]' $checked>${val[1]}\n");
					}
					echo(")");
				?>
			</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">비밀번호<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type=password name=pwd size=10 maxLength=20 <?=($mode=="edit")?"disabled style=background-color:dddddd;":""?> class="inputbox_single">
				&nbsp;&nbsp;&nbsp;
				확인<font color=red>*</font>
				<input type=password name=re_pwd size=10 maxLength=20 <?=($mode=="edit")?"disabled style=background-color:dddddd;":""?> class="inputbox_single">
				<?if($mode=="edit"){?><input type=checkbox onClick="check_edit_pwd(this);">
				<font color=blue>비밀번호 변경</font><?}?>&nbsp;&nbsp;<font color="red">※ 관리자 등급만 해당됩니다.</font></td>
		</tr>

		<tr height="30">
			<th bgcolor="#F6F6F6">이름</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$name?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">닉네임</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$nickname?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이메일</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><?=$email?></td>
		</tr>
		<?}else{?>
		<tr height="30">
			<th bgcolor="#F6F6F6">ID(상태)<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="id" size=20 maxLength=20 value="<?=$id?>" class="inputbox_single">
			<?
				echo("&nbsp;&nbsp;&nbsp;&nbsp;");
				echo("(");
				// 상태 ////////////////////////////////////////////
				$arr_val=array("wait|대기","ok|허가");
				for($i=0; $i<sizeof($arr_val); $i++){
					$val = explode("|", $arr_val[$i]);
					if($val[0]==$status){	$checked="checked";	}
					else{			$checked="";		}
					echo("<input type=radio name=status value='$val[0]' $checked>${val[1]}\n");
				}
				echo(")");
			?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">비밀번호<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type=password name=pwd size=10 maxLength=20 <?=($mode=="edit")?"disabled style=background-color:dddddd;":""?> class="inputbox_single">
				&nbsp;&nbsp;&nbsp;
				확인<font color=red>*</font>
				<input type=password name=re_pwd size=10 maxLength=20 <?=($mode=="edit")?"disabled style=background-color:dddddd;":""?> class="inputbox_single">
				<?if($mode=="edit"){?><input type=checkbox onClick="check_edit_pwd(this);">
				<font color=blue>비밀번호 변경</font><?}?></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이름<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="name" size=20 maxLength=10 value="<?=$name?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">닉네임<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="nickname" size=20 maxLength=30 value="<?=$nickname?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">이메일<font color=red>*</font></th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type=text name=email size=50 maxLength=100 value="<?=$email?>" class="inputbox_single"></td>
		</tr>
		<?}?>
		<tr height="30">
			<th bgcolor="#F6F6F6">주소</th>
			<td bgcolor="#FFFFFF" style="padding:5px 0px 5px 0px;">&nbsp;<input name="post" id="post" readonly type="text" class="inputbox_single" value="<?=$post?>" size="7" class="inputbox_single">&nbsp;<img src=/s_source/images/member/zipsearch_icon.gif style=cursor:hand; align=absmiddle onClick="execDaumPostcode(1);">
			<div id="Post_Layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
			<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
			</div>
			<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<script type="text/javascript" src="/s_inc/Daum_Post.js"></script>
			<br />&nbsp;<input type="text" id="addr1" name="addr1" size=50 maxLength=100 value="<?=$addr1?>"  readonly onClick="execDaumPostcode(1);" class="inputbox_single">&nbsp;<input type="text" id="addr2" name="addr2" size="40" maxLength=100 value="<?=$addr2?>" class="inputbox_single"> (상세)</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">전화번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="tel1" size="4" maxLength="4" value="<?=$tel1?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="tel2" size="4" maxLength="4" value="<?=$tel2?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="tel3" size="4" maxLength="4" value="<?=$tel3?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">휴대폰</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="mobile1" size="4" maxLength="4" value="<?=$mobile1?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="mobile2" size="4" maxLength="4" value="<?=$mobile2?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="mobile3" size="4" maxLength="4" value="<?=$mobile3?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"></td>
		</tr>


		<tr height="30">
			<th bgcolor="#F6F6F6">업체명</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="company" size=20 maxLength=20 value="<?=$company?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">업종</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="cetc" size=20 maxLength=20 value="<?=$cetc?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">직원 수</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="cperson" size=5 maxLength=5 value="<?=$cperson?>" class="inputbox_single"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업기간</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="cdate1" size="3" maxLength="2" value="<?=$cdate1?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled">년 <input name="cdate2" size="3" maxLength="2" value="<?=$cdate2?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled">개월</td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업내용</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><textarea name="comment" rows="10" cols="80" class="inputbox_multi"><?=$comment?></textarea></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">사업자등록번호</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input name="creg1" size="5" maxLength="3" value="<?=$creg1?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="creg2" size="5" maxLength="2" value="<?=$creg2?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"> - <input name="creg3" size="5" maxLength="5" value="<?=$creg3?>" class="inputbox_single" onkeypress="onlyNumber();" style="ime-mode:disabled"></td>
		</tr>
		<tr height="30">
			<th bgcolor="#F6F6F6">네이버톡톡</th>
			<td bgcolor="#FFFFFF" style="padding:5px;"><input type="text" name="n_talk" size="40" maxLength="50" value="<?=$n_talk?>" class="inputbox_single"></td>
		</tr>


		</table></td>
	</tr>
	<tr>
		<td height="30" align=center style="padding:10px;">
			<input type=submit value=' 저 장 ' style="width:100px;">
			<input type=button value=' 목 록 ' style="width:100px;" onClick="go_list();">
			<input type=button value=' 취 소 ' style="width:100px;" onClick="history.back();">
		</td>
	</tr>
</table>
</form>
