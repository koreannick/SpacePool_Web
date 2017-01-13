<?
header("location:member.php?mode=login");
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member sub_login">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">

						</div>
						<div class="mber_label_wrap">
							<div class="mber_label ">
								<div class="mber_label_in">
									<a href="/member/signup.php">회원가입</a>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label active">
								<div class="mber_label_in">
									<a href="/member/login.php">로그인</a>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label ">
								<div class="mber_label_in">
									<a href="/member/idpwfind.php">아이디/비밀번호 찾기</a>
								</div>
							</div>
						</div>
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
												<input type="text" name="" placeholder="아이디를 입력하세요">
											</div>
											<div class="s_login_form_label">
												비밀번호
											</div>
											<div class="s_login_form_input">
												<input type="password" name="" placeholder="비밀번호를 입력하세요">
											</div>
											<div class="s_login_btn_wrap">
												<a href="#" class="s_login_btn">로그인</a>
											</div>
											<div class="s_login_etc">
												<a href="#">아이디/비밀번호찾기</a>
												<a href="#">회원가입</a>
											</div>
										</div>
									</div>
								</div>
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