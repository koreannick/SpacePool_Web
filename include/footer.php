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
				<a href="http://blog.naver.com/spacepool">
					<img style="width:100px;"src="/images/temp/blog2.png">
				</a>
				<a href="https://www.facebook.com/spacepoolofficial/">
					<img style="width:100px;"src="/images/temp/fb.png">
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
		label: '<?=$subject?>',
		image: {
			src: 'http://spacepool.co.kr/DATAS/es_product/thum/<?=$bimg?>',
			width: '300',
			height: '200'
		},
		webButton: {
			text: '<?=$subject?>',
			url: 'http://spacepool.co.kr' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
		}
	});
}

// 카카오스토리 공유하기
function shareStory() {
	Kakao.Story.share({
		url: 'http://spacepool.co.kr',
		text: '<?=$subject?>'
	});
}

// send to SNS
function toSNS(sns, strTitle) {
	var strURL =  document.location.href;
	var snsArray = new Array();
	var strMsg = strTitle + " " + strURL;
	var image = "http://spacepool.co.kr/DATAS/es_product/thum/<?=$bimg?>";

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
<?

include $_SERVER["DOCUMENT_ROOT"]."/_space_tmp_del.php";


if($connect)		@mysql_close($connect);
?>
