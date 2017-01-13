<!doctype html>
<html>
<head>
	<meta charset="utf-8">
<link rel="canonical" href="http://www.spacepool.co.kr">
<meta name="Keywords" content="스페이스풀, 공유, 사무실, 창업, 프리랜서, 쉐어링, 공유경제, 공간, 오피스, 오피스공유플랫폼, 사무실 공유 커뮤니티, 공동 사무실, 비즈니스센터,사무실공유, 오피스쉐어, 쉐어오피스">
<meta name="robots" content="나에게 꼭 맞는 사무실을 찾아주는 오피스공유플랫폼 , 사무실 공유, 커뮤니티, 공동 사무실, 비즈니스센터, 사무실공유, 공유, 사무실, 창업, 프리랜서, 쉐어링, 공유경제">
<meta name="description" content="나에게 꼭 맞는 사무실을 찾아주는 오피스공유플랫폼 , 사무실 공유, 커뮤니티, 공동 사무실, 비즈니스센터, 사무실공유, 공유, 사무실, 창업, 프리랜서, 쉐어링, 공유경제">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- <meta name="viewport" content="width=1140px">  -->

<meta name="apple-mobile-web-app-title" content="SpacePool" />
<meta property="og:title" content="스페이스풀">
<meta property="og:url" content="http://spacepool.co.kr/">
<meta property="og:image" content="http://spacepool.co.kr/images/sub/about_box_04_right.jpg">
<meta property="og:description" content="나에게 꼭 맞는 사무실을 찾아주는 오피스공유플랫폼 , 사무실 공유, 커뮤니티, 공동 사무실, 비즈니스센터, 사무실공유, 공유, 사무실, 창업, 프리랜서, 쉐어링, 공유경제">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="스페이스풀">
<meta name="twitter:url" content="http://spacepool.co.kr/">
<meta name="twitter:image" content="http://spacepool.co.kr/images/sub/about_box_04_right.jpg">
<meta name="twitter:description" content="나에게 꼭 맞는 사무실을 찾아주는 오피스공유플랫폼, 사무실 공유 커뮤니티, 공동 사무실, 비즈니스센터,사무실공유, 오피스쉐어, 쉐어오피스,스페이스풀, 공유, 사무실, 창업, 프리랜서, 쉐어링, 공유경제, 공간, 오피스, 오피스공유플랫폼, 사무실 공유 커뮤니티, 공동 사무실, 비즈니스센터,사무실공유, 오피스쉐어, 쉐어오피스">
<link rel="apple-touch-icon-precomposed" href="/images/icon.png" />
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="/images/icon.png" />
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<title>SpacePool 스페이스풀</title><!-- 홈페이지제목 -->
<link href="/css/import.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/js/jquery.ui.totop.js"></script>
<script src="/js/easing.js"></script>
<script src="/js/totop.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/owl.carousel.js"></script>
<script src="/js/modernizr.js"></script>
<script src="/js/jquery.gray.min.js"></script>
<script src="/js/particles.min.js"></script>
<script src="/js/jquery.placeholder.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />
<script src="/s_inc/total_script.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('input, textarea').placeholder();
});
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
function Auth_Send(){
	var frm = document.form0;

	if(CheckStr(frm.mobile2.value," ","")==0){
		alert("휴대폰번호를 입력하세요.");
		frm.mobile2.focus();
		return;
	}
	if(CheckStr(frm.mobile3.value," ","")==0){
		alert("휴대폰번호를 입력하세요.");
		frm.mobile3.focus();
		return;
	}

	frm.mode.value = "sms_send_ok";
	frm.submit();
}

function Save_go(){
	var frm = document.form0;
//	var cnt=frm.elements.length;
	
	/*
	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return;
		}
	}
	*/
	frm.mode.value = "edit_ok";
	frm.submit();
}
</script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_list">
		<div class="all_bg"></div>
