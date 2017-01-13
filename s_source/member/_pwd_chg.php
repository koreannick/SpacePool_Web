<?
if(!defined("__GAUTECH__"))		exit;
?>
<form name="form0" method="post" action="<?=$_SERVER["PHP_SELF"]?>" target="tempFrame" onsubmit="return ValidChk(this);">
	<input type="hidden" name="mode" value="pwd_chg_ok">
	<input type="hidden" name="return_url" value="<?=urlencode($return_url)?>">
	<div class="view_info_box_02">
		<div class="view_info_box_title">비밀번호변경</div>
		<div class="view_info_box_wrap2">
			<div class="view_info_box_100">
				<div class="pwd_chg_desc">
					고객님의 개인정보호와 안전한 서비스 사용을 위해 비밀번호를 변경해 주시기 바랍니다.<br>
					소중한 개인정보를 안전하게 지키기 위해 주기적(최소 6개월)으로 비밀번호를 변경하시기 바랍니다.
				</div>
			</div>
		</div>

	</div>
	<div class="view_info_box_02">
		<div class="view_info_box_wrap">
			<div class="view_info_box_50">
				<div class="view_info_box_30 b_left_none">새로운 비밀번호</div>
				<div class="view_info_box_70">
					<input name="pwd" type="password" class="inputbox_single" size="24" maxlength="16" tabindex="2" must="Y" mval="새로운 비밀번호는">
				</div>
			</div>
			<div class="view_info_box_50">
				비밀번호는 영문,숫자,특수기호 조합의 4자이상이어야합니다.
			</div>
		</div>
		<div class="view_info_box_wrap">
			<div class="view_info_box_50">
				<div class="view_info_box_30 b_left_none">비밀번호 확인</div>
				<div class="view_info_box_70">
					<input name="pwd_re" type="password" class="inputbox_single" size="24" maxlength="16" tabindex="2" must="Y" mval="비밀번호 확인은">
				</div>
			</div>
			<div class="view_info_box_50">
				재확인을 위하여 입력하신 비밀번호를 다시 한번 입력해주세요.
			</div>
		</div>
		<div class="view_info_box_wrap2">
			<div class="view_info_box_100">
				쉬운 비밀번호나 자주 쓰는 사이트의 비밀번호가 같을 경우, 도용되기 쉬우므로 주기적으로 변경하셔서 사용하는 것이 좋습니다.<br><br>
				<span>아이디와 주민등록번호, 생일, 전화번호 등 개인정보와 관련된 숫자, 연속된 숫자, 반복된 문자 등 다른 사람이 쉽게 알아 낼 수 있는 비밀번호는 개인정보 유출의 위헙이 높으므로 사용을 자제해 주시기 바랍니다.</span>
			</div>
		</div>
	</div>
	<table width="45%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td colspan="2" height="30"></td>
		</tr>
		<tr>
			<td><input type="image" src="/s_source/images/member/new_btn01.jpg"></td>
			<td><a href="/"><img src="/s_source/images/member/new_btn02.jpg"></a></td>
		</tr>
	</table>
</form>