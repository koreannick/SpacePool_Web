<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member sub_signup">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">회원가입</div>
						</div>
						<div class="mber_label_wrap">
							<div class="mber_label ">
								<div class="mber_label_in">
									<div>약관동의</div>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label active">
								<div class="mber_label_in">
									<div>회원정보입력</div>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label">
								<div class="mber_label_in">
									<div>가입완료</div>
								</div>
							</div>
						</div>
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
											<input type="text" name="" class="sign_input_01" value="" placeholder="이름을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">아이디<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="sign_input_01" value="" placeholder="한글2~7자, 영문4~14자 입력">
											<span class="span_desc">
												<a href="#" class="sing_btn_01">중복 확인</a>
												<b class="alert_ok">사용가능</b>
											</span>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">닉네임<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="sign_input_01" value="" placeholder="한글2~7자, 영문4~14자 입력">
											<span class="span_desc">
												<a href="#" class="sing_btn_01">중복 확인</a>
												<b class="alert_no">사용불가</b>
											</span>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">비밀번호<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="password" name="" class="sign_input_01" value="" placeholder="">
											<span class="span_desc">
												<b class="alert_no">비밀번호는 영문,숫자,특수기호 조합의 4자이상이어야합니다.</b>
											</span>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">비밀번호 확인<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="password" name="" class="sign_input_01" value="" placeholder="">
											<span class="span_desc">
												<b class="alert_no">비밀번호를 한번 더 입력하세요.</b>
											</span>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">전화번호<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<select class="sign_input_02">
												<option>02</option>
												<option>031</option>
												<option>051</option>
											</select>
											<span class="span_col"> - </span>
											<input type="text" name="" class="sign_input_02"  placeholder="">
											<span class="span_col"> - </span>
											<input type="text" name="" class="sign_input_02"  placeholder="">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">휴대폰번호<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<select class="sign_input_02">
												<option>010</option>
												<option>011</option>
												<option>016</option>
												<option>017</option>
												<option>018</option>
												<option>019</option>
											</select>
											<span class="span_col"> - </span>
											<input type="text" name="" class="sign_input_02"  placeholder="">
											<span class="span_col"> - </span>
											<input type="text" name="" class="sign_input_02"  placeholder="">
											<span class="span_desc">
												<a href="#" class="sing_btn_01">인증하기</a>
											</span>
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">이메일<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="sign_input_01" value="" placeholder="이메일을 입력하세요.">
										</div>
									</div>
									<div class="s_view_desc_txt2">
										<div class="s_view_desc_txt_num">주소<span>*</span></div>
										<div class="s_view_desc_txt_desc">
											<input type="text" name="" class="sign_input_01" value="" placeholder="주소검색">
											<span class="span_desc">
												<a href="#" class="sing_btn_01">우편번호 찾기</a>
											</span>
										</div>
										<div class="s_view_desc_txt_desc">
											<span class="span_desc">
												<input type="text" name="" class="sign_input_03" value="" placeholder="주소">
											</span>
											<span class="span_desc">
												<input type="text" name="" class="sign_input_03" value="" placeholder="나머지주소">
											</span>
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
								<a href="/member/signup3.php" class="view_fixed_book_box">
									<span class="view_fixed_book_icon">
										<img src="/images/common/view_fixed_sign_icon.png">
									</span>
									<span class="view_fixed_book_txt">다음</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>