<div class="header_all_wrap">
	<div class="header_wrap">
		<div class="header">
			<a href="/" class="logo">
				<img src="/images/common/logo2.png" alt="스페이스풀 로고" title="스페이스풀 로고" class="logo_on_01">
				<img src="/images/common/logo2.png" alt="스페이스풀 로고" title="스페이스풀 로고" class="logo_on_02">
				<img src="/images/common/logo3.png" alt="스페이스풀 로고" title="스페이스풀 로고" class="logo_on_03">
			</a>
			<div class="header_right">
				<a href="#" class="h_search_btn">검색</a>
				<a href="/member/space_apply.php" class="h_space_regi">공간등록하기</a>
								<a href="/member/member.php?mode=logout_ok" class="h_logout_btn">로그아웃</a>
								<!-- 					<a href="/member/member.php?mode=logout_ok" class="h_logout_btn">로그아웃</a>
				 -->
				<a href="#" class="h_all_menu_btn">
					<img src="/images/common/menu.png">
				</a>
			</div>
			<div class="search_top_wrap">
				<form name="tsFrm" method="post" action="/space/list.php">
				<div class="search_top_input">
					<input type="text" name="skeyword" placeholder="검색어를 입력해주세요" id="search_top_input" autofocus maxlength="20" must="Y" mval="검색키워드는" value="" style="text-align:center">
				</div>
				<div class="search_top_btn_wrap">
					<a href="javascript:ValidChk3(document.tsFrm);" class="search_top_btn">검색</a>
					<a href="#" class="search_top_close_btn">닫기</a>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="slider_menu_wrap">
					<!-- 로그인 이후 시작-->
		<div class="slider_menu after_login">
			<div class="s_info_wrap">
				<div class="s_info_img_wrap">
					<div class="s_info_img">
						<a href="/member/member_info.php">
							<img src="https://phinf.pstatic.net/contactthumb/profile/blog/37/16/miszzang76.jpg?type=s80">
						</a>
					</div>
					<!-- <a href="#" class="s_alarm">12</a> -->
				</div>
				<div class="s_info">
					<div class="s_info_user">바람처럼</div>
					<div class="s_info_class">GUEST</div>
											<a href="/member/host_signup.php" class="s_info_host_chg">HOST 등록하기</a>
									</div>
				<a href="/member/member.php?mode=logout_ok" class="s_logout_btn">로그아웃</a>
			</div>
			<div class="s_scroll_wrap">
				<div class="s_box_menu_wrap s_box_menu_st">
										<a href="/member/book_list.php?kind=1" class="s_box_menu">
						<span class="s_box_alarm">
							0						</span>
						<span class="s_box_txt">
							신청/결제
						</span>
											</a>
										<a href="/member/book_list.php?kind=2" class="s_box_menu">
						<span class="s_box_alarm">
							0						</span>
						<span class="s_box_txt">
							취소/환불
						</span>
											</a>
										<a href="/member/book_list.php?kind=3" class="s_box_menu">
						<span class="s_box_alarm">
							0						</span>
						<span class="s_box_txt">
							이용중
						</span>
					</a>
										<a href="/member/book_list.php?kind=4" class="s_box_menu">
						<span class="s_box_alarm">
							0						</span>
						<span class="s_box_txt">
							이용완료
						</span>
					</a>
									</div>
				<div class="s_menu_05 s_menu_wrap">
					<a href="#" class="s_menu">마이페이지</a>
					<div class="s_menu_in">
						<!-- <a href="https://talk.naver.com/" target="_blank" class="s_menu_in_01">네이버톡톡</a> -->
												<a href="/member/member_info.php" class="s_menu_in_01">게스트 정보</a>
												<a href="/member/favorite.php" class="s_menu_in_02">내가 찜한 공간</a>
												<a href="/member/leave.php" class="s_menu_in_05">서비스 탈퇴</a>
											</div>
				</div>
								<div class="s_menu_07 s_menu_wrap">
					<a href="/about/intro.php" class="s_menu">About us</a>
				</div>
				<div class="s_menu_04 s_menu_wrap">
					<a href="/story" class="s_menu">POOL 이야기</a>
				</div>
				<div class="s_menu_02 s_menu_wrap">
					<a href="#" class="s_menu">고객센터</a>
					<div class="s_menu_in">
						<a href="/customer/notice.php" class="s_menu_in_01">공지사항</a>
						<a href="/customer/help.php" class="s_menu_in_02">도움말</a>
						<a href="/customer/qna.php" class="s_menu_in_03">질문하기</a>
						<a href="/customer/space.php" class="s_menu_in_04">공간별 설명</a>
					</div>
				</div>
				<div class="s_menu_03 s_menu_wrap">
					<a href="#" class="s_menu">광고 및 제휴</a>
					<div class="s_menu_in">
						<a href="/partner/contact.php" class="s_menu_in_01">제휴문의</a>
						<a href="/ad/apply.php" class="s_menu_in_02">광고 신청</a>
						<!-- <a href="/ad/ad_set.php" class="s_menu_in_03">광고 관리</a> -->
					</div>
				</div>
				<div class="s_menu_08 s_menu_wrap">
					<a href="#" class="s_menu">서비스정보</a>
					<div class="s_menu_in">
						<a href="/sv_info/terms.php" class="s_menu_in_01">이용약관</a>
						<a href="/sv_info/privacy.php" class="s_menu_in_02">개인정보처리방침</a>
						<a href="/sv_info/email.php" class="s_menu_in_03">이메일무단수집거부</a>
					</div>
				</div>
			</div>
			<a href="/member/member_info.php" class="s_go_mypage">
				마이페이지
			</a>
			<a href="#" class="s_menu_close_btn"></a>
		</div>
		<!-- 로그인 이후 끝-->
			</div>


