<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89662290-1', 'auto');
  ga('send', 'pageview');

</script>
<?
//휴대폰 번호가 등록안되어있는 경우 강제적으로 수정페이지로 이동시킴
if($USESSION[0]&&$PHP_SELF!="/member/member_info.php"){
	if(!$connect)		$connect = dbcon();

	$resultm = mysql_query("select replace(mobile,'-',''),n_talk from $t_member where email='$USESSION[0]'");
	if($resultm&&mysql_num_rows($resultm)>0){
		$chk_m = trim(mysql_result($resultm,0,0));
		$n_talk = trim(mysql_result($resultm,0,1));

		if($n_talk){
			//$n_talk = str_replace("http://","",$n_talk);
		}

		if(!$n_talk)		$n_talk = "#";

		if(!$chk_m){
			redir_proc3("/member/member_info.php","기본정보를 등록해주셔야 이용가능합니다.");
		}
	}else{
		redir_proc3("/member/member_info.php","기본정보를 등록해주셔야 이용가능합니다.");
	}
	@mysql_free_result($resultm);

	unset($chk_m);
}

$prev_date = mktime(23,59,59,date("m"),date("d")-1,date("Y"));

$naver = new Naver();
?>
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
				<?
				if($USESSION[0]){
				?>
				<a href="/member/member.php?mode=logout_ok" class="h_logout_btn">로그아웃</a>
				<?
				}else{
					$top_login = true;
					echo $naver->login();

					unset($top_login);
				}
				?>
				<!-- <?if(!$USESSION[0]){?>
					<a href="/member/login.php" class="h_login_btn">로그인</a>
				<?}else{?>
					<a href="/member/member.php?mode=logout_ok" class="h_logout_btn">로그아웃</a>
				<?}?> -->
				<a href="#" class="h_all_menu_btn">
					<img src="/images/common/menu.png">
				</a>
			</div>
			<div class="search_top_wrap">
				<form name="tsFrm" method="post" action="/space/list.php">
				<div class="search_top_input">
					<input type="text" name="skeyword" placeholder="검색어를 입력해주세요" id="search_top_input" autofocus maxlength="20" must="Y" mval="검색키워드는" value="<?=$skeyword?>" style="text-align:center">
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
	<?
	if(!$USESSION[0]){
	?>
	<!-- 로그인 이전 시작-->
	<div class="slider_menu before_login">
		<div class="s_login_form">
			<div class="s_login_form_top">
				<div class="sp_logo">
					<img src="/images/common/logo2.png" alt="스페이스풀 로고" title="스페이스풀 로고">
					<div>
						로그인이 필요합니다.
					</div>
				</div>
				<?=$naver->login()?>
			</div>
		</div>
		<div class="s_scroll_wrap">
			<?require "right_menu.php";?>
		</div>
		<a href="https://nid.naver.com/nidregister.form?url=<?=urlencode("http://".$_SERVER["HTTP_HOST"])?>" class="s_go_signup">
			네이버 회원가입
		</a>
		<a href="#" class="s_menu_close_btn"></a>
	</div>
	<!-- 로그인 이전 끝 -->
	<?}else{?>
		<?if($USESSION[2]=="m1"){?>
		<!-- 로그인 이후 시작-->
		<div class="slider_menu after_login">
			<div class="s_info_wrap">
				<div class="s_info_img_wrap">
					<div class="s_info_img">
						<a href="/member/member_info.php">
							<img src="<?=$USESSION[4]?>">
						</a>
					</div>
					<!-- <a href="#" class="s_alarm">12</a> -->
				</div>
				<div class="s_info">
					<div class="s_info_user"><?=$USESSION[3]?></div>
					<div class="s_info_class"><?=$m_level_arr[$USESSION[2]]?></div>
					<?if($USESSION[2]=="m1"){?>
						<a href="/member/host_signup.php" class="s_info_host_chg">HOST 등록하기</a>
					<?}?>
				</div>
				<a href="/member/member.php?mode=logout_ok" class="s_logout_btn">로그아웃</a>
			</div>
			<div class="s_scroll_wrap">
				<div class="s_box_menu_wrap s_box_menu_st">
					<?
					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='ok' and not (eDate<'".date("Y-m-d")."' or (eDate<='".date("Y-m-d")."' and eTime<=".date("H")."))");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);

					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='ok' and wdate >= $prev_date");
					if($resultc&&mysql_num_rows($resultc)>0){
						$n_cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/book_list.php?kind=1" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							신청/결제
						</span>
						<?if($n_cnt>0){?>
						<span class="s_new_icon">
							N
						</span>
						<?}?>
					</a>
					<?
					unset($n_cnt);
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='cancel'");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);

					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='cancel' and wdate >= $prev_date");
					if($resultc&&mysql_num_rows($resultc)>0){
						$n_cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/book_list.php?kind=2" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							취소/환불
						</span>
						<?if($n_cnt>0){?>
						<span class="s_new_icon">
							N
						</span>
						<?}?>
					</a>
					<?
					unset($n_cnt);
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='ok' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) or (eDate='".date("Y-m-d")."' and eTime>".date("H")."))");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/book_list.php?kind=3" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							이용중
						</span>
					</a>
					<?
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking where id='$USESSION[0]' and status='ok' and (eDate<'".date("Y-m-d")."' or (eDate='".date("Y-m-d")."' and eTime<=".date("H")."))");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/book_list.php?kind=4" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							이용완료
						</span>
					</a>
					<?
					unset($cnt);
					?>
				</div>
				<div class="s_menu_05 s_menu_wrap">
					<a href="#" class="s_menu">마이페이지</a>
					<div class="s_menu_in">
						<!-- <a href="https://talk.naver.com/" target="_blank" class="s_menu_in_01">네이버톡톡</a> -->
						<?if($USESSION[2]!="admin"){?>
						<a href="/member/member_info.php" class="s_menu_in_01"><?if($USESSION[2]=="m1")		echo "게스트";		elseif($USESSION[2]=="m2")		echo "HOST";?> 정보</a>
						<?}?>
						<a href="/member/favorite.php" class="s_menu_in_02">내가 찜한 공간</a>
						<?if($USESSION[2]!="admin"){?>
						<a href="/member/leave.php" class="s_menu_in_05">서비스 탈퇴</a>
						<?}?>
					</div>
				</div>
				<?require "right_menu.php";?>
			</div>
			<a href="/member/member_info.php" class="s_go_mypage">
				마이페이지
			</a>
			<a href="#" class="s_menu_close_btn"></a>
		</div>
		<!-- 로그인 이후 끝-->
		<?}else{?>
		<script type="text/javascript">
		<!--
		function Guest_Chg(){
			if(confirm('GUEST로 전환하시겠습니까?')){
				tempFrame.location.href = "/member/member.php?mode=guest_chg_ok";
			}
		}
		//-->
		</script>
		<!-- 호스트 로그인 시작-->
		<div class="slider_menu host_login">
			<div class="s_info_wrap">
				<div class="s_info_img_wrap">
					<div class="s_info_img">
						<a href="/member/member_info.php">
							<img src="<?=$USESSION[4]?>">
						</a>
					</div>
					<!-- <a href="#" class="s_alarm">12</a> -->
				</div>
				<div class="s_info">
					<div class="s_info_user"><?=$USESSION[3]?></div>
					<div class="s_info_class"><?=$m_level_arr[$USESSION[2]]?></div>
					<a href="javascript:Guest_Chg();" class="s_info_host_chg">GUEST 전환하기</a>
				</div>
				<a href="/member/member.php?mode=logout_ok" class="s_logout_btn">로그아웃</a>
			</div>
			<div class="s_scroll_wrap">
				<div class="s_box_menu_wrap">
					<?
					if($USESSION[2]=="admin"){
						$r_tmp_where = "where 1=1";
					}else{
						$r_tmp_where = "where pid='$USESSION[0]'";
					}
					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and pay_status='N'");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and pay_status='N' and wdate >= $prev_date");
					if($resultc&&mysql_num_rows($resultc)>0){
						$n_cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/host_book_list.php?kind=1" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							결제대기
						</span>
						<?if($n_cnt>0){?>
						<span class="s_new_icon">
							N
						</span>
						<?}?>
					</a>
					<?
					unset($n_cnt);
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and pay_status='Y'");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and pay_status='Y' and wdate >= $prev_date");
					if($resultc&&mysql_num_rows($resultc)>0){
						$n_cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/host_book_list.php?kind=2" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							결제승인
						</span>
						<?if($n_cnt>0){?>
						<span class="s_new_icon">
							N
						</span>
						<?}?>
					</a>
					<?
					unset($n_cnt);
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='cancel'");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/host_book_list.php?kind=3" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							취소
						</span>
					</a>
					<?
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and ((sDate<='$sDate' and eDate>='$sDate') or (sDate<='$eDate' and eDate>='$eDate')) or (eDate='".date("Y-m-d")."' and eTime>".date("H")."))");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/host_book_list.php?kind=4" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							이용중
						</span>
					</a>
					<?
					unset($cnt);

					$resultc = mysql_query("select count(uid) from es_booking $r_tmp_where and status='ok' and (eDate<'".date("Y-m-d")."' or (eDate='".date("Y-m-d")."' and eTime<=".date("H")."))");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/host_book_list.php?kind=5" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							이용완료
						</span>
					</a>
					<?
					$resultc = mysql_query("select count(uid) from es_product where id='$USESSION[0]'");
					if($resultc&&mysql_num_rows($resultc)>0){
						$cnt = mysql_result($resultc,0,0);
					}
					@mysql_free_result($resultc);
					?>
					<a href="/member/space_host.php" class="s_box_menu">
						<span class="s_box_alarm">
							<?=number_format($cnt)?>
						</span>
						<span class="s_box_txt">
							공간관리
						</span>
					</a>
					<?
					unset($cnt);
					unset($r_tmp_where);
					?>
				</div>
				<div class="s_menu_05 s_menu_wrap">
					<a href="#" class="s_menu">마이페이지</a>
					<div class="s_menu_in">
						<!-- <a href="<?=$n_talk?>" <?if($n_talk)	echo " target=\"_blank\"";?> class="s_menu_in_01">네이버톡톡</a> -->
						<a href="/member/space_host.php" class="s_menu_in_02">공간 정보</a>
						<a href="/member/member_info.php" class="s_menu_in_03">호스트 정보</a>
						<a href="/member/favorite.php" class="s_menu_in_06">내가 찜한 공간</a>
						<a href="/member/payment.php" class="s_menu_in_04">지불정보</a>
						<a href="/member/leave.php" class="s_menu_in_05">서비스 탈퇴</a>
					</div>
				</div>
				<div class="s_menu_06 s_menu_wrap">
					<a href="#" class="s_menu">GUEST</a>
					<div class="s_menu_in">
						<a href="/member/book_list.php?kind=1" class="s_menu_in_01">신청/결제</a>
						<a href="/member/book_list.php?kind=2" class="s_menu_in_02">취소/환불</a>
						<a href="/member/book_list.php?kind=3" class="s_menu_in_03">이용중</a>
						<a href="/member/book_list.php?kind=4" class="s_menu_in_04">이용완료</a>
					</div>
				</div>
				<?require "right_menu.php";?>
			</div>
			<a href="/member/member_info.php" class="s_go_mypage">
				마이페이지
			</a>
			<a href="#" class="s_menu_close_btn"></a>
		</div>
		<!--호스트 로그인 이후 끝-->
		<?}?>
	<?}?>
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
