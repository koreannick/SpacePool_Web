<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

    /* ============================================================================== */
    /* =   인증창 호출 및 수신 페이지                                               = */
    /* = -------------------------------------------------------------------------- = */
    /* =   해당 페이지는 반드시 가맹점 서버에 업로드 되어야 하며                    = */ 
    /* =   가급적 수정없이 사용하시기 바랍니다.                                     = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   라이브러리 파일 Include                                                  = */
    /* = -------------------------------------------------------------------------- = */

    require "../lib/ct_cli_lib.php";

    /* = -------------------------------------------------------------------------- = */
    /* =   라이브러리 파일 Include END                                               = */
    /* ============================================================================== */
?>
 
<?
   // $home_dir      = "/var/www/html/kcpcert_enc_linux_php"; // ct_cll 절대경로 ( bin 전까지 )
   	$home_dir = "/home/hosting_users/lucaspark90/www/plugin/kcpcert";
    $req_tx        = "cert";
	$cert_method ='01';
	$web_siteid = 'J17010201484';
    $site_cd       = "A7FKG";

    $ordr_idxx     =  date('Ymdhis');
  //  $ordr_idxx = get_session('ss_uniqid');
    $year          = "00";
    $month         = "00";
    $day           = "00";
    $user_name     = "<?=$name?>";
    $sex_code      = "";
    $local_code    = "";

    $cert_able_yn  = "";
    $web_siteid    = "J17010201484";
    $web_siteid_hashYN    = "Y";
    
    $up_hash       = "";
	/*------------------------------------------------------------------------*/
    /*  :: 전체 파라미터 남기기                                               */
    /*------------------------------------------------------------------------*/

  /*
            // !!up_hash 데이터 생성시 주의 사항
            // year , month , day 가 비어 있는 경우 "00" , "00" , "00" 으로 설정이 됩니다
            // 그외의 값은 없을 경우 ""(null) 로 세팅하시면 됩니다.
            // up_hash 데이터 생성시 site_cd 와 ordr_idxx 는 필수 값입니다.
            $hash_data = $site_cd                  .
                         $ordr_idxx                .
                         $web_siteid               .
                         $user_name                .
                         f_get_parm_int ( $year  ) .
                         f_get_parm_int ( $month ) .
                         f_get_parm_int ( $day   ) .
                         $sex_code                 .
                         $local_code; 
      
        $up_hash = $ct_cert->make_hash_data( $home_dir, $hash_data );

        // 인증창으로 넘기는 form 데이터 생성 필드 ( up_hash )
        $sbParam .= "<input type='hidden' name='up_hash' value='" . $up_hash . "'/>";
   
    $ct_cert->mf_clear();
*/
 $cert_url = 'https://cert.kcp.co.kr/kcp_cert/cert_view.jsp';
?>


<form name="form_auth" method="post" target="auth_popup" action="<?php echo $cert_url ?>">
<!-- 유저네임 -->
<input type="hidden" name="user_name"    value="<?=$name?>" />
<!-- 주문번호 -->
<input type="hidden" name="ordr_idxx"    value="<?php echo $ordr_idxx ?>">
<!-- 요청종류 -->
<input type="hidden" name="req_tx"       value="cert"/>
<!-- 인증종류 -->
<input type="hidden" name="cert_type"    value="01"/>
<!-- 웹사이트아이디 -->
<input type="hidden" name="web_siteid"   value="<?=$web_siteid?>"/>
<!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요
     SKT : SKT , KT : KTF , LGU+ : LGT
<input type="hidden" name="fix_commid"      value="KTF"/>
-->
<!-- 사이트코드 -->
<input type="hidden" name="site_cd"      value="<?php echo $site_cd; ?>" />
<!-- Ret_URL : 인증결과 리턴 페이지 ( 가맹점 URL 로 설정해 주셔야 합니다. ) -->
<input type="hidden" name="Ret_URL"      value="http://spacepool.co.kr/plugin/kcpcert/WEB_ENC/kcpcert_proc_res.php" />
<!-- cert_otp_use 필수 ( 메뉴얼 참고)
     Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
-->
<input type="hidden" name="cert_otp_use" value="Y"/>
<!-- cert_enc_use 필수 (고정값 : 메뉴얼 참고) -->
<input type="hidden" name="cert_enc_use" value="Y"/>

<input type="hidden" name="res_cd"       value=""/>
<input type="hidden" name="res_msg"      value=""/>

<input type="hidden" name="up_hash" value="<?php echo $up_hash; ?>"/>

<!-- up_hash 검증 을 위한 필드 -->
<input type="hidden" name="veri_up_hash" value=""/>

<!-- 가맹점 사용 필드 (인증완료시 리턴)-->
<input type="hidden" name="param_opt_1"  value="opt1"/>
<input type="hidden" name="param_opt_2"  value="opt2"/>
<input type="hidden" name="param_opt_3"  value="opt3"/>
</form>

<script>
document.form_auth.submit();
</script>