<script type="text/javascript">
// 헤드 메뉴
$(document).ready(function(){
	$('.h_all_menu_btn').click(function () {
		if ($('.header_all_wrap').hasClass('on')){
			$('.slider_menu_wrap').animate({"width":"0px", "opacity":"0"},300,"easeInOutBack" );
			$('.all_bg').fadeOut();
			$('.header_all_wrap').removeClass('on');
			$('body').removeClass('m_on');
		} else {
			$('.slider_menu_wrap').animate({"width":"360px", "opacity":"1"},300,"easeInOutBack" );
			$('.all_bg').fadeIn();
			$('.header_all_wrap').addClass('on');
			$('body').addClass('m_on');
		}
	});
	$('.all_bg').click(function(){
		$('.slider_menu_wrap').animate({"width":"0px", "opacity":"0"},300,"easeInOutBack" );
		$('.all_bg').fadeOut();
		$('.header_all_wrap').removeClass('on');
		$('body').removeClass('m_on');
	});
	$('.s_menu_close_btn').click(function(){
		$('.slider_menu_wrap').animate({"width":"0px", "opacity":"0"},300,"easeInOutBack" );
		$('.all_bg').fadeOut();
		$('.header_all_wrap').removeClass('on');
		$('body').removeClass('m_on');
	});
	$('.h_search_btn').click(function () {
		$("#search_top_input").focus();
		if ($('.header_all_wrap').hasClass('search_on')){
			$("#search_top_input").focus();
			$('.header_all_wrap').removeClass('search_on');
		} else {
			$('.header_all_wrap').addClass('search_on');
		}
	});
	$('.search_top_close_btn').click(function(){
		$('.header_all_wrap').removeClass('search_on');
	});
});

// 헤드 스크롤
$(window).scroll(function(){
	var scrollTop = $(document).scrollTop();
	if (scrollTop > 10) {
		$('.header_all_wrap').addClass('scroll');
	} else if (scrollTop  < 10) {
		$('.header_all_wrap').removeClass('scroll');
	}
});
$(document).ready(function(){
	var scrollTop = $(document).scrollTop();
	if (scrollTop > 10) {
		$('.header_all_wrap').addClass('scroll');
	} else if (scrollTop  < 10) {
		$('.header_all_wrap').removeClass('scroll');
	}
});


$(document).ready(function(){
	$('.s_menu_wrap > a').click(function () {
		var menuCC = $(this).closest('.s_menu_wrap');
		if (menuCC.hasClass('selected')){
			$('.s_menu_wrap .s_menu_in').hide();
			menuCC.find(".s_menu_in").hide();
			$('.s_menu_wrap').removeClass('selected');
		} else {
			$('.s_menu_wrap .s_menu_in').hide();
			menuCC.find(".s_menu_in").show();
			$('.s_menu_wrap').removeClass('selected');
			menuCC.addClass('selected');
		}
	});

});
</script>


<!-- 임시 -->
<!-- <script type="text/javascript">
$(document).ready(function(){
	$('.s_login_btn').click(function () {
		$('.slider_menu_wrap').addClass('login_on');
	});
	$('.s_logout_btn').click(function () {
		$('.slider_menu_wrap').removeClass('login_on');
		$('.slider_menu_wrap').removeClass('host_on');
	});
	$('.s_info_host_chg').click(function () {
		$('.slider_menu_wrap').addClass('host_on');
		$('.slider_menu_wrap').removeClass('login_on');
	});
	$('.host_login .s_info_host_chg').click(function () {
		$('.slider_menu_wrap').addClass('login_on');
		$('.slider_menu_wrap').removeClass('host_on');
	});
});
</script> -->
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="m_top_nav_wrap">
	<a href="/member/member_info.php" class="active">게스트 정보</a>
	<a href="/member/favorite.php" class="">내가 찜한 공간</a>
	<a href="/member/leave.php" class="">서비스 탈퇴</a>
