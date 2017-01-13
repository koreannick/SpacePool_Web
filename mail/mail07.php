<?
$mail_subject = "[] 3일 후에 ".$guest_name."님이 사용중인 공간의 사용기한이 만료됩니다.";
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
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img07.jpg\">
		</div>
		<div class=\"mail_txt\">
			 <b>3일 후에 ".$guest_name."님이 사용중인 공간의 사용기한이 만료됩니다.</b><br>
			새로운 게스트를 얻는 데는 오랜 시간이 걸릴지도 모릅니다.<br>
			 현재 게스트와의 쉐어링 기간을 늘여보는 것은 어떨까요? <br>
			연장은 게스트가 연장신청을 하면 됩니다.
		</div>
	</div>




</div>
</body>
</html>";