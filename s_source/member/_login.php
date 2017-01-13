<?
if(!defined("__GAUTECH__"))		exit;
?>
<form name=form0 method=post action="<?=$_SERVER[PHP_SELF]?>" target="tempFrame2">
<input type=hidden name="mode" value="login_ok">
<input type=hidden name="return_url" value="<?=$return_url?>">
<div class="s_view_desc">
	<div class="s_view_info_wrap">
		<div class="s_view_info_box">
			<div class="login_form_wrap">
				<div class="s_login_form">
					<div class="s_login_form_top">
						<a href="/" class="s_logo">
							<img src="/images/common/logo.png" alt="스페이스풀 로고" title="스페이스풀 로고">
						</a>
						로그인이 필요합니다.
					</div>
					<div class="s_login_form_label">
						아이디
					</div>
					<div class="s_login_form_input">
						<input type="text" name="id" placeholder="아이디를 입력하세요" maxlength="12" must="Y" mval="아이디는" required>
					</div>
					<div class="s_login_form_label">
						비밀번호
					</div>
					<div class="s_login_form_input">
						<input type="password" name="pwd" placeholder="비밀번호를 입력하세요" name="pwd" must="Y" mval="비밀번호는" required>
					</div>
					<div class="s_login_btn_wrap">
						<a href="javascript:ValidChk3(document.form0);" class="s_login_btn">로그인</a>
					</div>
					<div class="s_login_etc">
						<a href="<?=$CONF_MEMBER_FILE?>?mode=idpassfind">아이디/비밀번호찾기</a>
						<a href="<?=$CONF_MEMBER_FILE?>">회원가입</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<iframe name="tempFrame2" width="0" height="0" style="display:none;"></iframe>