</div>
						<div class="s_view_desc">
							<form name="form0" method="post" action="/member/member.php" target="tempFrame">
								<input type="hidden" name="mode" value="edit_ok">
								<input type="hidden" name="cert_no" value="1">
								<input type="hidden" name="birth_Y" value="00">
								<input type="hidden" name="birth_M" value="00">
								<input type="hidden" name="birth_D" value="00">
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
		 		       김재현				<span id="ins1">
				<input type="hidden" name="name" value="김재현" class="sign_input_02">&nbsp;&nbsp;&nbsp;
				 <label style="padding:0 10px 0 0"><input type="radio" name="mb_sex" value="M" checked />&nbsp;남자</label>
				<label><input type="radio" name="mb_sex" value="F"  />&nbsp;여자</label>
				</span>
				<span id="ins2" style="display:none"><span>
					<span id="ins2_txt" style="display:none"></span>
				<span id="ins1_txt" style="display:none"></span>
				<span id="ins1_btn" style="display:none"><!--input type=button value="다시입력" onclick="is_rebtn()"--></span>
				<input type=hidden name="kcp_code" >

				<script type="text/javascript">
		<!--
		function is_rebtn() {
			if(document.form0.kcp_code.value == "0000") {
				alert("본인인증이 끝난 이름/생년월일은 수정할수 없습니다.");
			} else {
				document.getElementById("ins1_txt").style.display = "none";
				document.getElementById("ins1_btn").style.display = "none";
				document.getElementById("ins2_txt").style.display = "none";

				document.getElementById("ins1").style.display = "";
				document.getElementById("ins2").style.display = "";
			}
		}
		//-->
		</script>

		
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">아이디<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			miszzang76@naver.com		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">닉네임<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			바람처럼		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">전화번호</div>
		<div class="s_view_desc_txt_desc">
			<select class="sign_input_02" name="tel1">
				<option value="02" >02</option>
				<option value="031" >031</option>
				<option value="032" >032</option>
				<option value="033" >033</option>
				<option value="041" >041</option>
				<option value="042" >042</option>
				<option value="043" >043</option>
				<option value="051" >051</option>
				<option value="052" >052</option>
				<option value="053" >053</option>
				<option value="054" >054</option>
				<option value="055" >055</option>
				<option value="061" >061</option>
				<option value="062" >062</option>
				<option value="063" >063</option>
				<option value="064" >064</option>
				<option value="070" >070</option>
			</select>
			<span class="span_col"> - </span>
			<input type="text" name="tel2" class="sign_input_02"  id='tel2' placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="">
			<span class="span_col"> - </span>
			<input type="text" name="tel3" class="sign_input_02" id='tel3' placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="">
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">휴대폰번호<span>*</span></div>
		<div class="s_view_desc_txt_desc">


			<select class="sign_input_02" name="mobile1">
				<option value="010" >010</option>
				<option value="011" >011</option>
				<option value="016" >016</option>
				<option value="017" >017</option>
				<option value="018" >018</option>
				<option value="019" >019</option>
			</select>
			<span class="span_col"> - </span>
			<input type="text" name="mobile2" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는" value="">
			<span class="span_col"> - </span>
			<input type="text" name="mobile3" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는" value="">

			<span class="span_desc">
				<a href="javascript:auth_type_check();" class="sing_btn_01" id="win_hp_cert">인증번호 발송</a>
			</span>
		</div>
		<!--
		<div class="s_view_desc_txt_desc">
			<input type="text" name="authnum" class="sign_input_01" onkeypress="onlyNumber();" style="ime-mode:disabled;"  placeholder="인증번호를 입력하세요" maxlength="6" must="Y" mval="인증번호는">
			<span class="span_desc">
				<a href="#" class="sing_btn_01">인증확인</a>
			</span>
		</div>
		 -->
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">주소<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="post" id="post" class="sign_input_01" value="" placeholder="주소검색" readonly onClick="execDaumPostcode(1);">
			<span class="span_desc">
				<a href="#" class="sing_btn_01" onClick="execDaumPostcode(1);">우편번호 찾기</a>
			</span>
			<div id="Post_Layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
				<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
			</div>
			<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<script type="text/javascript" src="/s_inc/Daum_Post.js"></script>
		</div>
		<div class="s_view_desc_txt_desc">
			<span class="span_desc">
				<input type="text" name="addr1" id="addr1" class="sign_input_03" value="" placeholder="주소" onClick="execDaumPostcode(1);" readonly>
			</span>
			<span class="span_desc">
				<input type="text" name="addr2" id="addr2"  class="sign_input_03" value="" maxlength="50" placeholder="나머지주소">
			</span>
		</div>
	</div>
	</div>
								</div>
							</form>

							

						</div>
						<div class="cm_wrap">
							<a href="javascript:Save_go();" class="cm_ok_btn">정보수정</a>
						</div>
					</div>
				</div>
			</div>
		</div>

<script type="text/javascript">
// 결제창 종료후 인증데이터 리턴 함수
function auth_data( frm )
{
	var auth_form     = document.form_auth;
	var nField        = frm.elements.length;
	var response_data = "";

	// up_hash 검증 
	if( frm.up_hash.value != auth_form.veri_up_hash.value )
	{
		alert("up_hash 변조 위험있음");
		// 오류 처리 ( dn_hash 변조 위험있음)
	}
	
   /* 리턴 값 모두 찍어보기 (테스트 시에만 사용) */
	var form_value = "";

	for ( i = 0 ; i < frm.length ; i++ )
	{
		form_value += "["+frm.elements[i].name + "] = [" + frm.elements[i].value + "]\n";
	}
	alert(form_value);
}

// 인증창 호출 함수
function auth_type_check()
{
	var auth_form = document.form_auth;
	var rf = document.form0;
	if( auth_form.ordr_idxx.value == "" ) {
		alert( "주문번호는 필수 입니다." );
		return false;
	} else if(rf.name.value == "") {
		alert("이름을 입력해 주세요.");
		return false;
	
	} else if(rf.mobile2.value == "") {
		alert("휴대폰번호를 입력해 주세요.");
		return ;
	} else if(rf.mobile3.value == "") {
		alert("휴대폰번호를 입력해 주세요.");
		return ;
	 
	} else {
		 
		auth_form.user_name.value = rf.name.value;
		auth_form.year.value = rf.birth_Y.value;
		auth_form.month.value = rf.birth_M.value;
		auth_form.day.value = rf.birth_D.value;
		auth_form.phone_no.value = rf.birth_Y.value+rf.birth_M.value+rf.birth_D.value;
		 

		document.getElementById("ins1").style.display = "none";
		document.getElementById("ins2").style.display = "none";

		document.getElementById("ins1_txt").style.display = "";
		document.getElementById("ins2_txt").style.display = "";
		document.getElementById("ins1_btn").style.display = "";

		document.getElementById("ins1_txt").innerHTML = rf.name.value;
		document.getElementById("ins2_txt").innerHTML = rf.birth_Y.value+"-"+rf.birth_M.value+"-"+rf.birth_D.value;

			if(rf.mb_sex[0].checked == true) 
			auth_form.sex_code.value = "01";
		else if(rf.mb_sex[0].checked == true) 
			auth_form.sex_code.value = "02";

 

		if( ( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 ) == false ) // 스마트폰이 아닌경우
		{
			var return_gubun;
			var width  = 410;
			var height = 500;

			var leftpos = screen.width  / 2 - ( width  / 2 );
			var toppos  = screen.height / 2 - ( height / 2 );

			var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
			var position = ",left=" + leftpos + ", top="    + toppos;
			var AUTH_POP = window.open('','auth_popup', winopts + position);
		}
		auth_form.method = "post";
		auth_form.target = "auth_popup"; // !!주의 고정값 ( 리턴받을때 사용되는 타겟명입니다.)
		auth_form.action = "/plugin/kcpcert/WEB_ENC/kcpcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소
		auth_form.submit();
		 return ;
	}
}

