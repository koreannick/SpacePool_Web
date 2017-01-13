<?
if(!defined("__GAUTECH__"))		exit;
?>
<script language=javascript>
<!--
// 아이디 찾기
function check_id_find(){
	var form = document.form0;
	if(CheckStr(form.name.value," ","")==0){
		alert("이름을 입력하세요.");
		return;
	}else if(CheckStr(form.email.value," ","")==0){
		alert("이메일주소를 입력하세요.");
		return;
	}else{
		window.open('','kk','width=500,height=200');
		form.target="kk";
		form.submit();
	}
}
// 비밀번호 찾기
function check_pass_find(){
	var form = document.form1;
	if(CheckStr(form.id.value," ","")==0){
		alert("아이디를 입력하세요.");
		return;
	}else if(CheckStr(form.name.value," ","")==0){
		alert("이름을 입력하세요.");
		return;
	}else if(CheckStr(form.email.value," ","")==0){
		alert("이메일주소를 입력하세요.");
		return;
	}else{
		window.open('','kk','width=500,height=200');
		form.target="kk";
		form.submit();
	}
}
-->
</script>
<div class="s_view_desc">
	<div class="s_view_info_wrap">
		<div class="s_view_info_box">
			<div class="login_form_wrap">
				<div class="s_login_form">
					<form name="form0" method="post" action="<?=$_SERVER[PHP_SELF]?>" onsubmit="return check_id_find();">
					<input type="hidden" name="mode" value="idpassfind_result">
					<input type="hidden" name="kind" value="id">
					<div class="s_login_form_top">
						<div class="left_txt_01">
							아이디 찾기
						</div>
					</div>
					<div class="s_login_form_label">
						이름
					</div>
					<div class="s_login_form_input">
						<input type="text" placeholder="이름 입력하세요" name="name" maxlength="20" must="Y" mval="이름은" required style="ime-mode:active;">
					</div>
					<div class="s_login_form_label">
						이메일
					</div>
					<div class="s_login_form_input">
						<input type="text" placeholder="이메일 입력하세요" name="email" maxlength="80" must="Y" mval="이메일은" required style="ime-mode:disabled;">
					</div>
					<div class="s_login_btn_wrap">
						<a href="javascript:check_id_find();" class="s_login_btn">찾기</a>
					</div>
					</form>

					<form name="form1" method="post" action="<?=$_SERVER[PHP_SELF]?>">
					<input type="hidden" name="mode" value="idpassfind_result">
					<input type="hidden" name="kind" value="pass">
					<div class="s_login_form_top">
						<div class="left_txt_01">
							비밀번호 찾기
						</div>
					</div>
					<div class="s_login_form_label">
						아이디
					</div>
					<div class="s_login_form_input">
						<input type="text" placeholder="아이디를 입력하세요" name="id" maxlength="20" must="Y" mval="아이디는" required>
					</div>
					<div class="s_login_form_label">
						이름
					</div>
					<div class="s_login_form_input">
						<input type="text" placeholder="이름을 입력하세요" name="name" maxlength="20" must="Y" mval="이름은" required style="ime-mode:active;">
					</div>
					<div class="s_login_form_label">
						이메일
					</div>
					<div class="s_login_form_input">
						<input type="text" placeholder="이메일 입력하세요" name="email" maxlength="80" must="Y" mval="이메일은" required style="ime-mode:disabled;">
					</div>
					<div class="s_login_btn_wrap">
						<a href="javascript:check_pass_find();" class="s_login_btn">찾기</a>
					</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>