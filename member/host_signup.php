<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

$result = mysql_query("select * from es_member where email='$USESSION[0]'");
if($result&&mysql_num_rows($result)>0){
	$r = mysql_fetch_array($result);
	foreach($r as $key=>$val){
		$$key = stripslashes($val);
	}

	if($m_kind=="m2"){
		redir_proc("/member/member_info.php","이미 HOST회원이십니다.");
		exit;
	}

	if($tel){
		$tel_arr = explode("-",$tel);
		$tel1 = $tel_arr[0];
		$tel2 = $tel_arr[1];
		$tel3 = $tel_arr[2];
	}
	if($mobile){
		$mobile_arr = explode("-",$mobile);
		$mobile1 = $mobile_arr[0];
		$mobile2 = $mobile_arr[1];
		$mobile3 = $mobile_arr[2];
	}
}
@mysql_free_result($result);
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
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
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return;
		}
	}
	frm.mode.value = "edit_ok";
	frm.submit();
}
</script>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_member m_list">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<div class="s_view_wrap">
						<div class="page_label_wrap">
							<div class="page_label">호스트 전환</div>
						</div>
						<div class="s_view_desc">
							<form name="form0" method="post" action="/member/member.php" target="tempFrame">
								<input type="hidden" name="mode" value="edit_ok">
								<input type="hidden" name="host" value="ok">
								<div class="s_view_info_wrap">
									<div class="s_view_info_label_wrap">
										<div class="s_view_info_label">추가 정보 입력
											<span class="label_span"><b>*</b> 표시는 필수입력 항목입니다.</span>
										</div>
										<span class="s_view_info_label_line"></span>
									</div>
									<?require "member_form.php";?>
								</div>
							</form>
						</div>
						<div class="cm_wrap">
							<a href="javascript:Save_go();" class="cm_ok_btn">호스트전환</a>
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