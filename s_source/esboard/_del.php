<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="/s_source/esboard/board.css">
<script language="javascript">
<!--
// 삭제 체크
function del_form_check(){
	var frm = document.del_form;

	if(frm.pwd.value == "") {
		alert("비밀번호를 입력해 주세요");
		frm.pwd.focus();
		return false;
	}
}
-->
</script>
<form name="del_form" method="post" action="<?=$_SERVER["PHP_SELF"]?>" onSubmit="return del_form_check()" target="tempFrame">
<input type="hidden" name="mode" value="del_ok">
<input type="hidden" name="uid" value="<?=$uid?>">
<input type="hidden" name="page" value="<?=$page?>">
<?if($kind_chk){?><input type="hidden" name="skind" value="<?=$skind?>"><?}?>
<input type="hidden" name="skey" value="<?=$skey?>">
<input type="hidden" name="search" value="<?=$search?>">

<div id="board-thumbnail-editor">
		<div class="board-header"></div>

		<div class="board-attr-row board-attr-title">
			<label class="attr-name">비밀번호</label>
			<div class="attr-value"><input name="pwd" type="password" maxlength="20"></div>
		</div>

		<div class="board-control">
			<div class="left">
								<a class="board-thumbnail-button-small" href="<?=$PHP_SELF?>?mode=view&uid=<?=$uid?>&page=<?=$page?>&skind=<?=$skind?>">본문보기</a>
								<a class="board-thumbnail-button-small" href="<?=$PHP_SELF?>?mode=list&page=<?=$page?>&skind=<?=$skind?>">목록보기</a>
			</div>
			<div class="right">
				<button class="board-thumbnail-button-small" type="submit">비밀번호 확인</button>
			</div>
		</div>
</div>
</form>