/* 예제 */
window.onload=function()
{
	init_orderid(); // 주문번호 샘플 생성
}

// 주문번호 생성 예제 ( up_hash 생성시 필요 ) 
function init_orderid()
{
	var today = new Date();
	var year  = today.getFullYear();
	var month = today.getMonth()+ 1;
	var date  = today.getDate();
	var time  = today.getTime();

	if(parseInt(month) < 10)
	{
		month = "0" + month;
	}

	var vOrderID = year + "" + month + "" + date + "" + time;

	document.form_auth.ordr_idxx.value = vOrderID;
}
</script>

<form name="form_auth">
<div id="show_pay_btn" style="display:none">
	<input type="image" src="../img/btn_certi.gif" onclick="return auth_type_check();" width="108" height="37" alt="결제를 요청합니다" />
</div>


<input type="hidden" name="ordr_idxx" class="frminput" value="" size="40" readonly="readonly" maxlength="40"/>
<input type="hidden" name="user_name" value="" size="20" maxlength="20" class="frminput" />
<input type="hidden" name='phone_no' id='phone_no' value="">
<input type="hidden" name='year' id='year_select'>
<input type="hidden" name="month" id="month_select">
<input type="hidden" name="day" id="day_select">


<input type="hidden" name="sex_code"> <!--01:남성 / 02:여성-->
<input type="hidden" name="local_code"> <!--01:내국인 / 02:외국인-->

<!-- 요청종류 -->
<input type="hidden" name="req_tx"       value="cert"/>
<!-- 요청구분 -->
<input type="hidden" name="cert_method"  value="01"/>
<!-- 웹사이트아이디 -->
<input type="hidden" name="web_siteid"   value=""/> 
<!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요 
	 SKT : SKT , KT : KTF , LGU+ : LGT
<input type="hidden" name="fix_commid"      value="KTF"/>
-->
<!-- 사이트코드 -->
<input type="hidden" name="site_cd"      value="A7FKG" />
<!-- Ret_URL : 인증결과 리턴 페이지 ( 가맹점 URL 로 설정해 주셔야 합니다. ) -->
<input type="hidden" name="Ret_URL"      value="http://spacepool.co.kr/plugin/kcpcert/WEB_ENC/kcpcert_proc_req.php" style="width:400px" />
<!-- cert_otp_use 필수 ( 메뉴얼 참고)
	 Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
-->
<input type="hidden" name="cert_otp_use" value="Y"/>
<!-- cert_enc_use 필수 (고정값 : 메뉴얼 참고) -->
<input type="hidden" name="cert_enc_use" value="Y"/>

<input type="hidden" name="res_cd"       value=""/>
<input type="hidden" name="res_msg"      value=""/>

<!-- up_hash 검증 을 위한 필드 -->
<input type="hidden" name="veri_up_hash" value=""/>

<!-- 본인확인 input 비활성화 -->
<input type="hidden" name="cert_able_yn" value=""/>

<!-- web_siteid 을 위한 필드 -->
<input type="hidden" name="web_siteid_hashYN" value="N"/>

