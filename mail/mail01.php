<?
$mail_subject = "[] 결제가 호스트에 의해 승인되었습니다.";
$mail_content = "<!doctype html>
<html>
<head>
<meta charset=\"utf-8\">
<title>스페이스풀</title>
<link href=\"http://".$CONF_SITE_DOMAIN."/css/base.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"http://".$CONF_SITE_DOMAIN."/css/mail.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>
<body>
<div id=\"wrap\" class=\"mail_wrap\">
	<div class=\"mail\">
	<div class=\"mail_tlt\">
		<img src=\"http://".$CONF_SITE_DOMAIN."/images/common/logo.png\">
	</div>


	<div class=\"mail_box\">
		<div class=\"mail_img\">
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img01.jpg\">
		</div>
		<div class=\"mail_txt\">
			<b>결제가 호스트에 의해 승인되었습니다.</b> <br>
			지정된 입주날짜에 입주하시기 바랍니다. <a class=\"mail_btn\" href=\"http://".$CONF_SITE_DOMAIN."/member/book_list.php?kind=1\" target=\"_blank\">결제승인 확인하러 가기</a>
		</div>
	</div>



</div>
</body>
</html>";