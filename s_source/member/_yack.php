<script type="text/javascript">
function chk(t){
	var frm = document.frm;
	var result1 = false;
	var result2 = false;
	var result3 = false;
	var result4 = false;

	if(frm.agree1.checked==true){
		result1 = true;
	}else{
		alert('공간약정서에 대한 동의에 체크하셔야합니다.');
		return;
	}

	if(frm.agree2.checked==true){
		result2 = true;
	}else{
		alert('개인정보이용처리방침 동의에 체크하셔야합니다.');
		return;
	}

	if(frm.agree3.checked==true){
		result3 = true;
	}else{
		alert('보안정책 동의에 체크하셔야합니다.');
		return;
	}

	if(frm.agree4.checked==true){
		result4 = true;
	}else{
		alert('이용약관에 대한 동의에 체크하셔야합니다.');
		return;
	}

	if(result1&&result2&&result3&&result4){
		frm.submit();
	}
}
</script>
<form name="frm" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" value="yack_ok">
<div class="s_view_desc">
	<div class="s_view_info_wrap">
		<div class="s_view_info_label_wrap">
			<div class="s_view_info_label">서비스 동의
			<div class="right_op_box_wrap">
				<div class="right_op_box">
					<input type="checkbox" name="all_agree" id="all_agree_chk">
					<label for="all_agree_chk">전체 동의</label>
				</div>
			</div>
			</div>
			<span class="s_view_info_label_line"></span>
		</div>
		<div class="s_view_info_box">
			<div class="agree_all_box_wrap">
				<div class="agree_box_wrap selected">
					<div class="agree_box">
						<div class="agree_label">
							<div class="agree_label_in">
								<input type="checkbox" name="agree1" id="agree_01" value="Y">
								<label for="agree_01">
									 공간약정서에 대한 동의 <span>(필수)</span>
								</label>
							</div>

						</div>
						<a href="javascript:void(0)">
							<span class="a_btn">열기/닫기</span>
						</a>
					</div>
					<div class="agree_desc_wrap">
						<div class="agree_desc">
							<textarea><?include $_SERVER["DOCUMENT_ROOT"]."/s_source/member/_yack_txt1.txt" ?></textarea>
						</div>
					</div>
				</div>
				<div class="agree_box_wrap selected">
					<div class="agree_box">
						<div class="agree_label">
							<div class="agree_label_in">
								<input type="checkbox" name="agree2" id="agree_02" value="Y">
								<label for="agree_02">
									 개인정보이용처리방침 동의 <span>(필수)</span>
								</label>
							</div>

						</div>
						<a href="javascript:void(0)">
							<span class="a_btn">열기/닫기</span>
						</a>
					</div>
					<div class="agree_desc_wrap">
						<div class="agree_desc">
							<textarea><?include $_SERVER["DOCUMENT_ROOT"]."/s_source/member/_yack_txt2.txt" ?></textarea>
						</div>
					</div>
				</div>
				<div class="agree_box_wrap selected">
					<div class="agree_box">
						<div class="agree_label">
							<div class="agree_label_in">
								<input type="checkbox" name="agree3" id="agree_03" value="Y">
								<label for="agree_03">
									 보안정책 동의 <span>(필수)</span>
								</label>
							</div>

						</div>
						<a href="javascript:void(0)">
							<span class="a_btn">열기/닫기</span>
						</a>
					</div>
					<div class="agree_desc_wrap">
						<div class="agree_desc">
							<textarea><?include $_SERVER["DOCUMENT_ROOT"]."/s_source/member/_yack_txt3.txt" ?></textarea>
						</div>
					</div>
				</div>
				<div class="agree_box_wrap selected">
					<div class="agree_box">
						<div class="agree_label">
							<div class="agree_label_in">
								<input type="checkbox" name="agree4" id="agree_04" value="Y">
								<label for="agree_04">
									 이용약관에 대한 동의 <span>(필수)</span>
								</label>
							</div>

						</div>
						<a href="javascript:void(0)">
							<span class="a_btn">열기/닫기</span>
						</a>
					</div>
					<div class="agree_desc_wrap">
						<div class="agree_desc">
							<textarea><?include $_SERVER["DOCUMENT_ROOT"]."/s_source/member/_yack_txt4.txt" ?></textarea>
						</div>
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
			<a href="javascript:chk();" class="view_fixed_book_box">
				<span class="view_fixed_book_icon">
					<img src="/images/common/view_fixed_sign_icon.png">
				</span>
				<span class="view_fixed_book_txt">다음</span>
			</a>
		</div>
	</div>
</div>
</form>