<!-- 가맹점 사용 필드 (인증완료시 리턴)-->
<input type="hidden" name="param_opt_1"  value="opt1"/> 
<input type="hidden" name="param_opt_2"  value="opt2"/> 
<input type="hidden" name="param_opt_3"  value="opt3"/> 
</form>
</html>

		<div class="footer_wrap">
	<div class="footer_top_wrap">
		<div class="footer_top">
			<div class="footer_top_left">
				<div class="sitemap_box">
					<a href="/space/list.php">공간찾기</a>
					<div class="sitemap_list">
						<a href="/space/list.php">핫스페이스보기</a>
						<a href="#">공간검색하기</a>
					</div>
				</div>
				<div class="sitemap_box">
					<a href="/about/intro.php">About us</a>
					<div class="sitemap_list">
						<a href="/about/intro.php">회사소개</a>
					</div>
				</div>
				<div class="sitemap_box">
					<a href="/customer/notice.php">고객센터</a>
					<div class="sitemap_list">
						<a href="/customer/notice.php" >공지사항</a>
						<a href="/customer/help.php" >도움말</a>
						<a href="/customer/qna.php" >질문하기</a>
						<a href="/customer/space.php" >공간별 설명</a>
					</div>
				</div>
				<div class="sitemap_box">
					<a href="/member/space_apply.php">공간등록</a>
					<div class="sitemap_list">
						<a href="#">등록 도움말</a>
						<a href="/member/space_apply.php">공간 등록하기</a>
					</div>
				</div>
				<div class="sitemap_box">
					<a href="/member/space_apply.php">광고 및 제휴</a>
					<div class="sitemap_list">
						<a href="/partner/contact.php">제휴문의</a>
						<a href="/ad/apply.php" >광고 신청</a>
					</div>
				</div>
			</div>
			<div class="footer_top_right">
				<a href="#">
					<img src="/images/temp/qr_store.png">
				</a>
			</div>
		</div>

	</div>
	<div class="footer_bottom_wrap">
		<div class="footer_bottom">
			<div class="footer_bottom_link">
				<a href="/sv_info/terms.php" class="fb_link_00">이용약관</a>
				<a href="/sv_info/privacy.php" class="fb_link_01">개인정보처리방침</a>
				<a href="/sv_info/email.php" class="fb_link_02">이메일무단수집거부</a>
				<a href="/about/intro.php" class="fb_link_03">회사소개</a>
				<a href="/s_admin" class="fb_link_04">관리자</a>
			</div>
			<div class="footer_copy_wrap">
				<div class="footer_copy_left">
					<div class="footer_copy_left_txt">
						<!-- 원래코드
						스페이스풀<span class="fc_sp1"></span>소재지 : 부산 금정구 장전동 수림로 93번길 62 501호<span class="fc_sp2"></span>고객센터 : <a href="tel:0508-5192-3708">0508-5192-3708</a><span class="fc_sp3"></span>팩스 : 051-000-0000<span class="fc_sp4"></span>사업자등록번호 :813-99-00263
					-->
					<!--바꾼코드-->
					스페이스풀<span class="fc_sp1"></span>소재지 : 부산 금정구 장전동 수림로 93번길 62 501호<span class="fc_sp2"></span>고객센터 : <a href="tel:0507-1417-2966">0507-1417-2966</a><span class="fc_sp3"></span>팩스 : 051-000-0000<span class="fc_sp4"></span>사업자등록번호 :813-99-00263
						<a href="javascript:s_p_info();">
							<img src="/images/common/enter_info.jpg">
						</a><span class="fc_sp5"></span>
						<!--원래코드
						대표 : 박경호<span class="fc_sp6"></span>통신판매업 신고번호 : 2016-부산금정-0398<span class="fc_sp7"></span>개인정보관리책임자 : 박경호<span class="fc_sp8"></span>이메일 : <a href="mailto:admin@spacepool.co.kr">admin@spacepool.co.kr</a>
					-->
					<!--바꾼코드-->
					대표 : 박경호<span class="fc_sp6"></span>통신판매업 신고번호 : 2016-부산금정-0398<span class="fc_sp7"></span>개인정보관리책임자 : 박경호<span class="fc_sp8"></span>이메일 : <a href="mailto:spacepool@naver.com">spacepool@naver.com</a>
					</div>
				</div>
				<div class="footer_copy_right">
					<span>고객센터 운영시간 : 10시 00분 ~ 17시 00분 까지</span><br>
					(토,일, 공휴일 휴무입니다. 점심 12시 ~ 13시까지)
				</div>
				<div class="footer_copy color_fix">
					스페이스풀은 회원이 자발적으로 등록한 게시물과 거래에 대하여 관여하지 않으며 책임을 지지 않습니다.
				</div>
				<div class="footer_copy">
					Copyright ⓒ 2016 SpacePool. All right Reserved. Designed by Gautech.
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function s_p_info(){
	var url = "http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=8139900263";
	window.open(url, "communicationViewPopup", "width=750, height=700;");
}

// 검색 라디오버튼
$(".main_area_top .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_area_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');
		$('.main_area_depth_02').removeClass('view_on');
	}else{
		$(".main_area_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');
		$('.main_area_depth_02').removeClass('view_on');
	}
});

$(".main_area_depth_01 .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');
		$('.main_area_depth_02').addClass('view_on');
	}else{
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');
		$('.main_area_depth_02').removeClass('view_on');
	}
});
$(".main_area_depth_02 .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');

	}else{
		$(".main_area_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_area_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');

	}
});

$(".main_space_top .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_space_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');
		$('.main_space_depth_02').removeClass('view_on');
	}else{
		$(".main_space_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');
		$('.main_space_depth_02').removeClass('view_on');
	}
});

$(".main_space_depth_01 .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_space_top .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');
		$('.main_space_depth_02').addClass('view_on');
	}else{
		$(".main_space_top .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_01 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');
		$('.main_space_depth_02').removeClass('view_on');
	}
});
$(".main_space_depth_02 .dp_box input").change(function() {
	if($(this).is(':checked')){
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").addClass('chk_on');

	}else{
		$(".main_space_depth_02 .dp_box input").next("label").removeClass('chk_on');
		$(".main_space_top .dp_box input").next("label").removeClass('chk_on');
		$(this).next("label").removeClass('chk_on');

	}
});

