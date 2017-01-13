<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

?>
<script language=javascript>
<?if($comment_write&&auth_lev()==0){?>
var prev_id = "";
function comment_del_check(uid){
	if(prev_id&&document.getElementById('pwd_layer_'+prev_id))		document.getElementById('pwd_layer_'+prev_id).style.display = "none";

	document.getElementById('pwd_layer_'+uid).style.display = "block";

	prev_id = uid;
}
<?}elseif($comment_write&&auth_lev()>0){?>
function comment_del_check(uid){
	if(confirm("삭제 하시겠습니까?")){
		document.cFrm2.uid.value = uid;
		document.cFrm2.submit();
	}
}
<?}?>

$(document).ready(function() {
	Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&puid=<?=$puid?>","result_frame","Get");
});
</script>


<div class="cm_wrap">
	<div class="cm_all_info">
		전체 댓글<span id="comment_cnt"></span>개
	</div>
	<div class="cm_list" id="result_frame">



	</div>
	<?if($comment_write){?>
	<div>
		<form name="cFrm1" method="POST" action="<?=$PHP_SELF?>" target="tempFrame" onSubmit="return ValidChk(this);">
		<input type="hidden" name="mode" value="comment_ok">
		<input type="hidden" name="tbl" value="<?=$tbl?>">
		<input type="hidden" name="puid" value="<?=$puid?>">
		<div class="cm_write_wrap">
			<div class="cm_write_info_wrap">
				<div class="cm_write_info">
					<label>이름</label>
					<input type="text" class="cm_write_input_01" name="name" maxLength="15" value="<?=$USESSION[1]?>" style="ime-mode:active;" must="Y" mval="이름은">
				</div>
				<?if(auth_lev()==0){?>
				<div class="cm_write_info">
					<label>비밀번호</label>
					<input type="password" class="cm_write_input_01" name="pwd" maxLength="15" must="Y" mval="비밀번호는" AUTOCOMPLETE="OFF">
				</div>
				<?}?>
			</div>
			<div class="cm_write_body_wrap">
				<div class="cm_write_body">
					<textarea class="cm_write_input_area" name="comment" must="Y" mval="내용은" placeholder="내용을 입력하세요."></textarea>
				</div>
				<div class="cm_write_btn">
					<input type="submit" value="등록" class="cm_write_input_btn">
				</div>
			</div>
		</div>
		</form>
	</div>
	<?}?>
</div>
<?if($comment_write&&auth_lev()>0){?>
<form name="cFrm2" method="POST" action="<?=$PHP_SELF?>" target="tempFrame">
<input type="hidden" name="mode" value="comment_del_ok">
<input type="hidden" name="tbl" value="<?=$tbl?>">
<input type="hidden" name="puid" value="<?=$puid?>">
<input type="hidden" name="uid">
<input type="hidden" name="pwd">
</form>
<?}?>
