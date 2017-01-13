<?
if(!defined("__GAUTECH__"))		exit;

if($USESSION[0]){
	// 회원기본정보
	$result = mysql_query("Select * From $t_member Where id='$USESSION[0]'");
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

	$mode = "edit";

}else{
	$mailling = "ok";
	$rec_id = $_SESSION["REC_ID"];
}
?>
<script language=javascript src='/s_inc/js_string.js'></script>
<script language="javascript">
<!--
function check_insert(){
	var form = document.form0;
	<?	if($mode == "insert"){	?>
	if(CheckStr(form.name.value," ","")==0){				return err_proc(form.name, "이름을 입력하세요.");		}
	if(CheckStr(form.id.value," ","")==0){					return err_proc(form.id, "아이디를 입력하세요.");		}
	if(CheckStr(form.nickname.value," ","")==0){			return err_proc(form.nickname, "닉네임을 입력하세요.");		}
	<?	}	?>
	if(!form.pwd.disabled){
		if(form.pwd.value.length < 4){					return err_proc(form.pwd, "비밀번호를 4 ~ 16자로 입력하세요!");	}
		if(form.pwd.value != form.re_pwd.value){	return err_proc(form.pwd, "비밀번호가 일치하지 않습니다!");	}
	}
	if(CheckStr(form.email.value," ","")==0){		return err_proc(form.email, "이메일을 입력하세요.");		}
	if(CheckStr(form.mobile2.value," ","")==0||CheckStr(form.mobile3.value," ","")==0){
		return err_proc(form.mobile2, "휴대폰번호를 입력하세요.");
	}
	form.submit();
}
<?	if($mode == "insert"){	?>
function searchID(){
	var form = document.form0;

	if(CheckStr(form.id.value," ","")==0){
		alert("희망하는 아이디를 입력하세요.");
		form.id.value='';
		form.id.focus();
		return;
	}else if(form.id.value.length<4){
		alert('아이디는 최소 4자이상이어야합니다.');
		form.id.focus();
		return;
	}

	Ajax_Request("/s_source/member/_idcheck.php?id="+form.id.value,"id_result");
}

function searchNICK(){
	var form = document.form0;

	if(CheckStr(form.nickname.value," ","")==0){
		alert("희망하는 아이디를 입력하세요.");
		form.nickname.value='';
		form.nickname.focus();
		return;
	}else if(form.nickname.value.length<4){
		alert('닉네임은 한글 또는 영문으로 4~14자이어야합니다.');
		form.nickname.focus();
		return;
	}

	Ajax_Request("/s_source/member/_nickcheck.php?nickname="+form.nickname.value,"nick_result");
}
<?}?>


