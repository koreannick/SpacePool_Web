<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

if($USESSION[0]){
	if($mode=="insert"||$mode=="insert_ok"){
		$mode = "edit";
	}elseif($mode=="login"||$mode=="login_ok"||$mode=="idcheck"||$mode=="idpassfind"||$mode=="idpassfind_result"||!$mode){
		echo "<script>alert('이미 로그인되어있습니다.');history.back();</script>";
		exit;
	}
}

$t_member = "es_member";

if(!$connect)		$connect = dbcon();
 
// 페이지 찾기 //////////////////////////////////////
if(!$mode){	$mode = "insert";	}
if($mode=="insert")				$mode = "yack";
elseif($mode=="yack_ok")		$mode = "insert";

if($mode=="insert"){
	if($agree1!="Y"||$agree2!="Y"||$agree3!="Y"||$agree4!="Y"){
		redir_proc($CONF_MEMBER_FILE, "약관에 동의하셔야 회원가입이 가능합니다.");
	}
}

if(substr($mode,strrpos($mode,"_")) == "_ok"){
	$page_source = "/s_source/member/_all_ok.php";
	include_once($_SERVER["DOCUMENT_ROOT"] . $page_source);
	exit();
}else{
	$page_source = "/s_source/member/_" . $mode . ".php";
}
// 페이지 재설정
if($mode == "edit"){
	$page_source = "/s_source/member/_insert.php";
	$page_title = "회원정보수정";
	if(!$USESSION[0])		redir_proc($CONF_MEMBER_FILE."?mode=login", "로그인하셔야합니다.");
}elseif($mode == "leave"){
	$page_title = "회원탈퇴";
	if(!$USESSION[0])		redir_proc($CONF_MEMBER_FILE."?mode=login", "로그인하셔야합니다.");

}elseif($mode == "idcheck"||$mode=="idpassfind_result"){
	$CONF_SKIN = 2;
}elseif($mode=="login"){
	$page_title = "로그인";
}elseif($mode=="yack"){
	if($USESSION[0])		redir_proc($CONF_MEMBER_FILE."?mode=edit","");
	$page_title = "회원가입약관";
}elseif($mode=="insert"){
	$page_title = "회원가입";
}elseif($mode=="end"){
	$page_title = "회원가입완료";
}elseif($mode=="idpassfind"){
	$page_title = "아이디/비번 찾기";
}

if(!file_exists($_SERVER[DOCUMENT_ROOT].$page_source)){
	redir_proc("/","존재하지않는 페이지입니다.");
}

if($CONF_SKIN == 2){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/top_blank.php");
	include_once($_SERVER["DOCUMENT_ROOT"] . $page_source);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/bottom_blank.php");
	exit();
}
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
						<?if($mode=="yack"||$mode=="insert"||$mode=="end"){?>
						<div class="page_label_wrap">
							<div class="page_label">회원가입</div>
						</div>
						<div class="mber_label_wrap">
							<div class="mber_label<?if($mode=="yack")		echo " active";?>">
								<div class="mber_label_in">
									<div>약관동의</div>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label<?if($mode=="insert")		echo " active";?>">
								<div class="mber_label_in">
									<div>회원정보입력</div>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label<?if($mode=="end")		echo " active";?>">
								<div class="mber_label_in">
									<div>가입완료</div>
								</div>
							</div>
						</div>
						<?}else{?>
						<div class="page_label_wrap">

						</div>
						<div class="mber_label_wrap">
							<div class="mber_label ">
								<div class="mber_label_in">
									<a href="/member/member.php">회원가입</a>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label<?if($mode=="login")		echo " active";?>">
								<div class="mber_label_in">
									<a href="/member/member.php?mode=login">로그인</a>
								</div>
							</div>
							<div class="mber_label_arr"></div>
							<div class="mber_label<?if($mode=="idpassfind")		echo " active";?>">
								<div class="mber_label_in">
									<a href="/member/member.php?mode=idpassfind">아이디/비밀번호 찾기</a>
								</div>
							</div>
						</div>
						<?}?>
						<?include_once($_SERVER[DOCUMENT_ROOT] . $page_source);?>
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