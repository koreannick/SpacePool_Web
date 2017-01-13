<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}
?>
<form name="form0" method="post" action="<?=$_SERVER[PHP_SELF]?>" target="tempFrame" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>_ok">
<div class="s_view_wrap">
	<div class="m_top_nav_wrap">
		<a href="/partner/contact.php" class="active">제휴문의</a>
		<a href="/ad/apply.php" class="">광고 신청</a>
		<a href="/ad/ad_set.php" class="">광고 관리</a>
	</div>
	<div class="s_view_desc">
		<div class="s_view_info_wrap">
			<div class="s_view_info_label_wrap">
				<div class="s_view_info_label">제휴문의 입력
					<span class="label_span"><b>*</b> 표시는 필수입력 항목입니다.</span>
				</div>
				<span class="s_view_info_label_line"></span>
			</div>
			<div class="s_view_info_box">
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">이름<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<input type="text" name="name" maxlength="20" class="book_input_01" value="" placeholder="이름을 입력하세요."  must="Y" mval="이름은">
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">이메일<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<input type="text" name="email" class="book_input_01" value="" placeholder="이메일을 입력하세요." maxlength="50" style="ime-mode:disabled;" must="Y" mval="이메일은">
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">전화번호</div>
					<div class="s_view_desc_txt_desc">
						<select class="sign_input_02" name="tel1">
							<option value="02" <?if($tel1=="02")		echo "selected";?>>02</option>
							<option value="031" <?if($tel1=="031")		echo "selected";?>>031</option>
							<option value="032" <?if($tel1=="032")		echo "selected";?>>032</option>
							<option value="033" <?if($tel1=="033")		echo "selected";?>>033</option>
							<option value="041" <?if($tel1=="041")		echo "selected";?>>041</option>
							<option value="042" <?if($tel1=="042")		echo "selected";?>>042</option>
							<option value="043" <?if($tel1=="043")		echo "selected";?>>043</option>
							<option value="051" <?if($tel1=="051")		echo "selected";?>>051</option>
							<option value="052" <?if($tel1=="052")		echo "selected";?>>052</option>
							<option value="053" <?if($tel1=="053")		echo "selected";?>>053</option>
							<option value="054" <?if($tel1=="054")		echo "selected";?>>054</option>
							<option value="055" <?if($tel1=="055")		echo "selected";?>>055</option>
							<option value="061" <?if($tel1=="061")		echo "selected";?>>061</option>
							<option value="062" <?if($tel1=="062")		echo "selected";?>>062</option>
							<option value="063" <?if($tel1=="063")		echo "selected";?>>063</option>
							<option value="064" <?if($tel1=="064")		echo "selected";?>>064</option>
							<option value="070" <?if($tel1=="070")		echo "selected";?>>070</option>
						</select>
						<span class="span_col"> - </span>
						<input type="text" name="tel2" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;">
						<span class="span_col"> - </span>
						<input type="text" name="tel3" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;">
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">휴대폰번호<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<select class="sign_input_02" name="mobile1">
							<option value="010" <?if($mobile1=="010")		echo "selected";?>>010</option>
							<option value="011" <?if($mobile1=="011")		echo "selected";?>>011</option>
							<option value="016" <?if($mobile1=="016")		echo "selected";?>>016</option>
							<option value="017" <?if($mobile1=="017")		echo "selected";?>>017</option>
							<option value="018" <?if($mobile1=="018")		echo "selected";?>>018</option>
							<option value="019" <?if($mobile1=="019")		echo "selected";?>>019</option>
						</select>
						<span class="span_col"> - </span>
						<input type="text" name="mobile2" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는">
						<span class="span_col"> - </span>
						<input type="text" name="mobile3" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는">
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">제안타입<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<select class="sign_input_05" name="gubun">
							<option value="비즈니스 제안">비즈니스 제안</option>
							<option value="서비스 제안">서비스 제안</option>
							<option value="기타">기타</option>
						</select>
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">제목<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<input type="text" name="subject" class="book_input_01" value="" placeholder="제목을 입력하세요." style="ime-mode:active;" must="Y" mval="제목은">
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">설명<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<textarea class="book_area_01" placeholder="설명을 입력해 주세요." must="Y" mval="설명은" name="comment"></textarea>
					</div>
				</div>
				<div class="s_view_desc_txt2">
					<div class="s_view_desc_txt_num">개인정보활용<br>동의<span>*</span></div>
					<div class="s_view_desc_txt_desc">
						<textarea class="book_area_01" readonly="readonly"><?include $_SERVER["DOCUMENT_ROOT"]."/s_source/online/_txt.php";?></textarea>
						<div class="on_txt_01">
							<input type="checkbox" name="agree" id="privacy_agree">
							<label for="privacy_agree">
								위의 개인정보처리방침을 읽었으며 이에 동의합니다.
							</label>
						</div>
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
			<a href="javascript:GO_chk2(document.form0);" class="view_fixed_book_box">
				<span class="view_fixed_book_icon">
					<img src="/images/common/view_fixed_sign_icon.png">
				</span>
				<span class="view_fixed_book_txt">제휴신청</span>
			</a>
		</div>
	</div>
</div>
</form>