$(".view_visual_love input").change(function() {
	if($(this).is(':checked')){
		$(".view_visual_love input").next("label").removeClass('love_on');
		$(this).next("label").addClass('love_on');
	}else{
		$(".view_visual_love input").next("label").removeClass('love_on');
		$(this).next("label").removeClass('love_on');
	}
});


$(document).ready(function(){
	$('.main_area_txt').click(function () {
		if ($('.main_area_wrap').hasClass('on')){
			$('.main_area_wrap').removeClass('on');
		} else {
			$('.main_area_wrap').addClass('on');
		}
	});
	$('.main_area_wrap .dp_box_ok_btn').click(function(){
		$('.main_area_wrap').removeClass('on');
	});
	$('.main_space_txt').click(function () {
		if ($('.main_space_wrap').hasClass('on')){
			$('.main_space_wrap').removeClass('on');
		} else {
			$('.main_space_wrap').addClass('on');
		}
	});
	$('.main_space_wrap .dp_box_ok_btn').click(function(){
		$('.main_space_wrap').removeClass('on');
	});

	// 가격범위
	$('.m_space_open_btn').click(function () {
		if ($('#wrap').hasClass('arr_on')){
			$('#wrap').removeClass('arr_on');
		} else {
			$('#wrap').addClass('arr_on');
		}
	});

	// 팝업1
	$('.view_fixed_tel_box').click(function () {
		if ($('#wrap').hasClass('f_pop_on')){
			$('#wrap').removeClass('f_pop_on');
		} else {
			$('#wrap').addClass('f_pop_on');
		}
	});
	$('.f_pop_close_btn').click(function(){
		$('#wrap').removeClass('f_pop_on');
	});
	$('.f_pop_bg').click(function(){
		$('#wrap').removeClass('f_pop_on');
	});

	// 팝업2
	$('.pay_end').click(function () {
		if ($('#wrap').hasClass('f_pop_on')){
			$('#wrap').removeClass('f_pop_on');
		} else {
			$('#wrap').addClass('f_pop_on');
		}
	});

});

$(".option_box input").change(function() {
	if($(this).is(':checked')){
		$(this).next("label").addClass('checkbox_on');
	}else{
		$(this).next("label").removeClass('checkbox_on');
	}
});

$(".right_op_box input").change(function() {
	if($(this).is(':checked')){
		$(this).next("label").addClass('checkbox_on');
		$(".agree_label_in input[type=checkbox]").prop("checked", true);
		$(".agree_label_in input[type=checkbox]").next("label").addClass('checkbox_on');
	}else{
		$(this).next("label").removeClass('checkbox_on');
		$(".agree_label_in input[type=checkbox]").prop("checked", false);
		$(".agree_label_in input[type=checkbox]").next("label").removeClass('checkbox_on');
	}
});


$(".agree_label_in input").change(function() {
	if($(this).is(':checked')){
		$(this).next("label").addClass('checkbox_on');
		$(".right_op_box input[type=checkbox]").prop("checked", false);
		$(".right_op_box input[type=checkbox]").next("label").removeClass('checkbox_on');
	}else{
		$(this).next("label").removeClass('checkbox_on');
		$(".right_op_box input[type=checkbox]").prop("checked", false);
		$(".right_op_box input[type=checkbox]").next("label").removeClass('checkbox_on');
	}
});


$(".sp_list_info_onoff input").change(function() {
	if($(this).is(':checked')){
		$(this).next("label").addClass('checkbox_on');
	}else{
		$(this).next("label").removeClass('checkbox_on');
	}
});

$(".acc_box input").change(function() {
	if($(this).is(':checked')){
		$(this).next("label").addClass('checkbox_on');
	}else{
		$(this).next("label").removeClass('checkbox_on');
	}
});

$(".pay_type input").change(function() {
	if($(this).is(':checked')){
		$(".pay_type input").next("label").removeClass('radio_on');
		$(this).next("label").addClass('radio_on');
	}else{
		$(".pay_type input").next("label").removeClass('radio_on');
		$(this).next("label").removeClass('radio_on');
	}
});


$(window).load(function () {
	if($(".option_box input").is(':checked')){
		$(".option_box input:checked").next("label").addClass('checkbox_on');
	}else{
		$(".option_box input:checked").next("label").removeClass('checkbox_on');
	}

	if($(".sp_list_info_onoff input").is(':checked')){
		$(".sp_list_info_onoff input:checked").next("label").addClass('checkbox_on');
	}else{
		$(".sp_list_info_onoff input:checked").next("label").removeClass('checkbox_on');
	}

	if($(".right_op_box input").is(':checked')){
		$(".right_op_box input:checked").next("label").addClass('checkbox_on');
	}else{
		$(".right_op_box input:checked").next("label").removeClass('checkbox_on');
	}

	if($(".acc_box input").is(':checked')){
		$(".acc_box input:checked").next("label").addClass('checkbox_on');
	}else{
		$(".acc_box input:checked").next("label").removeClass('checkbox_on');
	}

	if($(".pay_type input").is(':checked')){
		$(".pay_type input:checked").next("label").addClass('radio_on');
	}else{
		$(".pay_type input:checked").next("label").removeClass('radio_on');
	}

	if($(".dp_box input").is(':checked')){
		$(".dp_box input:checked").next("label").addClass('chk_on');
	}else{
		$(".dp_box input:checked").next("label").removeClass('chk_on');
	}

	if($(".view_visual_love input").is(':checked')){
		$(".view_visual_love input:checked").next("label").addClass('love_on');
	}else{
		$(".view_visual_love input:checked").next("label").removeClass('love_on');
	}
});

