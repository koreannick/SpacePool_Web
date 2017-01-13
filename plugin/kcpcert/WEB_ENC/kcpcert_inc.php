<?
 
/* ============================================================================== */
/* =   PAGE : 인증 요청 PAGE                                                    = */
/* = -------------------------------------------------------------------------- = */
/* =   Copyright (c)  2012.02   KCP Inc.   All Rights Reserved.                 = */
/* ============================================================================== */

/* ============================================================================== */
/* =   Hash 데이터 생성 필요 데이터                                             = */
/* = -------------------------------------------------------------------------- = */
/* = 사이트코드 ( up_hash 생성시 필요 )                                         = */
/* = -------------------------------------------------------------------------- = */

$site_cd   = 'A7FKG';
/* = -------------------------------------------------------------------------- = */
?>

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
<input type="hidden" name="site_cd"      value="<?= $site_cd ?>" />
<!-- Ret_URL : 인증결과 리턴 페이지 ( 가맹점 URL 로 설정해 주셔야 합니다. ) -->
<input type="hidden" name="Ret_URL"      value="http://<?=$_SERVER["HTTP_HOST"]?>/plugin/kcpcert/WEB_ENC/kcpcert_proc_req.php" style="width:400px" />
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