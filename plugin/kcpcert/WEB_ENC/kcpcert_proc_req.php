<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

    /* ============================================================================== */
    /* =   ����â ȣ�� �� ���� ������                                               = */
    /* = -------------------------------------------------------------------------- = */
    /* =   �ش� �������� �ݵ�� ������ ������ ���ε� �Ǿ�� �ϸ�                    = */ 
    /* =   ������ �������� ����Ͻñ� �ٶ��ϴ�.                                     = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   ���̺귯�� ���� Include                                                  = */
    /* = -------------------------------------------------------------------------- = */

    require "../lib/ct_cli_lib.php";

    /* = -------------------------------------------------------------------------- = */
    /* =   ���̺귯�� ���� Include END                                               = */
    /* ============================================================================== */
?>
 
<?
   // $home_dir      = "/var/www/html/kcpcert_enc_linux_php"; // ct_cll ������ ( bin ������ )
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
    /*  :: ��ü �Ķ���� �����                                               */
    /*------------------------------------------------------------------------*/

  /*
            // !!up_hash ������ ������ ���� ����
            // year , month , day �� ��� �ִ� ��� "00" , "00" , "00" ���� ������ �˴ϴ�
            // �׿��� ���� ���� ��� ""(null) �� �����Ͻø� �˴ϴ�.
            // up_hash ������ ������ site_cd �� ordr_idxx �� �ʼ� ���Դϴ�.
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

        // ����â���� �ѱ�� form ������ ���� �ʵ� ( up_hash )
        $sbParam .= "<input type='hidden' name='up_hash' value='" . $up_hash . "'/>";
   
    $ct_cert->mf_clear();
*/
 $cert_url = 'https://cert.kcp.co.kr/kcp_cert/cert_view.jsp';
?>


<form name="form_auth" method="post" target="auth_popup" action="<?php echo $cert_url ?>">
<!-- �������� -->
<input type="hidden" name="user_name"    value="<?=$name?>" />
<!-- �ֹ���ȣ -->
<input type="hidden" name="ordr_idxx"    value="<?php echo $ordr_idxx ?>">
<!-- ��û���� -->
<input type="hidden" name="req_tx"       value="cert"/>
<!-- �������� -->
<input type="hidden" name="cert_type"    value="01"/>
<!-- ������Ʈ���̵� -->
<input type="hidden" name="web_siteid"   value="<?=$web_siteid?>"/>
<!-- ���� ��Ż� default ó���� �Ʒ��� �ּ��� �����ϰ� ����Ͻʽÿ�
     SKT : SKT , KT : KTF , LGU+ : LGT
<input type="hidden" name="fix_commid"      value="KTF"/>
-->
<!-- ����Ʈ�ڵ� -->
<input type="hidden" name="site_cd"      value="<?php echo $site_cd; ?>" />
<!-- Ret_URL : ������� ���� ������ ( ������ URL �� ������ �ּž� �մϴ�. ) -->
<input type="hidden" name="Ret_URL"      value="http://spacepool.co.kr/plugin/kcpcert/WEB_ENC/kcpcert_proc_res.php" />
<!-- cert_otp_use �ʼ� ( �޴��� ����)
     Y : �Ǹ� Ȯ�� + OTP ���� Ȯ�� , N : �Ǹ� Ȯ�� only
-->
<input type="hidden" name="cert_otp_use" value="Y"/>
<!-- cert_enc_use �ʼ� (������ : �޴��� ����) -->
<input type="hidden" name="cert_enc_use" value="Y"/>

<input type="hidden" name="res_cd"       value=""/>
<input type="hidden" name="res_msg"      value=""/>

<input type="hidden" name="up_hash" value="<?php echo $up_hash; ?>"/>

<!-- up_hash ���� �� ���� �ʵ� -->
<input type="hidden" name="veri_up_hash" value=""/>

<!-- ������ ��� �ʵ� (�����Ϸ�� ����)-->
<input type="hidden" name="param_opt_1"  value="opt1"/>
<input type="hidden" name="param_opt_2"  value="opt2"/>
<input type="hidden" name="param_opt_3"  value="opt3"/>
</form>

<script>
document.form_auth.submit();
</script>
