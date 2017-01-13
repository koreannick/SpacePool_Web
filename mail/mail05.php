<?
$mail_subject = "[] ".$guest_name."님의 예약 및 결제가 신청 되었습니다.";
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
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img05.jpg\">
		</div>
		<div class=\"mail_txt\">
			 <b>".$guest_name."님의 예약 및 결제가 신청 되었습니다. </b><br>
			결제내역을 확인하시고 승인해주세요. <br>
		결제승인이 되어야 게스트가 영수증을 받을 수 있습니다. </div>
	</div>





</div>
</body>
</html>";