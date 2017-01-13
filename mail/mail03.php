<?
$mail_subject = "[] 3일 후에 회원님이 사용중인 공간의 사용기한이 만료됩니다.";
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
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img03.jpg\">
		</div>
		<div class=\"mail_txt\">
			 <b>3일 후에 회원님이 사용중인 공간의 사용기한이 만료됩니다.</b><br>
			SpacePool에서 당신의 공간사용을 연장하세요
			<a class=\"mail_btn\">연장하기</a>
		</div>
	</div>




</div>
</body>
</html>";