$(function() {
	$('.go_ani').bind('click',function(event){
		var $anchor = $(this);

		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 500,'easeInOutExpo');
				/*
				if you don't want to use the easing effects:
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top
				}, 1000);
				*/
				event.preventDefault();
			});
});

$(document).ready(function(){
	$(this).removeClass('active');
	$('.agree_box > a').click(function () {
		var agreeCC = $(this).closest('.agree_box_wrap');
		if (agreeCC.hasClass('selected')){
			agreeCC.find(".agree_desc_wrap").stop();
			agreeCC.find(".agree_desc_wrap").animate({"height":"0px","opacity":"0"},200 );
			agreeCC.removeClass('selected');
		} else {
			var agreeH = agreeCC.find(".agree_desc").height();
			agreeCC.find(".agree_desc_wrap").stop();
			agreeCC.find(".agree_desc_wrap").animate({"height":agreeH + 21,"opacity":"1"},200 );
			agreeCC.addClass('selected');
		}
	});
	$('.agree_atag').click(function () {
		var agreeDD = $(this).closest('.agree_box_wrap');
		if (agreeDD.hasClass('selected')){
			agreeDD.find(".agree_desc_wrap").stop();
			agreeDD.find(".agree_desc_wrap").animate({"height":"0px","opacity":"0"},200 );
			agreeDD.removeClass('selected');
		} else {
			var agreeH = agreeDD.find(".agree_desc").height();
			agreeDD.find(".agree_desc_wrap").stop();
			agreeDD.find(".agree_desc_wrap").animate({"height":agreeH + 21,"opacity":"1"},200 );
			agreeDD.addClass('selected');
		}
	});

});
</script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript">
// 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('e0b8811c749e15068d153bf5229f25a6');

// 카카오톡 공유하기
function sendKakaoTalk()
{
	Kakao.Link.sendTalkLink({
		label: '',
		image: {
			src: 'http://spacepool.co.kr/DATAS/es_product/thum/',
			width: '300',
			height: '200'
		},
		webButton: {
			text: '',
			url: 'http://spacepool.co.kr' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		}
	});
}

// 카카오스토리 공유하기
function shareStory() {
	Kakao.Story.share({
		url: 'http://spacepool.co.kr',
		text: ''
	});
}

// send to SNS
function toSNS(sns, strTitle) {
	var strURL =  document.location.href;
	var snsArray = new Array();
	var strMsg = strTitle + " " + strURL;
	var image = "http://spacepool.co.kr/DATAS/es_product/thum/";

	snsArray['twitter'] = "http://twitter.com/home?status=" + encodeURIComponent(strTitle) + ' ' + encodeURIComponent(strURL);
	snsArray['facebook'] = "http://www.facebook.com/share.php?u=" + encodeURIComponent(strURL);
	snsArray['pinterest'] = "http://www.pinterest.com/pin/create/button/?url=" + encodeURIComponent(strURL) + "&media=" + image + "&description=" + encodeURIComponent(strTitle);
	snsArray['band'] = "http://band.us/plugin/share?body=" + encodeURIComponent(strTitle) + "  " + encodeURIComponent(strURL) + "&route=" + encodeURIComponent(strURL);
	snsArray['blog'] = "http://blog.naver.com/openapi/share?url=" + encodeURIComponent(strURL) + "&title=" + encodeURIComponent(strTitle);
	snsArray['line'] = "http://line.me/R/msg/text/?" + encodeURIComponent(strTitle) + " " + encodeURIComponent(strURL);
	snsArray['pholar'] = "http://www.pholar.co/spi/rephol?url=" + encodeURIComponent(strURL) + "&title=" + encodeURIComponent(strTitle);
	snsArray['google'] = "https://plus.google.com/share?url=" + encodeURIComponent(strURL) + "&t=" + encodeURIComponent(strTitle);
	snsArray['tumblr'] = "https://www.tumblr.com/widgets/share/tool/preview?canonicalUrl=" + encodeURIComponent(strURL) + 'shareSource=tumblr_share_button'
	window.open(snsArray[sns]);
}

function copy_clip(url) {
	var url = document.location.href;
	var IE = (document.all) ? true : false;
	if (IE) {
		window.clipboardData.setData("Text", url);
		alert("이 글의 단축url이 클립보드에 복사되었습니다.");
	} else {
		temp = prompt("이 글의 단축url입니다. Ctrl+C를 눌러 클립보드로 복사하세요", url);
	}
}
</script>

<iframe name="tempFrame" id="tempFrame" width="0" height="0" style="display:none;"></iframe>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>