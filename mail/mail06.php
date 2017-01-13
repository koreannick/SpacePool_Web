<?
$mail_subject = "[] 결제가 정상적으로 취소되었습니다.";
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
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img06.jpg\">
		</div>
		<div class=\"mail_txt\">
			 <b>예약이 정상적으로 취소되었습니다.</b> <br>
			SpacePool에서 취소내역을 확인하세요.
			<a class=\"mail_btn\" href=\"http://".$CONF_SITE_DOMAIN."/member/host_book_list.php?kind=3\" target=\"_blank\">취소확인</a>
		</div>
	</div>



</div>
</body>
</html>";