<?	if($mode == "edit"){	?>
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
<?}?>
-->
</script>
<form name="form0" method=post action="<?=$_SERVER["PHP_SELF"]?>" target="tempFrame2">
<input type=hidden name=mode value="<?=$mode?>_ok">
<div class="s_view_desc">
	<div class="s_view_info_wrap">
		<div class="s_view_info_label_wrap">
			<div class="s_view_info_label">상세정보 입력
				<span class="label_span"><b>*</b> 표시는 필수입력 항목입니다.</span>
			</div>
			<span class="s_view_info_label_line"></span>
		</div>
		<div class="s_view_info_box">
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">이름<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<?if($mode=="insert"){?>
					<input name="name" maxLength="10" value="<?=$name?>" class="sign_input_01"  style="ime-mode:active"  placeholder="이름을 입력하세요.">
					<?}else{      echo $name ;}?>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">아이디<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<?if($mode=="insert"){?>
					<input name="id" maxLength="14" placeholder="영문4~14자 입력" class="sign_input_01" style="ime-mode:disabled;" onfocus="input_limit_string(this,'/eng,/d');">
					<span class="span_desc">
						<a href="javascript:searchID();" class="sing_btn_01">중복 확인</a>
						<span id="id_result"></span>
					</span>
					<?}else{      echo $id ;}?>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">닉네임<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<?if($mode=="insert"){?>
					<input name="nickname" maxLength="14" placeholder="한글 또는 영문으로 4~14자 입력" class="sign_input_01" style="ime-mode:active;" onfocus="input_limit_string(this,'/eng,/kor,/d');">
					<span class="span_desc">
						<a href="javascript:searchNICK();" class="sing_btn_01">중복 확인</a>
						<span id="nick_result"></span>
					</span>
					<?}else{      echo $nickname ;}?>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">비밀번호<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<input type="password" name="pwd" maxlength="16" class="sign_input_01" <?=($mode=="edit")?"disabled style=\"background-color:#eee;\"":""?>/>
                    <span class="in_txt">비밀번호는 영문,숫자,특수기호 조합의 4자이상이어야합니다.</span>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">비밀번호 확인<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<input type="password" name="re_pwd" class="sign_input_01" maxlength="16" <?=($mode=="edit")?"disabled style=\"background-color:#eee;\"":""?> />
					<?  if($mode == "edit"){?>
					<span class="span_desc">
						<input name="checkbox" type="checkbox" onClick="check_edit_pwd(this);" id="check_edit_pw">
						<label for="check_edit_pw" class="add_find_btn"> 비밀번호 변경</label>
					</span>
					<?  }else{?>
					<span class="span_desc">
						<b class="alert_no">비밀번호를 한번 더 입력하세요.</b>
					</span>
					<?}?>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">전화번호<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<select name="tel1" class="sign_input_02">
						<option value="02" <?if($tel1=="02")        echo "selected";?>>02</option>
						<option value="031" <?if($tel1=="031")      echo "selected";?>>031</option>
						<option value="032" <?if($tel1=="032")      echo "selected";?>>032</option>
						<option value="033" <?if($tel1=="033")      echo "selected";?>>033</option>
						<option value="041" <?if($tel1=="041")      echo "selected";?>>041</option>
						<option value="042" <?if($tel1=="042")      echo "selected";?>>042</option>
						<option value="043" <?if($tel1=="043")      echo "selected";?>>043</option>
						<option value="051" <?if($tel1=="051")      echo "selected";?>>051</option>
						<option value="052" <?if($tel1=="052")      echo "selected";?>>052</option>
						<option value="053" <?if($tel1=="053")      echo "selected";?>>053</option>
						<option value="054" <?if($tel1=="054")      echo "selected";?>>054</option>
						<option value="055" <?if($tel1=="055")      echo "selected";?>>055</option>
						<option value="061" <?if($tel1=="061")      echo "selected";?>>061</option>
						<option value="062" <?if($tel1=="062")      echo "selected";?>>062</option>
						<option value="063" <?if($tel1=="063")      echo "selected";?>>063</option>
						<option value="064" <?if($tel1=="064")      echo "selected";?>>064</option>
						<option value="070" <?if($tel1=="070")      echo "selected";?>>070</option>
					</select>
					<span class="span_col"> - </span>
					<input type="text" class="sign_input_02" name="tel2" onKeyPress="onlyNumber()" maxlength="4"  title="전화번호 가운데 자리 입력" value="<?=$tel2?>" style="ime-mode:disabled;" />
					<span class="span_col"> - </span>
					<input type="text" class="sign_input_02" name="tel3" onKeyPress="onlyNumber()" maxlength="4"  title="전화번호 마지막 자리 입력" value="<?=$tel3?>" style="ime-mode:disabled;" />
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">휴대폰번호<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<select name="mobile1" class="sign_input_02">
						<option value="010" <?if($mobile1=="010")       echo "selected";?>>010</option>
						<option value="011" <?if($mobile1=="011")       echo "selected";?>>011</option>
						<option value="016" <?if($mobile1=="016")       echo "selected";?>>016</option>
						<option value="017" <?if($mobile1=="017")       echo "selected";?>>017</option>
						<option value="018" <?if($mobile1=="018")       echo "selected";?>>018</option>
						<option value="019" <?if($mobile1=="019")       echo "selected";?>>019</option>
					</select>
					<span class="span_col"> - </span>
					<input class="sign_input_02" type="text" name="mobile2" onKeyPress="onlyNumber()" maxlength="4" title="휴대폰번호 가운데 자리 입력" value="<?=$mobile2?>"  style="ime-mode:disabled;">
					<span class="span_col"> - </span>
					<input name="mobile3" class="sign_input_02" type="text" onKeyPress="onlyNumber()"  maxlength="4" title="휴대폰번호 마지막 자리 입력" value="<?=$mobile3?>"  style="ime-mode:disabled;">
					<span class="span_desc">
						<a href="#" class="sing_btn_01">인증하기</a>
					</span>
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">이메일<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<input type="text" name="email" class="sign_input_01" maxlength="100" value="<?=$email?>" onfocus="input_limit_string(this,'/eng,/symbol,/d');" style="ime-mode:disabled" placeholder="이메일을 입력하세요." />
				</div>
			</div>
			<div class="s_view_desc_txt2">
				<div class="s_view_desc_txt_num">주소<span>*</span></div>
				<div class="s_view_desc_txt_desc">
					<input type="text" id="post" name="post" class="sign_input_01" maxlength="6" readonly value="<?=$post?>" placeholder="주소검색" onclick="execDaumPostcode(1);">
					<span class="span_desc">
						<a href="javascript:execDaumPostcode(1)" class="sing_btn_01">우편번호 찾기</a>
					</span>
					<div id="Post_Layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
						<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
					</div>
					<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
					<script type="text/javascript" src="/s_inc/Daum_Post.js"></script>
				</div>
				<div class="s_view_desc_txt_desc">
					<span class="span_desc">
						<input type="text" id="addr1" maxLength="100" name="addr1" class="sign_input_03" value="<?=$addr1?>" placeholder="주소" onclick="execDaumPostcode(1);">
					</span>
					<span class="span_desc">
						<input type="text" id="addr2" maxLength="100" name="addr2" class="sign_input_03" value="<?=$addr2?>" placeholder="나머지주소">
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="view_fixed_all_wrap">
	<div class="view_fixed_wrap">
		<div class="view_fixed_box">
			<a href="javascript:history.back();" class="view_fixed_cancel_box">
				<span class="view_fixed_cancel_icon">
					<img src="/images/common/s_menu_close_btn.png">
				</span>
				<span class="view_fixed_cancel_txt">취소</span>
			</a>
		</div>
		<div class="view_fixed_box">
			<a href="javascript:check_insert();" class="view_fixed_book_box">
				<span class="view_fixed_book_icon">
					<img src="/images/common/view_fixed_sign_icon.png">
				</span>
				<span class="view_fixed_book_txt">다음</span>
			</a>
		</div>
	</div>
</div>
</form>
<iframe name="tempFrame2" width="0" height="0" style="display:none;"></iframe>